<?php

namespace collocation\vues;

class VueNavigation
{
    const AFF_FORMULAIRE_LOGIN = 1;

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
        }
        return $content;
    }
}