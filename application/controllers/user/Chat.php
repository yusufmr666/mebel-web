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
        $id_faq = $this->input->post('id_faq');
        $id_user = $this->session->userdata('id');
        $id_level = $this->session->userdata('level');
        $id_status = $this->input->post('id_status');
        $id_status_user = $this->input->post('id_status_user');

        $query = $this->db->query("SELECT * FROM faqone Join user on user.id = faqone.id_user WHERE id_faq='$id_faq' and id_level ='admin' ORDER BY date ASC")->result();
        
        foreach ($query as $kel){
            $id_admin = $kel->id_user;
        }


        $data = array (
            'id_user' => $id_user,
            'id_faq' => md5($id_user),
            'id_level' => $id_level,
            'id_status' => $id_status,
            'faq' => $faq,
            );
        
        $datas = array (
            'id_status' => $id_status_user,        
        );

        $this->mebel_model->insert_data($data,'faqone');
        $this->mebel_model->updates('faqone','id_faq',$id_faq,$datas,$id_admin);
        redirect('user/chat');

    }

	

}
