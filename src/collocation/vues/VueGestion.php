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
        return VuePageHTML::getHeaders().VuePageHTML::getMenu(). $content . VuePageHTML::getFooter();
    }

        private function afficherGroupe(){
            $retour= "";
            $app = \Slim\Slim::getInstance();
            if($this->objet[2] != null) {
                $value1 = $this->objet[2]->idLogement;
                $value2 = $this->objet[2]->places;
                $retour .= <<<end
                <p><b>Appartement ciblé :</b></p>
<div class="detailU">
    <div class="col s12 m7">
        <div class="card">
            <div class="card-image">
            
                <img src=/img/apart/$value1.jpg>
            </div>
            <div class="card-content">
                <h3><b>Nombre de places : $value2 personnes</b></h3>
            </div>
        </div>
    </div>
</div>
<h3><b>Personnes concernées : </b></h3>
end;
            }
            foreach($this->objet[1] as $utilisateur){
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
}