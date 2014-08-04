<?php

session_start();

class Controller {

    public $ewallet_model;
    public $transaction_model;
    public $item_model;
    public $members_model;

    public function __construct() {
        $this->ewallet_model = new Ewallet_model();
        $this->transaction_model = new Transaction_model();
        $this->item_model = new Items_model();
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
                $_SESSION["user_role"] = $result[0]["user_role"];
                header("Location: /ewallet/retrieve");
            }
        }


        $page_template = "./views/members/login.php";
        require_once './views/_templates/masterPage.php';
    }

}

class Ewallet extends Controller {

    public function __construct() {
        parent::__construct();
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
        parent::__construct();
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

class purchase extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function create() {




        $items = new Items();
        $html = $items->retrieve();
        $page_template = "./views/purchase/create.php";
        require_once './views/_templates/masterPage.php';
    }

}

class Items extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function retrieve($ajaxify = FALSE) {
        $item_set = $this->item_model->retrieve();
        $html = "<select name='items[]'>";
        foreach ($item_set as $value) {
            $html.="<option value='" . $value["item_id"] . "'>" . $value["item_name"] . "</option>";
        }
        $html.="</select>";
        if ($ajaxify)
            echo $html;
        else
            return $html;
    }

}
