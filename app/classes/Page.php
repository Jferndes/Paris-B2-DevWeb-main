<?php

namespace App;
use App\Session;

class Page
{
    private \Twig\Environment $twig;
    public $session;

    function __construct()
    {    
        //$prefixe = str_contains(getcwd(), 'admin') ? "../" : "";
        $prefixe = "";
        $this->session = new Session();
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => $prefixe . '../var/cache/compilation_cache',
            'debug' => true
        ]);
    }

    public function render(string $name, array $data) :string
    {
        return $this->twig->render($name, $data);
    }
}