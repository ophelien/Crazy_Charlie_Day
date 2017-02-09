<?php
/**
 * Created by PhpStorm.
 * User: Ewan
 * Date: 09/02/2017
 * Time: 18:50
 */

namespace collocation\controleurs;


class ControleurGestionnaire
{

    public function afficherTousLesGroupesComplets(){
        if(isset($_SESSION['admin'])) { //si l'admin est vérifié
            $groupe = Groupe::where('status','=',1)->get();
        }else{ // si l'admin est inconnu

        }
        return $groupe;
    }
}