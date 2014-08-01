<?php

class Roles_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
       
    }
    
    
    public function create(){
        
    }

    public function retrieve(){

    }

    public function update($role_id,$role_name){
        $sql="UPDATE `app_roles` SET `name`='".$role_name."' WHERE `id`='".$role_id."' ;";
        $this->db->query($sql);
    }
    
    public function delete(){
        
    }
    
    
}

