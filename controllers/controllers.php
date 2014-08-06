<?php

session_start();

class Item extends Controller {

    public function __construct() {
        $this->model("Item_model");
    }

    public function create() {

        if (sizeof($_POST)) {
            $id = $this->item_model->create($_POST['product_name']);
            $this->item_model->createPackage('1', $id, $_POST['price']);
        }



        $page_template = "./views/item/create.php";
        require_once './views/_templates/masterPage.php';
    }

    public function retrieve() {


        $result = $this->item_model->retrieve();

        $page_template = "./views/item/retrieve.php";
        require_once './views/_templates/masterPage.php';
    }

}

class Package extends Controller {

    public function __construct() {
        $this->model("Package_model");
    }

    public function create() {

        $product = $this->package_model->showItem();
        if (sizeof($_POST)) {
            $id = $this->package_model->create($_POST['product_name']);
            $p_item = $_POST['product'];
            $price = $_POST['price'];
            foreach ($p_item as $key => $item) {
                $this->package_model->createPackage($id, $item, $price[$key]);
            }
        }

        $page_template = "./views/package/create.php";
        require_once './views/_templates/masterPage.php';
    }

    public function retrieve($ajaxify = NULL) {

        if (!$ajaxify) {
            $result = $this->package_model->retrieve();
            $page_template = "./views/package/retrieve.php";
            require_once './views/_templates/masterPage.php';
        } else {
            $product = $this->package_model->showItem();
            $html = "<b>Select Product:</b><select name ='product[]'>";

            foreach ($product as $pro) {
                $html .= "<option value = '" . $pro['item_id'] . "'>" . $pro['item_name'] . "</option>";
            }

            $html .= "</select>";
            $html .= "<b style = 'padding-left:38px;'>Product Price:</b><input type='text' name = 'price[]'  class = 'price'/></br>";
            echo($html);
        }
    }

}

class Members extends Controller {

    public function __construct() {
        $this->model("Members_model");
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


        require_once './views/_templates/login.php';
    }

}

class Ewallet extends Controller {

    public function __construct() {
        $this->model("Ewallet_model");
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

    public function update() {
        //$result=  $this->ewallet_model->retrieve($userId);
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
        $this->model("Transaction_model");
        $this->model("Users");
        $this->model("Items_Packages");
    }

    public function create() {

        if (sizeof($_POST)) {
            
        }

        $html = $this->users->retrieve();
        $items_html = $this->items_packages->retrieve();
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
        $this->model("Users_model");
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
        $this->model("Items_Packages_model");
    }

    public function retrieve($ajaxify = NULL) {
        $items_html = $this->items_packages_model->retrieve();

        if (!$ajaxify) {
            $option = "";

            $html = "           
           <tr>
            <td></td>
            <td></td>
            <td>
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
                            <select class='items' name='items' onchange = 'return show_items();'>
                                <option value='0'>Select Item</option>";

            foreach ($items_html as $value) {
                $option.= "<option value='" . $value["item-id"] . "'>" . $value["item_name"] . "</option>";
            }
            $html.="$option.</select>    
                        </td>
                        <td><input type='text' /></td>
                        <td><input type='text' /></td>
                        <td><input type='text' /></td>
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
            <td></td>
            <td></td>
            <td>
                <table class='table table-bordered table-striped'>
                    <tr>
                        <td>
                            <select class='items' name='items' onchange = 'return show_items();'>
                                <option value='0'>Select Item</option>";

            foreach ($items_html as $value) {
                $option.= "<option value='" . $value["item-id"] . "'>" . $value["item_name"] . "</option>";
            }
            $html.="$option.</select>    
                        <input type='text' />
                        <input type='text' />
                        <input type='text' />
                        <a class='del' href='javascript:void(0);' style='text-decoration: none;' onclick='return remove_service(this);'>x</a></td>
                    </tr>
                </table>
              </td>
            </tr>";
            $html.='';
            echo $html;
        }
    }

}
