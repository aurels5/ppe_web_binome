<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserEleve
 *
 * @author sarradin
 */
class UserEleve extends Model {//Modèle pour jointure
    var $table='`users` inner join `eleve` on users.u_code=eleve.u_code'; //jointure
}
