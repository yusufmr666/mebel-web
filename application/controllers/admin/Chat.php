<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

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
        $data['id'] = "Chat";
        $this->load->view('admin/templates/header',$data);
		$this->load->view('admin/chat');
		$this->load->view('admin/templates/footer');
	}




}
