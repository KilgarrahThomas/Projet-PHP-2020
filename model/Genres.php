<?php


class Genres
{
    private $genre_id;
    private $nom;
    private $genre_parent_id;

    /**
     * Genre constructor.
     * @param $genre_id
     * @param $nom
     * @param $genre_parent_id
     */
    public function __construct($genre_id = null, $nom = null, $genre_parent_id = null)
    {
        $this->genre_id = $genre_id;
        $this->nom = $nom;
        $this->genre_parent_id = $genre_parent_id;
    }

    private static function ParseGenreFromBDD($BDDResult)
    {
        if($BDDResult)
        {
            return new Genres($BDDResult["genre_id"], $BDDResult["nom"], $BDDResult["genre_parent_id"]);
        }
        else
            return false;
    }

    public static function all()
    {
        $genres = [];
        $results = (new BDD())->querySelect('SELECT * FROM genres');
        foreach ($results as $aResult) {
            $genres [] = self::ParseGenreFromBDD($aResult);
        }
        return $genres;
    }

    public static function allWithoutParent()
    {
        $genres = [];
        $results = (new BDD())->querySelect('SELECT * FROM genres WHERE genre_parent_id IS NULL OR genre_parent_id = \'\'');
        foreach ($results as $aResult) {
            $genres [] = self::ParseGenreFromBDD($aResult);
        }
        return $genres;
    }

    public static function allByParentID($id)
    {
        $genres = [];
        $results = (new BDD())->querySelect('SELECT * FROM genres WHERE genre_parent_id=:id', ['id' => $id]);
        foreach ($results as $aResult) {
            $genres [] = self::ParseGenreFromBDD($aResult);
        }
        return $genres;
    }

    public static function oneByID($id)
    {
        $result = (new BDD())->querySelectOne('SELECT * FROM genres WHERE genre_id=:id;', ['id' => $id]);
        return self::ParseGenreFromBdd($result);
    }

    public function save()
    {
        if (isset($this->genre_id)) {
            $sql = "UPDATE genres
                    SET nom = :nom, genre_parent_id = :par
                    WHERE genres.genre_id = :id;";
            $data = [
                'nom' => $this->nom,
                'par' => $this->genre_parent_id,
                'id' => $this->genre_id,
            ];
        } else {
            $sql = "INSERT INTO genres (nom, genre_parent_id) VALUES (:nom, :par);";
            $data = [
                'nom' => $this->nom,
                'par' => $this->genre_parent_id,
            ];
        }

        return (new BDD())->queryAction($sql, $data);
    }

    public function remove()
    {
        $result = (new BDD())->queryAction('DELETE FROM genres WHERE genres.genre_id = :id', [
            'id' => $this->genre_id,
        ]);
        unset($this->genre_id);
        unset($this->nom);
        unset($this->genre_parent_id);
        return $result;
    }

    /**
     * @var Genres
     */
    private $parent;

    /**
     * @return Genres
     */
    public function getParent()
    {
        if (!isset($this->parent)) {
            $this->parent = self::oneByID($this->genre_parent_id);
        }
        return $this->parent;
    }

    private $origine;

    /**
     * @return Race
     */
    public function getOrigine()
    {

        if (isset($this->genre_parent_id)) {
            $origine = $this->getParent()->getOrigine();
            if ($origine)
                return $origine;
            else
                return $this->getParent()->getNom();
        } else {
            return null;
        }
    }

    /**
     * @var Race[]
     */
    private $enfant;

    /**
     * @return Race[]
     */
    public function getEnfants()
    {
        if (!isset($this->enfant)) {
            $this->enfant = self::allByParentID($this->genre_id);
        }
        return $this->enfant;
    }

    /**
     * @return mixed
     */
    public function getGenreId()
    {
        return $this->genre_id;
    }

    /**
     * @param mixed $genre_id
     */
    public function setGenreId($genre_id)
    {
        $this->genre_id = $genre_id;
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
    public function getGenreParentId()
    {
        return $this->genre_parent_id;
    }

    /**
     * @param mixed $genre_parent_id
     */
    public function setGenreParentId($genre_parent_id)
    {
        $this->genre_parent_id = $genre_parent_id;
    }


}