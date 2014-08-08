<?php

class OpeningStock_model extends Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function create($item_id,$qnty,$date){
        $sql="INSERT INTO opening_stock SET item_id='".$item_id."' , "
                . "quantity= '".$qnty."' , "
                . "stock_date = '".$date."' ;";
        $this->db->ExecuteSQL($sql);
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

class Transaction_master extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function create($transaction_id, $transaction_date, $head_account, $client_account_id, $debit, $credit, $note) {
        $sql = "INSERT INTO company_transaction_master SET "
                . "transaction_id='" . $transaction_id . "' , "
                . "transaction_date='" . $transaction_date . "' , "
                . "head_account_id='" . $head_account . "' , "
                . "client_account_id='" . $client_account_id . "' , "
                . "debit='" . $debit . "' , "
                . "credit='" . $credit . "' , "
                . "note='" . $note . "' ; ";
        $this->db->ExecuteSQL($sql);
    }

}

class Transaction_details extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function create($transaction_id, $transaction_date, $items, $stock_debit, $stock_credit, $item_price, $note) {


        for ($i = 0; $i < count($items); $i++) {
            if ($items[$i]) {
                $sql = "INSERT INTO company_transaction_details SET "
                        . "transaction_id = '" . $transaction_id . "' , "
                        . "transaction_date = '" . $transaction_date . "' , "
                        . "item_id = '" . $items[$i] . "' , "
                        . "stock_debit = '$stock_debit[$i]' , "
                        . "stock_credit = '" . $stock_credit[$i] . "' , "
                        . "item_unit_price ='" . $item_price[$i] . "' , "
                        . "note = '" . $note . "';";
                $this->db->ExecuteSQL($sql);
            }
        }
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

    public function retrieveItemPrice($item_id) {
        $sql = "SELECT * FROM (

        SELECT item_master.item_id,item_name,item_price
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
                GROUP BY package_name
        )x WHERE x.item_id ='" . $item_id . "'";
        $result = $this->db->ExecuteSQL($sql);
        return $result[0]["item_price"];
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

class ItemMaster_model extends Model {

    public function __construct() {
        parent::__construct();
    }

<<<<<<< HEAD
    public function create($product, $category) {
        $sql = "INSERT INTO `item_master` SET `item_id` = NULL, `item_category` = '$category', `item_name` = '$product'";

        $this->db->executeSQL($sql);
        return $this->db->lastInsertID();
    }

    public function createPackage($pck_id, $pid, $price) {
        $sql = "INSERT INTO `package_details` SET `package_id` = '$pck_id' , `item_id` = '$pid', `item_price` = '$price'";
=======
    public function create($product, $item_type, $item_price) {
        $sql = "INSERT INTO `item_master` SET `item_name` = '$product' , `item_category` = '" . $item_type . "' , `item_price`='" . $item_price . "' ";
>>>>>>> 89e29283e45e8e60d236fe3fa034c1a4925d6676
        $this->db->executeSQL($sql);
    }

    public function retrieve() {
        $sql = "SELECT * FROM item_master";
        $result = $this->db->executeSQL($sql);
        return $result;
    }
    
    public function retrieveEdit($id) {
        $sql = "SELECT i.*, p.	item_price FROM item_master i
            LEFT JOIN package_details p ON i.item_id = p.item_id
            WHERE p.package_id = 1
            AND i.item_id = '".$id."'";

        $result = $this->db->executeSQL($sql);
        return $result;
    }

    /* public function createPackage($pck_id, $pid, $price) {
      $sql = "INSERT INTO `package_details` SET `package_id` = '$pck_id' , `item_id` = '$pid', `item_price` = '$price'";
      $this->db->executeSQL($sql);
      } */

    /* public function retrieve() {
      $sql = "SELECT i.*, p.	item_price FROM item_master i
      LEFT JOIN package_details p ON i.item_id = p.item_id
      WHERE p.package_id = 1";

      $result = $this->db->executeSQL($sql);
      return $result;
      } */
}

class packageMaster_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function create($package_name) {
        $sql = "INSERT INTO `package_master` SET `package_name` = '$package_name'";
        $this->db->executeSQL($sql);
        return $this->db->lastInsertID();
    }

}

class packageDetails_model extends Model {

    public function __construct() {
        parent::__construct();
    }

<<<<<<< HEAD
    public function retrieve() {
        $sql = "SELECT item_master.item_id,item_name,item_price,package_master.package_id
        FROM package_details
        JOIN package_master
        ON package_master.package_id=package_details.package_id
        JOIN item_master
        ON package_details.item_id=item_master.item_id
        WHERE package_name='DEFAULT'
        UNION ALL
        SELECT GROUP_CONCAT(item_master.item_id SEPARATOR ',') AS item_id,package_name AS 'item_name',SUM(item_price) AS item_price,package_details.package_id
        FROM package_details
        JOIN package_master
        ON package_master.package_id=package_details.package_id
        JOIN item_master
        ON package_details.item_id=item_master.item_id
        WHERE package_name != 'DEFAULT'
        GROUP BY package_name";
        //echo $sql;
        $result = $this->db->executeSQL($sql);
        return $result;
=======
    public function create($package_id, $item_id) {
        $sql = "INSERT INTO `package_details` SET `package_id` = '" . $package_id . "' , "
                . "`item_id` = '" . $item_id . "';";
        $this->db->executeSQL($sql);
>>>>>>> 89e29283e45e8e60d236fe3fa034c1a4925d6676
    }
    
    public function retrievePackageItem($pid) {
        $sql = "select p.*, i.item_name from package_details p
            left join item_master i on p.item_id = i.item_id
            WHERE p.package_id = $pid";
        $result = $this->db->executeSQL($sql);
        return $result;
    }

}

/* class Package_model extends Model {

  public function __construct() {
  parent::__construct();
  }

  public function create($package) {
  $sql = "INSERT INTO `package_master` SET `package_name` = '$package'";
  $this->db->executeSQL($sql);
  return $this->db->lastInsertID();
  }

  public function createPackage($pck_id, $pid, $price) {
  $sql = "INSERT INTO `package_details` SET `package_id` = '$pck_id' , `item_id` = '$pid', `item_price` = '$price'";
  $this->db->executeSQL($sql);
  }


  public function retrieve() {
  $sql = "SELECT * FROM `package_master`";
  $result = $this->db->executeSQL($sql);
  return $result;
  }

  } */

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
