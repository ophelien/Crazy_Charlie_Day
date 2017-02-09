<?php

namespace collocation\controleurs;

use \collocation\vues\VueNavigation;
use \collocation\models\User;

class ControleurNavigation
{

    public function index(){
        $vue = new VueNavigation();
        print $vue->render(VueNavigation::AFF_INDEX);
    }

    public function connexion(){
        $app =  \Slim\Slim::getInstance();
        $requete = $app->request;
        $password = filter_var($requete->post("mdp"),FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($requete->post("email"),FILTER_SANITIZE_SPECIAL_CHARS);
        $user = User::where("email","=",$email)->first();
        if($user != null) {
            if (password_verify($password, $user->mdp)) {
                $_SESSION['email'] = $user->email;
                // CONNEXION OK
                print "connection ok";
            } else {
                // ERREUR MDP FAUX
                print "mdp faux";
            }
        }else{
           // ERREUR LOGIN INCONNU
            print "login inconnu";
        }
    }

    public function afficherListeUtilisateurs(){
        $valeur = User::all();
        $vue = new VueNavigation($valeur);
        print $vue-> render(VueNavigation::AFF_LISTE_UTILISATEUR);
    }

    public function afficherUtilisateur($email){
        $valeur = User::where("email","=",$email)->first();
        $vue = new VueNavigation($valeur);
        //print $vue-> render(VueNavigation::AFF_UTILISATEUR);  // NOT YET IMPLEMENTED
    }

    public function afficherListeLogement(){
        $valeur = Logement::where("places",">",0)->get();
        $vue = new VueNavigation($valeur);
        print $vue -> render(VueNavigation::AFF_LISTE_LOGEMENT);
    }

    public function afficherLogement($idlogement){
        $valeur = Logement::where("idLogement","=",$idlogement)->first();
        $vue = new VueNavigation($valeur);
        //print $vue-> render(VueNavigation::AFF_LOGEMENT);  // NOT YET IMPLEMENTED
    }

}