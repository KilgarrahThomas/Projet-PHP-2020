<?php


class Auth
{
    // Constante pour les niveaux de droit d'aministration
    const LevelUnauthenticated = -1;
    const LevelUser = 0;
    const LevelAdministrateur = 1;
    const LevelRoot = 2;


    public static function getLevelNameByLevel($level)
    {
        $data = [
            self::LevelUnauthenticated => 'Déconnecté',
            self::LevelUser => 'User',
            self::LevelAdministrateur => 'Administrateur',
            self::LevelRoot => 'Root',
        ];
        return $data[$level];
    }

    /**
     * @return bool
     * @throws Exception
     */
    public static function check()
    {
        $token = null;
        if (isset($_COOKIE['authentication'])) {
            // On recupere le token de la BDD si le cookie existe
           $token = AuthTokens::findFirstBySelector($_COOKIE['authentication']['s']);
        }

        if (!isset($_SESSION["authentication"])) {
            // L'utilisateur est deconnecté
            if (!$token) {
                return false;
            }
            if (!$token->validate($_COOKIE['authentication']['v'])) {
                return false;
            }
            $_SESSION["authentication"] = $token->getClient();
        }

        // L'utilisateur est connecté
        if ($token) {
            if ($token->getExpires() < strtotime("+1 year -1 days ")) {
                // On regenere le cookie 1 fois par jour
                $token->regenerate();
                if (self::setAuthToken($token)) {
                    $token->save();
                }

            }
        }

        return true;
    }

    /**
     * Return Client if loged in.
     * @return bool|Clients
     */
    public static function user()
    {
        if (isset($_SESSION["authentication"]))
            return $_SESSION["authentication"];
        return
            false;
    }

    /**
     * Remove session from serveur
     */
    public static function logout()
    {
        if (isset($_COOKIE['authentication'])) {
            $token = AuthTokens::findFirstBySelector($_COOKIE['authentication']['s']);

            if ($token) {
                $token->expire();
                self::setAuthToken($token);
            }
        }
        $_SESSION["authentication"] = null;
        $_COOKIE['authentication'] = null;
        unset($_SESSION["authentication"]);
        unset($_COOKIE['authentication']);
    }

    /**
     * Login return True if succes, false if error
     * @param $mail
     * @param $clearMdp
     * @return bool
     * @throws Exception
     */
    public static function login($mail, $clearMdp, $remeber = false)
    {
        $user = Clients::oneByMail($mail);
        $user->setRememberMe($remeber);
        if ($user) {
            if ($user->checkPwd($clearMdp)) {
                $_SESSION["authentication"] = $user;
                if ($remeber) {
                    $token = AuthTokens::generate($user);
                    if (self::setAuthToken($token)) {
                        $token->save();
                    }
                }
                return true;
            }
        }
        return false;
    }

    public static function checkLevel($authLevel)
    {
        if ($authLevel == self::LevelUnauthenticated) {
            // Dans tout les cas on a acces au page sans identification
            return true;
        }
        if (!self::check()) {
            // Pour tout les autres niveaux, il faut être authentifié.
            return false;
        }

        switch ($authLevel) {
            case self::LevelUser :
                return true;
                break;
            case self::LevelAdministrateur :
                return self::user()->isAdministrator();
                break;
            case self::LevelRoot  :
                return self::user()->isRoot();
                break;
        }
        return false;
    }

    private static function setAuthToken($token)
    {
        $result1 = setcookie("authentication[s]", $token->getSelector(), $token->getExpires());
        $result2 = setcookie("authentication[v]", $token->getValidator(), $token->getExpires());
        return $result1 && $result2;
    }

    public static function whoAmI(){
        $Client = null;
        if (Auth::check()) {
            $Client = Auth::user();
        }
        else
        {
            $Client = new Clients();
            $Client->setPrenom("Visiteur");
            $Client->setLevel(-1);
        }

        return $Client;
    }
}