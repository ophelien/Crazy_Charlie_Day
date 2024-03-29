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
})->name("inscription");

$app->post('/identification/', function() {
    (new collocation\controleurs\ControleurNavigation())->saisirLogin();
})->name("identification");

$app->post('/', function() {
    (new \collocation\controleurs\ControleurNavigation())->connexion();
})->name("connexion");

$app->get('/utilisateur/', function() {
    (new collocation\controleurs\ControleurNavigation())->afficherListeUtilisateurs();
})->name("membres");

$app->get('/utilisateur/:email', function($email) {
    (new collocation\controleurs\ControleurNavigation())->afficherUtilisateur($email);
})->name("membre");

$app->get('/logement/', function() {
    (new collocation\controleurs\ControleurNavigation())->afficherListeLogement();
})->name("logements");

$app->get('/logement/:id', function($id) {
    (new collocation\controleurs\ControleurNavigation())->afficherLogement($id);
})->name("logement");

$app->get('/collocation/', function() {
    (new collocation\controleurs\ControleurGestion())->afficherGroupe();
})->name("collocation");

$app->get('/deconnexion/', function() {
    (new collocation\controleurs\ControleurNavigation())->deconnexion();
})->name("deconnexion");

$app->get('/ajouterUser/:email', function($email) {
    (new collocation\controleurs\ControleurGestion())->ajouterDansLeGroupe($email);
})->name("ajouterUser");

$app->get('/ajouterLogement/:id', function($id) {
    (new collocation\controleurs\ControleurGestion())->ajouterLogement($id);
})->name("ajouterLogement");

$app->get('/creerCollocation/', function() {
    (new collocation\controleurs\ControleurGestion())->creerGroupe();
})->name("creerCollocation");

$app->get('/validerGroupe/', function() {
    (new collocation\controleurs\ControleurGestion())->validerGroupe();
})->name("validerGroupe");

$app->get('/supprimerLogementColloc/', function() {
    (new collocation\controleurs\ControleurGestion())->supprimerBien();
})->name("supprimerLogementColloc");

$app->get('/invitation/:invitation', function($invitation) {
    (new collocation\controleurs\ControleurGestion())->invitation($invitation);
})->name("invitation");

$app->get('/refuserInvitation/', function() {
    (new collocation\controleurs\ControleurGestion())->repondreInvitation(0);
})->name("refuserInvitation");

$app->get('/accepterInvitation/', function() {
    (new collocation\controleurs\ControleurGestion())->repondreInvitation(1);
})->name("accepterInvitation");

$app->get('/supprimerUserColloc/:email', function($email) {
    (new collocation\controleurs\ControleurGestion())->supprimerUser($email);
})->name("supprimerUserColloc");

$app->get('/logementsCompatibles/', function(){
    (new collocation\controleurs\ControleurNavigation())->listerLogementCompatible();
})->name("logementsCompatibles");

$app->run();