<?php


class ControllerAuteur extends Controller
{

    public function index()
    {
        $this->page = 'Auteur';
        $Auteur = Auteurs::all();
        require './view/Auteurs/auteurs.php';
    }

    public function form()
    {
        $A = new Auteurs();
        if(isset($_POST['AuteurID'])) {
            $A = Auteurs::oneByID(Tools::sanitizeInput($_POST['AuteurID']));
        }
        require './view/Auteurs/formulaire.php';
    }

    public function store(){
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Index', Message::Error, 'Method not allowed');
        }
        $A = Auteurs::oneByID(Tools::sanitizeInput($_POST['AuteurID']));
        if (!$A) {
            $A = new Auteurs();
        }

        $A->setNom(Tools::sanitizeInput($_POST['nom']));
        $A->setPrenom(Tools::sanitizeInput($_POST['prenom']));

        if(isset($_POST['nom']) && !empty($_POST['nom'])
        && isset($_POST['prenom']) && !empty($_POST['prenom'])) // Vérif si le champ est rempli et non null
        {
            $_POST['nom'] = Tools::sanitizeInput($_POST['nom']);
            $_POST['prenom'] = Tools::sanitizeInput($_POST['prenom']);
        }
        else
        {
            Message::addMessage('Error', 'Les Champs n\'ont pas été remplis');
            require './view/Auteurs/formulaire.php';
            return;
        }

        if(!(Tools::vNom($_POST['nom'], 'nom')
        && Tools::vNom($_POST['prenom'], 'prenom'))){
            require './view/Auteurs/formulaire.php';
            return;
        }

        $A->setNom($_POST['nom']);
        $A->setPrenom($_POST['prenom']);


            $result = $A->save();
            if ($result) {
                Message::addMessage(Message::Error, $result);
                require './view/Auteurs/formulaire.php';
            } else {
                Router::RedirectWhitMessage('Auteur', Message::Succes, 'Enregistrement réussi');
            }

    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Auteur', Message::Error, 'Method not allowed');
        }
        $result = Auteurs::oneByID(Tools::sanitizeInput($_POST['AuteurID']))->remove();
        if ($result) {
            Router::RedirectWhitMessage('Auteur', Message::Error, $result);
        } else {
            Router::RedirectWhitMessage('Auteur', Message::Succes, 'Auteur supprimé');
        }
    }
}
