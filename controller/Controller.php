<?php


class Controller
{
    protected $title;
    protected $subtitle;
    protected $Client;
    protected $page;



    /**
     * Controller constructor.
     * @param null $vars
     */
    public function __construct($vars = null)
    {
        if (isset($vars['title'])) {
            $this->title = $vars['title'];
        } else {
            $this->title = 'Bibliocraft';
        }
        if (isset($vars['subtitle'])) {
            $this->subtitle = $vars['subtitle'];
        } else {
            $this->subtitle = 'Département des lecteurs assidus';
        }

        $this->Client = Auth::whoAmI();
        $this->page = null;
    }
}