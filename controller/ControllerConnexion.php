<?php


class ControllerConnexion extends Controller
{
    public function index()
    {
        $this->page = 'Connex';
        require './view/Connexion/index.php';
    }

    public function indexChangePassword()
    {
        require './view/Connexion/change-password.php';
    }

    public function login()
    {
        if (Auth::check()) {
            // si l'utilisateur est deja connecter on le renvoi sur l'index
            Router::Redirect('Index');
            return;
        }

        // On vérifie que les champ login et Mdp son bien remplit
        if (!isset($_POST['login']) || !isset($_POST['mdp']) || empty($_POST['login']) || empty($_POST['mdp'])) {
            Message::addMessage(Message::Error, "Le mail et le mot de passe sont requis");
            require './view/Connexion/index.php';
            return;
        }
        $remeberMe = (isset($_POST['remeberMe']));

        $result = Auth::login(Tools::sanitizeInput($_POST['login']), Tools::sanitizeInput($_POST['mdp']), $remeberMe);
        if (!$result) {
            // l'authentification a échouée
            Message::addMessage(Message::Error, "Le mail et/ou mot de passe sont incorrects");
            require './view/Connexion/index.php';
            return;
        }
        // l'authentification a réussie
        Message::addMessage(Message::Succes, "Authentification réussie");
        Router::Redirect('Index');
        return;
    }

    public function logout()
    {
        Auth::logout();
        Router::RedirectWhitMessage('Index', Message::Succes, "Vous êtes bien déconnecté");
        return;
    }

    public function changePassword()
    {
        // On vérifie que les champ soit bien remplit
        if (!isset($_POST['oldMdp']) || empty($_POST['oldMdp']) ||
            !isset($_POST['newMdp']) || empty($_POST['newMdp']) ||
            !isset($_POST['newMdpValidation']) || empty($_POST['newMdpValidation'])) {
            Message::addMessage(Message::Error, "Tous les champs sont requis");
            require './view/Connexion/change-password.php';
            return;
        }

        $oldMdp = Tools::sanitizeInput($_POST['oldMdp']);
        $newMdp = Tools::sanitizeInput($_POST['newMdp']);
        $newMdpValidation = Tools::sanitizeInput($_POST['newMdpValidation']);
        if (!Auth::user()->checkPwd($oldMdp)) {
            Message::addMessage(Message::Error, "Votre ancient mot de passe ne correspond pas");
            require './view/Connexion/change-password.php';
            return;
        }

        if(!Tools::vMDP($newMdp, $newMdpValidation))
        {
            require './view/Connexion/change-password.php';
            return;
        }

        Auth::user()->setPwd($newMdp);
        Auth::user()->save();
        Router::RedirectWhitMessage('Index', Message::Succes, "Mot de passe modifié avec succès ");
    }
}