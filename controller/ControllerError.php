<?php


class ControllerError extends Controller
{
    private $pageError;
    public function error404($page=null)
    {
        $Client = new Clients();
        $Client->setPrenom("Visiteur");
        $Client->setLevel(-1);
        $this->pageError=$page;
        http_response_code(404);
        require './view/error/404.php';
    }
    public function error405($error=null)
    {
        $this->pageError=$error;
        http_response_code(405);
        require './view/error/405.php';
    }

    public function error403()
    {
        http_response_code(403);
        require './view/error/403.php';
    }
}
