<?php

class Ewallet_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function create($user_id, $bank_tid, $debit, $note) {

        $sql = "INSERT INTO user_e_wallet SET `user_id` =  '$user_id', "
                . "`bank_transaction_id` = '$bank_tid',   `debit` = '$debit', `credit` = '0',"
                . "`note`  = '$note', `status` = '0' ";
        $result = $this->db->ExecuteSQL($sql);
        return $result;
    }

    public function retrieve($userId = NULL) {

        if ($userId):
            $sql = "SELECT * FROM user_e_wallet WHERE user_id='" . $userId . "' AND status = 1;";
            $result = $this->db->ExecuteSQL($sql);
            return $result;

        else :

            $sql = "SELECT * FROM user_e_wallet JOIN user ON user.user_id = user_e_wallet.user_id;";
            $result = $this->db->ExecuteSQL($sql);
            return $result;
        endif;
    }

    public function update($accept) {

        foreach ($accept as $value) {
            $sql = "UPDATE user_e_wallet SET status ='1' WHERE id='" . $value . "';";
            $this->db->ExecuteSQL($sql);
        }
    }

}

class Transaction_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        
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

class Items_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function retrieve() {
        $sql = "SELECT * FROM item_master;";
        $result = $this->db->executeSQL($sql);
        return $result;
    }

}

class Members_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function login($username, $password) {
        $sql = "SELECT COUNT(*) AS count,user_id,role FROM user WHERE user_name='" . $username . "' and user_password='" . $password . "';";
        $result = $this->db->ExecuteSQL($sql);
        return $result;
    }

}

class Users_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function create($introducer_id, $created_by, $user_name, $user_email, $user_password) {
        $sql = "INSERT INTO user SET introducer_id='" . $introducer_id . "', "
                . "created_by='" . $created_by . "' ,"
                . "role='2' , "
                . "user_left_right_index='0' ,"
                . "user_name='" . $user_name . "' ,"
                . "user_email='" . $user_email . "' ,"
                . "user_password='" . $user_password . "'";

        $this->db->ExecuteSQL($sql);
    }

    public function retrieve() {
        $sql = "SELECT * FROM user";
        $result = $this->db->ExecuteSQL($sql);
        return $result;
    }

}

class Items_Packages_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function retrieve() {
        $sql = "SELECT item_master.item_id,item_name,item_price 
FROM package_details
JOIN package_master
ON package_master.package_id=package_details.package_id
JOIN item_master
ON package_details.item_id=item_master.item_id
WHERE package_name='DEFAULT'
UNION ALL
SELECT GROUP_CONCAT(item_master.item_id SEPARATOR ',') AS item_id,package_name AS 'item_name',SUM(item_price) AS item_price
FROM package_details
JOIN package_master
ON package_master.package_id=package_details.package_id
JOIN item_master
ON package_details.item_id=item_master.item_id
WHERE package_name != 'DEFAULT'
GROUP BY package_name";
        $result = $this->db->ExecuteSQL($sql);
        return $result;
    }

}
