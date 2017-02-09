<?php

namespace collocation\controleurs;

use collocation\models\Appartient;
use \collocation\vues\VueNavigation;
use \collocation\models\User;
use \collocation\models\Logement;
use Illuminate\Support\Facades\App;

class ControleurNavigation
{

    public function index(){
        $vue = new VueNavigation();
        print $vue->render(VueNavigation::AFF_INDEX);
    }

    public function deconnexion(){
        if(isset($_SESSION['idGroupe'])){
            unset($_SESSION['idGroupe']);
        }
        if(isset($_SESSION['email'])){
            unset($_SESSION['email']);
        }
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        $app =  \Slim\Slim::getInstance();
        $app->redirect($app->urlFor("accueil"));
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
        print $vue-> render(VueNavigation::AFF_UTILISATEUR);  // NOT YET IMPLEMENTED
    }

    public function afficherListeLogement(){
        $valeur = Logement::where("places",">",0)->get();
        $vue = new VueNavigation($valeur);
        print $vue -> render(VueNavigation::AFF_LISTE_LOGEMENT);
    }

    public function afficherLogement($idlogement){
        $valeur = Logement::where("idLogement","=",$idlogement)->first();
        $vue = new VueNavigation($valeur);
        print $vue-> render(VueNavigation::AFF_LOGEMENT);  // NOT YET IMPLEMENTED
    }

    public function inscription(){
        $mdp = ""; $nom = ""; $mail = ""; $message =""; $error = [];

        if (isset($_POST['mdp1']) && isset($_POST['mdp2'])){
            if($_POST['mdp1'] === $_POST['mdp2']){
                if($_POST['mdp1'] == filter_var($_POST['mdp1'], FILTER_SANITIZE_STRING)){
                    $mdp = filter_var($_POST['mdp1'], FILTER_SANITIZE_STRING);
                }else{
                    array_push($error, "Le mot de passe indiqué est invalide, veuillez le changer.");
                }
            }else{
                array_push($error, "Les mots de passe indiqués sont différents, veuillez les modifier.");
            }
        }else{
            array_push($error, "Veuillez entrer un mot de passe.");
        }

        if ($_POST['nom'] !=''){
            if($_POST['nom'] == filter_var($_POST['nom'], FILTER_SANITIZE_STRING)){
                $nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
            }else{
                array_push($error, "Le nom indiqué est invalide, veuillez le modifier.");
            }
        }else{
            array_push($error, "Veuillez entrer un nom.");
        }

        if ($_POST['mail']!=''){
            $user = User::where("email","=",$_POST['mail'])->first();
            if($user != null){
                array_push($error, "Le mail indiqué est déjà utilisé");
            }else if(filter_var( $_POST['mail'], FILTER_VALIDATE_EMAIL)){
                $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
            }else{
                array_push($error, "Le mail indiqué est invalide, veuillez le changer.");
            }
        }else{
            array_push($error, "Veuillez entrer un mail.");
        }

        if(isset($_POST['message'])){
            if($_POST['message'] == filter_var($_POST['message'], FILTER_SANITIZE_STRING)){
                $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
            }else{
                array_push($error, "Le message indiqué est invalide, veuillez le changer.");
            }
        }

        if (sizeof ( $error ) == 0){
            copy("./img/user/defaut.jpg","./img/user/$mail.jpg");
            $mdp = password_hash($mdp, PASSWORD_DEFAULT, Array('cost' => 12));
            $u = new User();
            $u->email = $mail;
            $u->mdp = $mdp;
            $u->nom = $nom;
            $u->message = $message;
            $u->save();

            $_SESSION['email'] = $mail;

           $this->afficherListeLogement();
        }else{
            $vue = new VueNavigation($error);
            print $vue->render(VueNavigation::AFF_INDEX);
        }
    }

    public function saisirLogin(){
        $error = [];
        $user = User::where("email","=",$_POST['mailCon'])->first();
        if($user != null){
            if($_POST['mdpCon'] == filter_var($_POST['mdpCon'], FILTER_SANITIZE_STRING)){
                if(password_verify($_POST['mdpCon'], $user->mdp)){
                    $_SESSION['email'] = $user->email;
                    $appartient = Appartient::where("email","=",$user->email)->whereNotNull("urlGestion")->first();
                    if($appartient != null){
                        $_SESSION['idGroupe'] = $appartient->idGroupe;
                    }
                    if($user->admin == 1){
                        $_SESSION['admin'] = 1;
                    }
                }else{
                    array_push($error, "Mot de passe incorrect");
                }
            }else{
                array_push($error, "Mot de passe invalide");
            }
        }else{
            array_push($error, "Mail invalide.");
        }

        if(sizeof ($error) == 0){
            $this->afficherListeLogement();
        }else{
            $vue = new VueNavigation($error);
            print $vue->render(VueNavigation::AFF_INDEX);
        }
        
    }

    public function modifierInformationPerso($nom, $desc){
        if(isset($_SESSION['email'])){
            $gens = User::where('email','=',$_SESSION['email'])->first();
            $gens->nom=$nom;
            $gens->description=$desc;
            $gens->save();
        }
    }

    public function listerLogementCompatible(){
        if(isset($_SESSION['email']) && isset($_SESSION['idGroupe'])){ // utilisateur connu
            $user = User::where("email","=",$_SESSION['email'])->first();
            if($user->estGestionnaire()){ // deja gerant
                $app=Appartient::where('email','=',$user->email)->first();
                $groupe=Groupe::where('idGroupe','=',$app->idgroupe())->first();
                $log=Logement::where('places','=',$groupe->nbMembre())->get();
                $vue = new VueNavigation($log);
                print $vue-> render(VueNavigation::AFF_LOGEMENT);
            }else{ // pas encore gerant
                $app = \Slim\Slim::getInstance();
                $app->redirect($app->urlFor("accueil"));
            }
        }else{ // utilisateur inconnu
            $app = \Slim\Slim::getInstance();
            $app->redirect($app->urlFor("accueil"));
        }
        return $log;
    }
}