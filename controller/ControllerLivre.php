<?php


class ControllerLivre extends Controller
{

    public function index()
    {
        $this->page = 'Livre';
        $Livre = Livres::all();
        require './view/Livres/livre.php';
    }

    public function bibli()
    {
        $this->page = 'Bibli';
        $Livre = Livres::all();
        require './view/Livres/bibli.php';
    }

    public function detail()
    {
        if(isset($_POST['LivreID'])) {
            $L = Livres::OneById(Tools::sanitizeInput($_POST['LivreID']));
            $C = Collections::allNotesForBook(Tools::sanitizeInput($_POST['LivreID']));
            require './view/Livres/details.php';
        }
        else{
            Message::addMessage('Error', "Désolé. Il semblerait que vous n'ayez sélectionneé aucun livre.");
            require './view/Livres/bibli.php';
        }
    }

    public function show(){
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Livre', Message::Error, 'Method not allowed');
        }
        if (isset($_POST['LivreID'])) {
            $L = Livres::oneByID(Tools::sanitizeInput($_POST['LivreID']));
            require './view/Livres/show.php';
            return;
        }
        Router::RedirectWhitMessage('Livre', Message::Error, 'Aucun ID reçu');
    }

    public function form()
    {
        $L = new Livres();
        if(isset($_POST['LivreID'])) {
            $L = Livres::oneByID(Tools::sanitizeInput($_POST['LivreID']));
        }
        require './view/Livres/formulaire.php';
    }

    public function store()
    {
        $flag = true;
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Index', Message::Error, 'Method not allowed');
        }

        $L = Livres::oneByID(Tools::sanitizeInput($_POST['LivreID']));
        if (!$L) {
            $L = new Livres();
        }

        $L->setTitre(Tools::sanitizeInput($_POST['titre']));
        $L->setAuteurId(Tools::sanitizeInput($_POST['auteurID']));
        $L->setGenreId(Tools::sanitizeInput($_POST['genreID']));
        $L->setEditionId(Tools::sanitizeInput($_POST['editionID']));
        $L->setSommaire(Tools::sanitizeInput($_POST['resume']));

        if (isset($_POST['titre']) && !empty($_POST['titre'])
            && isset($_POST['auteurID']) && !empty($_POST['auteurID'])
            && isset($_POST['genreID']) && !empty($_POST['genreID'])
            && isset($_POST['editionID']) && !empty($_POST['editionID'])
            && isset($_POST['resume'])) // Vérif si le champ est rempli et non null
        {
            $_POST['LivreID'] = Tools::sanitizeInput($_POST['LivreID']);
            $_POST['titre'] = Tools::sanitizeInput($_POST['titre']);
            $_POST['auteurID'] = Tools::sanitizeInput($_POST['auteurID']);
            $_POST['genreID'] = Tools::sanitizeInput($_POST['genreID']);
            $_POST['editionID'] = Tools::sanitizeInput($_POST['editionID']);
            $_POST['resume'] = Tools::sanitizeInput($_POST['resume']);

        } else {
            Message::addMessage('Error', 'Les Champs n\'ont pas été remplis');
            require './view/Livres/formulaire.php';
            return;
        }

        if (!(Tools::vTexte($_POST['titre'], 'Le Titre'))
            && Tools::vID($_POST['auteurID'], Auteurs::all(), 'getAuteurId', 'L\'auteur')
            && Tools::vID($_POST['genreID'], Genres::all(), 'getGenreId', 'Le genre')
            && Tools::vID($_POST['editionID'], Editions::all(), 'getEditionId', 'La maison d\'édition')
            && (Tools::vTexte($_POST['resume'], 'Le résumé'))) {
            require './view/Livres/formulaire.php';
            return;
        }

        $L->setTitre($_POST['titre']);
        $L->setAuteurId($_POST['auteurID']);
        $L->setGenreId($_POST['genreID']);
        $L->setEditionId($_POST['editionID']);
        $L->setSommaire($_POST['resume']);

            $result = $L->save();
            if ($result) {
                Message::addMessage(Message::Error, $result);
                require './view/Livres/formulaire.php';
            } else {
                Router::RedirectWhitMessage('Livre', Message::Succes, 'Enregistrement réussi');
            }
    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Livre', Message::Error, 'Method not allowed');
        }
        $result = Livres::oneByID(Tools::sanitizeInput($_POST['LivreID']))->remove();
        if ($result) {
            Router::RedirectWhitMessage('Livre', Message::Error, $result);
        } else {
            Router::RedirectWhitMessage('Livre', Message::Succes, 'Livre supprimé');
        }
    }
}
