<?php

include_once './_core/class.MySQL.php';
include_once './models/class.Model.php';
include_once './controllers/class.Controller.php';



/*
 * 
 * Routing Engine
 */

Class RouteEngine {
    
    public $members;
    public $ewallet;
    public $transaction;

    public function __construct() {
        $this->members=new Members();
        $this->ewallet=new Ewallet();
        $this->transaction=new Transaction();
    }



    public function dispatch($requestURI) {
        switch (explode("?", $requestURI)[0]) {

            case "/":
                $this->members->login();
                break;

            case "/ewallet/retrieve":
                $this->ewallet->retrieve();
                break;
            
            case "/transaction/retrieve":
                $this->transaction->retrieve();
                break;
        }
    }

}

$routeEngine=new RouteEngine();
$routeEngine->dispatch($_SERVER["REQUEST_URI"]);
