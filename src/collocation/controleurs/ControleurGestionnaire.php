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
//111x133
    public function tousLesGroupesComplets(){
        if(isset($_SESSION['admin'])) { //si l'admin est vérifié
            $groupe = Groupe::where('status','=',2)->orderBy('idLogement')->get();
        }else{ // si l'admin est inconnu

        }
        return $groupe;
    }

    public function validerGroupe($idGroupe){
        if(isset($SESSION['admin'])){
            $groupe=Groupe::where('idGroupe','!=',$idGroupe)->get();
            foreach($groupe as $values){
                $values->idLogement=null;
            }
            $grp = Groupe::where('idGroupe','=',$idGroupe);
            $log = Logement::where('idLogement','=',$grp->idLogement);
            $log->places=0;
            $log->save();
        }
    }
}