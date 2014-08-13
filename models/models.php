<?php

class OpeningStock_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function create($item_id, $qnty, $date) {
        $sql = "INSERT INTO opening_stock SET item_id='" . $item_id . "' , "
                . "quantity= '" . $qnty . "' , "
                . "stock_date = '" . $date . "' ;";
        $this->db->ExecuteSQL($sql);
    }
    
    public function updateItemIdStock($item_id, $qnty, $date) {
        $sql = "UPDATE `opening_stock` SET `quantity` = '".$qnty."',"
                . "`stock_date` = '".$date."' WHERE `item_id` = '".$item_id."'";
        $this->db->ExecuteSQL($sql);
    }
    
    public function retrieveExist($item_id) {
        $sql = "select id from opening_stock where item_id = '".$item_id."' ";
        $result = $this->db->ExecuteSQL($sql);
        return $result[0][id];
    }

}

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
                $sql = "SELECT user_name,transaction_id,transaction_date,debit,credit,note ,transaction_type
                    FROM company_transaction_master
                    JOIN user
                    ON user.user_id = company_transaction_master.client_account_id
                    where head_account_id = '".$userId."' AND status = '1' ";
//            }
//            else{
//                $sql = "SELECT user_name,transaction_id,transaction_date,debit,credit,note ,transaction_type
//                    FROM company_transaction_master
//                    JOIN user
//                    ON user.user_id = company_transaction_master.client_account_id
//                    where client_account_id = '".$userId."' ";
//            }
            $result = $this->db->ExecuteSQL($sql);
            return $result;

        else :

            $sql = "SELECT user_name,transaction_id,transaction_date,debit,credit,note ,transaction_type
                    FROM company_transaction_master
                    JOIN user
                    ON user.user_id = company_transaction_master.client_account_id
                    where status = '0' ";
        
            $result = $this->db->ExecuteSQL($sql);
            return $result;
        endif;
    }

    public function update($accept) {

        foreach ($accept as $value) {
            $sql = "UPDATE company_transaction_master SET status ='1' WHERE transaction_id='" . $value . "';";
            $this->db->ExecuteSQL($sql);
        }
    }
   
}

class Transaction_master extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function create($transaction_id, $transaction_date, $bank_tran_id = "0", $head_account, $client_account_id, $debit, $credit, $note,$transaction_type="TRANSACTION", $status = 1) {
        $sql = "INSERT INTO company_transaction_master SET "
                . "transaction_id='" . $transaction_id . "' , "
                . "transaction_date='" . $transaction_date . "' , "
                . "bank_transaction_id = '" . $bank_tran_id . "' , "
                . "head_account_id='" . $head_account . "' , "
                . "client_account_id='" . $client_account_id . "' , "
                . "debit='" . $debit . "' , "
                . "credit='" . $credit . "' , "
                . "note='" . $note . "' , "
                . "transaction_type='".$transaction_type."', "
                . "status='" . $status . "' ";
        $this->db->ExecuteSQL($sql);
    }

}

class Transaction_details extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function create($transaction_id, $transaction_date, $items, $stock_debit, $stock_credit, $item_price, $note) {

        $sql = "INSERT INTO company_transaction_details SET "
                . "transaction_id = '" . $transaction_id . "' , "
                . "transaction_date = '" . $transaction_date . "' , "
                . "item_id = '" . $items . "' , "
                . "stock_debit = '$stock_debit' , "
                . "stock_credit = '" . $stock_credit . "' , "
                . "item_unit_price ='" . $item_price . "' , "
                . "note = '" . $note . "' ";
        $this->db->ExecuteSQL($sql);
    }
    
    public function retrieveItem($item_id) {

        $sql = "select * from company_transaction_details where item_id = '".$item_id."' ";
        echo $sql;
        $result = $this->db->executeSQL($sql);
        return $result;

    }
    
    

}

class Transaction_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function createId() {
        $sql = "SELECT IF(ISNULL(MAX(transaction_id)),1,MAX(transaction_id)+1) AS id FROM company_transaction_master";
        $result = $this->db->ExecuteSQL($sql);
        return $result[0]['id'];
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

class Items_Packages_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function retrieveItem() {

