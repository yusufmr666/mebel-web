<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function ceklogin()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$this->load->model('mebel_model');
		$this->mebel_model->ambillogin($username,$password);

	}

	
    public function aksi_logout()
    {
        $this->session->sess_destroy();
        redirect("login");
    }
}
