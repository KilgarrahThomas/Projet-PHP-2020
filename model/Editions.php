<?php


class Editions
{
    private $edition_id;
    private $maison_edition;

    /**
     * Editions constructor.
     * @param $edition_id
     * @param $maison_edition
     */
    public function __construct($edition_id = null, $maison_edition = null)
    {
        $this->edition_id = $edition_id;
        $this->maison_edition = $maison_edition;
    }

    private static function ParseEditionFromBDD($BDDResult)
    {
        if($BDDResult)
        {
            return new Editions($BDDResult["edition_id"], $BDDResult["maison_edition"]);
        }
        else
            return false;
    }

    public static function all()
    {
        $editions = [];
        $results = (new BDD())->querySelect('SELECT * FROM editions');
        foreach ($results as $aResult) {
            $editions [] = self::ParseEditionFromBDD($aResult);
        }
        return $editions;
    }

    public static function oneByID($id)
    {
        $result = (new BDD())->querySelectOne('SELECT * FROM editions WHERE edition_id=:id;', ['id' => $id]);
        return self::ParseEditionFromBdd($result);
    }

    public function save()
    {
        if (isset($this->edition_id)) {
            $sql = "UPDATE editions
                    SET maison_edition = :nom
                    WHERE editions.edition_id = :id;";
            $data = [
                'nom' => $this->maison_edition,
                'id' => $this->edition_id,
            ];
        } else {
            $sql = "INSERT INTO editions (maison_edition) VALUES (:nom);";
            $data = [
                'nom' => $this->maison_edition,
            ];
        }

        return (new BDD())->queryAction($sql, $data);
    }

    public function remove()
    {
        $result = (new BDD())->queryAction('DELETE FROM editions WHERE editions.edition_id = :id', [
            'id' => $this->edition_id,
        ]);
        unset($this->maison_edition);
        unset($this->edition_id);
        return $result;
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
    public function getMaisonEdition()
    {
        return $this->maison_edition;
    }

    /**
     * @param mixed $maison_edition
     */
    public function setMaisonEdition($maison_edition)
    {
        $this->maison_edition = $maison_edition;
    }


}