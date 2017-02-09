<?php
/**
 * Created by PhpStorm.
 * User: ophelien
 * Date: 09/02/17
 * Time: 14:52
 */

namespace collocation\vues;


class VueGestion
{
    const AFF_GROUPE = 1;

    private $objet;

    private function afficherGroupe(){
        $retour = "";
        foreach ($this->objet as $utilisateur) {
            $retour.=<<<end
<p>logement associé $utilisateur->idlogement</p>
<a href="">

end;
        }
        return $retour;
    }
}