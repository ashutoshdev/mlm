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
    public $purchase;
    public $items;
    public $payment;

    public function __construct() {
        $this->members = new Members();
        $this->ewallet = new Ewallet();
        $this->transaction = new Transaction();
        $this->purchase = new purchase();
        $this->items=new Items();
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

            case "/transaction/retrieve":
                $this->transaction->retrieve();
                break;

            case "/purchase/create":
                $this->purchase->create();
                break;
            
            case "/items/retrieve/ajaxify":
                //echo "hello there";
                $this->items->retrieve(TRUE);
                break;
        }
    }

}

$routeEngine = new RouteEngine();
$routeEngine->dispatch($_SERVER["REQUEST_URI"]);