        $sql = "SELECT item_id , item_name FROM item_master
        UNION ALL
        SELECT package_id AS 'item_id' , package_name AS 'item_name'  FROM package_master";
        $result = $this->db->ExecuteSQL($sql);
        return $result;
    }

    public function retrieveItemPrice($item_id) {


        $sql = "SELECT * FROM (
        SELECT item_id , item_price FROM item_master
        UNION ALL
        SELECT package_id AS 'item_id' , package_price AS 'item_price' FROM package_master)x
        WHERE item_id='" . $item_id . "' ";
        $result = $this->db->ExecuteSQL($sql);
        return $result[0]["item_price"];
    }

}

class Users_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function create($introducer_id, $created_by, $user_name, $user_email, $user_password, $position) {
        $sql = "INSERT INTO user SET introducer_id='" . $introducer_id . "', "
                . "created_by='" . $created_by . "' ,"
                . "role='2' , "
                . "user_left_right_index='".$position."' ,"
                . "user_name='" . $user_name . "' ,"
                . "user_email='" . $user_email . "' ,"
                . "user_password='" . $user_password . "',"
                . "joining_date = '".date("Y-m-d")."'";

        $this->db->ExecuteSQL($sql);
        return $this->db->lastInsertID();
    }

    public function retrieve() {
        $sql = "SELECT u.*, n.user_name as name FROM user u "
                . "left join user n on u.created_by = n.user_id";
        $result = $this->db->ExecuteSQL($sql);
        return $result;
    }
    
    public function retrieveUserIndex($int) {
        $sql = "SELECT	user_left_right_index FROM user where user_id = '".$int."' ";
        $result = $this->db->ExecuteSQL($sql);
        return $result[0]['user_left_right_index'];
    }

}

class ItemMaster_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getItemId() {
        $sql = "SELECT item_id FROM item_master ORDER BY item_id DESC LIMIT 0,1 ;";
        $result = $this->db->ExecuteSQL($sql);
        return $result[0]["item_id"];
    }

    public function createItemId($lastItemId) {

        $recent_id = $lastItemId[1] . $lastItemId[2] . $lastItemId[3] . $lastItemId[4] . $lastItemId[5] . $lastItemId[6];
        $fid = $recent_id + 1;
        $lid = strlen($fid);
        if ($lid == 1) {
            $id = "I00000" . $fid;
        } else if ($lid == 2) {
            $id = "I0000" . $fid;
        } else if ($lid == 3) {
            $id = "I000" . $fid;
        } else if ($lid == 4) {
            $id = "I00" . $fid;
        } else if ($lid == 5) {
            $id = "I0" . $fid;
        } else {
            $id = "I" . $fid;
        }

        return $id;
    }

    public function create($product, $item_type, $item_price) {

        $lastItemId = $this->getItemId();


        if (!$lastItemId):
            $sql = "INSERT INTO `item_master` SET "
                    . "`item_id`='I000001' , "
                    . "`item_name` = '$product' , "
                    . "`item_category` = '" . $item_type . "' , "
                    . "`item_price`='" . $item_price . "' ";
        else:
            $sql = "INSERT INTO `item_master` SET "
                    . "`item_id`='" . $this->createItemId($lastItemId) . "' , "
                    . "`item_name` = '$product' , "
                    . "`item_category` = '" . $item_type . "' , "
                    . "`item_price`='" . $item_price . "' ";
        endif;
        $this->db->ExecuteSQL($sql);
    }

    public function retrieve($pid = NULL) {
        if (!$pid) {
            $sql = "select i.*, o.quantity from item_master i "
                    . "LEFT JOIN  opening_stock o on i.item_id = o.item_id ";
        } else {
            $sql = "select i.* from item_master i "
                    . "LEFT JOIN  package_details p on i.item_id = p.item_id "
                    . "WHERE p.package_id = '" . $pid . "' ";
        }
        $result = $this->db->ExecuteSQL($sql);
        return $result;
    }


    /*
      
     public function retrieveEdit($id) {
        $sql = "SELECT i.*, p.	item_price FROM item_master i
        LEFT JOIN package_details p ON i.item_id = p.item_id
        WHERE p.package_id = 1
        AND i.item_id = '" . $id . "'";
        $result = $this->db->ExecuteSQL($sql);
        return $result;
    } 

       */

    public function retrievePin() {
        $sql="SELECT * FROM item_master WHERE item_category='PIN' limit 0,1;";
        $result=$this->db->ExecuteSQL($sql);
        return $result[0];
    }

}

