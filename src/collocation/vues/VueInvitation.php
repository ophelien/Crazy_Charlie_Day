<?php
/**
 * Created by PhpStorm.
 * User: ophelien
 * Date: 09/02/17
 * Time: 14:52
 */

namespace collocation\vues;

use collocation\models\Appartient;
use \collocation\vues\VuePageHTML;

class VueInvitation
{
    private $objet;

    public function __construct($array = null)
    {
        $this->objet =$array;
    }

    public function render()
    {
        $content = $this->afficherGroupe();
        return VuePageHTML::getHeaders().VuePageHTML::getMenu(). $content . VuePageHTML::getFooter();
    }

    private function afficherGroupe(){
        $retour= "";
        $app = \Slim\Slim::getInstance();
            $value1 = $this->objet[2]->idLogement;
            $value2 = $this->objet[2]->places;
            $retour .= <<<end
                <h4><b>Appartement ciblé :</b></h4>
<div class="detailU">
    <div class="col s12 m7">
        <div class="card">
            <div class="card-image">
                <img src=/img/apart/$value1.jpg>
            </div>
            <div class="card-content">
                <p><b>Nombre de places : $value2 personnes</b></p>
            </div>
        </div>
    </div>
</div>
<h4><b>Personnes concernées : </b></h4>
end;
        foreach($this->objet[1] as $utilisateur){
            $r_details = $app->urlFor("membre",array("email" => $utilisateur->email));
                $appartient = Appartient::where("email", "=", $utilisateur->email)->where("idGroupe", "=", $_SESSION['idGroupe'])->first();
                if($appartient->estOk){
                    $estOk = "<div class=\"card-content\"><p>Est d'accord</p></div>";
                }else{
                    if($appartient->estOk == null){
                        $estOk = "<div class=\"card-content\"><p>Non renseigné</p></div>";
                    }else {
                        $estOk = "<div class=\"card-content\"><p>N'est pas d'accord</p></div>";
                    }
                }
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
            $estOk
            <div class="card-action">
                <a href="$r_details">Details</a>
            </div>
        </div>
    </div>
</div>
end;
        }
        if($this->objet[0]->status == 3){
            $retour .= "<div>Collocation validée</div>";
        }
        if($this->objet[0]->status == 4){
            $retour .= "<div>Collocation refusée</div>";
        }
        return $retour;
    }
}