<?php

namespace collocation\vues;

class VueNavigation
{
    const AFF_FORMULAIRE_LOGIN = 1;
    const AFF_LISTE_UTILISATEUR = 2;

    private $objet;

    public function __construct($array)
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
<p>$utilisateur->nom</p>
<href="">
end;
        }
        return $retour;
    }
}