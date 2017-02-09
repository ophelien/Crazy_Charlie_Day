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
    $URI = \Slim\Slim::getInstance()->request->getRootUri();
    $html = <<<END
    <!DOCTYPE html>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="materialize.min.css"  media="screen,projection"/>
         <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		 <link rel="stylesheet" href="css.css">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
         <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>           
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
        
        
    </head>
<body>
<header>

         <div class="titre">
        <h1><b>TITRE</b></h1>
        <a class="waves-effect waves-light btn-large grey" href="">blablabla</a>
        <a class="waves-effect waves-light btn-large grey" href="">blablabla</a>
        <a class="waves-effect waves-light btn-large grey" href="">Se connecter<a>
        <a class="waves-effect waves-light btn-large grey" href="">Inscription</a>
        </div>  

</header>


        <footer class="page-footer grey">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">titre du footer</h5>
                <p class="grey-text text-lighten-4">blablablablablablablablablablablablablablablab</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Liens</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Liens 1</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Liens 2</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2017 Copyright
           </div>
          </div>
        </footer>
 
</body>  
</html>

END;

echo $html;
});

$app->start();