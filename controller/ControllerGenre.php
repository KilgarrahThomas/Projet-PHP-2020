<?php


class ControllerGenre extends Controller
{

    public function index()
    {
        $this->page = 'Genre';
        $Genre = Genres::allWithoutParent();
        require './view/Genres/genre.php';
    }

    public function form()
    {
        $G = new Genres();
        if(isset($_POST['GenreID'])) {
            $G = Genres::oneByID(Tools::sanitizeInput($_POST['GenreID']));
        }
        require './view/Genres/formulaire.php';
    }

    public function store(){
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Index', Message::Error, 'Method not allowed');
        }
        $G = Genres::oneByID(Tools::sanitizeInput($_POST['GenreID']));
        if (!$G) {
            $G = new Genres();
        }

        $G->setNom(Tools::sanitizeInput($_POST['nom']));
        $G->setGenreParentId(Tools::sanitizeInput($_POST['parent']));

        if(isset($_POST['nom']) && !empty($_POST['nom'])
            && isset($_POST['parent'])) // Vérif si le champ est rempli et non null
        {
            $_POST['nom'] = Tools::sanitizeInput($_POST['nom']);
            $_POST['parent'] = Tools::sanitizeInput($_POST['parent']);
        }
        else
        {
            Message::addMessage('Error', 'Les Champs n\'ont pas été remplis');
            require './view/Genres/formulaire.php';
            return;
        }

        if(!(Tools::vNom($_POST['nom'], 'nom'))
            && ($_POST['parent'] == null || Tools::vID($_POST['parent'], Genres::allWithoutParent(), 'getGenreParent','Parent'))){
            require './view/Genres/formulaire.php';
            return;
        }

        if($_POST['parent'] == null)
            $_POST['parent'] = null;

        $G->setNom($_POST['nom']);
        $G->setGenreParentId($_POST['parent']);


            $result = $G->save();
            if ($result) {
                Message::AddMessage(Error, $result);
                require './view/Genres/formulaire.php';
            } else {
                Router::RedirectWhitMessage('Genre', Message::Succes, 'Enregistrement réussi');
            }

    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Genre', Message::Error, 'Method not allowed');
        }
        $result = Genres::oneByID(Tools::sanitizeInput($_POST['genreID']))->remove();
        if ($result) {
            Router::RedirectWhitMessage('Genre', Message::Error, $result);
        } else {
            Router::RedirectWhitMessage('Genre', Message::Succes, 'Maison d\'édition supprimée');
        }
    }
}
