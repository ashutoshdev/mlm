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

class Members_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function login($username, $password) {
        $sql = "SELECT COUNT(*) AS count FROM user WHERE user_name='" . $username . "' and user_password='" . $password . "';";
        $result = $this->db->ExecuteSQL($sql);
        return $result["count"]["0"];
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

class Members {

    public $model;

    public function __construct() {
        $this->model = new Members_model();
    }

    public function login() {

        if (sizeof($_POST)) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($this->model->login($username, $password))
                header("Location: /modules/ewallet");
        }


        $page_template = "./views/members/login.php";
        require_once './views/templates/masterPage.php';
    }

    public function logout() {
        
    }

}

class Controller {

    public $members;
    public $modules;

    public function __construct() {
        $this->members = new Members();
        $this->modules = new Modules();
    }

}

$controller = new Controller();


/*
 * 
 * Routing Engine
 */

switch ($_SERVER["REQUEST_URI"]) {

    case "/":
        $controller->members->login();
        break;

    case "/modules/users/create":
        $controller->modules->users->create();
        break;

    case "/modules/users/retrieve":
        $controller->modules->users->retrieve();
        break;

    case "/modules/ewallet/":
        $controller->modules->ewallet->retrieve();
        break;
}
