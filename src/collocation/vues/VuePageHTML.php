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
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link type="text/css" rel="stylesheet" href="materialize.min.css"  media="screen,projection"/>
         <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		 <link rel="stylesheet" href="css/css.css">
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
        return <<<end
<div class="menu">
    <img src="logo.png" height="20%" width="20%">
    <a class="waves-effect waves-light btn-large">Nos logements</a>
    <a class="waves-effect waves-light btn-large">Nos membres</a>
    <a class="waves-effect waves-light btn-large">Ma coloc'</a>
    <a class="waves-effect waves-light btn-large">Se connecter</a>
    <a class="waves-effect waves-light btn-large">S'inscrire</a>
</div>
end;

    }
}