<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Chat extends CI_Controller {

	public function __construct()
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
        $id_user = $this->session->userdata('id');
        $id_faq = md5($id_user);
        $username = $this->session->userdata('username');
        $data = [
            'name' => $username,
            'id' => "Chat",
            'page' => "profile",
            'datas' => $this->db->query("SELECT * FROM faqone WHERE id_faq='$id_faq' ORDER BY date ASC")->result_array(),
        ];
		$this->load->view('user/chat',$data);
	}

    public function add(){

        $faq = $this->input->post('faq');
        $id_level = $this->session->userdata('level');
        $id_user = $this->session->userdata('id');

        $data = array (
            'id_user' => $id_user,
            'id_faq' => md5($id_user),
            'id_level' => $id_level,
            'faq' => $faq,
            );

            $this->mebel_model->insert_data($data,'faqone');
		    
            $this->session->set_flashdata(
                "message", 
                '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    Berhasil menambahkan data!.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('user/chat');

    }

	

}
