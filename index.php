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
    (new collocation\controleurs\ControleurNavigation())->index();
})->name("accueil");

$app->post('/inscription/', function(){
    (new collocation\controleurs\ControleurNavigation())->inscription();
});

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
    (new collocation\controleurs\ControleurNavigation())->afficherListeLogement();
});

$app->get('/logement/:id', function($id) {
    (new collocation\controleurs\ControleurNavigation())->afficherLogement($id);
});

$app->run();