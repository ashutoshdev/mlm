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

    public function retrieve($userId) {
        $sql = "SELECT * FROM user_e_wallet where user_id='" . $userId . "';";
        $result = $this->db->ExecuteSQL($sql);
        return $result;
    }
}

class Transaction_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function retrieve($transaction_id = NULL, $user_id = NULL) {

        if ($transaction_id):
            $sql = "SELECT * FROM company_transaction_master WHERE transaction_id='" . $transaction_id . "'";
            $result["transaction_master"] = $this->db->ExecuteSQL($sql);
            $sql = "SELECT * FROM company_transaction_details "
                    . "JOIN item_master ON company_transaction_details.item_id = item_master.item_id "
                    . "WHERE transaction_id='" . $transaction_id . "';";
            $result["transaction_details"] = $this->db->executeSQL($sql);
            return $result;

        elseif ($user_id) :
            $sql = "SELECT * FROM company_transaction_master WHERE transaction_id in (SELECT transaction_id FROM user_e_wallet WHERE user_id='" . $user_id . "')";
            $result["transaction_master"] = $this->db->ExecuteSQL($sql);
            $sql = "SELECT * FROM company_transaction_details "
                    . "JOIN item_master ON company_transaction_details.item_id = item_master.item_id "
                    . "WHERE transaction_id IN (SELECT transaction_id FROM user_e_wallet WHERE user_id='" . $user_id . "');";
            $result["transaction_details"] = $this->db->executeSQL($sql);
            return $result;

        endif;
    }
}

class Items_model extends Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function retrieve(){
        $sql="SELECT * FROM item_master;";
        $result=$this->db->executeSQL($sql);
        return $result;
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
