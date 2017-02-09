<?php
/**
 * Created by PhpStorm.
 * User: ophelien
 * Date: 09/02/17
 * Time: 15:21
 */

namespace collocation\vues;


class VuePageHTML
{
    public static function getHeaders(){
        return <<<end
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
        <link type="text/css" rel="stylesheet" href="/css/materialize.min.css"  media="screen,projection"/>
         <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		 <link rel="stylesheet" href="/css/css.css">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
         <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>           
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
    </head>
<body>
end;
    }

    public static function getFooter(){
        return <<<end
</body>
</html>
end;
    }

    public static function getMenu(){
        $app = \Slim\Slim::getInstance();
        $r_logements = $app->urlFor("logements");
        $r_membre = $app->urlFor("membres");
        $r_aff_coloc = $app->urlFor("collocation");
        $r_creer_coloc = $app->urlFor("creerCollocation");
        $r_deconnexion = $app->urlFor("deconnexion");
        $r_accueil = $app->urlFor("accueil");

        if(isset($_SESSION['email'])){
            $connexion = "<a class=\"waves-effect waves-light btn-large\" href=\"$r_deconnexion\">Deconnexion</a>";
        }else{
            $connexion = "<a class=\"waves-effect waves-light btn-large\" href=\"$r_accueil\">Connexion</a>";
        }

        if(isset($_SESSION['idGroupe'])){
            $groupe = "<a class=\"waves-effect waves-light btn-large\" href=\"$r_aff_coloc\">Ma coloc'</a>";
        }else{
            $groupe = "<a class=\"waves-effect waves-light btn-large\" href=\"$r_creer_coloc\">Créer colloc'</a>";
        }

        return <<<end
<div class="menu">
    <div class="imgmenu"><img src="/img/logo.png" height="20%" width="20%"></div>
    <a class="waves-effect waves-light btn-large" href="$r_logements">Nos logements</a>
    <a class="waves-effect waves-light btn-large" href="$r_membre">Nos membres</a>
    $groupe
    $connexion
</div>
end;

    }
}