<?php
/**
 * Created by Visual Studio Code.
 * User: Clement
 * Date: 09/02/2017
 * Time: 10:50
 */

//pour utiliser les variables de session
session_start();

require 'vendor/autoload.php';

\conf\Eloquent::init('src/conf/conf.ini');

$app = new \Slim\Slim;

$app->get('/', function(){
    $html = <<<END
<!DOCTYPE html>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="materialize.min.css"  media="screen,projection"/>
         <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		 <link rel="stylesheet" href="css/css.css">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
         <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>           
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
        
        
    </head>
<body>
<a class="waves-effect waves-light btn grey" href=""><i class="material-icons right">trending_flat</i>Parcourir le site sans se connecter </a>

<div class="test">

<img class ="img" src="img/logo.png " height ="40%" width = "40%">
<div class="row">



    <form class="for">
        <div class="row">
            <div class="input-field">
                <input placeholder="ex : Dupont"  type="text">
                <label class="black-text">Nom d'utilisateur</label>
            </div>
            <div class="input-field">
                <input placeholder="ex : Dupont@gmail.com" type="text">
                <label class="black-text">Adresse mail</label>
            </div>
            <div class="input-field">
                <input placeholder="*********"  type="password">
                <label class="black-text">Mot de passe</label>
            </div>
            <div class="input-field">
                <input placeholder="*********"  type="password">
                <label class="black-text">Confirmation du mot de passe</label>
            </div>
        </div>
        <a class="waves-effect waves-light btn green" href="">S'inscrire gratuitement</a>
    </form>


    <form class="for">
        <div class="row">
            <div class="input-field">
                <input placeholder="ex : Dupont@gmail.com" type="text">
                <label class="black-text">Adresse mail</label>
            </div>
            <div class="input-field">
                <input placeholder="*********"  type="password">
                <label class="black-text">Mot de passe</label>
            </div>
        </div>
        <a class="waves-effect waves-light btn green" href="">Se connecter</a>
    </form>


</div>
</div>



</body>
</html>

END;

echo $html;
})->name("accueil");

$app->get('/identification/', function() {
    (new collocation\controleurs\ControleurNavigation())->saisirLogin();
})->name("identification");

$app->post('/', function() {
    (new \collocation\controleurs\ControleurNavigation())->connexion();
})->name("connexion");

$app->get('/utilisateur/', function() {
    (new collocation\controleurs\ControleurNavigation())->afficherListeUtilisateurs();
});

$app->get('/utilisateur/:email', function($email) {
    (new collocation\controleurs\ControleurNavigation())->afficherUtilisateur($email);
});

$app->get('/logement/', function() {
    (new collocation\controleurs\ControleurNavigation())->afficherListeUtilisateurs();
});

$app->get('/logement/:id', function($id) {
    (new collocation\controleurs\ControleurNavigation())->afficherLogement($id);
});

$app->run();