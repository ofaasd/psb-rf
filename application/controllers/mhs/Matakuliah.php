<?php
/**
* 
*/
class Matakuliah extends CI_Controller
{
	function __construct()
		{
			parent::__construct();
			if($this->session->userdata('status') != 'login_mhs')
			{
				redirect(base_url());
			}

		}
	function index(){
		$nim = $this->session->userdata('nim');
		$krs['mhs'] = $this->db->get_where('mahasiswa', array('nim' => $nim))->result_array();
		$data['title'] = "Matakuliah - Academic Portal";
		$content['sudah_diambil'] = $this->db->query("SELECT table_transkrip.*, master_jadwal.kode_mata_kuliah, master_mata_kuliah.nama_mata_kuliah, master_mata_kuliah.jumlah_sks from table_transkrip INNER JOIN master_jadwal ON table_transkrip.id_jadwal = master_jadwal.id INNER JOIN master_mata_kuliah ON master_jadwal.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah where table_transkrip.nim = '".$nim."' and master_mata_kuliah.id_program_studi='". $krs['mhs'][0]['id_program_studi']. "' ORDER BY table_transkrip.grade DESC")->result();
		$content['sedang_diambil'] = $this->db->select('master_krs_temp.*, master_jadwal_temp.*')
											  ->from('master_krs_temp')
											  ->join('master_jadwal_temp', 'master_krs_temp.id_jadwal = master_jadwal_temp.id', 'left')
											  ->where('master_krs_temp.nim', $nim)
											  ->get()->result();
		$content['daftar'] = $this->db->get_where('master_mata_kuliah', array('is_aktif' => 1))->result();
		
		$data['content'] = $this->load->view('mhs/matakuliah',$content,true);
		$this->load->view('mhs/index',$data);
	}
}
?>