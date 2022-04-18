<?php


class Collections
{
    private $client_id;
    private $livre_id;
    private $possede;
    private $note;
    private $commentaire;

    /**
     * Collections constructor.
     * @param $client_id
     * @param $livre_id
     * @param $possede
     * @param $note
     * @param $commentaire
     */
    public function __construct($client_id = null, $livre_id = null, $possede = null, $note = null, $commentaire = null)
    {
        $this->client_id = $client_id;
        $this->livre_id = $livre_id;
        $this->possede = $possede;
        $this->note = $note;
        $this->commentaire = $commentaire;
    }

    private static function ParseCollectionFromBDD($BDDResult)
    {
        if($BDDResult)
        {
            return new Collections($BDDResult["client_id"], $BDDResult["livre_id"], $BDDResult["possede"], $BDDResult["note"], $BDDResult["Commentaire"]);
        }
        else
            return false;
    }

    public static function all()
    {
        $collections = [];
        $results = (new BDD())->querySelect('SELECT * FROM collections');
        foreach ($results as $aResult) {
            $collections [] = self::ParseCollectionFromBDD($aResult);
        }
        return $collections;
    }

    public static function allByClient($id)
    {
        $collections = [];
        $results = (new BDD())->querySelect('SELECT * FROM collections WHERE client_id=:id;', ['id' => $id]);
        foreach ($results as $aResult) {
            $collections [] = self::ParseCollectionFromBDD($aResult);
        }
        return $collections;
    }

    public static function allReadByClient($id)
    {
        $collections = [];
        $results = (new BDD())->querySelect('SELECT * FROM collections WHERE client_id=:id AND possede = 1;', ['id' => $id]);
        foreach ($results as $aResult) {
            $collections [] = self::ParseCollectionFromBDD($aResult);
        }
        return $collections;
    }

    public static function allWishedByClient($id)
    {
        $collections = [];
        $results = (new BDD())->querySelect('SELECT * FROM collections WHERE client_id=:id  AND possede = 0;', ['id' => $id]);
        foreach ($results as $aResult) {
            $collections [] = self::ParseCollectionFromBDD($aResult);
        }
        return $collections;
    }

    public static function allNotesForBook($id)
    {
        $collections = [];
        $results = (new BDD())->querySelect('SELECT * FROM collections WHERE livre_id=:id AND possede = 1 AND (note IS NOT null);', ['id' => $id]);
        foreach ($results as $aResult) {
            $collections [] = self::ParseCollectionFromBDD($aResult);
        }
        return $collections;
    }

    public static function oneByIds($cid, $lid)
    {
        $result = (new BDD())->querySelectOne('SELECT * FROM collections WHERE client_id=:cid AND livre_id=:lid', ['cid' => $cid, 'lid' => $lid]);
        return self::ParseCollectionFromBDD($result);
    }

    public function save()
    {
        if (self::oneByIds($this->client_id, $this->livre_id)) {
            $sql = "UPDATE collections
SET possede = :pos, note= :note, Commentaire = :com
WHERE collections.client_id = :cid AND collections.livre_id = :lid;";
            $data = [
                'pos' => $this->possede,
                'note' => $this->note,
                'com' => $this->commentaire,

                'cid' => $this->client_id,
                'lid' => $this->livre_id
            ];
        } else {
            $sql = "INSERT INTO collections (client_id, livre_id, possede, note, Commentaire) VALUES (:cid, :lid, :pos, :note, :com);";
            $data = [
                'pos' => $this->possede,
                'note' => $this->note,
                'com' => $this->commentaire,

                'cid' => $this->client_id,
                'lid' => $this->livre_id
            ];
        }

        return (new BDD())->queryAction($sql, $data);
    }

    public function remove()
    {
        $result = (new BDD())->queryAction('DELETE FROM collections WHERE client_id = :cid AND livre_id=:lid', [
            'cid' => $this->client_id,
            'lid' => $this->livre_id
        ]);
        unset($this->client_id);
        unset($this->livre_id);
        unset($this->possede);
        unset($this->note);
        unset($this->commentaire);
        unset($this->livre);
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
    public function getPossede()
    {
        return $this->possede;
    }

    /**
     * @param mixed $possede
     */
    public function setPossede($possede)
    {
        $this->possede = $possede;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        if($this->note)
            return $this->note.'/20';
        else
            return '?/20';
    }

    /**
     * @return mixed
     */
    public function getIntNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param mixed $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }

    /**
     * @var Livres
     */
    private $livre;

    /**
     * @return Livres
     */
    public function getLivre()
    {
        if (!isset($this->livre)) {
            $this->livre = Livres::oneByID($this->livre_id);
        }
        return $this->livre;
    }

    private $lecteur;

    public function getLecteur(){
        if (!isset($this->lecteur)) {
            $this->lecteur = Clients::oneByID($this->client_id);
        }
        return $this->lecteur;
    }





}