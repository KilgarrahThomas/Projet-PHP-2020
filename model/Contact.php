<?php


class Contact
{
 private $id;
 private $client_id;
 private $message;

    /**
     * Contact constructor.
     * @param $id
     * @param $client_id
     * @param $message
     */
    public function __construct($id = null, $client_id = null, $message = null)
    {
        $this->id = $id;
        $this->client_id = $client_id;
        $this->message = $message;
    }

    private static function ParseContactFromBDD($BDDResult)
    {
        if($BDDResult)
        {
            return new Contact($BDDResult["id"], $BDDResult["client_id"], $BDDResult["message"]);
        }
        else
            return false;
    }

    public static function all()
    {
        $contact = [];
        $results = (new BDD())->querySelect('SELECT * FROM contact');
        foreach ($results as $aResult) {
            $contact [] = self::ParseContactFromBDD($aResult);
        }
        return $contact;
    }

    public static function oneByID($id)
    {
        $result = (new BDD())->querySelectOne('SELECT * FROM contact WHERE id=:id;', ['id' => $id]);
        return self::ParseContactFromBDD($result);
    }

    public function save()
    {
        $sql = "INSERT INTO contact (client_id, message) VALUES (:cid, :mes);";
        $data = [
            'cid' => $this->client_id,
            'mes' => $this->message,
        ];

        return (new BDD())->queryAction($sql, $data);
    }

    public function remove()
    {
        $result = (new BDD())->queryAction('DELETE FROM contact WHERE contact.id = :id', [
            'id' => $this->id,
        ]);
        unset($this->id);
        unset($this->client_id);
        unset($this->message);
        return $result;
    }

    public static function removeByClient($id)
    {
        $result = (new BDD())->queryAction('DELETE FROM contact WHERE contact.id = :id', [
            'id' => $id,
        ]);
        return $result;
    }

    public static function removeAll()
    {
        $result = (new BDD())->queryAction('TRUNCATE TABLE contact');
        return $result;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

private $client;

    /**
     * @return mixed
     */
    public function getClient()
    {
        if (!isset($this->client)) {
            $this->client = Clients::oneByID($this->client_id);
        }
        return $this->client;
    }
}