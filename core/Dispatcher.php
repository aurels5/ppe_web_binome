<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dispatcher
 *
 * @author travail
 */
class Dispatcher {
    //put your code here
    var $request;
    function __construct() {
       // print_r($_SESSION);
        $this->request=new Request();
        //si 
        Router::parse($this->request) ;
        //print_r( $this->request);
        $controller=$this->loadController();
        if(!in_array($this->request->action, get_class_methods($controller))){
            $this->error('Le controleur n\'a pas '.$this->request->action);
        }
        call_user_func(array($controller, $this->request->action), $this->request->params);
        $controller->render($this->request->action);
    
    }
    function loadController(){
        //print_r($this->request);
        $name=ucfirst($this->request->controller).'Controller';
        $file=ROOT.DS.'controller'.DS.$name.'.php';
        require $file;
       return new $name($this->request);
    }
    function error($message){
        
        $controller=new Controller($this->request);
        $controller->e404($message);
       
        
    }
}
