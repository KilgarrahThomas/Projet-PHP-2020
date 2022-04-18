<?php


class ControllerClient extends Controller
{
    public function inscription()
    {
        $this->page = 'Inscription';
        $_POST['nom'] = null;
        $_POST['prenom'] = null;
        $_POST['mail'] = null;
        $_POST['dateNaiss'] = null;
        require './view/Clients/Inscription.php';
    }

    public function compte()
    {
        $this->page = 'Compte';
        $Client = Clients::OneById($this->Client->getClientId());
        $lu = count(Collections::allReadByClient($this->Client->getClientId()));
        $souhait = count(Collections::allWishedByClient($this->Client->getClientId()));
        $vc = Visibilite::oneByID($Client->getVisibilityCollec());
        $vs = Visibilite::oneByID($Client->getVisibilityWhislist());
        require './view/Clients/compte.php';
    }

    public function liste()
    {
        $this->page = 'Clients';
        $Clients = Clients::all();
        require './view/Clients/liste.php';
    }

    public function form()
    {
        $C = new Clients();
        if(isset($_POST['ClientID'])) {
            $C = Clients::oneByID(Tools::sanitizeInput($_POST['ClientID']));
        }
        require './view/Clients/formAdmin.php';
    }

    public function formUser()
    {
        $C = Clients::oneByID($this->Client->getClientId());
        require './view/Clients/formUser.php';
    }

