<?php

namespace collocation\controleurs;

use \collocation\models\User;

class ControleurGestion
{
    public function creerGroupe(){
        if(isset($_SESSION['email'])){ // utilisateur connu
            $user = User::where("email","=",$_SESSION['email'])->first();
            if($user->estGestionnaire()){ // deja gerant

            }else{ // pas encore gerant

            }
        }else{ // utilisateur inconnu
            $app = \Slim\Slim::getInstance();
            $app->redirect("accueil");
        }
    }

    public function afficherGroupe(){
        if(isset($_SESSION['email']) && isset($_SESSION['idGroupe'])){ // utilisateur connu
            $user = User::where("email","=",$_SESSION['email'])->first();
            if($user->estGestionnaire()){ // deja gerant
                $valeur = Groupe::where("idGroupe","=",$_SESSION['idGroupe'])->first();
                $vue = new VueNavigation($valeur);
                //print $vue-> render(VueGestion::AFF_GROUPE);  // NOT YET IMPLEMENTED
            }else{ // pas encore gerant

            }
        }else{ // utilisateur inconnu
            $app = \Slim\Slim::getInstance();
            $app->redirect("accueil");
        }
    }

}