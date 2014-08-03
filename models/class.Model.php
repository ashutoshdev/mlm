<?php

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

    public function create() {
        
    }

    public function retrieve($userId) {
        $sql = "SELECT * FROM e_wallet where user_id='" . $userId . "';";
        $result = $this->db->ExecuteSQL($sql);
        return $result;
    }

    public function update() {
        
    }

    public function delete() {

    }

}

class Transaction_model extends Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function create(){
        
    }
    
    public function retrieve($transaction_id){
        $sql="SELECT * FROM transaction_master WHERE transaction_id='".$transaction_id."'";
        $result["transaction_master"] = $this->db->ExecuteSQL($sql);
        $sql="SELECT * FROM transaction_details "
                ."JOIN item_master ON transaction_details.item_id = item_master.item_id "
                . "WHERE transaction_id='".$transaction_id."';";
        $result["transaction_details"]=  $this->db->executeSQL($sql);
        return $result;
    }
    
    public function update(){
        
    }
    
    public function delete(){
        
    }

}

class Members_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function login($username, $password) {
        $sql = "SELECT COUNT(*) AS count,user_id FROM user WHERE user_name='" . $username . "' and user_password='" . $password . "';";
        $result = $this->db->ExecuteSQL($sql);
        return $result;
    }

}
