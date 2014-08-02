<?php

require_once './core/class.MySQL.php';


class Model {

    public $db;

    public function __construct() {
        $this->db = new MySQL('db_mlm', 'root', 'bonnie');
    }

}

class Ewallet_model extends Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function ewallet_create() {
        $sql = "INSERT INTO ";
        $this->db->ExecuteSQL($query);
    }

    public function ewallet_retrieve() {
        $sql = "";
        $this->db->ExecuteSQL($query);
    }

    public function ewallet_Update() {
        $sql = "";
        $this->db->ExecuteSQL($query);
    }

    public function delete() {
        $sql = "";
        $this->db->ExecuteSQL($query);
    }

}

class Members_model extends Model{
    
    public function login(){
        $sql="";
    }
}


class Users {

    public function create() {
        require_once './views/modules/users/create.php';
    }

    public function retrieve() {
        require_once './views/modules/users/retrieve.php';
    }

    public function update() {
        
    }

    public function delete() {
        
    }

}

class Ewallet {

    public function create() {
        require_once './views/modules/ewallet/create.php';
    }

    public function retrieve() {
        require_once './views/modules/ewallet/retrieve.php';
    }

    public function update() {
        
    }

    public function delete() {
        
    }

}

class Modules {

    public $users;
    public $ewallet;

    public function __construct() {
        $this->users = new Users();
        $this->ewallet = new Ewallet();
    }

}

class Members{
    
    public $model;
    
    public function __construct() {
//        $this->model=;
    }

    public function login(){
           
    }
    
    public function logout(){
        
    }
}

class Controller {

    public $members;
    public $modules;
    

    public function __construct() {
        $this->members=new Members();
        $this->modules = new Modules();
    }
}

$controller = new Controller();


/*
 * 
 * Routing Engine
 */

switch ($_SERVER["REQUEST_URI"]) {

    case "/modules/users/create":
        $controller->modules->users->create();
        break;

    case "/modules/users/retrieve":
        $controller->modules->users->retrieve();
        break;
    
    case "/modules/ewallet/retrieve":
        $controller->modules->ewallet->retrieve();
        break;
}
