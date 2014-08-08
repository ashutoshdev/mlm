<?php

session_start();

class Item extends Controller {

    public function __construct() {
        parent::__construct();

        if (!$_SESSION['user_id']) {
            header("location: /members/logout/");
        }

        $this->load->_CLASS("ItemMaster_model");
    }

    public function create() {



        if (sizeof($_POST)) {

            $item_name = $_POST['product_name'];
            $item_type = $_POST["item_type"];
            $item_price = $_POST['price'];
            $this->itemmaster_model->create($item_name, $item_type, $item_price);
        }

        $page_template = "./views/item/create.php";
        require_once './views/_templates/masterPage.php';
    }

    public function retrieve() {

        if($_GET["packageId"]){

            $result = $this->itemmaster_model->retrieve($_GET["packageId"]);
        }
        else{
             $result = $this->itemmaster_model->retrieve();

        }
        $page_template = "./views/item/retrieve.php";
        require_once './views/_templates/masterPage.php';
       
    }

}

class OpeningStock extends Controller {

    public function __construct() {

        parent::__construct();

        if (!$_SESSION['user_id']) {
            header("location: /members/logout/");
        }
        $this->load->_CLASS("ItemMaster_model");
        $this->load->_CLASS("OpeningStock_model");
    }

    public function create() {



        if (sizeof($_POST)) {

            $itemId = $_POST["itemId"];
            $qnty = $_POST["qnty"];
            $date = date("Y-m-d");

            foreach ($itemId as $k => $v) {
                $this->openingstock_model->create($v, $qnty[$k], $date);
            }
        }

        $result = $this->itemmaster_model->retrieve();
        $page_template = "./views/openingstock/create.php";
        require_once './views/_templates/masterPage.php';
    }

    public function edit() {



        $eid = $_GET['eid'];
        $result = $this->item_model->retrieveEdit($eid);

        $page_template = "./views/item/retrieve_edit.php";
        require_once './views/_templates/masterPage.php';
    }

}

class Stock extends Controller {

    public function __construct() {
        parent::__construct();

        if (!$_SESSION['user_id']) {
            header("location: /members/logout/");
        }
    }

    public function retrieve() {
        
    }

}

class Package extends Controller {

    public function __construct() {

        parent::__construct();

        if (!$_SESSION['user_id']) {
            header("location: /members/logout/");
        }
        $this->load->_CLASS("Package_model");
        $this->load->_CLASS("PackageMaster_model");
        $this->load->_CLASS("packageDetails_model");
        $this->load->_CLASS("ItemMaster_model");
    }

    public function create() {

        if (sizeof($_POST)) :

            $package_name = $_POST["package_name"];
            $package_price = $_POST["package_price"];
            $p_item = $_POST['item'];
            $p_quantity = $_POST['quantity'];

            if ($package_name) {
                $id = $this->packagemaster_model->create($package_name, $package_price);
            }

            foreach ($p_item as $key => $item):
                $this->packagedetails_model->create($id, $key, $p_quantity[$key]);
            endforeach;


        endif;

        $product = $this->itemmaster_model->retrieve();
        $page_template = "./views/package/create.php";
        require_once './views/_templates/masterPage.php';
    }

    public function retrieve() {

            $result = $this->package_model->retrieve();
            
            /*foreach ($result as $val) {
                $item_res[$val['package_id']] = $this->packageDetails_model->retrievePackageItem($val['package_id']);
                print_r($item_res); die;
            }*/           
            $page_template = "./views/package/retrieve.php";
            require_once './views/_templates/masterPage.php';

    }

}

class Members extends Controller {

    public function __construct() {
        parent::__construct();
        $this->load->_CLASS("Members_model");
    }

    public function login() {

        if (sizeof($_POST)) {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $result = $this->members_model->login($username, $password);


            if ($result[0]["count"]) {
                $_SESSION["user_id"] = $result[0]["user_id"];
                $_SESSION["user_role"] = $result[0]["role_name"];
                header("Location: /ewallet/retrieve");
            }
        }


        require_once './views/_templates/login.php';
    }

    public function logout() {
        session_destroy();
        header("location: /");
    }

}

class Ewallet extends Controller {

    public function __construct() {
        parent::__construct();

        if (!$_SESSION['user_id']) {
            header("location: /members/logout/");
        }
        $this->load->_CLASS("Ewallet_model");
    }

    public function create() {

        if (sizeof($_POST))
            $this->ewallet_model->create($_SESSION['user_id'], $_POST['bank_tran_id'], $_POST['payment'], $_POST['note']);

        $page_template = "./views/ewallet/create.php";
        require_once './views/_templates/masterPage.php';
    }

    public function retrieve() {
        $userId = $_SESSION["user_id"];
        $result = $this->ewallet_model->retrieve($userId);
        $page_template = "./views/ewallet/retrieve.php";
        require_once './views/_templates/masterPage.php';
    }

    public function acceptPayment() {

        if (sizeof($_POST))
            $this->ewallet_model->update($_POST["accept"]);

        $result = $this->ewallet_model->retrieve();
        $page_template = "./views/ewallet/acceptPayment.php";
        require_once './views/_templates/masterPage.php';
    }

}

class Transaction extends Controller {

    public function __construct() {
        parent::__construct();

        if (!$_SESSION['user_id']) {
            header("location: /members/logout/");
        }

        $this->load->_CLASS("Users");

        $this->load->_CLASS("Transaction_model");
        $this->load->_CLASS("Transaction_master");
        $this->load->_CLASS("Transaction_details");
        $this->load->_CLASS("Items_Packages");
    }

