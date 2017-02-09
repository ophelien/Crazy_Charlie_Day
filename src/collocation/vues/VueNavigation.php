<?php

namespace collocation\vues;

use \collocation\vues\VuePageHTML;

class VueNavigation
{
    const AFF_INDEX = 1;
    const AFF_LISTE_UTILISATEUR = 2;
    const AFF_LISTE_LOGEMENT = 3;

    private $objet;
    public $URI;

    public function __construct($array = null)
    {
        $this->objet = $array;
        $this->URI = \Slim\Slim::getInstance()->request->getRootUri();
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
        }
        return VuePageHTML::getHeaders().VuePageHTML::getMenu().$content.VuePageHTML::getFooter();
    }

    private function listeUtilisateur(){
        $retour = "";
        foreach($this->objet as $utilisateur){
            $retour .= <<<end
<div class="row">
    <div class="col s12 m7">
        <div class="card">
            <div class="card-image">
                <img src=/img/user/$utilisateur->email.jpg>
            </div>
            <div class="card-content">
                <p><b>$utilisateur->nom</b></p>
            </div>
            <div class="card-action">
                <a href="#">Details</a>
            </div>
        </div>
    </div>
</div>
end;
        }
        return $retour;
    }

    private function listeLogement(){
        $retour = "";
        foreach($this->objet as $logement){
            $retour.=<<<end
<div class="row">
    <div class="col s12 m7">
        <div class="card">
            <div class="card-image">
                <img src=/img/apart/$logement->idLogement.jpg>
            </div>
            <div class="card-content">
                <p><b>Nombre de places : $logement->places personnes</b></p>
            </div>
            <div class="card-action">
                <a href="#">Details</a>
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
            return <<<end
<div class="detailU">
    <div class="col s12 m7">
        <div class="card">
            <div class="card-image">
                <img src=/img/user/$value1.jpg>
            </div>
            <div class="card-content">
                <p><b>$value2/b></p>
            </div>
            <div class="card-action">
                <a href="#">Details</a>
            </div>
        </div>
</div>
<a class="waves-effect waves-light btn-large">Ajouter à ma coloc'</a>
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
                <img src=/img/user/$value1.jpg>
            </div>
            <div class="card-content">
                <p><b>Nombre de places : $value2 personnes</b></p>
            </div>
            <div class="card-action">
                <a href="#">Details</a>
            </div>
        </div>
</div>
<a class="waves-effect waves-light btn-large">Demander cette logement pour une coloc'</a>
</div>
end;
    }





    private function index(){
        return <<<end
<a class="waves-effect waves-light btn grey" href=""><i class="material-icons right">trending_flat</i>Parcourir le site sans se connecter </a>
<div class="test">
<img class ="img" src="/img/logo.png " height ="40%" width = "40%">
<div class="row">
    <form class="for" method="POST" action="$this->URI/inscription">
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
        </div>
        <button type="submit">Je m'inscris</button>
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