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
class ContactDevenir extends Model {
    var $table='`contact` inner join `devenir` on devenir.d_code=contact.d_code'; //jointure
    
}
