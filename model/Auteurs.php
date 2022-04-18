<?php


class Auteurs
{
    private $auteur_id;
    private $nom;
    private $prenom;

    /**
     * Auteurs constructor.
     * @param $auteur_id
     * @param $nom
     * @param $prenom
     */
    public function __construct($auteur_id = null, $nom = null, $prenom = null)
    {
        $this->auteur_id = $auteur_id;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    private static function ParseAuteurFromBDD($BDDResult)
    {
        if($BDDResult)
        {
            return new Auteurs($BDDResult["auteur_id"], $BDDResult["nom"], $BDDResult["prenom"]);
        }
        else
            return false;
    }

    public static function all()
    {
        $auteurs = [];
        $results = (new BDD())->querySelect('SELECT * FROM auteurs');
        foreach ($results as $aResult) {
            $auteurs [] = self::ParseAuteurFromBDD($aResult);
        }
        return $auteurs;
    }

    public static function oneByID($id)
    {
        $result = (new BDD())->querySelectOne('SELECT * FROM auteurs WHERE auteur_id=:id;', ['id' => $id]);
        return self::ParseAuteurFromBdd($result);
    }

    public function save()
    {
        if (isset($this->auteur_id)) {
            $sql = "UPDATE auteurs
                    SET nom = :nom, prenom = :pre
                    WHERE auteurs.auteur_id = :id;";
            $data = [
                'nom' => $this->nom,
                'pre' => $this->prenom,
                'id' => $this->auteur_id,
            ];
        } else {
            $sql = "INSERT INTO auteurs (nom, prenom) VALUES (:nom, :pre);";
            $data = [
                'nom' => $this->nom,
                'pre' => $this->prenom,
            ];
        }

        return (new BDD())->queryAction($sql, $data);
    }

    public function remove()
    {
        $result = (new BDD())->queryAction('DELETE FROM auteurs WHERE auteurs.auteur_id = :id', [
            'id' => $this->auteur_id,
        ]);
        unset($this->nom);
        unset($this->prenom);
        unset($this->auteur_id);
        return $result;
    }

    /**
     * @return mixed
     */
    public function getAuteurId()
    {
        return $this->auteur_id;
    }

    /**
     * @param mixed $auteur_id
     */
    public function setAuteurId($auteur_id)
    {
        $this->auteur_id = $auteur_id;
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


}