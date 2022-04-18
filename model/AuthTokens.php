<?php


class AuthTokens
{
    private $id;
    private $selector;
    private $validator;
    private $hashedValidator;
    private $client_id;
    private $expires;

    /**
     * @return mixed
     */
    public function getSelector()
    {
        return $this->selector;
    }
    /**
     * @return mixed
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @return mixed
     */
    public function getHashedValidator()
    {
        if (!isset($this->hashedValidator) && isset($this->validator)) {
            $this->hashedValidator = self::hashValidator($this->validator);
        }
        return $this->hashedValidator;
    }

    /**
     * @return mixed
     */
    public function getExpires()
    {
        return $this->expires;
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

    /**
     * @param $bddResult
     * @return AuthTokens|bool
     * @throws Exception
     */
    private static function parseFromBdd($bddResult)
    {
        if ($bddResult) {
            $token = new self();
            $token->id = $bddResult['id'];
            $token->selector = $bddResult['selector'];
            $token->hashedValidator = $bddResult['hash_validator'];
            $token->client_id = $bddResult['client_id'];
            $token->expires = strtotime($bddResult['expires']);
            return $token;
        } else {
            return false;
        }
    }

    /**
     * @param $selector
     * @return AuthTokens|bool
     * @throws Exception
     */
    public static function findFirstBySelector($selector)
    {
        return self::parseFromBdd((new BDD())->querySelectOne('SELECT * FROM `auth_tokens` WHERE `selector` LIKE :selector LIMIT 1;', ['selector' => $selector]));
    }

    public function save()
    {
        $this->getHashedValidator();
        if (!isset($this->hashedValidator)) {
            throw new Exception("HashedValidator can't be null on save");
        }
        if (isset($this->id)) {
            $sql = "UPDATE auth_tokens 
SET selector = :selector, hash_validator = :hashedValidator, client_id = :cid, expires = :expires 
WHERE auth_tokens.id = :id;";
            $data = [
                'selector' => $this->selector,
                'hashedValidator' => $this->hashedValidator,
                'cid' => intval($this->client_id),
                'expires' => date("Y-m-d H:i:s", $this->expires),
                'id' => intval($this->id),
            ];
        } else {
            $sql = "INSERT INTO auth_tokens (id, selector, hash_validator, client_id, expires) 
VALUES (NULL, :selector, :hash_validator, :cid, :expires);";
            $data = [
                'selector' => $this->selector,
                'hash_validator' => $this->hashedValidator,
                'cid' => intval($this->client_id),
                'expires' => date("Y-m-d H:i:s", $this->expires),
            ];
        }
        return (new BDD())->queryAction($sql, $data);
    }

    /**
     * @param Clients $user
     * @return AuthTokens
     */
    public static function generate($user)
    {
        $token = new self();
        $token->client_id = $user->getClientId();
        $token->regenerate();
        return $token;
    }

    public function regenerate()
    {
        $this->selector = bin2hex(random_bytes(6));
        $this->hashedValidator = null;
        $this->validator = hash("sha256", bin2hex(random_bytes(15)) . $_SERVER["REMOTE_ADDR"] . $this->client_id);
        $this->expires = strtotime("+1 year");
    }

    /**
     *
     * @throws Exception
     */
    public function expire()
    {
        $this->expires = strtotime("now");
        return $this->save();
    }

    public function validate($validator)
    {
        return hash_equals($this->getHashedValidator(), self::hashValidator($validator));
    }

    private static function hashValidator($aString)
    {
        return hash("sha256", $aString);
    }
}