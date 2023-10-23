<?php
class Keuangan extends CI_Controller
{
    function __construct()
		{
			# code...
			parent::__construct();
			if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
				$this->load->model('matakuliah/Matakuliah_Model');
				$this->load->model('krs/Krs_Model');
        }
    function index(){
        $data['title'] = "Keuangan - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $keuangan['uang'] = $this->Krs_Model->tampil_mhs()->result();
        $data['content'] = $this->load->view('keuangan/v_mhs',$keuangan,true);
        $this->load->view('index',$data);
	}
	function input($nims){
		$data['title'] = "Keuangan - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$get_info['tagihan'] = $this->db->query("SELECT pmb_peserta.*, pmb_keuangan.*, pmb_pernyataan.* FROM pmb_peserta INNER JOIN pmb_keuangan ON pmb_peserta.kelas = pmb_keuangan.kelas INNER JOIN pmb_pernyataan ON pmb_peserta.nopen = pmb_pernyataan.nopen where pmb_peserta.nim = $nims")->row();
		$data['content'] = $this->load->view('keuangan/v_tagihan',$get_info,true);
        $this->load->view('index',$data);
	}
	function publish(){
		$r = $this->db->update('master_keuangan_temp',array('is_publish' => 1));
		if ($r) {
			# code...
			$this->session->set_userdata('uang', '<script type="text/javascript">
                                                            alert("Berhasil Mempublikasi Tagihan."); 
                                                        </script>');
				redirect('master/keuangan/');
		}else{
			$this->session->set_userdata('uang', '<script type="text/javascript">
                                                            alert("Gagal Mempublikasi Tagihan."); 
                                                        </script>');
				redirect('master/keuangan/');
		}
	}
	function simpan(){
		$ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row();
		$nim = $this->input->post('nim');
		$spi = $this->input->post('spi');
		$operasional = $this->input->post('operasional');
		$kemahasiswaan = $this->input->post('kemahasiswaan');
		$seragam = $this->input->post('seragam');
		$sks = $this->input->post('sks');
		$total = $spi + $operasional + $kemahasiswaan + $seragam + $sks;

		$data = array(
						'id_tahun' => $ta->id,
						'nim' => $nim,
						'operasional' => $operasional,
						'seragam' => $seragam,
						'kemahasiswaan' => $kemahasiswaan,
						'spi' => $spi,
						'sks' => $sks,
						'total' => $total,
						'is_publish' => 0
					 );
		$data_update = array(
						'id_tahun' => $ta->id,
						// 'nim' => $nim,
						'operasional' => $operasional,
						'seragam' => $seragam,
						'kemahasiswaan' => $kemahasiswaan,
						'spi' => $spi,
						'sks' => $sks,
						'total' => $total,
						'is_publish' => 0
					 );
		$cek_row = $this->db->get_where('master_keuangan_temp', array('nim' => $nim))->num_rows();
		if ($cek_row > 0) {
			# code...
			$r = $this->db->update('master_keuangan_temp',$data_update,array('nim' => $nim));
		}else{
			$r = $this->db->insert('master_keuangan_temp',$data);
		}

		if ($r) {
			# code...
			$this->session->set_userdata('uang', '<script type="text/javascript">
                                                            alert("Berhasil Menambahkan Tagihan."); 
                                                        </script>');
				redirect('master/keuangan/');
		}else{
			$this->session->set_userdata('uang', '<script type="text/javascript">
                                                            alert("Gagal Menambahkan Tagihan."); 
                                                        </script>');
				redirect('master/keuangan/');
		}
	}
	function bayar($nims){
		$data['title'] = "Keuangan - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$get_info['tagihan'] = $this->db->query("SELECT master_keuangan_temp.*, mahasiswa.nama from master_keuangan_temp INNER JOIN mahasiswa ON master_keuangan_temp.nim = mahasiswa.nim where master_keuangan_temp.nim = $nims")->row();
		// var_dump($get_info);
		$data['content'] = $this->load->view('keuangan/v_bayar',$get_info,true);
        $this->load->view('index',$data);
	}
	function bayar_aksi(){
		$nim = $this->input->post('nim');
		$bayar = $this->input->post('bayar');
		$r = $this->db->update('master_keuangan_temp',array('is_bayar' => $bayar),array('nim' => $nim));
		if ($r) {
			# code...
			$this->session->set_userdata('uang', '<script type="text/javascript">
                                                            alert("Berhasil Merubah Status Tagihan."); 
                                                        </script>');
				redirect('master/keuangan/');
		}else{
			$this->session->set_userdata('uang', '<script type="text/javascript">
                                                            alert("Gagal Merubah Status Tagihan."); 
                                                        </script>');
				redirect('master/keuangan/');
		}
	}
	function save_izin_ujian(){
		$nim = $this->input->post('nim');
		$izin_ujian = $this->input->post('izin_ujian');

		$data = array('izin_ujian' => $izin_ujian);
		$this->db->update('master_keuangan_temp', $data, array('nim' => $nim));
		$res = array('result' => 1);
		echo json_encode($res);
	}
	function biaya_pendaftaran(){
		$data['title'] = "Biaya Pendaftaran - Academic Portal";
		$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$pmb['daftar_pmb'] = $this->Model_pmb->daftar_pmb();
		$data['content'] = $this->load->view('keuangan/biaya_pendaftaran',$pmb,true);
		$this->load->view('index',$data);
	}
	function detail_biaya_pendaftaran($nopen=''){
		$data['title'] = "Biaya Pendaftaran - Academic Portal";
		$pmb['nopen'] = $nopen;
		$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$q = $this->db->get_where('biaya_pendaftaran', array('nopen' => $nopen));
		if ($q->num_rows() > 0) {
			$pmb['detail'] = $q->result();
		}else{
			$pmb['detail'] = 0;
		}
		$data['content'] = $this->load->view('keuangan/biaya_pendaftaran_detail',$pmb,true);
		$this->load->view('index',$data);
	}
	function biaya_pendaftaran_save(){
		$nopen = $this->input->post('nopen');
		$tahap_1 = $this->input->post('tahap_1');
		$tahap_2 = $this->input->post('tahap_2');
		$tahap_3 = $this->input->post('tahap_3');
		$stat_tahap_1 = $this->input->post('stat_tahap_1');
		$stat_tahap_2 = $this->input->post('stat_tahap_2');
		$stat_tahap_3 = $this->input->post('stat_tahap_3');
		$tgl_tahap_1 = $this->input->post('tgl_tahap_1');
		$tgl_tahap_2 = $this->input->post('tgl_tahap_2');
		$tgl_tahap_3 = $this->input->post('tgl_tahap_3');

		$data = array(
						'nopen' => $nopen,
						'tahap_1' => $tahap_1,
						'tahap_2' => $tahap_2,
						'tahap_3' => $tahap_3,
						'stat_tahap_1' => $stat_tahap_1,
						'stat_tahap_2' => $stat_tahap_2,
						'stat_tahap_3' => $stat_tahap_3,
						'tgl_tahap_1' => $tgl_tahap_1,
						'tgl_tahap_2' => $tgl_tahap_2,
						'tgl_tahap_3' => $tgl_tahap_3
					 );
		$cek = $this->db->get_where('biaya_pendaftaran', array('nopen' =>$nopen))->num_rows();
		if ($cek > 0) {
			# code..
			$this->db->update('biaya_pendaftaran', $data, array('nopen' =>$nopen));
		}else{
			$this->db->insert('biaya_pendaftaran', $data);
		}
		redirect('master/keuangan/detail_biaya_pendaftaran/'.$nopen);
	}
}
?>