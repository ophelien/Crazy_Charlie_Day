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
<img src=$logement->idLogement.png>
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