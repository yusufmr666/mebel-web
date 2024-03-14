<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

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

	public function index($id=null)
	{
        $data['id'] = "Order";

        //pengaturan pagination
        $config['base_url'] = base_url().'admin/produk/index';
        $config['total_rows'] = $this->mebel_model->get_alls('cart','id_transaksi')->num_rows();
        $config['per_page'] = '5';
        // Membuat Style pagination untuk BootStrap v4
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';        
        $config['full_tag_close'] = '</ul>';        
        $config['first_link'] = 'First';        
        $config['last_link'] = 'Last';        
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['first_tag_close'] = '</span></li>';        
        $config['prev_link'] = '&laquo';        
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['prev_tag_close'] = '</span></li>';        
        $config['next_link'] = '&raquo';        
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['next_tag_close'] = '</span></li>';        
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['last_tag_close'] = '</span></li>';        
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['num_tag_close'] = '</span></li>';

        //inisialisasi config
        $this->pagination->initialize($config);

        //buat pagination
        $data['halaman'] = $this->pagination->create_links();

        //tamplikan data
        $data['query'] = $this->mebel_model->get_all_cartdata('cart',$config['per_page'], $id);
        
		$this->load->view('admin/templates/header',$data);
		$this->load->view('admin/order');
		$this->load->view('admin/templates/footer');
	}
}
