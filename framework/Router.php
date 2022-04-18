<?php


class Router
{
    private static $config = [
        "GET" => [
            //NoLogin
            "Index" => ['Controller' => 'ControllerIndex', 'Function' => 'index', 'Level' => Auth::LevelUnauthenticated],
            "Connexion" => ['Controller' => 'ControllerConnexion', 'Function' => 'index', 'Level' => Auth::LevelUnauthenticated],
            "Inscription" => ['Controller' => 'ControllerClient', 'Function' => 'inscription', 'Level' => Auth::LevelUnauthenticated],
            "404" => ['Controller' => 'ControllerError', 'Function' => 'error404', 'Level' => Auth::LevelUnauthenticated],

            //User
            "Logout" => ['Controller' => 'ControllerConnexion', 'Function' => 'logout', 'Level' => Auth::LevelUser],
            "Bibli" => ['Controller' => 'ControllerLivre', 'Function' => 'bibli', 'Level' => Auth::LevelUser],
            "Collection" => ['Controller' => 'ControllerCollection', 'Function' => 'read', 'Level' => Auth::LevelUser],
            "Souhaits" => ['Controller' => 'ControllerCollection', 'Function' => 'wished', 'Level' => Auth::LevelUser],
            "Compte" => ['Controller' => 'ControllerClient', 'Function' => 'compte', 'Level' => Auth::LevelUser],
            "ClientUpdate" => ['Controller' => 'ControllerClient', 'Function' => 'formUser', 'Level' => Auth::LevelUser],
            "PWDUpdate" => ['Controller' => 'ControllerConnexion', 'Function' => 'indexChangePassword', 'Level' => Auth::LevelUser],
            "SelfDelete" => ['Controller' => 'ControllerClient', 'Function' => 'userRemove', 'Level' => Auth::LevelUser],
            "Contact" => ['Controller' => 'ControllerContact', 'Function' => 'form', 'Level' => Auth::LevelUser],

            //Admin
            "Messages" => ['Controller' => 'ControllerContact', 'Function' => 'message', 'Level' => Auth::LevelAdministrateur],
            "Auteur" => ['Controller' => 'ControllerAuteur', 'Function' => 'index', 'Level' => Auth::LevelAdministrateur],
            "Clients" => ['Controller' => 'ControllerClient', 'Function' => 'liste', 'Level' => Auth::LevelAdministrateur],
            "Edition" => ['Controller' => 'ControllerEdition', 'Function' => 'index', 'Level' => Auth::LevelAdministrateur],
            "Genre" => ['Controller' => 'ControllerGenre', 'Function' => 'index', 'Level' => Auth::LevelAdministrateur],
            "Livre" => ['Controller' => 'ControllerLivre', 'Function' => 'index', 'Level' => Auth::LevelAdministrateur],
            "Visibility" => ['Controller' => 'ControllerVisibility', 'Function' => 'index', 'Level' => Auth::LevelAdministrateur],

            "AllMessageDel" => ['Controller' => 'ControllerContact', 'Function' => 'removeAll', 'Level' => Auth::LevelAdministrateur],


            "Info" => ['Controller' => 'ControllerIndex', 'Function' => 'info', 'Level' => Auth::LevelRoot],
        ],
        "POST" => [
            "ConnexionPost" => ['Controller' => 'ControllerConnexion', 'Function' => 'login', 'Level' => Auth::LevelUnauthenticated],

            "NewClient" => ['Controller' => 'ControllerClient', 'Function' => 'newClient', 'Level' => Auth::LevelUnauthenticated],

            "ComptePost" => ['Controller' => 'ControllerClient', 'Function' => 'storeClient', 'Level' => Auth::LevelUser],
            "PWDPost" => ['Controller' => 'ControllerConnexion', 'Function' => 'changePassword', 'Level' => Auth::LevelUser],

            "LivreDetail" => ['Controller' => 'ControllerLivre', 'Function' => 'detail', 'Level' => Auth::LevelUser],

            "ContactPost" => ['Controller' => 'ControllerContact', 'Function' => 'store', 'Level' => Auth::LevelUser],

            "CollectionSouhait" => ['Controller' => 'ControllerCollection', 'Function' => 'souhait', 'Level' => Auth::LevelUser],
            "CollectionLu" => ['Controller' => 'ControllerCollection', 'Function' => 'lu', 'Level' => Auth::LevelUser],
            "CollectionNote" => ['Controller' => 'ControllerCollection', 'Function' => 'form', 'Level' => Auth::LevelUser],
            "CollectionPost" => ['Controller' => 'ControllerCollection', 'Function' => 'note', 'Level' => Auth::LevelUser],
            "CollectionDel" => ['Controller' => 'ControllerCollection', 'Function' => 'remove', 'Level' => Auth::LevelUser],

            "AuteurEdit" => ['Controller' => 'ControllerAuteur', 'Function' => 'form', 'Level' => Auth::LevelAdministrateur],
            "AuteurPost" => ['Controller' => 'ControllerAuteur', 'Function' => 'store', 'Level' => Auth::LevelAdministrateur],
            "AuteurDel" => ['Controller' => 'ControllerAuteur', 'Function' => 'remove', 'Level' => Auth::LevelAdministrateur],

            "ClientEdit" => ['Controller' => 'ControllerClient', 'Function' => 'form', 'Level' => Auth::LevelAdministrateur],
            "ClientPost" => ['Controller' => 'ControllerClient', 'Function' => 'store', 'Level' => Auth::LevelAdministrateur],
            "ClientDel" => ['Controller' => 'ControllerClient', 'Function' => 'remove', 'Level' => Auth::LevelAdministrateur],

            "EditionEdit" => ['Controller' => 'ControllerEdition', 'Function' => 'form', 'Level' => Auth::LevelAdministrateur],
            "EditionPost" => ['Controller' => 'ControllerEdition', 'Function' => 'store', 'Level' => Auth::LevelAdministrateur],
            "EditionDel" => ['Controller' => 'ControllerEdition', 'Function' => 'remove', 'Level' => Auth::LevelAdministrateur],

            "GenreEdit" => ['Controller' => 'ControllerGenre', 'Function' => 'form', 'Level' => Auth::LevelAdministrateur],
            "GenrePost" => ['Controller' => 'ControllerGenre', 'Function' => 'store', 'Level' => Auth::LevelAdministrateur],
            "GenreDel" => ['Controller' => 'ControllerGenre', 'Function' => 'remove', 'Level' => Auth::LevelAdministrateur],

            "LivreShow" => ['Controller' => 'ControllerLivre', 'Function' => 'show', 'Level' => Auth::LevelAdministrateur],
            "LivreEdit" => ['Controller' => 'ControllerLivre', 'Function' => 'form', 'Level' => Auth::LevelAdministrateur],
            "LivrePost" => ['Controller' => 'ControllerLivre', 'Function' => 'store', 'Level' => Auth::LevelAdministrateur],
            "LivreDel" => ['Controller' => 'ControllerLivre', 'Function' => 'remove', 'Level' => Auth::LevelAdministrateur],

            "MessageDel" => ['Controller' => 'ControllerContact', 'Function' => 'remove', 'Level' => Auth::LevelAdministrateur],

            "VisibiliteEdit" => ['Controller' => 'ControllerVisibility', 'Function' => 'form', 'Level' => Auth::LevelAdministrateur],
            "VisibilitePost" => ['Controller' => 'ControllerVisibility', 'Function' => 'store', 'Level' => Auth::LevelAdministrateur],
            "VisibiliteDel" => ['Controller' => 'ControllerVisibility', 'Function' => 'remove', 'Level' => Auth::LevelAdministrateur],
        ],
        "HEAD" => [],
        "PUT" => [],
    ];

