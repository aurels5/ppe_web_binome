<?php

/*
 * Configuration,
 * accès DB via le serveur...
 */
//echo 'tentative de connexion';
class Conf {
    static $debug=1;
    static $databases = array(
        'default' => array(
            'host' => 'localhost',
            'database' => 'devenir',
            'login' => 'devenir',
            'password' => 'devenir'
        )
    );
    

}
