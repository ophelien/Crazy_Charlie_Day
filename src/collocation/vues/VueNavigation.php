<?php

namespace collocation\vues;

use \collocation\vues\VuePageHTML;

class VueNavigation
{
    const AFF_INDEX = 1;
    const AFF_LISTE_UTILISATEUR = 2;
    const AFF_LISTE_LOGEMENT = 3;

    private $objet;

    public function __construct($array = null)
    {
        $this->objet =$array;
    }

    public function render($selecteur)
    {
        switch ($selecteur) {
            case VueNavigation::AFF_INDEX :
                $content = $this->index();
                break;
            case VueNavigation::AFF_LISTE_UTILISATEUR :
                $content = $this->listeUtilisateur();
                break;
        }
        return VuePageHTML::getHeaders().$content.VuePageHTML::getFooter();
    }

    private function listeUtilisateur(){
        $retour = "";
        foreach($this->objet as $utilisateur){
            $retour .= <<<end
<img src=$utilisateur->email.png>
<p>$utilisateur->nom</p>
<a href="">Details</a>
end;
        }
        return $retour;
    }

    private function listeLogement(){
        $retour = "";
        foreach($this->objet as $logement){
            $retour.=<<<end
<img src="$logement->idLogement">
<p>Nombre de place(s): $logement->places</p>
end;

        }
        return $retour;
    }

    private function index(){
        return <<<end
<a class="waves-effect waves-light btn grey" href=""><i class="material-icons right">trending_flat</i>Parcourir le site sans se connecter </a>
<div class="test">
<img class ="img" src="img/logo.png " height ="40%" width = "40%">
<div class="row">
    <form class="for">
        <div class="row">
            <div class="input-field">
                <input placeholder="ex : Dupont"  type="text">
                <label class="black-text">Nom d'utilisateur</label>
            </div>
            <div class="input-field">
                <input placeholder="ex : Dupont@gmail.com" type="text">
                <label class="black-text">Adresse mail</label>
            </div>
            <div class="input-field">
                <input placeholder="*********"  type="password">
                <label class="black-text">Mot de passe</label>
            </div>
            <div class="input-field">
                <input placeholder="*********"  type="password">
                <label class="black-text">Confirmation du mot de passe</label>
            </div>
        </div>
        <a class="waves-effect waves-light btn green" href="">S'inscrire gratuitement</a>
    </form>
    <form class="for">
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
        <a class="waves-effect waves-light btn green" href="">Se connecter</a>
    </form>
</div>
</div>
end;
    }
}