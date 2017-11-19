<?php

/**
 * Description of UserEleveContact : jointure entre User Eleve et Contact afin de savoir par exemple quels élèves ont une fiche contact
 *
 * @author sarradin
 */
class UserEleveContact extends Model {
    var $table='`contact` inner join `users` on contact.u_code=users.u_code inner join `eleve` on eleve.u_code=users.u_code'; 
//jointure sur le u_code de l'élève
    
}
