<?php

namespace collocation\vues;

class VueNavigation
{
    const AFF_FORMULAIRE_LOGIN = 1;
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
            case VueNavigation::AFF_FORMULAIRE_LOGIN :
                $content = $this->formulaire();
                break;
            case VueNavigation::AFF_LISTE_UTILISATEUR :
                $content = $this->listeUtilisateur();
                break;
        }
        return $content;
    }


    private function listeUtilisateur(){
        $retour = "";
        foreach($this->objet as $utilisateur){
            $retour .= <<<end
<div class="row">
    <div class="col s12 m7">
        <div class="card">
            <div class="card-image">
                <img src=$utilisateur->email.png>
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
<img >
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

    private function formulaire(){
        $app = \Slim\Slim::getInstance();
        $c_form = $app->urlFor("connexion");
        return <<<END
<form method="post" action="$c_form">
<fieldset>
    <legend>Saisir vos identifiants</legend>
    <input name="nom" type="text" required placeholder="<Nom>"/>
    <input name="mdp" type="password" required placeholder="<Mot de passe>"/>
</fieldset>
<input type="submit" value="Connexion"/>
</form>
END;
    }
}