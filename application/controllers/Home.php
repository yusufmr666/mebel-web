<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
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
		$data['id']= "Home";
		$data['produk'] = $this->mebel_model->get_all('produk');
		$data['slider'] = $this->mebel_model->get_slider();
		
		$this->load->view('user/templates/header',$data);
		$this->load->view('user/index');
		$this->load->view('user/templates/footer');
	}
	
	public function detail($id){
		$data['id']= "Detail Produk";
		$data['detail']=$this->mebel_model->get_produk_byid($id);
		$this->load->view('user/templates/header',$data);
		$this->load->view('user/service');
		$this->load->view('user/templates/footer');
	}

	public function cart(){
		$this->load->model('mebel_model');
		if($this->session->userdata('level') != 'user') {
			redirect('login');
		}

		$id = $this->input->post('id');
        $id_user = $this->session->userdata('id');
        $status = $this->input->post('status');
		$id_transaksi = $this->input->post('id_transaksi');
       
        $this->mebel_model->simpan_cart($id,$id_user,$status,$id_transaksi); //simpan ke database
        redirect('home'); //redirect ke mahasiswa usai simpan data
	}
}
