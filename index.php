<?php
/**
 * Created by Visual Studio Code.
 * User: Clement
 * Date: 09/02/2017
 * Time: 10:50
 */

session_start();

require 'vendor/autoload.php';

\conf\Eloquent::init('src/conf/conf.ini');

$app = new \Slim\Slim;

$app->get('/', function(){
    $URI = \Slim\Slim::getInstance()->request->getRootUri();
    
});