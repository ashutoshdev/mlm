<?php

class admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('user_membership');
        $this->load->library('controllerlist');
    }

    public function index() {

        if ($this->input->server('REQUEST_METHOD') === 'POST') :
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->login($username, $password);
        endif;

        $this->load->view('/admin/index');
    }

    public function login($username, $password) {

        if ($this->user_membership->authenticate($username, $password))
            redirect('/admin/profile');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/admin/index');
    }

    public function profile() {

        $this->load->view('admin/profile');
    }

    public function changepassword() {
        $this->load->view('admin/changepassword');
    }

}
