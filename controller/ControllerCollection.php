<?php


class ControllerCollection extends Controller
{

    public function read()
    {
        $this->page = 'Read';
        $Collection = Collections::allReadByClient($this->Client->getClientId());
        require './view/Collections/read.php';
    }

    public function wished()
    {
        $this->page = 'Wished';
        $Collection = Collections::allWishedByClient($this->Client->getClientId());
        require './view/Collections/wished.php';
    }

    public function form()
    {
        $C = new Collections();
        if(isset($_POST['ClientID']) && isset($_POST['LivreID'])) {
            $C = Collections::oneByIDs(Tools::sanitizeInput($_POST['ClientID']),Tools::sanitizeInput($_POST['LivreID']));
        }
        require './view/Collections/formulaire.php';
    }

    public function souhait(){
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Index', Message::Error, 'Method not allowed');
        }

        if (isset($_POST['LivreID']) && empty($_POST['LivreID'])) {
            Message::addMessage('Error', 'Désolé ! Il semblerait qu\'il nous manque une information');
            Router::Redirect('Bibli');
            return;
        }
        else
            $C = Collections::oneByIDs($this->Client->getClientId(), Tools::sanitizeInput($_POST['LivreID']));

        if(!$C)
            $C = new Collections();

        if (!(Tools::vID($_POST['LivreID'], Livres::all(), 'getLivreId', 'Le Livre'))) {
            Router::Redirect('Bibli');
            return;
        }

        $C->setClientId($this->Client->getClientId());
        $C->setLivreId(Tools::sanitizeInput($_POST['LivreID']));
        $C->setPossede(false);
        $C->setNote(null);
        $C->setCommentaire(null);


            $result = $C->save();
            if ($result) {
                Router::RedirectWhitMessage('Bibli', Message::Error, $result);
            } else {
                Router::RedirectWhitMessage('Bibli', Message::Succes, 'Enregistrement réussi');
            }

    }

    public function lu(){
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Index', Message::Error, 'Method not allowed');
        }

        if (isset($_POST['LivreID']) && empty($_POST['LivreID'])) {
            Message::addMessage('Error', 'Désolé ! Il semblerait qu\'il nous manque une information');
            Router::Redirect('Bibli');
            return;
        }
        else
            $C = Collections::oneByIDs($this->Client->getClientId(), Tools::sanitizeInput($_POST['LivreID']));

        if(!$C)
            $C = new Collections();

        if (!(Tools::vID($_POST['LivreID'], Livres::all(), 'getLivreId', 'Le Livre'))) {
            Router::Redirect('Bibli');
            return;
        }

        $C->setClientId($this->Client->getClientId());
        $C->setLivreId(Tools::sanitizeInput($_POST['LivreID']));
        $C->setPossede(true);


            $result = $C->save();
            if ($result) {
                Router::RedirectWhitMessage('Bibli', Message::Error, $result);
            } else {
                Router::RedirectWhitMessage('Bibli', Message::Succes, 'Enregistrement réussi');
            }

    }

    public function note(){
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Index', Message::Error, 'Method not allowed');
        }

        $C = new Collections();

        if (empty($_POST['LivreID'])) {
            Message::addMessage('Error', 'Désolé ! Nous n\'avons pas trouvé de livre correspondant dans votre collection.');
            Router::Redirect('Collection');
            return;
        }
        else
            $C = Collections::oneByIDs(Tools::sanitizeInput($_POST['ClientID']), Tools::sanitizeInput($_POST['LivreID']));

        $C->setNote($_POST['note']);
        $C->setCommentaire($_POST['commentaire']);

        if(isset($_POST['note']) && isset($_POST['note'])) // Vérif si le champ est rempli et non null
        {
            $_POST['note'] = Tools::sanitizeInput($_POST['note']);
            $_POST['commentaire'] = Tools::sanitizeInput($_POST['commentaire']);
        }
        else
        {
            Message::addMessage('Error', 'Bizarre... Certains champs requis n\'ont pas l\'air d\'exister');
            require './view/Collections/formulaire.php';
            return;
        }

        if(!(Tools::vTexte($_POST['commentaire'], 'commentaire'))
        && (Tools::vNote($_POST['note']))){
            require './view/Collections/formulaire.php';
            return;
        }

        $C->setNote($_POST['note']);
        $C->setCommentaire($_POST['commentaire']);


            $result = $C->save();
            if ($result) {
                Message::addMessage(Error, $result);
                require './view/Collections/formulaire.php';
            } else {
                Router::RedirectWhitMessage('Collection', Message::Succes, 'Enregistrement réussi');
            }

    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Index', Message::Error, 'Method not allowed');
        }
        $result = Collections::oneByIDs(Tools::sanitizeInput($_POST['ClientID']),Tools::sanitizeInput($_POST['LivreID']))->remove();
        if ($result) {
            Router::RedirectWhitMessage('Index', Message::Error, $result);
        } else {
            Router::RedirectWhitMessage('Index', Message::Succes, 'Suppression réussie');
        }
    }
}
