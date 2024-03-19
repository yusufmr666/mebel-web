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
        if($this->session->userdata('level') != 'admin') {
            redirect('login');
        }



    }
	public function index($id=null)
	{
        $data['id'] = "Chat";
        
        //pengaturan pagination
        $config['base_url'] = base_url().'admin/chat/index';
        $config['total_rows'] = $this->mebel_model->get_alls('faqone','id_user')->num_rows();
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
        $data['query'] = $this->mebel_model->get_all_chat($config['per_page'], $id);

        $this->load->view('admin/templates/header',$data);
        $this->load->view('admin/chat');
        $this->load->view('admin/templates/footer');

        //batas suci

		
	}

    public function add(){

        $faq = $this->input->post('faq');
        $id_faq = $this->input->post('id_faq');
        $id_status = $this->input->post('id_status');
        $id_status_user = $this->input->post('id_status_user');

        $query = $this->db->query("SELECT * FROM faqone Join user on user.id = faqone.id_user WHERE id_faq='$id_faq' and id_level ='user' ORDER BY date ASC")->result();
        
        foreach ($query as $kel){
            $id_admin = $kel->id_user;
        }

        $id_user = $this->session->userdata('id');
        $id_level = $this->session->userdata('level');

        $data = array (
            'id_user' => $id_user,
            'id_faq' => $id_faq,
            'id_level' => $id_level,
            'id_status' => $id_status,
            'faq' => $faq,
            );

        $datas = array (
            'id_status' => $id_status_user,        
            );

        //$this->mebel_model->insert_data($data,'faqone');
        //$this->mebel_model->updates('faqone','id_faq',$id_faq,$datas,$id_admin);
        
        $this->session->set_flashdata(
            "message", 
            '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                Berhasil menambahkan data!.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );
        redirect('admin/chat');

    }

    public function detail($id_faq){
        $name = "yusufmr";
        $username = $this->session->userdata('username');
        $query = $this->db->query("SELECT * FROM faqone Join user on user.id = faqone.id_user WHERE id_faq='$id_faq' ORDER BY date ASC")->result_array();

        $data = [
            'name' => $username,
            'page' => "profile",
            'datas' => $query,
        ];
        
		$this->load->view('admin/detailchat', $data);
    }
	

}
