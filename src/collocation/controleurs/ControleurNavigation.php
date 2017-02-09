<?php

namespace collocation\controleurs;

use \collocation\vues\VueNavigation;

class Navigation
{

    public function saisiLogin(){
        $vue = new VueNavigation();
        print $vue->render(VueNavigation::AFF_FORMULAIRE_LOGIN);
    }

}