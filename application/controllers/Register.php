<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    function __construct()
    {
    parent::__construct();
    //load Helper for Form
    $this->load->helper('url', 'form'); 
    $this->load->library('form_validation');
    $this->load->model('mebel_model');
    }

	public function index()
	{
		$this->load->view('register');
	}

    public function simpan(){
        $email=$this->input->post('email');
        $username=$this->input->post('username');
        $password = md5($this->input->post('password'));
        $level=$this->input->post('level');
       
        $this->mebel_model->simpan_user($email,$username,$password,$level); //simpan ke database
        redirect('login'); //redirect ke mahasiswa usai simpan data
    }


}
