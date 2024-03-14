<?php
class Mebel_model extends CI_Model{

        
	public function ambillogin($username,$password)
	{
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $query = $this->db->get('user');
        if ($query->num_rows()>0){
            foreach ($query->result() as $row){
                $sess = array ('username' => $row->username,
                'id'=>$row->id, 'level'=>$row->level );
            }
        if($row->level == "admin"){
        $this->session->set_userdata($sess);
        redirect('dashboard');}
        else{
        $this->session->set_userdata($sess);
        redirect('user/home');
        }
        } else {
        $this->session->set_flashdata( "message", 
        ' <div class="alert alert-danger alert-dismissible text-white fade show" role="alert">
                <span class="alert-text"><strong>Gagal!</strong> Username atau Password Salah!</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>' );
        redirect('login');
        }
	}

        function get_all_user(){
                $hasil=$this->db->get('user');
                return $hasil;
        }

            
        function get_user_byid($where){
                $this->db->select('*');
                $this->db->from('user');
                $this->db->where('id', $where);
                $hasil=$this->db->get();
                return $hasil;
                }
        
        function simpan_user($email,$username,$password,$level){
                $data = array(
                        'email'          => $email,
                        'username'       => $username,
                        'password'       => $password,
                        'level'       => $level
                );
                $this->db->insert('user',$data);
        }

          
        function update_user($id,$nama,$username,$password,$email){
                $data = array(
                        'name'          => $nama,
                        'username'       => $username,
                        'password'       => $password,
                        'email'       => $email
                );

                $this->db->where('id', $id);
                $this->db->update('user',$data);

        }


 
        function get_all($table){
                $hasil=$this->db->get($table);
                return $hasil;
        }
        function get_alls($table){
                $this->db->group_by("id_transaksi");
                $hasil=$this->db->get($table);
                return $hasil;
        }

        function get_produk_byid($where){
                $this->db->select('*');
                $this->db->from('produk');
                $this->db->where('id_produk', $where);
                $hasil=$this->db->get();
                return $hasil;
                }
        
        function get_suratkat_byid($where){
                $this->db->select('*');
                $this->db->from('surat');
                $this->db->join('kategori', 'kategori.id_kat = surat.kategori');
                $this->db->where('id_kat', $where);
                $hasil=$this->db->get();
                return $hasil;
            }
        
            
        
        function get_cart_byid($where){
        $this->db->select('*');
        $this->db->from('cart');
        $this->db->join('produk', 'produk.id_produk = cart.id_produk');
        $this->db->where('id_user', $where);
        $this->db->where('status', 'Waiting');
        $hasil=$this->db->get();
        return $hasil;
        }

        function get_chart_byid($where){
                $this->db->select('*');
                $this->db->from('cart');
                $this->db->join('produk', 'produk.id_produk = cart.id_produk');
                $this->db->join('user', 'user.id = cart.id_user');
                $this->db->where('status', $where);
                $this->db->limit('1');
                $this->db->order_by('tgl_pesan', 'ASC');
                $hasil=$this->db->get();
                return $hasil;
                }

        function get_chart($id,$id_status){
                $this->db->select('*');
                $this->db->from('cart');
                $this->db->join('produk', 'produk.id_produk = cart.id_produk');
                $this->db->where('status', $id_status);
                $this->db->where('id_user', $id);
                $hasil=$this->db->get();
                return $hasil;
                }

        function get_charts($id){
                $this->db->select('*');
                $this->db->from('cart');
                $this->db->join('produk', 'produk.id_produk = cart.id_produk');
                $this->db->where('status', 'Selesai');
                $this->db->where('id_transaksi', $id);
                $hasil=$this->db->get();
                return $hasil;
                }
        function get_user_chart($id){
                $this->db->select('*');
                $this->db->from('cart');
                $this->db->join('produk', 'produk.id_produk = cart.id_produk');
                $this->db->where('id_user', $id);
                $this->db->group_by("id_transaksi");
                $this->db->order_by('tgl_pesan', 'DESC');
                $hasil=$this->db->get();
                return $hasil;
                }  

                
        function get_all_cartdata($table,$number,$offset){
                $this->db->select('*');
                $this->db->from($table);
                $this->db->join('produk', 'produk.id_produk = cart.id_produk');
                $this->db->where('status', 'Selesai');
                $this->db->limit($number,$offset);
                $this->db->group_by("id_transaksi");
                $hasil=$this->db->get();
                return $hasil;
        }
         
        function simpan_cart($id_produk,$id_user,$status,$id_transaksi){
                $data = array(
                        'id_user'           => $id_user,
                        'id_produk'           => $id_produk,
                        'status'          => $status,
                        'id_transaksi'          => $id_transaksi,
                      
                );
                $this->db->insert('cart',$data);
        }

        function update_cart($id_user,$status,$id_transaksi){
                $data = array(
                        'id_user'           => $id_user,
                        'status'          => $status,
                        'id_transaksi'          => $id_transaksi,
                      
                );
                $this->db->where('id_user', $id_user);
                $this->db->where('id_transaksi', '2');
                $this->db->update('cart',$data);
        }

        function update($table,$id,$id_user,$data){

                $this->db->where($id, $id_user);
                $this->db->update($table,$data);
        }



        function simpan_produk($nama,$estimasi,$deskripsi,$file_name1,$file_name2,$file_name3){
            $data = array(
                    'nama'  => $nama,
                    'estimasi'  => $estimasi,
                    'deskripsi' => $deskripsi,
                    'file_name1' => $file_name1,
                    'file_name2' => $file_name2,
                    'file_name3' => $file_name3
            );
            $this->db->insert('produk',$data);
        }

        function update_produk($id,$nama,$estimasi,$deskripsi,$file_name1,$file_name2,$file_name3){
                $data = array(
                        'nama'  => $nama,
                        'estimasi' => $estimasi,
                        'deskripsi' => $deskripsi,
                        'file_name1' => $file_name1,
                        'file_name2' => $file_name2,
                        'file_name3' => $file_name3
                );
                $this->db->where('id_produk', $id);
                $this->db->update('produk', $data);
            }

        public function delete($where, $table)
        {
            $this->db->where($where);
            $this->db->delete($table);
        }

        function data($number,$offset){
                $this->db->select('*');
                $this->db->from('surat');
                $this->db->join('kategori', 'kategori.id_kat = surat.kategori');
                $this->db->limit($number,$offset);
                return $query = $this->db->get()->result(); 
        }

        function data_surat($where,$number,$offset){
                $this->db->select('*');
                $this->db->from('surat');
                $this->db->join('kategori', 'kategori.id_kat = surat.kategori');
                $this->db->where('id_kat', $where);
                $this->db->limit($number,$offset);
                $hasil=$this->db->get();
                return $hasil;
        }
        
        
        function jumlah_data(){
                $this->db->select('*');
                $this->db->from('surat');
                $this->db->join('kategori', 'kategori.id_kat = surat.kategori');
                return $this->db->get()->num_rows();
        }

        function get_all_data($table,$number,$offset){
                $this->db->select('*');
                $this->db->from($table);
                $this->db->limit($number,$offset);
                $hasil=$this->db->get();
                return $hasil;
        }

}