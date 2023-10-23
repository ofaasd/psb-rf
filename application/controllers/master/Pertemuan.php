<?php
class Pertemuan extends CI_Controller
{
    function __construct()
		{
			# code..
			parent::__construct();
			if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
        }
    function index(){
        $data['title'] = "Pertemuan - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $pertemuan['temu'] = $this->db->query("SELECT master_jadwal_temp.*, concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_dosen, master_mata_kuliah.nama_mata_kuliah FROM master_jadwal_temp INNER JOIN pegawai_biodata ON master_jadwal_temp.id_dosen = pegawai_biodata.id INNER JOIN master_mata_kuliah ON master_jadwal_temp.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah")->result();
        // var_dump($pertemuan['temu']);
        $data['content'] = $this->load->view('pertemuan/v_jadwal',$pertemuan,true);
        $this->load->view('index',$data);
    }
    function input($id){
        $data['title'] = "Pertemuan - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $id_jadwal = $this->openssl->convert("decrypt", $id);
        $pertemuan['temu'] = $this->db->query("SELECT master_jadwal_temp.*, concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_dosen, master_mata_kuliah.nama_mata_kuliah FROM master_jadwal_temp INNER JOIN pegawai_biodata ON master_jadwal_temp.id_dosen = pegawai_biodata.id INNER JOIN master_mata_kuliah ON master_jadwal_temp.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah where master_jadwal_temp.id = $id")->result();
        $pertemuan['tgl'] = $this->db->get_where('master_pertemuan', array('id_jadwal' => $id))->result_array();
        $data['content'] = $this->load->view('pertemuan/v_input',$pertemuan,true);
        $this->load->view('index',$data);
    }
    function simpan(){
    	for ($i=1; $i <= 16; $i++) { 
    		# code...
    		$id_jadwal = $this->input->post('id_jadwal');
    		$id_tahun = $this->input->post('id_tahun');
    		$tgl_pertemuan = $this->input->post('pertemuan'.$i);
    		echo $tgl_pertemuan;
    		$where = array('id_pertemuan' => $i,
    					   'id_jadwal' => $id_jadwal,
    					   'id_tahun' => $id_tahun);
    		$data = array('id_pertemuan' => $i,
    					   'id_jadwal' => $id_jadwal,
    					   'id_tahun' => $id_tahun,
    					   'tgl_pertemuan' => $tgl_pertemuan
    					   );
    		$cek_row = $this->db->get_where('master_pertemuan', $where)->num_rows();
    		if ($cek_row > 0) {
    			# code...
    			$this->db->update('master_pertemuan', $data, $where);
    			$r = 1;
    			
    		}else{
    			$r = $this->db->insert('master_pertemuan', $data);
    			$r = 1;
    		}
    	}
    	if ($r == 1) {
    		# code...
    		$this->session->set_userdata('pertemuan','Pertemuan sudah Di set');
				redirect('master/pertemuan/input/'.$id_jadwal);
    	}else{
    		$this->session->set_userdata('pertemuan','Pertemuan gagal di set');
				redirect('master/pertemuan/input/'.$id_jadwal);
    	}
    }
}