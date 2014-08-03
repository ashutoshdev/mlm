<?php

session_start();

class Controller {

    public $ewallet_model;
    public $transaction_model;
    public $members_model;

    public function __construct() {
        $this->ewallet_model = new Ewallet_model();
        $this->transaction_model = new Transaction_model();
        $this->members_model = new Members_model();
    }

}

class Members extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function login() {

        if (sizeof($_POST)) {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $result = $this->members_model->login($username, $password);


            if ($result[0]["count"]) {
                $_SESSION["user_id"] = $result[0]["user_id"];
                header("Location: /ewallet/retrieve");
            }
        }


        $page_template = "./views/members/login.php";
        require_once './views/templates/masterPage.php';
    }

    public function logout() {
        
    }

}

class Ewallet extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        require_once './views/modules/ewallet/create.php';
    }

    public function retrieve() {
        $userId = $_SESSION["user_id"];
        $result = $this->ewallet_model->retrieve($userId);
        $page_template = "./views/modules/ewallet/retrieve.php";
        require_once './views/templates/masterPage.php';
    }

    public function update() {
        
    }

    public function delete() {
        
    }

}

class Transaction extends Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function create(){
        
    }
    
    public function retrieve(){
        
        if(sizeof($_GET))
            $transaction_id=$_GET["id"];   
        
        $result=$this->transaction_model->retrieve($transaction_id);
        $page_template = "./views/modules/transaction/retrieve.php";
        require_once './views/templates/masterPage.php';
        
    }
    
    public function update(){
        
    }
    
    public function delete(){
        
    }
}
