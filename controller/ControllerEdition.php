<?php


class ControllerEdition extends Controller
{

    public function index()
    {
        $this->page = 'Edition';
        $Edition = Editions::all();
        require './view/Editions/editions.php';
    }

    public function form()
    {
        $E = new Editions();
        if(isset($_POST['EditionID'])) {
            $E = Editions::oneByID(Tools::sanitizeInput($_POST['EditionID']));
        }
        require './view/Editions/formulaire.php';
    }

    public function store(){
        $flag = true;
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Index', Message::Error, 'Method not allowed');
        }
        $E = Editions::oneByID(Tools::sanitizeInput($_POST['visibilityID']));
        if (!$E) {
            $E = new Editions();
        }

        $E->setMaisonEdition(Tools::sanitizeInput($_POST['nom']));

        if(isset($_POST['nom']) && !empty($_POST['nom'])) // Vérif si le champ est rempli et non null
        {
            $_POST['nom'] = Tools::sanitizeInput($_POST['nom']);
        }
        else
        {
            Message::addMessage('Error', 'Les Champs n\'ont pas été remplis');
            require './view/Editions/formulaire.php';
            return;
        }

        if(!(Tools::vNom($_POST['nom'], 'nom'))){
            require './view/Editions/formulaire.php';
            return;
        }

        $E->setMaisonEdition($_POST['nom']);

            $result = $E->save();
            if ($result) {
                Message::AddMessage(Error, $result);
                require './view/Editions/formulaire.php';
            } else {
                Router::RedirectWhitMessage('Edition', Message::Succes, 'Enregistrement réussi');
            }
    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Edition', Message::Error, 'Method not allowed');
        }
        $result = Editions::oneByID(Tools::sanitizeInput($_POST['EditionID']))->remove();
        if ($result) {
            Router::RedirectWhitMessage('Edition', Message::Error, $result);
        } else {
            Router::RedirectWhitMessage('Edition', Message::Succes, 'Maison d\'édition supprimée');
        }
    }
}
