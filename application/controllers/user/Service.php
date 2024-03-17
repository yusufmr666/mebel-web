<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {
	function __construct()
    {
    parent::__construct();
    //load Helper for Form
    $this->load->helper('url', 'form'); 
    $this->load->library('form_validation');
    $this->load->model('mebel_model');
    if($this->session->userdata('level') != 'user') {
        redirect('login');
    }
    }

	public function index()
	{
        $data['id']= "Pesanan";
        $id_user = $this->session->userdata('id');
        $data['query'] = $this->mebel_model-> get_user_chart($id_user);

		$this->load->view('user/templates/header',$data);
		$this->load->view('user/pesanan');
		$this->load->view('user/templates/footer');
	}

    public function cart(){
		if($this->session->userdata('level') != 'user') {
			redirect('login');
		}
		$idp = $this->input->post('idp');
        $id_user = $idx = $this->session->userdata('id');
        $status = $this->input->post('status');
		$id_transaksi = $this->input->post('id_transaksi');  
        
        $this->mebel_model->update_cart($id_user,$status,$id_transaksi); //simpan ke database
        redirect('user/chart'); //redirect ke mahasiswa usai simpan data
	}
}