    private static $pages;

    private static function getPages()
    {
        if (!isset(self::$pages)) {
            self::$pages = [];
            foreach (self::$config as $key => $value) {
                self::$pages[$key] = array_keys($value);
            }
        }
        return self::$pages;
    }

    private static $pagesWhitOutMethod;

    private static function getPagesWhitOutMethod()
    {
        if (!isset(self::$pagesWhitOutMethod)) {
            self::$pagesWhitOutMethod = [];
            foreach (self::$config as $key => $value) {
                self::$pagesWhitOutMethod = array_merge(self::$pagesWhitOutMethod, array_keys($value));
            }
        }
        return self::$pagesWhitOutMethod;
    }

    public static function run()
    {
        $pageToLoad = 'Index';

        if (isset($_GET['page']))
            $pageToLoad = Tools::sanitizeInput($_GET['page']);

        $pageAvailable = self::getPages()[$_SERVER['REQUEST_METHOD']];


        // On verifie si la page existe
        if (!in_array($pageToLoad, $pageAvailable, true)) {
            if (in_array($pageToLoad, self::getPagesWhitOutMethod(), true)) {
                // si le nom de la page existe dans le routeur
                (new ControllerError())->error405($pageToLoad.' '.$_SERVER['REQUEST_METHOD']);
                return;
            }
            // La page n'existe pas du tout
            (new ControllerError())->error404($pageToLoad);
            return;
        }

        $configToLoad = self::$config[$_SERVER['REQUEST_METHOD']][$pageToLoad];

        if (!Auth::checkLevel($configToLoad['Level'])) {
            (new ControllerError())->error403();
            return;
        }

        $CTRL = $configToLoad['Controller'];
        $FUNCT = $configToLoad['Function'];
        (new $CTRL())->$FUNCT();
        return;
    }

    /**
     * @param $pageToRedirect
     * @throws Exception
     */
    public static function Redirect($pageToRedirect)
    {
        header("LOCATION: " . self::GenerateRoute($pageToRedirect));
        return;
    }

    /**
     * @param $pageToRedirect
     * @param $messageType
     * @param $message
     * @throws Exception
     */
    public static function RedirectWhitMessage($pageToRedirect, $messageType, $message)
    {
        Message::addMessage($messageType, $message);
        self::Redirect($pageToRedirect);
    }

    /**
     * Renvoie l' URL de la page à chargé
     * @param $pageToLoad
     * @return string url d'acces
     * @throws Exception
     */
    public static function GenerateRoute($pageToLoad)
    {
        if (in_array($pageToLoad, array_keys(self::getPagesWhitOutMethod())))
            return '/index.php?page=' . $pageToLoad;
        else
            return self::GenerateRoute('404');
    }
}