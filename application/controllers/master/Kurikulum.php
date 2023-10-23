<?php
	class Kurikulum extends CI_Controller{
		function __construct()
			{
				parent::__construct();
				if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
				$this->load->model('kurikulum/Kurikulum_Model');
				$this->load->model('matakuliah/Matakuliah_Model');
			}
		function index(){
			$data['title'] = "Kurikulum - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());

			// matakuliah
			$kurikulum['matakuliah'] = $this->Matakuliah_Model->v_matakuliah();
			$kurikulum['rumpun'] = $this->db->get_where('master_rumpun', array('status' => 1))->result();
			
			// kurikulum
			$kurikulum['kurikulum'] = $this->Kurikulum_Model->v_kurikulum();
			// var_dump($kurikulum['kurikulum']);
			$kurikulum['progdi'] = $this->Kurikulum_Model->v_progdi();

			$data['content'] = $this->load->view('kurikulum/v_kurikulum',$kurikulum,true);
			$this->load->view('index',$data);
		}

		function daftar_matkul($kurikulumid){
			$data['title'] = "Daftar Mata Kuliah Kurikulum - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$kurikulum['list_matkul']=$this->Kurikulum_Model->getDaftarMatkul($kurikulumid);
			// matakuliah
			// $kurikulum['matakuliah'] = $this->Matakuliah_Model->v_matakuliah();
			$kurikulum['kurikulum']=$this->Kurikulum_Model->v_detail($kurikulumid);
			
			$data['content'] = $this->load->view('kurikulum/v_daftar_matkul',$kurikulum,true);
			
			$this->load->view('index',$data);
		}
		function update_togle_kur($id=''){
			$cek = $this->db->get_where('master_kurikulum', array('id' => $id))->row()->status;
			if ($cek == 1) {
				$data = array(
								'status' => 0
							 );
			}else{
				$data = array(
								'status' => 1
							 );
			}
			$this->db->update('master_kurikulum', $data, array('id' => $id));
			redirect('master/kurikulum');
		}
		function kelola_matkul($id){
			$data['title'] = "Tambah Mata Kuliah Ke Kurikulum - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$kurikulum['kurikulum_item']=$this->Kurikulum_Model->getKurikulumItem($id);
			// matakuliah
			$kurikulum['matakuliah'] = $this->Matakuliah_Model->v_matakuliah();
			$kurikulum['kurikulum']=$this->Kurikulum_Model->v_detail($id);

			$data['content'] = $this->load->view('kurikulum/v_kelola_matkul',$kurikulum,true);
			
			$this->load->view('index',$data);
		}

		public function kurikulum_item()
		{
		$id=$this->input->post('isi');
		$kdkurikulum=$this->input->post('kdkur');
		// echo $id."-".$kdkurikulum;
		$data = array(
			'id_kurikulum'=>$kdkurikulum,
			'id_mata_kuliah'=>$id
		);
		$cekExist=$this->Kurikulum_Model->getWhere('*','kurikulum_item',$data);		
		if(!empty($cekExist)){
			$res=$this->Kurikulum_Model->hapus_data('kurikulum_item',$data);
			if($res){
				echo "Berhasil dihapus";
			}else{
				echo "Gagal dihapus";
			}
		}else{
			$res=$this->Kurikulum_Model->simpan_data('kurikulum_item',$data);
			if($res){
				echo "Berhasil Disimpan";
			}else{
				echo "Gagal disimpan";
			}
		}
		//now use the $id variable for the desired purpose.
		}

		function add(){
			$data['title'] = "Kurikulum - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$kurikulum['ta'] = $this->db->get_where('master_tahun_ajaran',array('is_aktif' => 1))->result();
			$kurikulum['progdi'] = $this->Kurikulum_Model->v_progdi();
			$data['content'] = $this->load->view('kurikulum/v_add',$kurikulum,true);
			$this->load->view('index',$data);
		}

		
		function add_act(){
			$r = $this->Kurikulum_Model->add();
			if ($r == 1) {
				# code...
				$this->session->set_userdata('kurikulum', '<script type="text/javascript">
                                                            alert("Data Kurikulum di tambahkan."); 
                                                        </script>');
				redirect('master/kurikulum');
			}else{
				$this->session->set_userdata('kurikulum', '<script type="text/javascript">
                                                            alert("Data Kurikulum gagal di tambahkan."); 
                                                        </script>');
				redirect('master/kurikulum');
			}
		}

		function update_matkul(){
			$kurid=$this->input->post('kurid');
			$id=$this->input->post('id');
			$sks=$this->input->post('sks');
			$smt=$this->input->post('smt');
			$tipe=$this->input->post('tipe');
			$status=$this->input->post('status');
			$r = $this->Kurikulum_Model->update_data('kurikulum_item',array('id_kurikulum'=>$kurid,'id_mata_kuliah'=>$id),array('sks'=>$sks,'semester'=>$smt,'tipe'=>$tipe,'status'=>$status));
			if ($r) {
				# code...
				$this->session->set_userdata('updatematkul', '<script type="text/javascript">
                                                            alert("Berhasil diubah"); 
                                                        </script>');
			}else{
				$this->session->set_userdata('updatematkul', '<script type="text/javascript">
                                                            alert("Gagal diubah"); 
                                                        </script>');
			}
			redirect($_SERVER['HTTP_REFERER']);
		}

		function hapus_matkul($idkur,$id){
			$data = array(
				'id_kurikulum'=>$idkur,
				'id_mata_kuliah'=>$id
			);
			$res=$this->Kurikulum_Model->hapus_data('kurikulum_item',$data);
			if($res){
				$this->session->set_userdata('hapusmatkul', '<script type="text/javascript">
				alert("Berhasil dihapus"); 
				</script>');
			}else{
				$this->session->set_userdata('hapusmatkul', '<script type="text/javascript">
				alert("Gagal dihapus"); 
				</script>');
			}
			redirect($_SERVER['HTTP_REFERER']);
		}


		function update($ids = ''){
			$data['title'] = "Kurikulum - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$kurikulum['detail'] = $this->Kurikulum_Model->v_detail($ids);
			$kurikulum['ta'] = $this->db->get_where('master_tahun_ajaran',array('is_delete' => '0'))->result();
			$kurikulum['progdi'] = $this->Kurikulum_Model->v_progdi();
			$data['content'] = $this->load->view('kurikulum/v_update',$kurikulum,true);
			$this->load->view('index',$data);
		}
		function update_act(){
			$id = $this->input->post('id');
			$kode_kurikulum = $this->input->post('kode_kurikulum');
			$progdi = $this->input->post('progdi');
			$thn_ajar = $this->input->post('tahun_ajar');
			$angkatan = $this->input->post('angkatan1').'-'.$this->input->post('angkatan2');
			$status = $this->input->post('status');
			$data = array(
							'kode_kurikulum' => $kode_kurikulum,
							'progdi' => $progdi,
							'thn_ajar' => $thn_ajar,
							'angkatan' => $angkatan,
							'status' => $status,
						 );
			$r = $this->db->update('master_kurikulum', $data, array('id' => $id));
			if ($r == 1) {
				# code...
				$this->session->set_userdata('kurikulum', '<script type="text/javascript">
                                                            alert("Data Kurikulum di update."); 
                                                        </script>');
				redirect('master/kurikulum');
			}else{
				$this->session->set_userdata('kurikulum', '<script type="text/javascript">
                                                            alert("Data Kurikulum gagal di update."); 
                                                        </script>');
				redirect('master/kurikulum');
			}
		}
	}
?>