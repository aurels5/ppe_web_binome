<?php

/**
 * Description of UserEleveContact : jointure entre User Eleve et Contact afin de savoir par exemple quels élèves ont une fiche contact
 *
 * @author sarradin
 */
class UserEleveContact extends Model {
    var $table='`users` inner join `eleve` on eleve.u_code=users.u_code left join `contact` on eleve.u_code=contact.u_code'; 
//jointure sur le u_code de l'élève
    
}
