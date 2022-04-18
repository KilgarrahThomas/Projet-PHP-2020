<?php


class ControllerContact extends Controller
{
    public function form()
    {
        $this->page = 'Contact';
        $Co = new Contact();
        require './view/Contact/form.php';
    }

    public function message()
    {
        $this->page = 'Message';
        $Messages = Contact::all();
        require './view/Contact/Messages.php';
    }

    public function store(){
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Index', Message::Error, 'Method not allowed');
        }

        $Co = new Contact();
        $Co->setMessage(Tools::sanitizeInput($_POST['mess']));

        if(isset($_POST['mess']) && !empty($_POST['mess'])) // Vérif si le champ est rempli et non null
        {
            $_POST['mess'] = Tools::sanitizeInput($_POST['mess']);
        }
        else
        {
            Message::addMessage('Error', 'Les Champs n\'ont pas été remplis');
            require './view/Contact/form.php';
            return;
        }

        if(!(Tools::vTexte($_POST['mess'], 'message'))){
            require './view/Contact/form.php';
            return;
        }

        $Co->setClientId($this->Client->getClientId());
        $Co->setMessage(Tools::sanitizeInput($_POST['mess']));

            $result = $Co->save();
            if ($result) {
                Message::addMessage(Message::Error, $result);
                require './view/Contact/form.php';
            } else {
                Router::RedirectWhitMessage('Index', Message::Succes, 'Enregistrement réussi');
            }

    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Router::RedirectWhitMessage('Messages', Message::Error, 'Method not allowed');
        }
        $result = Contact::oneByID(Tools::sanitizeInput($_POST['MessageID']))->remove();
        if ($result) {
            Router::RedirectWhitMessage('Messages', Message::Error, $result);
        } else {
            Router::RedirectWhitMessage('Messages', Message::Succes, 'Message supprimé');
        }
    }

    public function removeAll()
    {
        $result = Contact::removeAll();
        if ($result) {
            Router::RedirectWhitMessage('Messages', Message::Error, $result);
        } else {
            Router::RedirectWhitMessage('Messages', Message::Succes, 'Message supprimé');
        }
    }
}
