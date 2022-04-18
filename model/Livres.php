<?php


class Livres
{
    private $livre_id;
    private $titre;
    private $auteur_id;
    private $edition_id;
    private $genre_id;
    private $sommaire;
    private $couverture_id;

    /**
     * Livres constructor.
     * @param $livre_id
     * @param $titre
     * @param $auteur_id
     * @param $edition_id
     * @param $genre_id
     * @param $sommaire
     * @param $couverture_id
     */
    public function __construct($livre_id = null, $titre = null, $auteur_id = null, $edition_id = null, $genre_id = null, $sommaire = null, $couverture_id = null)
    {
        $this->livre_id = $livre_id;
        $this->titre = $titre;
        $this->auteur_id = $auteur_id;
        $this->edition_id = $edition_id;
        $this->genre_id = $genre_id;
        $this->sommaire = $sommaire;
        $this->couverture_id = $couverture_id;
    }

    private static function ParseLivreFromBDD($BDDResult)
    {
        if($BDDResult)
        {
            return new Livres($BDDResult["livre_id"], $BDDResult["titre"], $BDDResult["auteur_id"], $BDDResult["edition_id"], $BDDResult["genre_id"], $BDDResult["sommaire"], $BDDResult["couverture_id"]);
        }
        else
            return false;
    }

    public static function all()
    {
        $livres = [];
        $results = (new BDD())->querySelect('SELECT * FROM livres');
        foreach ($results as $aResult) {
            $livres [] = self::ParseLivreFromBDD($aResult);
        }
        return $livres;
    }

    public static function oneByID($id)
    {
        $result = (new BDD())->querySelectOne('SELECT * FROM livres WHERE livre_id=:id;', ['id' => $id]);
        return self::ParseLivreFromBDD($result);
    }

    public function save()
    {
        if (isset($this->livre_id)) {
            $sql = "UPDATE livres
                    SET titre = :titre, genre_id = :gid, auteur_id = :aid, edition_id = :eid, sommaire = :som
                    WHERE livres.livre_id = :id;";
            $data = [
                'titre' => $this->titre,
                'gid' => $this->genre_id,
                'aid' => $this->auteur_id,
                'eid' => $this->edition_id,
                'som' => $this->sommaire,
                'id' => $this->livre_id,
            ];
        } else {
            $sql = "INSERT INTO livres (titre, auteur_id, edition_id, genre_id, sommaire) VALUES (:titre, :aid, :eid, :gid, :som);";
            $data = [
                'titre' => $this->titre,
                'gid' => $this->genre_id,
                'aid' => $this->auteur_id,
                'eid' => $this->edition_id,
                'som' => $this->sommaire,
            ];
        }

        return (new BDD())->queryAction($sql, $data);
    }

    public function remove()
    {
        $result = (new BDD())->queryAction('DELETE FROM livres WHERE livres.livre_id = :id', [
            'id' => $this->livre_id,
        ]);
        unset($this->livre_id);
        unset($this->titre);
        unset($this->auteur_id);
        unset($this->auteur);
        unset($this->genre_id);
        unset($this->genre);
        unset($this->edition_id);
        unset($this->edition);
        unset($this->sommaire);
        unset($this->couverture_id);
        return $result;
    }

    /**
     * @return mixed
     */
    public function getLivreId()
    {
        return $this->livre_id;
    }

    /**
     * @param mixed $livre_id
     */
    public function setLivreId($livre_id)
    {
        $this->livre_id = $livre_id;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
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
    public function getEditionId()
    {
        return $this->edition_id;
    }

    /**
     * @param mixed $edition_id
     */
    public function setEditionId($edition_id)
    {
        $this->edition_id = $edition_id;
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
    public function getSommaire()
    {
        return $this->sommaire;
    }

    /**
     * @param mixed $sommaire
     */
    public function setSommaire($sommaire)
    {
        $this->sommaire = $sommaire;
    }

    /**
     * @return mixed
     */
    public function getCouvertureId()
    {
        return $this->couverture_id;
    }

    /**
     * @param mixed $couverture_id
     */
    public function setCouvertureId($couverture_id)
    {
        $this->couverture_id = $couverture_id;
    }

    /**
     * @var Genres
     * @var Auteurs
     * @var Editions
     */
    private $genre;
    private $auteur;
    private $edition;

    /**
     * @return Genres
     */
    public function getGenre()
    {
        if (!isset($this->genre)) {
            $this->genre = Genres::oneByID($this->genre_id);
        }
        return $this->genre;
    }

    /**
     * @return Auteurs
     */
    public function getAuteur()
    {
        if (!isset($this->auteur)) {
            $this->auteur = Auteurs::oneByID($this->auteur_id);
        }
        return $this->auteur;
    }

    /**
     * @return Editions
     */
    public function getEdition()
    {
        if (!isset($this->edition)) {
            $this->edition = Editions::oneByID($this->edition_id);
        }
        return $this->edition;
    }

    private $moyenne;

    /**
     * @return mixed
     */
    public function getMoyenne()
    {

            $somme = 0;
            $livres = Collections::allNotesForBook($this->livre_id);
            if($livres) {
                foreach ($livres as $L) {
                    $somme += $L->getIntNote();
                }
                $this->moyenne = $somme/count($livres) ."/20";
            }
            else
                $this->moyenne = "Personne n'a encore noté ce livre.";
        return $this->moyenne;
    }


}