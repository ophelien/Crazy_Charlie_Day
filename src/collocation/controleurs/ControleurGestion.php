<?php

namespace collocation\controleurs;

use collocation\models\Appartient;
use collocation\models\Groupe;
use \collocation\models\User;

class ControleurGestion
{
    public function creerGroupe(){
        if(isset($_SESSION['email'])) { // utilisateur connu
            $user = User::where("email", "=", $_SESSION['email'])->first();
            if ($user->estGestionnaire()) { // deja gerant
                $app = \Slim\Slim::getInstance();
                $app->redirect($app->urlFor("accueil"));
            } else { // pas encore gerant
                $groupe = new Groupe();
                $groupe->status = 0;
                $groupe->save();
                $appartient = new Appartient();
                $appartient->email = $_SESSION['email'];
                $appartient->idGroupe = $groupe->idGroupe;
                $appartient->estOk = 1;
                $appartient->urlGestion = ""; // TODO
                $appartient->save();
                $_SESSION['idGroupe'] = $groupe->idGroupe;
                $this->afficherGroupe();
            }
        }else{
            $app = \Slim\Slim::getInstance();
            $app->redirect($app->urlFor("accueil"));
        }
    }

    public function afficherGroupe(){
        if(isset($_SESSION['email']) && isset($_SESSION['idGroupe'])){ // utilisateur connu
            $user = User::where("email","=",$_SESSION['email'])->first();
            if($user->estGestionnaire()){ // deja gerant
                $groupe = Groupe::where("idGroupe","=",$_SESSION['idGroupe'])->first();
                $users = $groupe->users();
                $vue = new VueNavigation(array($groupe,$users));
                print $vue-> render(VueGestion::AFF_GROUPE);  // NOT YET IMPLEMENTED
            }else{ // pas encore gerant
                $app = \Slim\Slim::getInstance();
                $app->redirect($app->urlFor("accueil"));
            }
        }else{ // utilisateur inconnu
            $app = \Slim\Slim::getInstance();
            $app->redirect($app->urlFor("accueil"));
        }
    }

    public function ajouterDansLeGroupe($gens){
        if(isset($_SESSION['email']) && isset($_SESSION['idGroupe'])){ // utilisateur connu
            $user = User::where("email","=",$_SESSION['email'])->first();
            if($user->estGestionnaire()){ // deja gerant
                $groupe = Groupe::where("idGroupe","=",$_SESSION['idGroupe'])->first();
                $logement = Logement::select("places")->where('idlogement',"=","$groupe->idLogement")->get();
                if($groupe->nbMembre() < $logement){//si y a de la place dans le logement
                    $appartient = new Appartient();
                    $appartient->email = $gens;
                    $appartient ->idGroupe = $_SESSION['idGroupe'];
                    $appartient->estOk = 0;
                    $appartient->urlGestion = null;
                    $appartient->save();
                }
            }else{ // pas encore gerant
                $app = \Slim\Slim::getInstance();
                $app->redirect("accueil");
            }
        }else{ // utilisateur inconnu
            $app = \Slim\Slim::getInstance();
            $app->redirect("accueil");
        }
    }

    public function ajouterLogement($logement){
        if(isset($_SESSION['email']) && isset($_SESSION['idGroupe'])){ // utilisateur connu
            $user = User::where("email","=",$_SESSION['email'])->first();
            if($user->estGestionnaire()){ // deja gerant
                $groupe = Groupe::where('idGroupe','=',$_SESSION['idGroupe']);
                if($logement == null){
                    $groupe->idLogement = $logement;
                    $groupe->save();
                }
            }else{ // pas encore gerant
                $app = \Slim\Slim::getInstance();
                $app->redirect("accueil");
            }
        }else{ // utilisateur inconnu
            $app = \Slim\Slim::getInstance();
            $app->redirect("accueil");
        }
    }
}