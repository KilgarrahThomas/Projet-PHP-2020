<?php


class Clients
{
    const LevelUser = 0;
    const LevelAdministrateur = 1;
    const LevelRoot = 2;

    private $client_id;
    private $nom;
    private $prenom;
    private $mail;
    private $mdp;
    private $date_naiss;
    private $visibility_collec;
    private $visibility_whislist;
    private $level;
    private $rememberMe;

    /**
     * Clients constructor.
     * @param $client_id
     * @param $nom
     * @param $prenom
     * @param $mail
     * @param $mdp
     * @param $date_naiss
     * @param $visibility_collec
     * @param $visibility_whislist
     * @param $admin
     */
    public function __construct($client_id = NULL, $nom = NULL, $prenom = NULL, $mail = NULL, $mdp = NULL, $date_naiss = NULL, $visibility_collec = NULL, $visibility_whislist = NULL, $admin = NULL)
    {
        $this->client_id = $client_id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->mdp = $mdp;
        $this->date_naiss = new DateTime($date_naiss);
        $this->visibility_collec = $visibility_collec;
        $this->visibility_whislist = $visibility_whislist;
        $this->level = $admin;
    }

    private static function ParseClientFromBDD($BDDResult)
    {
        if($BDDResult)
        {
            return new Clients($BDDResult["client_id"], $BDDResult["nom"], $BDDResult["prenom"], $BDDResult["mail"], $BDDResult["mdp"], $BDDResult["date_naiss"], $BDDResult["visibility_collec"], $BDDResult["visibility_wishlist"], $BDDResult["niveau"]);
        }
        else
            return false;
    }

    public static function all()
    {
        $clients = [];
        $results = (new BDD())->querySelect('SELECT * FROM clients');
        foreach ($results as $aResult) {
            $clients [] = self::ParseClientFromBDD($aResult);
        }
        return $clients;
    }

    public static function oneByID($id)
    {
        $result = (new BDD())->querySelectOne('SELECT * FROM clients WHERE client_id=:id;', ['id' => $id]);
        return self::ParseClientFromBDD($result);
    }

    public static function oneByMail($mail)
    {
        $result = (new BDD())->querySelectOne('SELECT * FROM clients WHERE mail=:mail;', ['mail' => $mail]);
        return self::ParseClientFromBDD($result);
    }

    public function save()
    {
        if (isset($this->client_id)) {
            $sql = "UPDATE clients
SET nom = :nom, prenom = :prenom, mail = :mail, mdp = :mdp, date_naiss = :dn, visibility_collec = :vc, visibility_wishlist = :vw, niveau = :lvl
WHERE clients.client_id = :cid;";
            $data = [
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'mail' => $this->mail,
                'mdp' => $this->mdp,
                'dn' => $this->date_naiss->format('Y-m-d H:i:s'),
                'vc' => intval($this->visibility_collec),
                'vw' => intval($this->visibility_whislist),
                'lvl' => intval($this->level),
                'cid' => $this->client_id
            ];
        } else {
            $sql = "INSERT INTO clients (nom, prenom, mail, mdp, date_naiss) VALUES (:nom, :prenom, :mail, :mdp, :dn);";
            $data = [
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'mail' => $this->mail,
                'mdp' => $this->mdp,
                'dn' => $this->date_naiss->format('Y-m-d H:i:s')
            ];
        }

        return (new BDD())->queryAction($sql, $data);
    }

    public function remove()
    {
        $result = (new BDD())->queryAction('DELETE FROM clients WHERE clients.client_id = :id', [
            'id' => $this->client_id,
        ]);
        unset($this->client_id);
        unset($this->nom);
        unset($this->prenom);
        unset($this->mail);
        unset($this->mdp);
        unset($this->date_naiss);
        unset($this->visibility_collec);
        unset($this->visibility_whislist);
        unset($this->level);
        return $result;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param mixed $client_id
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @param $notCryptedMdp
     */
    public function setPwd($notCryptedMdp)
    {
        $this->mdp = password_hash($notCryptedMdp, PASSWORD_DEFAULT, ['cost' => 10,]);
    }

    /**
     * @param $notCryptedMdp
     * @return bool
     */
    public function checkPwd($notCryptedMdp)
    {
        return password_verify($notCryptedMdp, $this->mdp);
    }


    /**
     * @return mixed
     */
    public function getDateNaiss()
    {
        return $this->date_naiss;
    }

    public function getAge()
    {
        return $this->date_naiss->diff(new DateTime())->format('%Y');
    }

    /**
     * @param mixed $date_naiss
     */
    public function setDateNaiss($date_naiss)
    {
        $this->date_naiss = $date_naiss;
    }

    /**
     * @return mixed
     */
    public function getVisibilityCollec()
    {
        return $this->visibility_collec;
    }

    /**
     * @param mixed $visibility_collec
     */
    public function setVisibilityCollec($visibility_collec)
    {
        $this->visibility_collec = $visibility_collec;
    }

    /**
     * @return mixed
     */
    public function getVisibilityWhislist()
    {
        return $this->visibility_whislist;
    }

    /**
     * @param mixed $visibility_whislist
     */
    public function setVisibilityWhislist($visibility_whislist)
    {
        $this->visibility_whislist = $visibility_whislist;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return intval($this->level);
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getRememberMe()
    {
        return $this->rememberMe;
    }

    /**
     * @param mixed $remeberMe
     */
    public function setRememberMe($remeberMe)
    {
        $this->remeberMe = $remeberMe;
    }

    /**
     * @return bool
     */
    public function isAdministrator()
    {
        switch ($this->level) {
            case self::LevelRoot:
            case self::LevelAdministrateur:
                return true;
            case self::LevelUser :
            default:
                return false;
        }
    }

    /**
     * @return bool
     */
    public function isRoot()
    {
        switch ($this->level) {
            case self::LevelRoot:
                return true;
            case self::LevelAdministrateur:
            case self::LevelUser :
            default:
                return false;
        }
    }




}