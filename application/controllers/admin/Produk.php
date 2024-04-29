<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
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
		$data['id'] = "Produk";

		//pengaturan pagination
        $config['base_url'] = base_url().'admin/produk/index';
        $config['total_rows'] = $this->mebel_model->get_all('produk')->num_rows();
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
        $data['query'] = $this->mebel_model->get_all_data('produk',$config['per_page'], $id);

		$this->load->view('admin/templates/header',$data);
		$this->load->view('admin/produk');
		$this->load->view('admin/templates/footer');
	}
	
	public function simpan() 
    {
        $nama=$this->input->post('nama');
        $deskripsi=$this->input->post('deskripsi');
        $estimasi=$this->input->post('estimasi');
        $jenis=$this->input->post('jenis');
        $harga=$this->input->post('harga');


        $config['upload_path'] = FCPATH.'./assets/img/produk/';
		$config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = 2000;
  
        $this->load->library('upload', $config);
  
		if(!empty($_FILES['foto1'])){
			$this->upload->do_upload('foto1');
			$uploaded_data1 = $this->upload->data();
			$file_name1 = $uploaded_data1['file_name'];
		}

		if(!empty($_FILES['foto2'])){
			$this->upload->do_upload('foto2');
			$uploaded_data2 = $this->upload->data();
			$file_name2 = $uploaded_data2['file_name'];
		}

		if(!empty($_FILES['foto3'])){
			$this->upload->do_upload('foto3');
			$uploaded_data3 = $this->upload->data();
			$file_name3 = $uploaded_data3['file_name'];
		}
    

            $this->mebel_model->simpan_produk($nama,$harga,$jenis,$estimasi,$deskripsi,$file_name1,$file_name2,$file_name3); //simpan ke database
            redirect('produk'); //redirect ke mahasiswa usai simpan data
    }

    
    public function edit() 
    {
        $id=$this->input->post('id');
        $nama=$this->input->post('nama');
        $estimasi=$this->input->post('estimasi');
        $jenis=$this->input->post('jenis');
        $deskripsi=$this->input->post('deskripsi');
        $harga=$this->input->post('harga');

        $data_kat = $this->mebel_model->get_produk_byid($id)->result();

        foreach($data_kat as $row){
            $id_file1 = $row->file_name1;
            $id_file2 = $row->file_name2;
            $id_file3 = $row->file_name3;
        }
        unlink(FCPATH.'./assets/img/produk/'.$id_file1);
        unlink(FCPATH.'./assets/img/produk/'.$id_file2);
        unlink(FCPATH.'./assets/img/produk/'.$id_file3);


        $config['upload_path'] = FCPATH.'./assets/img/produk/';
		$config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = 2000;
  
        $this->load->library('upload', $config);
  
		if(!empty($_FILES['foto1'])){
			$this->upload->do_upload('foto1');
			$uploaded_data1 = $this->upload->data();
			$file_name1 = $uploaded_data1['file_name'];
		}

		if(!empty($_FILES['foto2'])){
			$this->upload->do_upload('foto2');
			$uploaded_data2 = $this->upload->data();
			$file_name2 = $uploaded_data2['file_name'];
		}

		if(!empty($_FILES['foto3'])){
			$this->upload->do_upload('foto3');
			$uploaded_data3 = $this->upload->data();
			$file_name3 = $uploaded_data3['file_name'];
		}
    

            $this->mebel_model->update_produk($id,$nama,$harga,$jenis,$estimasi,$deskripsi,$file_name1,$file_name2,$file_name3); //simpan ke database
            redirect('produk'); //redirect ke mahasiswa usai simpan data
    }

    public function delete($id)
    {
        $data_kat = $this->mebel_model->get_produk_byid($id)->result();

        foreach($data_kat as $row){
            $id_file1 = $row->file_name1;
            $id_file2 = $row->file_name2;
            $id_file3 = $row->file_name3;
        }
        unlink(FCPATH.'./assets/img/produk/'.$id_file1);
        unlink(FCPATH.'./assets/img/produk/'.$id_file2);
        unlink(FCPATH.'./assets/img/produk/'.$id_file3);

        $where = array('id_produk' => $id);
        $this->mebel_model->delete($where,'produk');
        redirect('produk');


    }
}
