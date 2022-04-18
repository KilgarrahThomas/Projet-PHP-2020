<?php


class BDD
{
    private $pdo;

    /**
     * @return PDO
     */
    private function getPdo()
    {
        if (!$this->pdo) {
            $this->pdo = new PDO(Configuration::get('BDD_DRIVER') .
                ':host=' . Configuration::get('BDD_HOST') .
                ';port='.  Configuration::get('BDD_PORT') .
                ';dbname=' . Configuration::get('BDD_DATABASE') .
                ';charset=' . Configuration::get('BDD_CHARSET'),
                Configuration::get('BDD_USER'),
                Configuration::get('BDD_PASSWORD'));
        }
        return $this->pdo;
    }

    /**
     * Execute select on DataBase
     * @param string $statement
     * @param null $parameters
     * @return array
     */
    public function querySelect($statement, $parameters = null)
    {
        $stmt = $this->getPdo()->prepare($statement);
        $stmt->execute($parameters);
        return $stmt->fetchAll();
    }

    /**
     * Execute select on DataBase
     * @param string $statement
     * @param null $parameters
     * @return object
     */
    public function querySelectOne($statement, $parameters = null)
    {
        $stmt = $this->getPdo()->prepare($statement);
        $stmt->execute($parameters);
        return $stmt->fetch();
    }

    /**
     * Execute action on DataBase
     * @param string $statement
     * @param null $parameters
     * @return bool|string false if successful, error message else.
     */
    public function queryAction($statement, $parameters = null)
    {
        $stmt = $this->getPdo()->prepare($statement);
        $stmt->execute($parameters);
        if ($stmt->errorCode() === '00000') {
            // La requête fonctionne
            return false;
        }
        return $stmt->errorInfo()[2];
    }
}