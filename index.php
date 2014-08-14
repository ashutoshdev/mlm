<?php

define('BASE_PATH', dirname(__FILE__));

// DB login info
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'bonnie');
define('DB_DBASE', 'db_mlm');


/*
 * define('DB_HOST', 'localhost');
define('DB_USER', 'nisclien_bonnie');
define('DB_PASSWORD', 'souparnomajumder');
define('DB_DBASE', 'nisclien_mlm');
 */



include_once './_core/class.Core.php'; '';
include_once './_core/class.MySQL.php';

include_once './models/models.php';
include_once './controllers/controllers.php';





Class RouteEngine extends Core {
   


    public function __construct() {        
        parent::__construct();
    }
    
    public function dispatch($requestURI) {
        switch (explode("?", $requestURI)[0]) {

            case "/":
                $this->load->_CLASS("Members");
                $this->members->login();
                break;
            
            case "/members/logout/":
                $this->load->_CLASS("Members");
                $this->members->logout();
                break;
                
            case "/ewallet/create":
                $this->load->_CLASS("Ewallet");
                $this->ewallet->create();
                break;
                
            case "/ewallet/retrieve":
                $this->load->_CLASS("Ewallet");
                $this->ewallet->retrieve();
                break;

            case "/ewallet/acceptPayment":
                $this->load->_CLASS("Ewallet");
                $this->ewallet->acceptPayment();
                break;
            
            case "/transaction/create":
                $this->load->_CLASS("Transaction");
                $this->transaction->create();
                break;

            case "/transaction/retrieve":
                $this->load->_CLASS("Transaction");
                $this->transaction->retrieve();
                break;
            
            case "/item/create":
                $this->load->_CLASS("Item");
                $this->item->create();
                break;
            
            case "/item/retrieve":
                $this->load->_CLASS("Item");
                $this->item->retrieve();
                break;
            
            case "/item/edit":
                $this->load->_CLASS("Item");
                $this->item->edit();
                break;
            
            case "/package/create":
                $this->load->_CLASS("Package");
                $this->package->create();
                break;
            
            case "/package/items/retieve/ajaxify":
                $this->load->_CLASS("Package");
                $this->package->retrieve(TRUE);
                break;           
            
            case "/package/retrieve":
                $this->load->_CLASS("Package");
                $this->package->retrieve();
                break;
            
            case "/items_packages/retrieve/ajaxify":
                $this->load->_CLASS("Items_Packages");
                $this->items_packages->retrieveItem(TRUE);
                break;
            
            case "/items_packages/retrieveItemPrice/ajaxify":
                $this->load->_CLASS("Items_Packages");
                $this->items_packages->retrieveItemPrice(TRUE);
                break;
            
            case "/users/create":
                $this->load->_CLASS("Users");
                $this->users->create();
                break;
            
            case "/users/retrieve":
                $this->load->_CLASS("Users");
                $this->users->retrieve();
                break;
            
            case "/openingstock/create":
                $this->load->_CLASS("OpeningStock");
                $this->openingstock->create();
                break;
            
            case "/stock/productStock":
                $this->load->_CLASS("stock");
                $this->stock->productStock();
                break;


         }
    }

}

$routeEngine = new RouteEngine();
$routeEngine->dispatch($_SERVER["REQUEST_URI"]);
