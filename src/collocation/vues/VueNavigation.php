<?php

namespace collocation\vues;

use \collocation\vues\VuePageHTML;

class VueNavigation
{
    const AFF_INDEX = 1;
    const AFF_LISTE_UTILISATEUR = 2;
    const AFF_LISTE_LOGEMENT = 3;
    const AFF_UTILISATEUR = 4;
    const AFF_LOGEMENT = 5;

    private $objet;

    public function __construct($array = null)
    {
        $this->objet = $array;
    }

    public function render($selecteur)
    {
        switch ($selecteur) {
            case VueNavigation::AFF_INDEX :
                $content = $this->index();
                return VuePageHTML::getHeaders().$content.VuePageHTML::getFooter();
                break;
            case VueNavigation::AFF_LISTE_UTILISATEUR :
                $content = $this->listeUtilisateur();
                break;
            case VueNavigation::AFF_LISTE_LOGEMENT :
                $content = $this->listeLogement();
                break;
            case VueNavigation::AFF_UTILISATEUR :
                $content = $this->detailUtilisateur();
                break;
            case VueNavigation::AFF_LOGEMENT :
                $content = $this->detailLogement();
                break;
        }
        return VuePageHTML::getHeaders().VuePageHTML::getMenu().$content.VuePageHTML::getFooter();
    }

    private function listeUtilisateur(){
        $app = \Slim\Slim::getInstance();
        $retour = "";
        foreach($this->objet as $utilisateur){
            $r_details = $app->urlFor("membre",array("email" => $utilisateur->email));
            $retour .= <<<end
<div class="lis">
    <div class="col s12 m7">
        <div class="card">
            <div class="card-image">
                <img src=/img/user/$utilisateur->email.jpg>
            </div>
            <div class="card-content">
                <p><b>$utilisateur->nom</b></p>
            </div>
            <div class="card-action">
                <a href="$r_details">Details</a>
            </div>
        </div>
    </div>
</div>
end;
        }
        return $retour;
    }

    private function listeLogement(){
        $app = \Slim\Slim::getInstance();
        $retour = "";
        foreach($this->objet as $logement){
            $r_details = $app->urlFor("logement",array("id" => $logement->idLogement));
            $retour.=<<<end
<div class="lis">
    <div class="col s12 m7">
        <div class="card">
            <div class="card-image">
                <img src=/img/apart/$logement->idLogement.jpg>
            </div>
            <div class="card-content">
                <p><b>Nombre de places : $logement->places personnes</b></p>
            </div>
            <div class="card-action">
                <a href="$r_details">Details</a>
            </div>
        </div>
    </div>
</div>
end;
        }
        return $retour;
    }

    private function detailUtilisateur(){
        $value1 = $this->objet->email;
        $value2 = $this->objet->nom;
        $value3 = $this->objet->message;
            return <<<end
<div class="detailU">
    <div class="col s12 m7">
        <div class="card">
            <div class="card-image">
                <img src=/img/user/$value1.jpg>
            </div>
            <div class="card-content">
                <p><b>$value2</b></p>
                <p>$value3</p>
            </div>
             <div class="card-action">
                <a href="#">Ajouter cette personne à ma coloc'</a>
            </div>
        </div>
    </div>
</div>
end;
    }

    private function detailLogement(){
        $value1 = $this->objet->idLogement;
        $value2 = $this->objet->places;
        return <<<end
<div class="detailU">
    <div class="col s12 m7">
        <div class="card">
            <div class="card-image">
                <img src=/img/apart/$value1.jpg>
            </div>
            <div class="card-content">
                <p><b>Nombre de places : $value2 personnes</b></p>
            </div>
            <div class="card-action">
                <a href="#">Postuler pour ce logement</a>
            </div>
        </div>
    </div>
</div>
end;
    }

    private function index($error = null){
        $app = \Slim\Slim::getInstance();
        $r_inscription = $app->urlFor("inscription");
        $r_connexion = $app->urlFor("identification");
        $r_logements = $app->urlFor("logements");
        $mess = "";
        if($error != null){
            foreach($error as $value){
                $mess .='<p class="red-text">' . $value . '<br></p>';
            }
        }
        return <<<end
<a class="waves-effect waves-light btn grey" href="$r_logements"><i class="material-icons right">trending_flat</i>Parcourir le site sans se connecter </a>
<div class="test">
<img class ="img" src="/img/logo.png " height ="40%" width = "40%">
    $mess<p>test test</p>
<div class="row">

    <form id="formulaire_inscription" class="for" method="POST" action="$r_inscription">
        <div class="row">
            <div class="input-field">
                <input placeholder="ex : Dupont"  type="text" name="nom" required>
                <label class="black-text">Nom d'utilisateur</label>
            </div>
            <div class="input-field">
                <input placeholder="ex : Dupont@gmail.com" type="text" name="mail" required>
                <label class="black-text">Adresse mail</label>
            </div>
            <div class="input-field">
                <input placeholder="*********"  type="password" name="mdp1" required>
                <label class="black-text">Mot de passe</label>
            </div>
            <div class="input-field">
                <input placeholder="*********"  type="password" name="mdp2" required>
                <label class="black-text">Confirmation du mot de passe</label>
            </div>
            <div class="input-field">
                <input placeholder="votre description"  type="text" name="message" required>
                <label class="black-text">Une courte description de vous même</label>
            </div>
        </div>
        <a id="boutton_inscription" class="waves-effect waves-light btn green">S'inscrire gratuitement</a>
    </form>
    <form id="formulaire_connexion" class="for" metho="POST" action="$r_connexion">
        <div class="row">
            <div class="input-field">
                <input placeholder="ex : Dupont@gmail.com" type="text">
                <label class="black-text">Adresse mail</label>
            </div>
            <div class="input-field">
                <input placeholder="*********"  type="password">
                <label class="black-text">Mot de passe</label>
            </div>
        </div>
        <a id="boutton_connexion" class="waves-effect waves-light btn green">Se connecter</a>
    </form>
</div>
</div>
<script>
    document.getElementById("boutton_inscription").onclick = function() {
        document.getElementById("formulaire_inscription").submit();
    }
    document.getElementById("boutton_connexion").onclick = function() {
        document.getElementById("formulaire_connexion").submit();
    }
</script>
end;
    }
}