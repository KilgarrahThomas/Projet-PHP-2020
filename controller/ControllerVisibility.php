<?php


class ControllerVisibility extends Controller
{

    public function index()
    {
        $this->page = 'Visi';
        $Visible = Visibilite::all();
        require './view/Visibility/visibility.php';
    }

    public function form()
    {
        $V = new Visibilite();
        if(isset($_POST['visibilityID'])) {
            $V = Visibilite::oneByID(Tools::sanitizeInput($_POST['visibilityID']));
        }
        require './view/Visibility/formulaire.php';
    }

    public function store(){
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Index', Message::Error, 'Method not allowed');
        }

        if (empty($_POST['visibilityID'])) {
            $V = new Visibilite();
        }
        else
            $V = Visibilite::oneByID(Tools::sanitizeInput($_POST['visibilityID']));

        $V->setNom(Tools::sanitizeInput($_POST['nom']));

        if(isset($_POST['nom']) && !empty($_POST['nom'])) // Vérif si le champ est rempli et non null
        {
            $_POST['nom'] = Tools::sanitizeInput($_POST['nom']);
        }
        else
        {
            Message::addMessage('Error', 'Les Champs n\'ont pas été remplis');
            require './view/Visibility/formulaire.php';
            return;
        }

        if(!(Tools::vNom($_POST['nom'], 'nom'))){
            require './view/Visibility/formulaire.php';
            return;
        }

        $V->setNom($_POST['nom']);

            $result = $V->save();
            if ($result) {
                Message::addMessage(Message::Error, $result);
                require './view/Visibility/formulaire.php';
            } else {
                Router::RedirectWhitMessage('Visibility', Message::Succes, 'Enregistrement réussi');
            }

    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Visibility', Message::Error, 'Method not allowed');
        }
        $result = Visibilite::oneByID(Tools::sanitizeInput($_POST['visibilityID']))->remove();
        if ($result) {
            Router::RedirectWhitMessage('Visibility', Message::Error, $result);
        } else {
            Router::RedirectWhitMessage('Visibility', Message::Succes, 'Niveau de visibilité supprimé');
        }
    }
}
