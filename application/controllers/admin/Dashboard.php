<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
    {
    parent::__construct();
    //load Helper for Form
    $this->load->helper('url', 'form'); 
    $this->load->library('form_validation');
    $this->load->model('mebel_model');
    if($this->session->userdata('level') != 'admin') {
        redirect('login');
    }
    }

	public function index()
	{
        $where = $this->session->userdata('id');
        $data['id'] = "Dashboard";
        $data['user_id'] = $this->mebel_model->get_user_byid($where)->result();
        $data['query'] =  $this->mebel_model->get_chart_byid();
        $data['tukang'] =  $this->mebel_model->get_tukang_cart();
        $data['wait'] =  $this->mebel_model->get_chart_byid('Diproses');


		$this->load->view('admin/templates/header',$data);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/templates/footer');
	}

    public function order(){
        $status=$this->input->post('status');
        $id_transaksi = $this->input->post('id_transaksi');
        $user_status=$this->input->post('user_status');
        $id_admin = $this->input->post('id_admin');
        $link = $this->input->post('link');


        $data = array(
            'status'           => $status,
            'link'           => $link,
        );
        
        $this->mebel_model->update('cart','id_transaksi',$id_transaksi,$data);
        redirect('dashboard'); 
    }

    public function alg(){
        $id_transaksi = $this->input->post('id_transaksi');
        $user_status=$this->input->post('user_status');
        $id_admin = $this->input->post('id_admin');

        $data = array(
             'id_admin'           => $id_admin,
        );

        $data_user = array(
            'user_status'           => $user_status,
        );
        
        $this->mebel_model->update('tukang','id',$id_admin,$data_user);
        $this->mebel_model->update('cart','id_transaksi',$id_transaksi,$data);
        redirect('dashboard'); 
    }

    public function checkout(){
        $status=$this->input->post('status');
        $id_transaksi = $this->input->post('id_transaksi');
        $user_status=$this->input->post('user_status');
        $id_admin = $this->input->post('id_admin');
        $link = $this->input->post('link');

        $data = array(
            'status'           => $status,
             'id_admin'           => $id_admin,
             'link'           => $link,
        );

        $data_user = array(
            'user_status'           => $user_status,
        );
        
        $this->mebel_model->update('tukang','id',$id_admin,$data_user);
        $this->mebel_model->update('cart','id_transaksi',$id_transaksi,$data);
        redirect('dashboard'); 
    }

        public function print()
        {
            // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
            $this->load->library('pdfgenerator');
            
            // title dari pdf
            $this->data['title_pdf'] = 'Laporan Pemesanan AJF';
            $this->data['wait'] =  $this->mebel_model->get_chart_byid();
            
            // filename dari pdf ketika didownload
            $file_pdf = 'laporan_pemesanan_AJF';
            // setting paper
            $paper = 'A4';
            //orientasi paper potrait / landscape
            $orientation = "portrait";
            
            $html = $this->load->view('admin/cetak_laporan',$this->data, true);	    
            
            // run dompdf
            $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        }
}