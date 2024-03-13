<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct()
    {
    parent::__construct();
    //load Helper for Form
    $this->load->helper('url', 'form'); 
    $this->load->library('form_validation');
    $this->load->model('mebel_model');
    }

    public function index($id=null)
	{
		$data['id'] = "User";

		//pengaturan pagination
        $config['base_url'] = base_url().'admin/produk/index';
        $config['total_rows'] = $this->mebel_model->get_all('user')->num_rows();
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
        $data['query'] = $this->mebel_model->get_all_data('user',$config['per_page'], $id);

		$this->load->view('admin/templates/header',$data);
		$this->load->view('admin/user');
		$this->load->view('admin/templates/footer');
	}

    public function simpan(){
        $email=$this->input->post('email');
        $username=$this->input->post('username');
        $password = md5($this->input->post('password'));
        $level=$this->input->post('level');
       
        $this->mebel_model->simpan_user($email,$username,$password,$level); //simpan ke database
        redirect('admin/user'); //redirect ke mahasiswa usai simpan data
    }


}
