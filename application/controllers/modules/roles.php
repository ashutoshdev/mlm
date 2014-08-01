<?php

class Roles extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('modules/roles_model');
        $this->load->model("modules/roles_action_model");
        
        $this->load->helper('url');
        $this->load->library('user_membership');  
        $this->load->library('controllerlist');
    }

    public function index() {

        $data = array();
        $data['roles_list'] = $this->retrieve();
        $this->load->view('modules/roles/list', $data);
    }

    public function create() {

        if ($this->input->server('REQUEST_METHOD') === 'POST') :

            $rolename = $this->input->post('name');
            $actions=$this->input->post('permission');
            $this->user_membership->create_role($rolename,$actions);
            redirect('modules/roles');
        endif;
        $this->load->view('modules/roles/create',array('clist' => $this->controllerlist->getControllers()));
    }

    public function retrieve() {
        return $this->user_membership->get_roles();
    }

    public function update($role_id = 0) {

        if ($this->input->server('REQUEST_METHOD') === 'POST') :

            $sent = $this->input->post("sent");


            if (!empty($sent)) :
                $role_name = $this->input->post('name');
                $actions=$this->input->post('permission');

                $this->roles_model->update($role_id,$role_name);
                $this->roles_action_model->delete();
                $this->roles_action_model->create($role_id,$actions);
                
            endif;

            redirect('modules/roles');
        endif;


        if (!empty($role_id)) :
            
            $data = array();
            $data['role_data'] = $this->user_membership->get_role($role_id);
            $data['role_actions']=$this->roles_action_model->retrive($role_id);
            $data['clist']=$this->controllerlist->getControllers();

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
