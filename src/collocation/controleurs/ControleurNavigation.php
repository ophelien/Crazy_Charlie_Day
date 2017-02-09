<?php

namespace collocation\controleurs;

use \collocation\vues\VueNavigation;
use \collocation\models\User;

class Navigation
{

    public function saisiLogin(){
        $vue = new VueNavigation();
        print $vue->render(VueNavigation::AFF_FORMULAIRE_LOGIN);
    }

    public function afficherListeUtilisateurs(){
        $valeur = User::all();
        $vue = new VueNavigation($valeur);
        print $vue-> render(VueNavigation::AFF_LISTE_UTILISATEUR);
    }

}