    public function create() {

        if (!$_SESSION['user_id']) {
            header("location: /members/logout/");
        }

        if (sizeof($_POST)) {
            $trsnsaction_type = $_POST['transaction_type'];

            $transaction_date = date("Y-m-d");
            $head_account = $_SESSION["user_id"];
            $client_account_id = $_POST["users"];
            $items = $_POST["items"];
            $item_unit_price = $_POST["price"];
            

            $totprice = 0;
            foreach ($_POST["totprice"] as $value) {
                $totprice = $totprice + $value;
            }
            $debit = $trsnsaction_type == "SALE" ? $totprice : 0;
            $credit = $trsnsaction_type == "PURCHASE" ? $totprice : 0;



            $stock_debit = array();
            $stock_credit = array();
            $quantity = $_POST['qnty'];
            foreach ($quantity as $v) {
                $stock_debit[] = $trsnsaction_type == "SALE" ? 0 : $v;
                $stock_credit[] = $trsnsaction_type == "PURCHASE" ? 0 : $v;
            }

            $transaction_id = $this->transaction_model->createId();
            $this->transaction_master->create($transaction_id, $transaction_date, $head_account, $client_account_id, $debit, $credit, "");
            foreach ($items as $item_key => $item) {
              
                if ($item)
                    $this->transaction_details->create($transaction_id, $transaction_date, $item, $stock_debit[$item_key], $stock_credit[$item_key], $item_unit_price[$item_key], "");
            }
        }

        $html = $this->users->retrieve();
        $items_html = $this->items_packages->retrieveItem();
        $page_template = "./views/transaction/create.php";
        require_once './views/_templates/masterPage.php';
    }

    public function retrieve() {

        if (sizeof($_GET)):
            $transaction_id = $_GET["id"];
            $result = $this->transaction_model->retrieve($transaction_id);
        else:
            $result = $this->transaction_model->retrieve("", $_SESSION["user_id"]);
        endif;

        $page_template = "./views/transaction/retrieve.php";
        require_once './views/_templates/masterPage.php';
    }

}

class Users extends Controller {

    public function __construct() {
        parent::__construct();

        if (!$_SESSION['user_id']) {
            header("location: /members/logout/");
        }
        $this->load->_CLASS("Users_model");
    }

    public function create() {

        if (sizeof($_POST)) {
            $username = $_POST["username"];
            $useremail = $_POST["useremail"];
            $password = $_POST["password"];
            $introducer = $_POST["introducer"];
            $this->users_model->create($introducer, $_SESSION["user_id"], $username, $useremail, $password);
        }

        $html = $this->retrieve();
        $page_template = "./views/users/create.php";
        require_once './views/_templates/masterPage.php';
    }

    public function retrieve() {
        return $this->users_model->retrieve();
    }

}

class Items_Packages extends Controller {

    public function __construct() {
        parent::__construct();

        if (!$_SESSION['user_id']) {
            header("location: /members/logout/");
        }
        $this->load->_CLASS("Items_Packages_model");
    }

    public function retrieveItem($ajaxify = NULL) {
        $items_html = $this->items_packages_model->retrieveItem();

        if (!$ajaxify) {
            $option = "";

            $html = "           
           <tr>
            <td colspan =2>
                <table >
                    <tr>
                        <td>Item</td>
                        <td>Price</td>
                        <td>Qnty</td>
                        <td>Tot Price</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <select class='items' name='items[]' onchange = 'return show_items(this.value,1);'>
                                <option value='0'>Select Item</option>";

            foreach ($items_html as $value) {
                $option.= "<option value='" . $value["item_id"] . "'>" . $value["item_name"] . "</option>";
            }
            $html.="$option.</select></td>   
                        <td><input type='text' name='price[]' id = 'price_1' value = ''/></td>
                        <td><input type='text' name='qnty[]' id = 'qnty_1' value = '1' onblur = 'return quantity(this.value,1);'/></td>
                        <td><input type='text' name='totprice[]' id = 't_pr_1' value = ''/></td>
                        <td><a class='del' href='javascript:void(0);' style='text-decoration: none;' onclick='return remove_service(this);'>x</a></td>
                    </tr>
                </table>
              </td>
            </tr>";
            $html.='';
            return $html;
        } else {
            $option = "";

            $html = "           
           <tr>
            <td colspan = 2>
                <table >
                    <tr>
                        <td>
                            <select class='items' name='items[]' onchange = 'return show_items(this.value," . $_GET[id] . ");'>
                                <option value='0'>Select Item</option>";

            foreach ($items_html as $value) {
                $option.= "<option value='" . $value["item_id"] . "'>" . $value["item_name"] . "</option>";
            }
            $html.="$option.</select></td>
                        <td><input type='text' name='price[]'  id = 'price_" . $_GET[id] . "' value = ''/></td>
                        <td><input type='text' name='qnty[]'  id = 'qnty_" . $_GET[id] . "' value = '1' onblur = 'return quantity(this.value," . $_GET[id] . ");'/></td>
                        <td><input type='text' name='totprice[]'  id = 't_pr_" . $_GET[id] . "' value = ''/></td>
                        <td><a class='del' href='javascript:void(0);' style='text-decoration: none;' onclick='return remove_service(this);'>x</a></td>
                    </tr>
                </table>
              </td>
            </tr>";
            $html.='';

            echo $html;
        }
    }

    public function retrieveItemPrice($ajaxify = NULL) {
        if ($ajaxify) {
            $item_id = $_GET['id'];
            $item_price = $this->items_packages_model->retrieveItemPrice($item_id);
            echo $item_price;
        }
    }

}
