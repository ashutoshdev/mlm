<?php

class Roles_action_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function create($role_id, $role_actions) {
        foreach ($role_actions as $v) {
            $sql = "INSERT INTO `app_roles_action` SET `role_id`='" . $role_id . "', `actions`='" . $v . "' ";
            $this->db->query($sql);
        }
    }

    public function retrive($role_id) {
        
        $sql = "SELECT `actions` FROM app_roles_action WHERE `role_id`='" . $role_id . "';";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function delete($role_id) {
        $sql = "DELETE FROM `app_roles_action` WHERE `role_id`='" . $role_id . "';";
        $this->db->query($sql);
    }

}
