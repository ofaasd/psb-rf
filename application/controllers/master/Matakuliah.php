<?php
	class Matakuliah extends CI_Controller{
		function __construct()
			{
				parent::__construct();
				if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
				$this->load->model('matakuliah/Matakuliah_Model');
			}
		function index(){
			$data['title'] = "Matakuliah - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$matakuliah['matakuliah'] = $this->Matakuliah_Model->v_matakuliah();
			$matakuliah['rumpun'] = $this->db->get_where('master_rumpun', array('status' => 1))->result();
			$data['content'] = $this->load->view('mata_kuliah/v_matakuliah',$matakuliah,true);
			$this->load->view('index',$data);
		}
		function add(){
			$data['title'] = "Matakuliah - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			// $matakuliah['matakuliah'] = $this->Matakuliah_Model->v_matakuliah();
			$matakuliah['rumpun'] = $this->db->get_where('master_rumpun', array('status' => 1))->result();
			$data['content'] = $this->load->view('mata_kuliah/v_add',$matakuliah,true);
			$this->load->view('index',$data);
		}
		function update_togle_matkul($id=''){
			$cek = $this->db->get_where('master_mata_kuliah', array('id' => $id))->row()->is_aktif;
			if ($cek == 1) {
				$data = array(
								'is_aktif' => 0
							 );
			}else{
				$data = array(
								'is_aktif' => 1
							 );
			}
			$this->db->update('master_mata_kuliah', $data, array('id' => $id));
			redirect('master/matakuliah');
		}
		function add_act(){
			$r = $this->Matakuliah_Model->tambah_matakuliah();
			if ($r == 1) {
				# code...
				$this->session->set_userdata('matakuliah', '<script type="text/javascript">
                                                            alert("Data matakuliah di tambahkan."); 
                                                        </script>');
				redirect('master/kurikulum');
			}else{
				$this->session->set_userdata('matakuliah', '<script type="text/javascript">
                                                            alert("Data matakuliah gagal di tambahkan."); 
                                                        </script>');
				redirect('master/kurikulum');
			}
		}
		function update($ids){
			$id = base64_decode(base64_decode($ids));
			$data['title'] = "Matakuliah - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$matakuliah['matakuliah'] = $this->Matakuliah_Model->update_matakuliah($id);
			$matakuliah['rumpun'] = $this->db->get_where('master_rumpun', array('status' => 1))->result();
			$data['content'] = $this->load->view('mata_kuliah/v_update',$matakuliah,true);
			$this->load->view('index',$data);
		}
		function update_act(){
			$r = $this->Matakuliah_Model->update_act();
			if ($r == 1) {
				# code...
				$this->session->set_userdata('matakuliah', '<script type="text/javascript">
                                                            alert("Data matakuliah di update."); 
                                                        </script>');
				redirect('master/kurikulum');
			}else{
				$this->session->set_userdata('matakuliah', '<script type="text/javascript">
                                                            alert("Data matakuliah gagal di update."); 
                                                        </script>');
				redirect('master/kurikulum');
			}
		}
		function delete($ids){
			$id = base64_decode(base64_decode($ids));
			//echo $id;
			//exit;
			$data = array('is_aktif' => 0);
			$r = $this->db->delete('master_mata_kuliah', array('id' => $id));
			if ($r == 1) {
				# code...
				$this->session->set_userdata('matakuliah', '<script type="text/javascript">
                                                            alert("Data Matakuliah di Hapus."); 
                                                        </script>');
				redirect('master/kurikulum');
			}else{
				$this->session->set_userdata('matakuliah', '<script type="text/javascript">
                                                            alert("Data Matakuliah gagal di Hapus."); 
                                                        </script>');
				redirect('master/kurikulum');
			}
		}
		function generate_program_studi(){
			$matakuliah = $this->db->get("master_mata_kuliah")->result();
			foreach($matakuliah as $row){
				echo $row->kode_mata_kuliah;
				if(substr($row->kode_mata_kuliah,0,3) == "205"){
					echo "- D3";
					$hasil = $this->db->update('master_mata_kuliah',array('id_program_studi'=>1), array('id'=>$row->id));
					if($hasil){
						echo "- berhasil";
					}else{
						echo "- gagal";
					}
				}else if(substr($row->kode_mata_kuliah,0,3) == "165"){
					echo "- D3";
					$hasil = $this->db->update('master_mata_kuliah',array('id_program_studi'=>1), array('id'=>$row->id));
					if($hasil){
						echo "- berhasil";
					}else{
						echo "- gagal";
					}
				}else if(substr($row->kode_mata_kuliah,0,3) == "206"){
					echo "- S1";
					$hasil = $this->db->update('master_mata_kuliah',array('id_program_studi'=>2), array('id'=>$row->id));
					if($hasil){
						echo "- berhasil";
					}else{
						echo "- gagal";
					}
				}
				echo "<br />"; 
			}
		}
	}
?>