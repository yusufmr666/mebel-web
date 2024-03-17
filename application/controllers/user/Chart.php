<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart extends CI_Controller {
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
        $data['id']= "Cart";
        $id_user = $this->session->userdata('id');
        $data['query'] = $this->mebel_model->get_cart_byid($id_user);

		$this->load->view('user/templates/header',$data);
		$this->load->view('user/chart');
		$this->load->view('user/templates/footer');
	}

    public function cart(){
		if($this->session->userdata('level') != 'user') {
			redirect('login');
		}
		$idp = $this->input->post('idp');
        $id_user = $idx = $this->session->userdata('id');
        $keterangan = $this->input->post('keterangan');
        $status = $this->input->post('status');
		$id_transaksi = $this->input->post('id_transaksi');  
        
        $this->mebel_model->update_cart($id_user,$keterangan,$status,$id_transaksi); //simpan ke database
        redirect('user/chart'); //redirect ke mahasiswa usai simpan data
	}

    public function delete($id)
    {

        $where = array('id' => $id);
        $this->mebel_model->delete($where,'cart');
        redirect('user/chart');


    }
}
