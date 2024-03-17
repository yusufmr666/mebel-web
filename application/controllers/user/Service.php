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

    public function checkout(){
        $id_transaksi=$this->input->post('id_transaksi');
       
        
        $config['upload_path'] = FCPATH.'./assets/img/bukti/';
		$config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = 2000;
  
        $this->load->library('upload', $config);
  
		if(!empty($_FILES['bukti'])){
			$this->upload->do_upload('bukti');
			$uploaded_data1 = $this->upload->data();
			$bukti = $uploaded_data1['file_name'];

            $data = array(
                'bukti'           => $bukti,
            );            
    
            $this->mebel_model->update('cart','id_transaksi',$id_transaksi,$data);
            redirect('user/service'); 
		}
        
    }
}
