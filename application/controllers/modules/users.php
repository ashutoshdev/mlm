<?php

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->load->view('');
    }

    public function create() {


        $sent = $this->input->post('sent');
        if (!empty($sent)) {
            $data = array();
            $data['firstname'] = $this->input->post('firstname');
            $data['lastname'] = $this->input->post('lastname');
            $data['username'] = $this->input->post('username');
            $data['password'] = $this->input->post('password');
            $data['email'] = $this->input->post('email');

            $this->user_membership->create_user($data);

            redirect('membership/users');
        }

        $this->load->view('membership/user_add');
    }

    public function retrieve() {
        
    }

    public function update() {
        
    }

    public function delete() {
        
    }

}
