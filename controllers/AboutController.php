<?php

namespace Controllers;

class AboutController
{
    public function about()
    {
        $title = "À propos du Tchat Anonyme";
        $view = "about/about.phtml";
        require "views/layout.phtml";
    }
}