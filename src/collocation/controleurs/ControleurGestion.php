<?php

namespace collocation\controleurs;

use collocation\models\Appartient;
use collocation\models\Groupe;
use \collocation\models\User;

class ControleurGestion
{
    public function creerGroupe(){
        if(isset($_SESSION['email'])){ // utilisateur connu
            $user = User::where("email","=",$_SESSION['email'])->first();
            if($user->estGestionnaire()){ // deja gerant
                $app = \Slim\Slim::getInstance();
                $app->redirect("accueil");
            }else{ // pas encore gerant
                $groupe = new Groupe();
                $groupe->status = 0;
                $groupe->save();
                $appartient = new Appartient();
                $appartient->email = $_SESSION['email'];
                $appartient->idGroupe = $groupe->idGroupe;
                $appartient->estOk = 1;
                $appartient->urlGestion = ""; // TODO
                $appartient->save();
                $this->afficherGroupe();
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
                $app = \Slim\Slim::getInstance();
                $app->redirect("accueil");
            }
        }else{ // utilisateur inconnu
            $app = \Slim\Slim::getInstance();
            $app->redirect("accueil");
        }
    }

    public function appartientGroupe($idGroupe){

    }

}