class packageMaster_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getPackageId() {
        $sql = "SELECT package_id FROM package_master ORDER BY package_id DESC LIMIT 0,1 ;";
        $result = $this->db->ExecuteSQL($sql);
        return $result[0]["package_id"];
    }

    public function createPackageId($lastItemId) {

        $recent_id = $lastItemId[1] . $lastItemId[2] . $lastItemId[3] . $lastItemId[4] . $lastItemId[5] . $lastItemId[6];
        $fid = $recent_id + 1;
        $lid = strlen($fid);
        if ($lid == 1) {
            $id = "P00000" . $fid;
        } else if ($lid == 2) {
            $id = "P0000" . $fid;
        } else if ($lid == 3) {
            $id = "P000" . $fid;
        } else if ($lid == 4) {
            $id = "P00" . $fid;
        } else if ($lid == 5) {
            $id = "P0" . $fid;
        } else {
            $id = "P" . $fid;
        }

        return $id;
    }

    public function create($package_name, $package_price) {

        $lastPackageId = $this->getPackageId();
        $package_id = "P000001";

        if (!$lastPackageId):

            $sql = "INSERT INTO `package_master` SET "
                    . "`package_id` = '" . $package_id . "' , "
                    . "`package_name` = '$package_name' , "
                    . "`package_price`='" . $package_price . "'";
        else:

            $package_id = $this->createPackageId($lastPackageId);
            $sql = "INSERT INTO `package_master` SET "
                    . "`package_id` = '" . $package_id . "' , "
                    . "`package_name` = '$package_name' , "
                    . "`package_price`='" . $package_price . "'";

        endif;
        $this->db->ExecuteSQL($sql);



        return $package_id;
    }

}

class packageDetails_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function create($package_id, $item_id, $quantity) {
        $sql = "INSERT INTO `package_details` SET `package_id` = '" . $package_id . "' , "
                . "`item_id` = '" . $item_id . "', `quantity` = '" . $quantity . "'";
        $this->db->ExecuteSQL($sql);
    }

    public function retrievePackageItem($pid) {
        $sql = "select p.*, i.item_name from package_details p"
                . "LEFT JOIN item_master i on i.item_id = p.item_id"
                . "WHERE p.package_id = '" . $pid . "' ";
        echo $sql;
        $result = $this->db->ExecuteSQL($sql);
        return $result;
    }

}

class Package_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function retrieve() {
        $sql = "SELECT * FROM `package_master`";
        $result = $this->db->executeSQL($sql);
        return $result;
    }

}

class Members_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function login($username, $password) {
        $sql = "SELECT COUNT( * ) AS count, u.user_id, r.role_name FROM user u
                LEFT JOIN user_role r ON r.role_id = u.role 
                WHERE u.user_name='" . $username . "' and u.user_password='" . $password . "' ";
        $result = $this->db->ExecuteSQL($sql);
        return $result;
    }

}


class Stock_model extends Model{
    
    public function retrieve($date_from , $date_to){
        $sql="SELECT item_id,item_name,SUM(stock) AS stock FROM (
            SELECT item_master.item_id AS item_id , item_name , quantity AS stock FROM opening_stock
            JOIN item_master 
            ON item_master.item_id = opening_stock.item_id
            WHERE stock_date >='2014-04-01' AND stock_date <= '2015-04-01'
            UNION ALL
            SELECT item_master.item_id AS item_id, item_name, stock_debit-stock_credit AS stock FROM company_transaction_details
            JOIN item_master
            ON item_master.item_id = company_transaction_details.item_id
            WHERE transaction_date >='".$date_from."' AND transaction_date <='".$date_to."'
            )x
            GROUP BY item_id,item_name
            ";
       
        $result = $this->db->ExecuteSQL($sql);        
        return $result;
        
    }
    
    
}
