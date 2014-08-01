<?php

class Roles extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('user_membership');        
    }

    public function index() {

        $data = array();
        $data['roles_list'] = $this->retrieve();
        $this->load->view('modules/roles/list', $data);
    }

    public function create() {

        if ($this->input->server('REQUEST_METHOD') === 'POST') :

            $rolename = $this->input->post('name');
            $this->user_membership->create_role($rolename);
            redirect('modules/roles');
        endif;
        $this->load->view('modules/roles/create');
    }

    public function retrieve() {
        return $this->user_membership->get_roles();
    }

    public function update($role_id = 0) {

        if ($this->input->server('REQUEST_METHOD') === 'POST') :

            $sent = $this->input->post("sent");
            $role_id = $this->input->post("role_id");

            if (!empty($sent) && !empty($role_id)) :
                $role_data = array();
                $role_data['name'] = $this->input->post('name');


                $this->user_membership->update_role($role_id, $role_data);
            endif;

            redirect('modules/roles');
        endif;


        if (!empty($role_id)) :
            $data = array();
            $data['role_data'] = $this->user_membership->get_role($role_id);
            $this->load->view('modules/roles/update', $data);
        endif;
    }

    public function delete($role_id=0) {
        if (!empty($role_id)) {
            $this->user_membership->delete_role($role_id);
        }

        redirect('modules/roles');
    }

}
