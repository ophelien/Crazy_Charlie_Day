<?php
/**
 * Created by PhpStorm.
 * User: ophelien
 * Date: 09/02/17
 * Time: 14:52
 */

namespace collocation\vues;

use \collocation\vues\VuePageHTML;

class VueGestion
{
    const AFF_GROUPE = 1;

    private $objet;

    public function __construct($array = null)
    {
        $this->objet =$array;
    }

    public function render($selecteur)
    {
        switch ($selecteur) {
            case VueGestion::AFF_GROUPE :
                $content = $this->afficherGroupe();
                break;
        }
        return VuePageHTML::getHeaders() . $content . VuePageHTML::getFooter();
    }

        private function afficherGroupe(){
        $retour = "";
        $log = $this->objet[0];
            $retour.=<<<end
<p>logement associé $log->idlogement</p>
<a href="">
end;
        foreach ($this->objet[1] as $utilisateur) {
            $retour.=<<<end
<p>$utilisateur->nom</p>
end;
        }
        return $retour;
    }
}