    public function newClient()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Index', Message::Error, 'Method not allowed');
        }

        $Client = new Clients();


        if (isset($_POST['nom']) && !empty($_POST['nom'])
        && isset($_POST['prenom']) && !empty($_POST['prenom'])
        && isset($_POST['mail']) && !empty($_POST['mail'])
        && isset($_POST['newMdp']) && !empty($_POST['newMdp'])
        && isset($_POST['newMdpValidation']) && !empty($_POST['newMdpValidation'])
        && isset($_POST['dateNaiss']) && !empty($_POST['dateNaiss']))
        {
            $_POST['nom'] = Tools::sanitizeInput($_POST['nom']);
            $_POST['prenom'] = Tools::sanitizeInput($_POST['prenom']);
            $_POST['mail'] = Tools::sanitizeInput($_POST['mail']);
            $_POST['newMdp'] = Tools::sanitizeInput($_POST['newMdp']);
            $_POST['newMdpValidation'] = Tools::sanitizeInput($_POST['newMdpValidation']);
            $_POST['dateNaiss'] = Tools::sanitizeInput($_POST['dateNaiss']);
        } else {
            Message::addMessage('Error', 'Les Champs n\'ont pas été remplis');
            require './view/Clients/Inscription.php';
            return;
        }

        $newMdp = $_POST['newMdp'];
        $newMdpValidation = $_POST['newMdpValidation'];

        if (!(Tools::vNom($_POST['nom'], 'nom')
            && Tools::vNom($_POST['prenom'], 'prenom')
            && Tools::vMail($_POST['mail'])
            && Tools::vMailAlreadyExist($_POST['mail'])
            && Tools::vMDP($newMdp, $newMdpValidation)
            && Tools::vDate($_POST['dateNaiss']))) {
            require './view/Clients/Inscription.php';
            return;
        }

        $Client->setNom($_POST['nom']);
        $Client->setPrenom($_POST['prenom']);
        $Client->setMail($_POST['mail']);
        $Client->setPwd($newMdp);
        $Client->setDateNaiss(DateTime::createFromFormat('d/m/Y', $_POST['dateNaiss']));


            $result = $Client->save();
            if ($result) {
                Message::AddMessage(Error, $result);
                require './view/Clients/Inscription.php';
            } else {
                Router::RedirectWhitMessage('Index', Message::Succes, 'Enregistrement réussi');
            }

    }

    public function storeClient()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Index', Message::Error, 'Method not allowed');
        }

        $Client = Clients::oneByID($this->Client->getClientId());

        $Client->setNom($_POST['nom']);
        $Client->setPrenom($_POST['prenom']);
        $Client->setMail($_POST['mail']);
        $Client->setDateNaiss(DateTime::createFromFormat('d/m/Y', $_POST['dateNaiss']));

        if (isset($_POST['nom']) && !empty($_POST['nom'])
        && isset($_POST['prenom']) && !empty($_POST['prenom'])
        && isset($_POST['mail']) && !empty($_POST['mail'])
        && isset($_POST['dateNaiss']) && !empty($_POST['dateNaiss']))
        {
            $_POST['nom'] = Tools::sanitizeInput($_POST['nom']);
            $_POST['prenom'] = Tools::sanitizeInput($_POST['prenom']);
            $_POST['mail'] = Tools::sanitizeInput($_POST['mail']);
            $_POST['dateNaiss'] = Tools::sanitizeInput($_POST['dateNaiss']);
        } else {
            Message::addMessage('Error', 'Les Champs n\'ont pas été remplis');
            require './view/Clients/formUser.php';
            return;
        }

        if (!(Tools::vNom($_POST['nom'], 'nom')
            && Tools::vNom($_POST['prenom'], 'prenom')
            && Tools::vMail($_POST['mail'])
            && Tools::vMailAlreadyExist($_POST['mail'], $this->Client)
            && Tools::vDate($_POST['dateNaiss']))) {
            require './view/Clients/formUser.php';
            return;
        }

        $Client->setNom($_POST['nom']);
        $Client->setPrenom($_POST['prenom']);
        $Client->setMail($_POST['mail']);
        $Client->setDateNaiss(DateTime::createFromFormat('d/m/Y', $_POST['dateNaiss']));


            $result = $Client->save();
            if ($result) {
                Message::AddMessage(Error, $result);
                require './view/Clients/formUser.php';
            } else {
                $_SESSION["authentication"] = $Client;
                Router::RedirectWhitMessage('Index', Message::Succes, 'Enregistrement réussi');
            }

    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Index', Message::Error, 'Method not allowed');
        }

        $C = Clients::oneByID(Tools::sanitizeInput($_POST['ClientID']));
        if (!$C) {
            Router::RedirectWhitMessage('Clients', Message::Error, 'L\'ID du Client n\'a pas été retrouvé');
        }

        if (isset($_POST['mail']) && !empty($_POST['mail'])){
            $_POST['mail'] = Tools::sanitizeInput($_POST['mail']);
        } else {
            Message::addMessage('Error', 'Les Champs n\'ont pas été remplis');
            require './view/Clients/formAdmin.php';
            return;
        }

        if(!Tools::vMail($_POST['mail']
        && Tools::vMailAlreadyExist($_POST['mail'], Clients::oneByID(Tools::sanitizeInput($_POST['ClientID']))))) {
            require './view/Clients/formAdmin.php';
            return;
        }

        $C->setMail($_POST['mail']);

        if($C->getLevel() != Auth::LevelRoot)
            $C->setLevel($_POST['niveau'] ? 1 : 0);


        $result = $C->save();
        if ($result) {
            Message::AddMessage(Error, $result);
            var_dump($result);
            require './view/Clients/formAdmin.php';
        } else {
            Router::RedirectWhitMessage('Clients', Message::Succes, 'Enregistrement réussi');
        }

    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Client', Message::Error, 'Method not allowed');
        }

        $C = Clients::oneByID(Tools::sanitizeInput($_POST['ClientID']));

        if($C->getLevel() != Clients::LevelRoot) {
            $result = $C->remove();
            if ($result) {
                Router::RedirectWhitMessage('Clients', Message::Error, $result);
            } else {
                Router::RedirectWhitMessage('Clients', Message::Succes, 'Client supprimé');
            }
        }
        else
            Router::RedirectWhitMessage('Clients', Message::Error, 'Vous ne pouvez pas supprimer l\'utilisateur Root !');
    }

    public function userRemove()
    {

        if($this->Client->getLevel() != Clients::LevelRoot) {
            $result = Clients::oneByID($this->Client->getClientId())->remove();
            if ($result) {
                Router::RedirectWhitMessage('Clients', Message::Error, $result);
            } else {
                Auth::logout();
                Router::RedirectWhitMessage('Index', Message::Succes, 'Votre Compte a bel et bien été supprimé. Au revoir !');
            }
        }
        else
            Router::RedirectWhitMessage('Clients', Message::Error, 'Voyons ! Vous êtes le Root ! Vous ne pouvez pas supprimer votre compte ainsi !');
    }
}