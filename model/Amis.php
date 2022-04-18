<?php


class Amis
{
    private $client_id1;
    private $client_id2;

    /**
     * Amis constructor.
     * @param $client_id1
     * @param $client_id2
     */
    public function __construct($client_id1, $client_id2)
    {
        $this->client_id1 = $client_id1;
        $this->client_id2 = $client_id2;
    }

    private static function ParseEditionFromBDD($BDDResult)
    {
        if($BDDResult)
        {
            return new Amis($BDDResult["client_id1"], $BDDResult["client_id2"]);
        }
        else
            return false;
    }

    public static function all()
    {
        $amis = [];
        $results = (new BDD())->querySelect('SELECT * FROM amis');
        foreach ($results as $aResult) {
            $amis [] = self::ParseEditionFromBDD($aResult);
        }
        return $amis;
    }

    public static function allByClient1($id)
    {
        $amis = [];
        $results = (new BDD())->querySelect('SELECT * FROM amis WHERE client_id1=:id;', ['id' => $id]);
        foreach ($results as $aResult) {
            $amis [] = self::ParseEditionFromBDD($aResult);
        }
        return $amis;
    }

    /**
     * @return mixed
     */
    public function getClientId1()
    {
        return $this->client_id1;
    }

    /**
     * @param mixed $client_id1
     */
    public function setClientId1($client_id1)
    {
        $this->client_id1 = $client_id1;
    }

    /**
     * @return mixed
     */
    public function getClientId2()
    {
        return $this->client_id2;
    }

    /**
     * @param mixed $client_id2
     */
    public function setClientId2($client_id2)
    {
        $this->client_id2 = $client_id2;
    }


}