<?php

class HomeController
{

    public function viewHome(): void

    {       
        $template = 'template/homePage.phtml';
        require 'view/layout.phtml';
    }
    
}
