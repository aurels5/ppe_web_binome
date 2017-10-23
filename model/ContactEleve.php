<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContactDevenir
 *
 * @author sarradin
 */
class ContactEleve extends Model {
    var $table='`contact` inner join `eleve` on eleve.u_code=contact.u_code'; //jointure sur le u_code de l'élève
    
}
