<?php

namespace collocation\controleurs;

use \collocation\models\User;

class ControleurGestion
{
    public function creerGroupe(){
        if(isset($_SESSION['email'])){ // utilisateur connu
            $user = User::where("email","=",$_SESSION['email'])->first();
            if($user->estGestionnaire()){ // deja gerant

            }else{ // pas encore gerant

            }
        }else{ // utilisateur inconnu

        }
    }

}