<?php

namespace collocation\controleurs;

use \collocation\models\Appartient;
use \collocation\models\Groupe;
use collocation\models\Logement;
use \collocation\models\User;
use \collocation\vues\VueGestion;
use collocation\vues\VueInvitation;
use Illuminate\Support\Facades\App;

class ControleurGestion
{
    public function invitation($url){
        $appartient = Appartient::where("urlInvitation","=",$url);
        if($appartient != null && !isset($_SESSION['email'])) {
            $user = User::where("email","=",$appartient->email);
            $_SESSION['invitation'] = $user->email;
            $_SESSION['invitationValide'] = $appartient->estOk;
            $this->afficherInvitation();
        }else {
            $app = \Slim\Slim::getInstance();
            $app->redirect($app->urlFor("accueil"));
        }
    }

    public function afficherInvitation(){
        if(isset($_SESSION['email']) && isset($_SESSION['idGroupe'])){ // utilisateur connu
                $groupe = Groupe::where("idGroupe","=",$_SESSION['idGroupe'])->first();
                $lieu = Logement::where("idLogement","=",$groupe->idLogement)->first();

                $users = $groupe->users();
                $vue = new VueInvitation(array($groupe,$users,$lieu));
                print $vue-> render();
            }else{ // pas encore gerant
                $app = \Slim\Slim::getInstance();
                $app->redirect($app->urlFor("accueil"));
            }

    }

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
                $appartient->urlGestion = $this->genererToken();
                $appartient->save();
                $_SESSION['idGroupe'] = $groupe->idGroupe;
                $this->afficherGroupe(VueGestion::AFF_CREATION);
            }
        }else{
            $app = \Slim\Slim::getInstance();
            $app->redirect($app->urlFor("accueil"));
        }
    }

    public function afficherGroupe($arg = null){
        if(isset($_SESSION['email']) && isset($_SESSION['idGroupe'])){ // utilisateur connu
            $user = User::where("email","=",$_SESSION['email'])->first();
            if($user->estGestionnaire()){ // deja gerant
                $groupe = Groupe::where("idGroupe","=",$_SESSION['idGroupe'])->first();
                if($groupe->idLogement != null){$lieu = Logement::where("idLogement","=",$groupe->idLogement)->first();}
                else{$lieu = null;}
                $possible = false;
                if($groupe->idLogement != null){ //si le logement est bien affecté
                    if($groupe->nbMembre()=== $lieu->places){ // et si le logement a la taille exacte du groupe
                        $possible = true;
                    }
                }
                $users = $groupe->users();
                $vue = new VueGestion(array($groupe,$users,$lieu,$possible));
                print $vue-> render($arg);
            }else{ // pas encore gerant
                $app = \Slim\Slim::getInstance();
                $app->redirect($app->urlFor("accueil"));
            }
        }else{ // utilisateur inconnu
            $app = \Slim\Slim::getInstance();
            $app->redirect($app->urlFor("accueil"));
        }
    }

    public function ajouterDansLeGroupe($idGens){
        if(isset($_SESSION['email']) && isset($_SESSION['idGroupe'])){ // utilisateur connu
            $user = User::where("email","=",$_SESSION['email'])->first();
            if($user->estGestionnaire()){ // deja gerant
                $groupe = Groupe::where("idGroupe","=",$_SESSION['idGroupe'])->first();
                if($groupe->status==0){
                    if($groupe->idLogement != null) {
                        $logement = Logement::where('idlogement',"=",$groupe->idLogement)->first();
                        if ($groupe->nbMembre() < $logement) {//si y a de la place dans le logement
                            $appartient = new Appartient();
                            $appartient->email = $idGens;
                            $appartient->idGroupe = $_SESSION['idGroupe'];
                            $appartient->estOk = 0;
                            $appartient->urlGestion = null;
                            $appartient->save();
                            $this->afficherGroupe(VueGestion::AFF_AJOUT);
                        }
                    }else{
                        $appartient = new Appartient();
                        $appartient->email = $idGens;
                        $appartient->idGroupe = $_SESSION['idGroupe'];
                        $appartient->estOk = 0;
                        $appartient->urlGestion = null;
                        $appartient->save();
                        $this->afficherGroupe(VueGestion::AFF_AJOUT);
                    }
                }else{
                    $app = \Slim\Slim::getInstance();
                    $app->redirect($app->urlFor("accueil"));
                }
            }else{ // pas encore gerant
                $app = \Slim\Slim::getInstance();
                $app->redirect($app->urlFor("accueil"));
            }
        }else{ // utilisateur inconnu
            $app = \Slim\Slim::getInstance();
            $app->redirect($app->urlFor("accueil"));
        }
    }

    public function ajouterLogement($idlogem){
        if(isset($_SESSION['email']) && isset($_SESSION['idGroupe'])){ // utilisateur connu
            $user = User::where("email","=",$_SESSION['email'])->first();
            if($user->estGestionnaire()){ // deja gerant
                $groupe = Groupe::where('idGroupe','=',$_SESSION['idGroupe'])->first();
                if($groupe->status==0){
                    $place = Logement::where('idLogement','=',$idlogem)->first();
                    if($place->places >= $groupe->nbMembre()){ // s'il y a assez de places
                        $groupe->idLogement = $idlogem;
                        $groupe->save();
                        $this->afficherGroupe(VueGestion::AFF_STATUS);
                    }else{
                        $this->afficherGroupe(VueGestion::AFF_ERR_LOGEMENT);
                    }
                }else {
                    $this->afficherGroupe(VueGestion::AFF_ERR_STATUS);
                }
            }else{ // pas encore gerant
                $app = \Slim\Slim::getInstance();
                $app->redirect($app->urlFor("accueil"));
            }
        }else{ // utilisateur inconnu
            $app = \Slim\Slim::getInstance();
            $app->redirect($app->urlFor("accueil"));
        }
    }

    public function validerGroupe(){
        if(isset($_SESSION['email']) && isset($_SESSION['idGroupe'])){ // utilisateur connu
            $user = User::where("email","=",$_SESSION['email'])->first();
            if($user->estGestionnaire()){ // deja gerant
                $groupe = Groupe::where('idGroupe','=',$_SESSION['idGroupe'])->first();
                $logement = Logement::where('idLogement','=',$groupe->idLogement)->first();
                if($groupe->idLogement != null){ //si le logement est bien affecté
                    if($groupe->nbMembre()== $logement->places){ // et si le logement a la taille exacte du groupe
                       $groupe->status=1;
                       $groupe->save();
                        $appartients = Appartient::where("idGroupe","=",$_SESSION['idGroupe'])->get();
                        foreach ($appartients as $appartient){
                            if($appartient->email != $_SESSION['email']){
                                $appartient->urlInvitation = $this->genererToken();
                                $appartient->save();
                            }
                        }
                        $this->afficherGroupe(VueGestion::AFF_LOGEMENT); // valider
                    }else{
                        $this->afficherGroupe(VueGestion::AFF_ERR_LOGEMENT);  // err : taille differente
                    }
                }else{
                    $this->afficherGroupe(VueGestion::AFF_ERR_NO_LOGEMENT); // err : aucun logement
                }
            }else{ // pas encore gerant
                $app = \Slim\Slim::getInstance();
                $app->redirect($app->urlFor("accueil"));
            }
        }else{ // utilisateur inconnu
            $app = \Slim\Slim::getInstance();
            $app->redirect($app->urlFor("accueil"));
        }
    }

    public function genererToken(){
        $factory = new \RandomLib\Factory;
        $generator = $factory->getGenerator(new \SecurityLib\Strength(\SecurityLib\Strength::MEDIUM));
        $token = $generator->generateString(32, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        return $token;
    }

    public function supprimerBien(){
        $groupe = Groupe::where('idGroupe','=',$_SESSION['idGroupe'])->first();
        $groupe->idLogement = null;
        $groupe->save();
        $this->afficherGroupe(VueGestion::AFF_SUPPRESSION_LOGEMENT);
    }

    public function supprimerUser($emailUser){
        Appartient::where('email', '=', $emailUser)->where('idGroupe','=',$_SESSION['idGroupe'])->delete();
        $this->afficherGroupe(VueGestion::AFF_SUPPRESSION_USER);
    }

}