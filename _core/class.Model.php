<?php
class Model {

    public $db;

    public function __construct() {
        $this->db = new MySQL('db_mlm', 'root', 'Numerico_2013');
    }

}
