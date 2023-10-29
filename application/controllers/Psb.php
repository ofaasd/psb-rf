<?php
	class Psb extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if($this->session->userdata('status') != 'login_camaba')
			{
				redirect(base_url());
			}
			$this->load->model('pmb_model/Model_pmb');
			$this->load->model('Model_online');
		}

		function index()
		{
			$gelombang = $this->Model_online->get_gelombang('psb_gelombang');
			$hasil['nik'] = $this->session->userdata('nim');
			$data['nik'] = $hasil['nik'];
			$data['title'] = "Dashboard - Calon Santri Baru";
			$id = $this->session->userdata('id_user');
			$hasil['peserta'] = $this->db->get_where('psb_peserta_online',array('user_id'=>$id,'deleted_at'=>NULL))->result();
			$data['content'] = $this->load->view('psb/index',$hasil,true);
			$this->load->view('pmb_online/index_layout',$data);
		}
		function create(){
			$gelombang = $this->Model_online->get_gelombang('psb_gelombang');
			$hasil['nik'] = $this->session->userdata('nim');
			$data['nik'] = $hasil['nik'];
			$data['title'] = "Dashboard - Calon Santri Baru";
			$hasil['provinsi'] = $this->db->get('provinces')->result();
			$data['content'] = $this->load->view('psb/create',$hasil,true);
			$this->load->view('pmb_online/index_layout',$data);	
		}
		function simpan(){
			$user_id = $this->session->userdata('id_user');
			$gelombang = $this->db->limit("1")->get_where('psb_gelombang',array('pmb_online'=>1))->row()->id;
			$tanggal = date('Y-m-d H:i:s');
			$dateTime = new DateTime($tanggal); 
			$cek_nik  = $this->db->get_where("psb_peserta_online",array("nik"=>$this->input->post('nik'),"deleted_at"=>NULL))->num_rows();
			$id = $this->input->post('id');
			if($cek_nik > 0 && empty($id)){
				echo 2;
				//exit;
			}else{
				$data = array(
					'nik' => $this->input->post('nik'),
					'nama' => $this->input->post('nama'),
					'nama_panggilan' => $this->input->post('nama_panggilan'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'tempat_lahir' => $this->input->post('tempat_lahir'),
					'tanggal_lahir' => $this->input->post('tanggal_lahir'),
					'usia_tahun' => $this->input->post('usia_tahun'),
					'usia_bulan' => $this->input->post('usia_bulan'),
					'jumlah_saudara' => $this->input->post('jumlah_saudara'),
					'anak_ke' => $this->input->post('anak_ke'),
					'alamat' => $this->input->post('alamat'),
					'prov_id' => $this->input->post('provinsi'),
					'kota_id' => $this->input->post('kota'),
					'kecamatan' => $this->input->post('kecamatan'),
					'kelurahan' => $this->input->post('kelurahan'),
					'user_id' => $user_id,
					'status' => 0,
					'created_at' => $dateTime->format('U'),
				);
				if(empty($id)){
					$hasil = $this->db->insert('psb_peserta_online',$data);
				}else{
					$hasil = $this->db->update('psb_peserta_online',$data,array('id'=>$id));
				}
				if($hasil){
					$psb_peserta_id = 0;
					if(empty($id)){
						$psb_peserta_id = $this->db->insert_id();
					}
					$data2 = array(
						'nama_ayah' => $this->input->post('nama_ayah'),
						'pendidikan_ayah' => $this->input->post('pendidikan_ayah'),
						'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah'),
						'alamat_ayah' => $this->input->post('alamat_ayah'),
						'no_hp' => $this->input->post('no_hp'),
						'nama_ibu' => $this->input->post('nama_ibu'),
						'pendidikan_ibu' => $this->input->post('pendidikan_ibu'),
						'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu'),
						'alamat_ibu' => $this->input->post('alamat_ibu'),
						'no_telp' => $this->input->post('no_telp'),
						'created_at' => $dateTime->format('U'),
						//'psb_peserta_id' => $id,
					);
					if(empty($id)){
						$data2['psb_peserta_id'] = $psb_peserta_id;
						$hasil2 = $this->db->insert('psb_wali_peserta',$data2);
					}else{
						$hasil2 = $this->db->update('psb_wali_peserta',$data2,array('psb_peserta_id'=>$id));
					}
					

					$data3 = array(
						'jenjang' => $this->input->post('jenjang'),
						'kelas' => $this->input->post('kelas'),
						'nama_sekolah' => $this->input->post('nama_sekolah'),
						'nss' => $this->input->post('nss'),
						'npsn' => $this->input->post('npsn'),
						'nisn' => $this->input->post('nisn'),
						//'psb_peserta_id' => $id,
					);
					if(empty($id)){
						$data3['psb_peserta_id'] = $psb_peserta_id;
						$hasil3 = $this->db->insert('psb_sekolah_asal',$data3);
					}else{
						$hasil3 = $this->db->update('psb_sekolah_asal',$data3,array('psb_peserta_id'=>$id));
					}
					
					echo 1;
				}else{
					echo 0;
				}
			}
		}
		
		function edit($id){
			$gelombang = $this->Model_online->get_gelombang('psb_gelombang');
			$hasil['nik'] = $this->session->userdata('nim');
			$data['nik'] = $hasil['nik'];
			$data['title'] = "Dashboard - Calon Santri Baru";
			$hasil['psb_peserta'] = $this->db->get_where('psb_peserta_online',array('id'=>$id))->row();
			$hasil['psb_wali'] = $this->db->get_where('psb_wali_peserta',array('psb_peserta_id'=>$id))->row();
			$hasil['psb_sekolah'] = $this->db->get_where('psb_sekolah_asal',array('psb_peserta_id'=>$id))->row();
			$hasil['id'] = $id;
			$hasil['provinsi'] = $this->db->get('provinces')->result();
			$hasil['kota'] = $this->db->get_where('cities',array('prov_id'=>$hasil['psb_peserta']->prov_id))->result() ?? "";
			$data['content'] = $this->load->view('psb/create',$hasil,true);
			$this->load->view('pmb_online/index_layout',$data);	
		}
		function delete($id){
			$tanggal = date('Y-m-d H:i:s');
			$dateTime = new DateTime($tanggal); 
			$data = array(
				'deleted_at' => $dateTime->format('U'),
			);
			$update = $this->db->update('psb_peserta_online',$data, array('id'=>$id));
			redirect(base_url('psb/index'));
		}
		function get_kota(){
			$id_kota = $this->input->post("id");
			$kota = $this->db->get_where("cities",array("prov_id"=>$id_kota))->result();
			foreach($kota as $row){
				echo "<option value='" . $row->city_id . "'>" . $row->city_name . "</option>";
			}
		}
		function validasi($id){
			$gelombang = $this->Model_online->get_gelombang('psb_gelombang');
			$gelombang_id = $gelombang->row()->id;
			$tahun = date('y');
			$nopen = $tahun . $gelombang_id . $id;
			$data = array(
				'no_pendaftaran' => $nopen,
			);
			$update = $this->db->update('psb_peserta_online',$data,array('id'=>$id));
			if($update){
				redirect(base_url("psb/index"));
			}
		}
	}
