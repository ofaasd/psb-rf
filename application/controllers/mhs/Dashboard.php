<?php
	class Dashboard extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if($this->session->userdata('status') != 'login_mhs')
			{
				redirect(base_url());
			}
			$this->load->model('pmb_model/Model_pmb');
		}

		function index()
		{
			$data['title'] = "Dashboard - Mahasiswa Portal";
			$data['content'] = $this->load->view('default','',true);
			$this->load->view('mhs/index',$data);
		}
		function profil(){
			$data['title'] = "Profil - Mahasiswa Portal";
			$nim = $this->session->userdata('nim');
			$mhs['detail'] = $this->db->query("SELECT mahasiswa.*, wilayah.*,pegawai.nama as dosen_wali FROM `mahasiswa` LEFT join pegawai on pegawai.id = mahasiswa.id_dsn_wali LEFT JOIN wilayah ON mahasiswa.provinsi = wilayah.id_wil or mahasiswa.kokab = wilayah.id_wil or mahasiswa.kecamatan = wilayah.id_wil LEFT JOIN pmb_peserta ON mahasiswa.nim = pmb_peserta.nim where mahasiswa.nim = '".$nim."'")->result_array();
			$mhs['wilayah'] = $this->db->get_where('wilayah', array('id_induk_wilayah' => '000000'))->result();
			$mhs['dosen'] = $this->db->select('*')->where('id <> 1')->get('pegawai')->result();
			$data['content'] = $this->load->view('mhs/profil',$mhs,true);
        	$this->load->view('mhs/index',$data);
		}
		function ganti_password(){
			$data['title'] = "Dashboard - Mahasiswa Portal";
			$data['content'] = $this->load->view('mhs/password','',true);
			$this->load->view('mhs/index',$data);
		}
		function daftar_kotakab(){
			$id=$this->input->post('id');
	        $data=$this->Model_pmb->daftar_kotakab($id);
	        echo json_encode($data);
		}
		function daftar_kec(){
			$id=$this->input->post('id');
	        $data=$this->Model_pmb->daftar_kec($id);
	        echo json_encode($data);
		}
		function update(){
			$nim = $this->input->post('nim');
			$w = array('nim' => $nim);
			$data = array(
							'nama' => $this->input->post('nama'),
							'telp' => $this->input->post('telp'),
							'hp' => $this->input->post('hp'),
							'email' => $this->input->post('email'),
							'alamat' => $this->input->post('alamat'),
							'rt' => $this->input->post('rt'),
							'rw' => $this->input->post('rw'),
							'provinsi' => $this->input->post('provinsi'),
							'kokab' => $this->input->post('kokab'),
							'kecamatan' => $this->input->post('kecamatan'),
							'kelurahan' => $this->input->post('kelurahan'),
							'hp_ortu' => $this->input->post('hp_ortu'),
							'tempat_lahir' => $this->input->post('tempat_lahir'),
							'tgl_lahir' => $this->input->post('tgl_lahir'),
							'jk' => $this->input->post('jk'),
							'agama' => $this->input->post('agama'),
							'nama_ayah' => $this->input->post('nama_ayah'),
							'nama_ibu' => $this->input->post('nama_ibu'),
							'no_ktp' => $this->input->post('no_ktp'),
							'id_dsn_wali'=>$this->input->post('id_dsn_wali'),
						 );
			/* $cek_pmb = $this->db->get_where('pmb_peserta', array('nim' => $nim))->num_rows();
			if ($cek_pmb > 0) {
				$data_pmb = array(
									'hp_ortu' => $this->input->post('hp_ortu'),
									'alamat_semarang' => $this->input->post('alamat_semarang')
								 );
				$this->db->update('pmb_peserta',$data_pmb,$w);
			}else{
				$data_pmb = array(
									'nim' => $nim,
									
									'alamat_semarang' => $this->input->post('alamat_semarang')
								 );
				$this->db->insert('pmb_peserta', $data_pmb);
			} */
			$r = $this->db->update('mahasiswa',$data,$w);
			if ($r) {
				# code...
				redirect('mhs/dashboard/profil');
			}else{
				redirect('mhs/dashboard/profil');
			}
		}
		function ubah_photo(){
			$config['upload_path'] = './assets/foto_mahasiswa/';
		    $config['allowed_types'] = 'gif|jpg|png';
		    $config['max_size']  = '2048';
		    $config['overwrite'] = TRUE;
		    $config['file_name'] = 'mahasiswa_'.$this->input->post('nim').date('YmdHis');
			$dname = explode(".", $_FILES['foto']['name']);
		    $config['file_ext'] = "." . end($dname);
		    $config['remove_space'] = TRUE;
		    $this->load->library('upload', $config); 
		    $nama_foto = "";
		    if($this->upload->do_upload('foto')){ 
		    	$nama_foto = $config['file_name'].$config['file_ext'];
		    	$biodata = array(
		    		'foto_mhs' => $nama_foto,
		    	);
		    	$where_biodata = array("nim"=> $this->input->post("nim"));
		    	$r = $this->db->update('mahasiswa', $biodata,$where_biodata);
		    	if($r)
		    		redirect("/mhs/dashboard/profil/" . $this->input->post("npp"));	
				//echo "berhasil";
		    	else 
		    		echo "gagal";
		    }else{
		    	echo "gagal"; 
		    }
		}
		function save_pass(){
			$old_pass = $this->input->post('old_pass');
			$new_pass = $this->input->post('new_pass');
			$new_pass1 = $this->input->post('new_pass1');
			$get_data = $this->db->get_where('mahasiswa', array('nim' => $this->session->userdata('nim')))->row();
			if (($get_data->paswd == $this->authact->generatepass($old_pass)) || $get_data->paswd == md5($old_pass)) {
				if ($new_pass != $new_pass1) {
					$this->session->set_userdata('ganti_pass', '<script type="text/javascript">
                                                            alert("Password baru tidak sama!"); 
                                                        </script>');
					redirect('mhs/dashboard/ganti_password');
				}else{
					$password_baru = $this->authact->generatepass($new_pass);
					//echo $password_baru;
					$this->db->update('mahasiswa', array('paswd' => $password_baru), array('nim' => $this->session->userdata('nim')));
					$this->session->set_userdata('ganti_pass', '<script type="text/javascript">
                                                            alert("Password berhasil diubah!"); 
                                                        </script>');
					redirect('mhs/dashboard/logout');
				}
				
			}else{
				$this->session->set_userdata('ganti_pass', '<script type="text/javascript">
                                                            alert("Password lama salah!"); 
                                                        </script>');
				redirect('mhs/dashboard/ganti_password');
			}
		}
		function logout()
		{
			$this->session->sess_destroy();
    		redirect('');
		}
	}
?>