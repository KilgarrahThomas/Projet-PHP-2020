<?php


class ControllerIndex extends Controller
{

    public function index()
    {
        $this->page = "Index";
        require './view/Index/index.php';
    }

    public function indexCusto($Custo)
    {
        $this->succes = $Custo;
        require './view/Index/index.php';
    }
    public function info()
    {
        require './view/Index/info.php';
    }
}
