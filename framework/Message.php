<?php


class Message
{
    const Info = 'Info';
    const Succes = 'Succes';
    const Warning = 'Warning';
    const Error = 'Error';

    public static function addMessage($messageType, $message)
    {
        if (self::typeOfMessage($messageType)) {
            $_SESSION["message"][$messageType] = $message;
        } else
            return false;
    }

    public static function getMessage($messageType)
    {
        if (self::typeOfMessage($messageType)) {
            if (isset($_SESSION["message"][$messageType]))
                return $_SESSION["message"][$messageType];
        }
        return false;
    }

    public static function fetchMessage($messageType)
    {
        if (self::typeOfMessage($messageType)) {
            if (isset($_SESSION["message"][$messageType]))
                $temp = $_SESSION["message"][$messageType];
            unset($_SESSION["message"][$messageType]);
            return $temp;
        }
        return false;
    }

    public static function hasMessage($messageType)
    {
        if (self::typeOfMessage($messageType)) {
            return isset($_SESSION["message"][$messageType]);
        }
        return false;
    }

    private static function typeOfMessage($messageType)
    {
        return (($messageType == self::Info) || ($messageType == self::Succes) || ($messageType == self::Warning) || ($messageType == self::Error));
    }
}