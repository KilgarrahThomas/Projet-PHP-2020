<?php


class Tools
{
    public static function sanitizeInput($input)
    {
        return htmlspecialchars($input);
    }

    public static function requireOnceFolder($folder)
    {
        foreach (scandir($folder) as $filename) {
            $path = $folder . '/' . $filename;
            if (is_file($path)) {
                require_once $path;
            }
        }
    }

    public static function vNom($nom, $tag)
    {
        if (!preg_match("#^[a-zA-Zéèëïö]+(([' -][a-zA-Zéèëïö])?[a-zA-Zéèëïö]*)*$#", $nom))
        {
            Message::addMessage(Message::Error, "Votre $tag ne contient aucun chiffre ou caractère spécial");
            return false;
        }

        return true;
    }

    public static function vNote($note)
    {
        if (!preg_match("#^[0-9]*$#", $note) || $note < 0 || $note > 20)
        {
            Message::addMessage(Message::Error, "La note ne doit contenir que des chiffres et se trouver entre 0 et 20");
            return false;
        }

        return true;
    }

    public static function vTexte($nom, $tag)
    {
        if (!preg_match("#^[a-zA-Zéèëïöàâêù0-9\-+?! .,:;']*$#", $nom))
        {
            Message::addMessage(Message::Error, "$tag ne doit pas contenir de caractère spécial");
            return false;
        }

        return true;
    }

    public static function vMail($mail)
    {
        if (!preg_match("#^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$#", $mail))
        {
            Message::addMessage(Message::Error, "Votre adresse mail n\'est pas valide");
            return false;
        }

        return true;
    }

    public static function vMailAlreadyExist($mail, $client = false)
    {
        if ((Clients::oneByMail($mail)))
        {
            if($client){
                if($client->getMail() == $mail)
                    return true;
            }

            Message::addMessage(Message::Error, "Ce mail est déjà connu de notre base de données");
            return false;
        }

        return true;
    }

    public static function vMDP($newMdp, $newMdpValidation)
    {
        if (strlen($newMdp) <= 3) {
            Message::addMessage(Message::Error, "Le nouveau mot de passe doit faire au moins 4 caractères");
            return false;
        }
        if(!(preg_match('#(?=.*[A-Z])#', $newMdp)) && preg_match('#(?=.*[a-z])#', $newMdp) && preg_match('#(?=.*[0-9])#', $newMdp)) {
            Message::addMessage(Message::Error, "Le Mot de passe doit avoir au minimum un chiffre, une minuscule et une majuscule !");
            return false;
        }
        if ($newMdp != $newMdpValidation) {
            Message::addMessage(Message::Error, "La validation du mot de passe ne correspond pas au nouveau mot de passe");
            return false;
        }

        return true;
    }

    public static function vDate($date)
    {
        $vDate = DateTime::createFromFormat('d/m/Y',$date);
        if (!$vDate)
        {
            Message::addMessage(Message::Error, "Votre date n'est pas valide ou n'est pas sous un format JJ/MM/AAAA.");
            return false;
        }

        return true;
    }

    public static function vID($id, $list, $func, $tag)
    {
        $flag = false;
        foreach ($list as $L){
            if($L->$func() == $id)
                $flag = true;
        }

        if (!($flag))
        {
            Message::addMessage(Message::Error, "$tag n'a pas été choisi parmi la liste proposée");
            return false;
        }

        return $flag;
    }


}