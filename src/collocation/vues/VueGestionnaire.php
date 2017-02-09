<?php
/**
 * Created by PhpStorm.
 * User: Ewan
 * Date: 09/02/2017
 * Time: 18:51
 */

namespace collocation\vues;


class VueGestionnaire
{
    private $objet;

    public function __construct($array = null)
    {
        $this->objet =$array;
    }

    private function afficherTousLesGroupe(){
        $app = \Slim\Slim::getInstance();
        $retour = "";
        foreach($this->objet as $groupe){
            $retour .= <<<end
<p>$groupe->idGroupe</p>
<p>$groupe->idLogement</p>
end;

        }
        return $retour;
    }
}