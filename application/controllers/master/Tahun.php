<?php
/**
* 
*/
class Tahun extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
				if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
				$this->load->model('fakultas/Fakultas_Model');
	}
	function index(){
		$data['title'] = "Master Tahun - Academic Portal";
		$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$tahun['tahun'] = $this->db->get_where('master_tahun_ajaran',array('is_delete' => '0'))->result();
		$data['content'] = $this->load->view('tahun/v_tahun',$tahun,true);
		$this->load->view('index',$data);
	}
	function add(){
			$data['title'] = "Master Tahun - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			// $ruang['ruang'] = $this->Ruang_model->v_ruang();
			$data['content'] = $this->load->view('tahun/v_add',[],true);
			$this->load->view('index',$data);
	}
	function add_act(){
		$data = array(
						'id_tahun' => $this->input->post('awal').''.$this->input->post('jenis'),
						'awal' => $this->input->post('awal'),
						'akhir' => $this->input->post('akhir'),
						'jenis' => $this->input->post('jenis')
					 );
		$r = $this->db->insert('master_tahun_ajaran', $data);
		if ($r) {
			# code...
			$this->session->set_userdata('tahun', '<script type="text/javascript">
                                                            alert("Data tahun di tambahkan."); 
                                                        </script>');
				redirect('master/tahun');
		}else{
			$this->session->set_userdata('tahun', '<script type="text/javascript">
                                                            alert("Data tahun gagal di tambahkan."); 
                                                        </script>');
				redirect('master/tahun');
		}
	}
	function update($ids){
		$id = base64_decode(base64_decode($ids));
		$data['title'] = "Master Tahun - Academic Portal";
		$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$tahun['tahun'] = $this->db->get_where('master_tahun_ajaran',array('id' => $id))->result();
		$data['content'] = $this->load->view('tahun/v_update',$tahun,true);
		$this->load->view('index',$data);
	}
	function update_act(){
		$where = array('id' => $this->input->post('id'));
		$data = array(
						'id_tahun' => $this->input->post('awal').''.$this->input->post('jenis'),
						'awal' => $this->input->post('awal'),
						'akhir' => $this->input->post('akhir'),
						'jenis' => $this->input->post('jenis')
					 );
		$cek = $this->db->get_where('master_tahun_ajaran', $where);
		if ($cek->num_rows() > 0) {
			if ($cek->row()->is_aktif == 1) {
				$this->session->set_userdata('tahun', '<script type="text/javascript">
                                                            swal("Gagal!", "Tahun Aktif tidak boleh lebih dari 1", "error");
                                                        </script>');
				redirect('master/tahun');
			}else{
				$this->db->update('master_tahun_ajaran', ['is_aktif' => $this->input->post('stat')], $where);
				$this->session->set_userdata('tahun', '<script type="text/javascript">
	                                                            swal("Berhasil!", "Tahun Ajaran Telah Aktif", "success");
	                                                        </script>');

				redirect('master/tahun');
			}
		}else{
			$this->db->update('master_tahun_ajaran', $data, $where);
			$this->session->set_userdata('tahun', '<script type="text/javascript">
                                                            swal("Berhasil!", "Tahun Ajaran Telah Aktif", "success");
                                                        </script>');
			redirect('master/tahun');
		}
	}
	function delete($ids){
		$id = base64_decode(base64_decode($ids));
		$where = array('id' => $id);
		$data = array(
						'is_delete' => '1'
					 );
		$r = $this->db->update('master_tahun_ajaran', $data, $where);
		if ($r) {
			# code...
			$this->session->set_userdata('tahun', '<script type="text/javascript">
                                                            alert("Data tahun di hapus."); 
                                                        </script>');
				redirect('master/tahun');
		}else{
			$this->session->set_userdata('tahun', '<script type="text/javascript">
                                                            alert("Data tahun gagal di hapus."); 
                                                        </script>');
				redirect('master/tahun');
		}
	}
}
?>