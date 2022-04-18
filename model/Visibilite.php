<?php


class Visibilite
{
    private $visibility_id;
    private $nom;

    /**
     * Editions constructor.
     * @param $visibility_id
     * @param $nom
     */
    public function __construct($visibility_id = null, $nom = null)
    {
        $this->visibility_id = $visibility_id;
        $this->nom = $nom;
    }

    private static function ParseVisibiliteFromBDD($BDDResult)
    {

        if($BDDResult)
        {
            return new Visibilite($BDDResult["visibility_id"], $BDDResult["nom"]);
        }
        else
            return false;
    }

    public static function all()
    {
        $visibilites = [];
        $results = (new BDD())->querySelect('SELECT * FROM visibilite');
        foreach ($results as $aResult) {
            $visibilites [] = self::ParseVisibiliteFromBDD($aResult);
        }
        return $visibilites;
    }

    public static function oneByID($id)
    {
        $result = (new BDD())->querySelectOne('SELECT * FROM visibilite WHERE visibility_id=:id;', ['id' => $id]);
        return self::ParseVisibiliteFromBDD($result);
    }

    public function save()
    {
        if (isset($this->visibility_id)) {
            $sql = "UPDATE visibilite
                    SET nom = :nom
                    WHERE visibilite.visibility_id = :id;";
            $data = [
                'nom' => $this->nom,
                'id' => $this->visibility_id,
            ];
        } else {
            $sql = "INSERT INTO visibilite (nom) VALUES (:nom);";
            $data = [
                'nom' => $this->nom,
            ];
        }

        return (new BDD())->queryAction($sql, $data);
    }

    public function remove()
    {
        $result = (new BDD())->queryAction('DELETE FROM visibilite WHERE visibilite.visibility_id = :id', [
            'id' => $this->visibility_id,
        ]);
        unset($this->nom);
        unset($this->visibility_id);
        return $result;
    }

    /**
     * @return mixed
     */
    public function getVisibilityId()
    {
        return $this->visibility_id;
    }

    /**
     * @param mixed $visibility_id
     */
    public function setVisibilityId($visibility_id)
    {
        $this->visibility_id = $visibility_id;
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


}