<?php
/**
* 
*/
class Gelombang extends CI_Controller
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
		$data['title'] = "Gelombang - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $gelombang['gelombang'] = $this->db->get('pmb_gelombang')->result();
        $data['content'] = $this->load->view('gelombang/v_gel',$gelombang,true);
        $this->load->view('index',$data);
	}
	function add(){
		$data['title'] = "Gelombang - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $gelombang['hari'] = $this->db->get('master_hari')->result();
        $data['content'] = $this->load->view('gelombang/v_add',$gelombang,true);
        $this->load->view('index',$data);
	}
	function add_act(){
		$data = array(
						'nama_gel' => $this->input->post('kode'),
						'nama_gel_long' => $this->input->post('nama'),
						'tgl_mulai' => $this->input->post('tgl_mulai'),
						'tgl_akhir' => $this->input->post('tgl_akhir'),
						'ujian' => $this->input->post('tgl_ujian'),
						'jam_ujian' => $this->input->post('waktu_ujian'),
						'hari_ujian' => $this->input->post('hari_ujian'),
						'pengumuman' => $this->input->post('pengumuman'),
						'reg_mulai' => $this->input->post('reg_mulai'),
						'reg_akhir' => $this->input->post('reg_akhir'),
						'tahun' => $this->input->post('tahun'),
						'jenis' => $this->input->post('jenis')
					 ); 
		$r = $this->db->insert('pmb_gelombang', $data);
		if ($r) {
			$this->session->set_userdata('gel', '<script type="text/javascript">
                                                            alert("Data Gelombang ditambah."); 
                                                        </script>');
			redirect('master/gelombang');
		}else{
			$this->session->set_userdata('gel', '<script type="text/javascript">
                                                            alert("Data Gelombang gagal ditambah."); 
                                                        </script>');
			redirect('master/gelombang');
		}
	}
	function update($id=''){
		if ($id == '') {
			redirect('master/gelombang');
		}else{
			$ids = base64_decode(base64_decode($id));
			$data['title'] = "Gelombang - Academic Portal";
        	$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        	$gelombang['hari'] = $this->db->get('master_hari')->result();
        	$gelombang['data'] = $this->db->query("SELECT pmb_gelombang.*, master_hari.nama_hari FROM pmb_gelombang INNER JOIN master_hari ON pmb_gelombang.hari_ujian = master_hari.id where pmb_gelombang.id = $ids")->row();
        	//echo $ids;
        	//var_dump($gelombang['data']);
        	$data['content'] = $this->load->view('gelombang/v_update',$gelombang,true);
        	$this->load->view('index',$data);
		}
	}
	function update_act(){
		$where = array('id' => $this->input->post('id'));
		$data = array(
						'nama_gel' => $this->input->post('kode'),
						'nama_gel_long' => $this->input->post('nama'),
						'tgl_mulai' => $this->input->post('tgl_mulai'),
						'tgl_akhir' => $this->input->post('tgl_akhir'),
						'ujian' => $this->input->post('tgl_ujian'),
						'jam_ujian' => $this->input->post('waktu_ujian'),
						'hari_ujian' => $this->input->post('hari_ujian'),
						'pengumuman' => $this->input->post('pengumuman'),
						'reg_mulai' => $this->input->post('reg_mulai'),
						'reg_akhir' => $this->input->post('reg_akhir'),
						'tahun' => $this->input->post('tahun'),
						'jenis' => $this->input->post('jenis')
					 );
		$r = $this->db->update('pmb_gelombang', $data, $where);
		if ($r) {
			$this->session->set_userdata('gel', '<script type="text/javascript">
                                                            alert("Data Gelombang diubah."); 
                                                        </script>');
			redirect('master/gelombang');
		}else{
			$this->session->set_userdata('gel', '<script type="text/javascript">
                                                            alert("Data Gelombang gagal diubah."); 
                                                        </script>');
			redirect('master/gelombang');
		}			  
	}
	function delete($id=''){
		if ($id == '') {
			redirect('master/gelombang');
		}else{
			$ids = base64_decode(base64_decode($id));
			$r = $this->db->delete('pmb_gelombang', array('id' => $ids));
			if ($r) {
			$this->session->set_userdata('gel', '<script type="text/javascript">
                                                            alert("Data Gelombang dihapus."); 
                                                        </script>');
			redirect('master/gelombang');
		}else{
			$this->session->set_userdata('gel', '<script type="text/javascript">
                                                            alert("Data Gelombang gagal dihapus."); 
                                                        </script>');
			redirect('master/gelombang');
		  }
		}
	}
}
?>