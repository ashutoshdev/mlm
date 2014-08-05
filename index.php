<?php
include_once './_core/class.MySQL.php';
include_once './_core/class.Model.php';
include_once './_core/class.Controller.php';


include_once './models/models.php';
include_once './controllers/controllers.php';


/*
 * 
 * Routing Engine
 */

Class RouteEngine {


    public function __construct() {
        $this->members = new Members();
        $this->ewallet = new Ewallet();
        $this->transaction = new Transaction();
        $this->purchase = new purchase();
        $this->items = new Items();
        $this->users=new Users();
        $this->items_packages=new Items_Packages();
    }
    
    public function dispatch($requestURI) {
        switch (explode("?", $requestURI)[0]) {

            case "/":
                $this->members->login();
                break;

            case "/ewallet/create":
                $this->ewallet->create();
                break;

            case "/ewallet/retrieve":
                $this->ewallet->retrieve();
                break;

            case "/ewallet/acceptPayment":
                $this->ewallet->acceptPayment();
                break;
            
            case "/transaction/create":
                $this->transaction->create();
                break;

            case "/transaction/retrieve":
                $this->transaction->retrieve();
                break;

            case "/purchase/create":
                $this->purchase->create();
                break;

            case "/items/retrieve/ajaxify":
                $this->items->retrieve(TRUE);
                break;
            
            case "/items_packages/retrieve/ajaxify":
                $this->items_packages->retrieve(TRUE);
                break;
            
            case "/users/create":
                $this->users->create();
                break;
        }
    }

}

$routeEngine = new RouteEngine();
$routeEngine->dispatch($_SERVER["REQUEST_URI"]);
