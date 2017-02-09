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

class VueGestion
{
    const AFF_ERR = 1;
    const AFF_CREATION = 2;
    const AFF_AJOUT = 3;
    const AFF_ERR_AJOUT = 4;
    const AFF_ERR_STATUS = 5;
    const AFF_STATUS = 6;
    const AFF_ERR_LOGEMENT = 7;
    const AFF_LOGEMENT = 8;
    const AFF_ERR_NO_LOGEMENT = 9;
    const AFF_SUPPRESSION_LOGEMENT = 10;

    private $objet;

    public function __construct($array = null)
    {
        $this->objet =$array;
    }

    public function render($selecteur = null)
    {
        $content = "";
        switch ($selecteur) {
            case VueGestion::AFF_ERR :
                $content .= "<div class='red'>Erreur : Le logement choisi n'est pas assez grand</div>";
                break;
            case VueGestion::AFF_CREATION :
                $content .= "<div class='message'>Le groupe a bien été créé</div>";
                break;
            case VueGestion::AFF_AJOUT :
                $content .= "<div class='message'>Le membre a bien été ajouté au groupe</div>";
                break;
            case VueGestion::AFF_ERR_AJOUT :
                $content .= "<div class='red'>Erreur : Le membre n'a pas été ajouté au groupe</div>";
                break;
            case VueGestion::AFF_ERR_STATUS :
                $content .= "<div class='red'>Erreur : Le groupe à déjà un logement</div>";
                break;
            case VueGestion::AFF_STATUS :
                $content .= "<div class='message'>Le groupe possède un nouveau logement</div>";
                break;
            case VueGestion::AFF_ERR_LOGEMENT :
                $content .= "<div class='red'>Erreur : Le logement n'a pas assez de place</div>";
                break;
            case VueGestion::AFF_LOGEMENT :
                $content .= "<div class='message'>Le logement a assez de place</div>";
                break;
            case VueGestion::AFF_ERR_NO_LOGEMENT :
                $content .= "<div class='red'>Erreur : Il n'y a pas de logement</div>";
                break;
        }
        $content .= $this->afficherGroupe();
        return VuePageHTML::getHeaders().VuePageHTML::getMenu(). $content . VuePageHTML::getFooter();
    }

        private function afficherGroupe(){
            $retour= "";
            $app = \Slim\Slim::getInstance();
            $r_valider = $app->urlFor("validerGroupe",array("email" => $_SESSION['idGroupe']));
            if($this->objet[2] != null) {
                $value1 = $this->objet[2]->idLogement;
                $value2 = $this->objet[2]->places;
                $r_supprimerBien = $app->urlFor("supprimerLogementColloc");
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
            <div class="card-action">
                <a href="$r_supprimerBien">Supprimer ce bien</a>
            </div>
        </div>
    </div>
</div>
<h4><b>Personnes concernées : </b></h4>
end;
            }
            foreach($this->objet[1] as $utilisateur){
                $r_supprimer = $app->urlFor("supprimerUserColloc",array("email" => $utilisateur->email));
                $r_details = $app->urlFor("membre",array("email" => $utilisateur->email));
                if($this->objet[0]->status > 0) {
                    $ok = Appartient::where("email", "=", $utilisateur->email)->where("idGroupe", "=", $_SESSION['idGroupe'])->first();
                    if($ok->estOk){
                        $estOk = "<div class=\"card-content\"><p>Est d'accord</p></div>";
                    }else{
                        if($ok->estOk == null){
                            $estOk = "<div class=\"card-content\"><p>Non renseigné</p></div>";
                        }else {
                            $estOk = "<div class=\"card-content\"><p>N'est pas d'accord</p></div>";
                        }
                    }
                }else{
                    $estOk = "";
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
            <div class="card-action">
                <a href="$r_supprimer">Enlever de la coloc</a>
            </div>
            
        </div>
    </div>
</div>
end;
            }
            if($this->objet[3] && $this->objet[0]->status == 0){ // pas encore validée
                $retour .= "<a href='$r_valider' id=\"boutton_connexion\" class=\"waves-effect waves-light btn green\">Valider</a>";
            }
        return $retour;
    }
}