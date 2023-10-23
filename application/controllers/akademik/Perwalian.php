<?php
/**
* 
*/
use Zend\Crypt\Password\Bcrypt;
class Perwalian extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if(!$this->authact->logged_in())
		{
			redirect(base_url());
		}
		$this->load->model('Model_front');
		$this->load->model('pmb_model/Model_pmb');
	}
	function index(){
		$data['title'] = "Perwalian - Academic Portal";
		$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$content['mhs'] = $this->db->select('mahasiswa.*, pegawai.nama as nama_lengkap, program_studi.jenjang, program_studi.nama_jurusan, program_studi.id as id_progdi,fakultas.nama_fakultas')
								   ->from('mahasiswa')
								   ->join('pegawai', 'mahasiswa.id_dsn_wali = pegawai.id', 'left')
								   ->join('program_studi', 'mahasiswa.id_program_studi = program_studi.id', 'left')
								   ->join('fakultas', 'program_studi.fakultas = fakultas.id', 'left')
								   ->where('mahasiswa.status', 1)
								   ->order_by('mahasiswa.nim', 'ASC')
								   ->get()->result();
		
		$data['content'] = $this->load->view('perwalian/index',$content,true);
		$this->load->view('index',$data);
	}
	function save_dsn(){
		$nim = $this->input->post('nim');
		$id_dsn_wali = $this->input->post('id_dsn_wali');

		$q = $this->db->update('mahasiswa', array('id_dsn_wali' => $id_dsn_wali), array('nim' => $nim));
		if ($q) {
			$res = array('result' => 1);
		}else{
			$res = array('result' => 0);
		}
		echo json_encode($res);
	}
	function dosen(){
		$data['title'] = "Perwalian - Academic Portal";
		$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$get_id_pegawai = $this->db->select('*')->from('pegawai')->join('users','users.userid = pegawai.id')->where('users.id',$this->session->userdata('id_user'))->get()->row()->userid;
		$content['mhs'] = $this->db->select('mahasiswa.*, pegawai.nama as nama_lengkap, program_studi.jenjang, program_studi.nama_jurusan, program_studi.id as id_progdi,fakultas.nama_fakultas,get_jumlah_sks(nim) as jumlah_sks,get_status_krs(nim) as status_krs')
								   ->from('mahasiswa')
								   ->join('pegawai', 'mahasiswa.id_dsn_wali = pegawai.id', 'left')
								   ->join('program_studi', 'mahasiswa.id_program_studi = program_studi.id', 'left')
								   ->join('fakultas', 'program_studi.fakultas = fakultas.id', 'left')
								   ->where('mahasiswa.status', 1)
								   ->where('id_dsn_wali',$get_id_pegawai)
								   ->order_by('mahasiswa.nim', 'ASC')
								   ->get()->result();
		//echo $this->db->last_query();
		
		$data['content'] = $this->load->view('perwalian/dosen_perwalian',$content,true);
		$this->load->view('dosen/index',$data);
	}
	function verifikasi(){
		$nim = $this->input->post('nim');
		$status_krs = $this->input->post('status_krs');
		
		$q = $this->db->update('master_krs_temp', array('is_publish' => $status_krs), array('nim' => $nim));
		if ($q) {
			$res = array('result' => 1);
		}else{
			$res = array('result' => 0);
		}
		echo json_encode($res);
	}
	/* function generate_dosen_wali(){
		$query = $this->db->get('mahasiswa')->result();
		foreach($query as $row){
			$dosen_wali = $this->db->get_where("pegawai",array('id'=>$row->id_dsn_wali))->row();
			echo $dosen_wali->nama;
			echo "-"; 
			echo $row->id_dsn_wali;
			echo "<br />";
			
			$pegawai = $this->db->get_where("pegawai",array("id"=>$dosen_wali->id_pegawai))->row();
			echo $pegawai->nama;
			echo "-";
			echo $pegawai->id;
			echo "<br />";
			$hasil = $this->db->update('mahasiswa',array('id_dsn_wali'=>$pegawai->id),array('id'=>$row->id));
			
			
			echo "<br /><br />";
			
			
			
		}
		
	} */
	function cetak_krs($nim){
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
			
			$krs['biodata'] = $this->db->select('mahasiswa.*, program_studi.nama_jurusan, pegawai.nama as nama_dosen')
									   ->from('mahasiswa')
									   ->join('program_studi', 'mahasiswa.id_program_studi = program_studi.id', 'left')
									   ->join('pegawai', 'mahasiswa.id_dsn_wali = pegawai.id', 'left')
									   ->where('mahasiswa.nim', $nim)
									   ->get()->row();
			$ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row();
			if ($ta->jenis == 1) {
				# code...
				$jenis = 'Ganjil';
			}elseif ($ta->jenis == 2) {
				# code...
				$jenis = 'Genap';
			}elseif ($ta->jenis == 3) {
				# code...
				$jenis = 'Antara Ganjil Genap';
			}elseif ($ta->jenis == 4) {
				# code...
				$jenis = 'Antara Genap Ganjil';
			}
			$krs['ta'] = $ta->awal.' - '.$ta->akhir;
			$krs['status'] = $jenis;
			$krs['krs'] = $this->db->query("SELECT master_krs_temp.*,  
											master_jadwal_temp.kode_mata_kuliah, 
											master_tahun_ajaran.*,
											master_mata_kuliah.jumlah_sks 
											FROM `master_krs_temp` 
											INNER JOIN master_jadwal_temp ON master_krs_temp.id_jadwal = master_jadwal_temp.id 
											INNER JOIN master_tahun_ajaran ON master_krs_temp.id_tahun = master_tahun_ajaran.id
											INNER JOIN master_mata_kuliah ON master_jadwal_temp.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah 
											WHERE master_krs_temp.nim = '".$nim."'
											AND master_krs_temp.id_tahun = $ta->id")->result();
			// $this->load->view('mhs/cetak_krs', $krs);
			$data = $this->load->view('mhs/cetak_krs', $krs, TRUE);
			$pdfFilePath ="Kartu Rencana Studi - ".$nim.".pdf"; 
			$mpdf->WriteHTML($data);
			$mpdf->Output($pdfFilePath, "D");
			exit;
	}
	function reset_password(){
		$data['title'] = "Reset Password - Academic Portal";
		$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$content['mhs'] = $this->db->select('mahasiswa.*, pegawai.nama as nama_lengkap, program_studi.jenjang, program_studi.nama_jurusan, program_studi.id as id_progdi,fakultas.nama_fakultas')
								   ->from('mahasiswa')
								   ->join('pegawai', 'mahasiswa.id_dsn_wali = pegawai.id', 'left')
								   ->join('program_studi', 'mahasiswa.id_program_studi = program_studi.id', 'left')
								   ->join('fakultas', 'program_studi.fakultas = fakultas.id', 'left')
								   ->where('mahasiswa.status', 1)
								   ->order_by('mahasiswa.nim', 'ASC')
								   ->get()->result();
		$data['content'] = $this->load->view('reset_mhs/reset_password',$content,true);
		$this->load->view('index',$data);
	}
	function reset_act($nim=''){
		$bcrypt = new Bcrypt();
		$pass = $bcrypt->create($nim);
		$this->db->update('mahasiswa', ['paswd' => $pass], ['nim' => $nim]);
		$this->session->set_userdata('notif', '<script>alert("Setel Ulang Kata Sandi Berhasil")</script>');
		redirect('akademik/perwalian/reset_password');

	}
}
?>