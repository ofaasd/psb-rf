<?php
/**
* 
*/
class Kelas extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
			if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
	}
	function index(){
		$data['title'] = "Kelas Matakuliah - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $kelas['kelas'] = $this->db->get('pmb_kelas')->result();
        $data['content'] = $this->load->view('kelas/v_kelas',$kelas,true);
        $this->load->view('index',$data);
	}
	function add(){
		$data['title'] = "Kelas - Academic Portal";
		$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		// $fakultas['fakultas'] = $this->Fakultas_Model->v_fakultas();
		$data['content'] = $this->load->view('kelas/v_add',[],true);
		$this->load->view('index',$data);
	}
	function update($id=''){
		if ($id == '') {
			# code...
			redirect('master/kelas');
		}else{
			$ids = base64_decode(base64_decode($id));
			$data['title'] = "Kelas - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$kelas['kelas'] = $this->db->get_where('pmb_kelas', array('id' => $ids))->row();
			$data['content'] = $this->load->view('kelas/v_update',$kelas,true);
			$this->load->view('index',$data);
		}
	}
	function update_act(){
		$where = array(
						'id' => $this->input->post('id')
					  );
		$data = array(
						'nama_kelas' => $this->input->post('nama'),
						'jalur' => $this->input->post('jalur'),
						'is_active' => $this->input->post('status')
					 );
		$r = $this->db->update('pmb_kelas', $data, $where);
		if ($r) {
			# code...
			$this->session->set_userdata('kelas', '<script type="text/javascript">
                                                            alert("Data kelas diubah."); 
                                                        </script>');
			redirect('master/kelas');
		}else{
			$this->session->set_userdata('kelas', '<script type="text/javascript">
                                                            alert("Data kelas gagal diubah."); 
                                                        </script>');
			redirect('master/kelas');
		}
	}
	function add_act()
	{
		$nama_kelas = $this->input->post('nama');
		$jalur = $this->input->post('jalur');
		$is_active = $this->input->post('status');

		$data = array(
						'nama_kelas' => $nama_kelas,
						'jalur' => $jalur,
						'is_active' => $is_active
					 );
		$r = $this->db->insert('pmb_kelas', $data);
		if ($r) {
			# code...
			$this->session->set_userdata('kelas', '<script type="text/javascript">
                                                            alert("Data kelas di tambahkan."); 
                                                        </script>');
			redirect('master/kelas');
		}else{
			$this->session->set_userdata('kelas', '<script type="text/javascript">
                                                            alert("Data kelas gagal di tambahkan."); 
                                                        </script>');
			redirect('master/kelas');
		}
	}
	function delete($id=''){
		if ($id == '') {
			# code...
			redirect('master/kelas');
		}else{
			$ids = base64_decode(base64_decode($id));
			$r = $this->db->delete('pmb_kelas', array('id' => $ids));
			if ($r) {
			# code...
			$this->session->set_userdata('kelas', '<script type="text/javascript">
                                                            alert("Data kelas dihapus."); 
                                                        </script>');
				redirect('master/kelas');
			}else{
				$this->session->set_userdata('kelas', '<script type="text/javascript">
	                                                            alert("Data kelas gagal dihapus."); 
	                                                        </script>');
				redirect('master/kelas');
			}
		}
	}
}
?>