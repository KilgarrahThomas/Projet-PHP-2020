<?php

class Configuration
{

    // Tableau des paramètres
    private static $parametres;

    // Renvoie la valeur d'un paramètre
    public static function get($nom, $valeurParDefaut = null)
    {
        $parametres = self::getParametres();

        if (isset($parametres[$nom])) {
            $valeur = $parametres[$nom];
        } else {
            $valeur = $valeurParDefaut;
        }

        return $valeur;
    }


    // Renvoie les paramètres en chargeant config.ini si besoin
    private static function getParametres()
    {
        if (self::$parametres == null) {
            $cheminFichier = "./Config/config.ini";

            if (!file_exists($cheminFichier)) {
                throw new Exception("Aucun fichier de configuration trouvé");
            } else {
                self::$parametres = parse_ini_file($cheminFichier, false);
            }
        }

        return self::$parametres;
    }
}