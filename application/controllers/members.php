<?php

class members extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('user_membership');
        $this->load->library('controllerlist');
    }

    public function index() {

        if ($this->input->server('REQUEST_METHOD') === 'POST') :
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->login($username, $password);
        endif;

        $this->load->view('members/index');
    }

    public function login($username, $password) {

        $result = $this->user_membership->authenticate($username, $password);

        if ($result) :
            redirect('members/profile');
        else :
            redirect('members/index');
        endif;
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('members/index');
    }

    public function profile() {
        $this->load->view('members/profile');
    }

}
