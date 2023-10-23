<?php

	class Nilai extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if (!$this->authact->logged_in())
			{
				redirect("dashboard");
			}
			$this->load->model('Model_front');
			$this->load->library('email');
		}
 
		function index()
		{
			$data['title'] = "KRM - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$cek_id = $this->db->get_where('pegawai_biodata', array('nidn' => $this->authact->get_user_name()))->row();
			$ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row();
			$krm['jadwal'] = $this->db->query("SELECT master_jadwal_temp.*, master_mata_kuliah.nama_mata_kuliah as matkul FROM master_jadwal_temp INNER JOIN master_mata_kuliah ON master_jadwal_temp.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah where master_jadwal_temp.id_tahun = $ta->id and master_jadwal_temp.id_dosen = $cek_id->id and master_jadwal_temp.status = 1")->result();
			$ta_sekarang = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row()->id;
			$krm['ta'] = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 0 AND id != $ta_sekarang ORDER BY id DESC LIMIT 1")->result();
			// $krm['get_id'] = $this->db->get_where('pegawai_biodata', array('nidn' => $this->session->userdata('npp')))->row()->id;
			$krm['dosen'] = $cek_id->id;
			$data['content'] = $this->load->view('krm/v_jadwal',$krm,true);
			$this->load->view('index',$data);
		}
		function input($name){
			$this->session->set_userdata('url', $name);
			$decode_matkul = base64_decode(base64_decode($name));
			$matkul = explode('-', $decode_matkul);
			$sesi = $matkul[2].'-'.$matkul[3]; 
			$data['title'] = "KRM - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			// $ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_delete = '0' ORDER BY id DESC LIMIT 1")->row();
			$tahun_ajaran = $this->db->select('*')
						   ->from('master_tahun_ajaran')
						   ->where('is_delete', '0')
						   ->order_by('id', 'DESC')
						   ->limit(1)
						   ->get();
			$ta = $tahun_ajaran->row();
			$mhs = $this->db->select('master_nilai.*, master_jadwal_temp.*, mahasiswa.nama, pmb_peserta.foto_peserta, , pmb_peserta.hp, master_keuangan_temp.is_bayar')
							->from('master_nilai')
							->join('master_jadwal_temp', 'master_nilai.id_jadwal = master_jadwal_temp.id')
							->join('mahasiswa', 'mahasiswa.nim = master_nilai.nim')
							->join('pmb_peserta', 'pmb_peserta.nim = mahasiswa.nim')
							->join('master_keuangan_temp', 'master_keuangan_temp.nim = master_nilai.nim')
							->where('master_nilai.id_jadwal', $matkul[6])
							->where('master_nilai.is_krs', 1)
							->get();
			$krm['r_mhs'] = $mhs->result();
			$krm['url_encode'] = $name;
			$krm['t_mhs'] = $mhs->num_rows();
			$id_jadwal = $matkul[6];
			$krm['matkul'] = $this->db->query("SELECT master_jadwal_temp.*, concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_dosen, master_mata_kuliah.nama_mata_kuliah as makul FROM `master_jadwal_temp` LEFT JOIN pegawai_biodata on master_jadwal_temp.id_dosen = pegawai_biodata.id LEFT JOIN master_mata_kuliah on master_jadwal_temp.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah where master_jadwal_temp.id = '$id_jadwal'")->result();
			$krm['persentase'] = $this->db->get_where('master_persentase_nilai', array('id_jadwal' => $id_jadwal))->result();
			$data['content'] = $this->load->view('krm/v_input',$krm,true);
			$this->load->view('index',$data);
		}
		function input_aksi(){
			$url = $this->input->post('url');
			$total_row = $this->input->post('total_row');
			$cek_persentase = $this->db->get_where('master_persentase_nilai',array('id_jadwal' => $this->input->post('id_jadwal')))->num_rows();
			if ($cek_persentase == 0) {
				# code...
				$this->session->set_userdata('nilai', '<script type="text/javascript">
	                                                            alert("Persentase nilai belum di set."); 
	                                                        </script>');
				redirect('krm/nilai/input/'.$url);
				// echo "";
			}
			for ($i=0; $i < $total_row; $i++) { 
				# code... 
				$nim = $this->input->post('nim'.$i);
				$id_jadwal = $this->input->post('id_jadwal');
				$get_persentase = $this->db->get_where('master_persentase_nilai', array('id_jadwal' => $id_jadwal))->row();
				$id_dosen = $this->input->post('id_dosen');
				$ntugas = floatval(str_replace(',', '.', $this->input->post('ntugas'.$i)));
				$nuts = floatval(str_replace(',', '.', $this->input->post('nuts'.$i)));
				$nuas = floatval(str_replace(',', '.', $this->input->post('nuas'.$i)));
				$nakhir = ($ntugas * $get_persentase->ntugas / 100) + ($nuts * $get_persentase->nuts / 100) + ($nuas * $get_persentase->nuas / 100);
				$where = array('id_jadwal' => $id_jadwal, 'nim' => $nim, 'ndosen' => $id_dosen);
				$cek = $this->db->get_where('master_nilai', $where)->num_rows();
	
				if ($nakhir < 50) {
					# code...
					$nhuruf = 'E';
				}elseif (($nakhir > 49) && ($nakhir < 60)) {
					# code...
					$nhuruf = 'D';
				}elseif (($nakhir > 59) && ($nakhir < 70)) {
					# code...
					$nhuruf = 'C';
				}elseif (($nakhir > 69) && ($nakhir < 85)) {
					# code...
					$nhuruf = 'B';
				}elseif (($nakhir > 84) && ($nakhir <= 100)) {
					# code...
					$nhuruf = 'A';
				}
				$data = array(
								'id_jadwal' => $id_jadwal, 
								'nim' => $nim, 
								'ntugas' => $this->openssl->convert("encrypt",$ntugas), 
								'nuts' => $this->openssl->convert("encrypt",$nuts), 
								'nuas' => $this->openssl->convert("encrypt",$nuas), 
								'nakhir' => $this->openssl->convert("encrypt",$nakhir), 
								'nhuruf' => $this->openssl->convert("encrypt",$nhuruf), 
								'ndosen' => $id_dosen, 
								'is_publish' => 0
								);
				// var_dump($data);
				
				if ($cek > 0) {
					# code...
					$this->db->update('master_nilai',$data,$where);
					if ($i == ($total_row - 1)) {
						# code...
						$this->session->set_userdata('nilai', '<script type="text/javascript">
                                                            alert("nilai berhasil di Update."); 
                                                        </script>');
						redirect('krm/nilai/input/'.$url);
					}
				}else{
					$this->db->insert('master_nilai',$data);
					if ($i == ($total_row - 1)) {
						# code...
						$this->session->set_userdata('nilai', '<script type="text/javascript">
                                                            alert("nilai berhasil di Simpan."); 
                                                        </script>');
						redirect('krm/nilai/input/'.$url);
					}
				}
			}
		}
		function publish($id_jadwal){
			ini_set('SMTP','ssl://smtp.googlemail.com');
			ini_set('smtp_port', 465);
			$jadwal = explode('-', $id_jadwal);
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
			$get_nilai = $this->db->get_where('master_jadwal_temp',array('id' => $jadwal[0]))->row();
			$get_identitas['result'] = $this->db->query("SELECT master_nilai.*, mahasiswa.nama FROM master_nilai INNER JOIN mahasiswa ON master_nilai.nim = mahasiswa.nim where master_nilai.id_jadwal = $jadwal[0]")->result();
			$data = $this->load->view('template_arsip/arsip_dsn', $get_identitas, TRUE);
			$pdfFilePath = APPPATH.$get_nilai->kode_mata_kuliah.".pdf"; 
			$mpdf->WriteHTML($data);
			$mpdf->Output($pdfFilePath, "F");
			
			$get_dosen = $this->db->get_where('master_jadwal_temp', array('id_jadwal' => $id_jadwal))->row();
			$get_email = $this->db->get_where('pegawai_biodata', array('id' => $get_dosen->id_dosen))->row();
			//SMTP & mail configuration
			$config = array(
			    'protocol'  => 'smtp',
			    'smtp_host' => 'ssl://smtp.googlemail.com',
			    'smtp_port' => 465,
			    'smtp_user' => '111201408450@mhs.dinus.ac.id',
			    'smtp_pass' => 'Peler123@@!!',
			    'mailtype'  => 'html',
			    'charset'   => 'utf-8'
			);
			$this->email->initialize($config);
			$this->email->set_mailtype("html");
			$this->email->set_newline("\r\n");

	        //Email content
			$htmlContent = '<h1>Akademi Farmasi Nusaputera Arsip</h1>';
			$htmlContent .= '<p>Arsip Nilai mahasiswa</p>';

			$this->email->to($get_email->email1);
			$this->email->from('no-reply@akfar-nusaputera.ac.id','Akademi Farmasi Nusaputera');
			$this->email->subject('Arsip Nilai');
	        $this->email->attach(site_url().'assets/arsip/arsip_nilai/Arsip_Nilai_'.$get_nilai->kode_mata_kuliah.".pdf");
			$this->email->message($htmlContent);
			$rs = $this->email->send();

			$r = $this->db->update('master_nilai', array('is_publish' => 1), array('id_jadwal' => $jadwal[0]));
			if ($r && $rs) {
				# code...
				$this->session->set_userdata('nilai', '<script type="text/javascript">
                                                            alert("nilai berhasil di Publish."); 
                                                        </script>');
						redirect('krm/nilai/input/'.$jadwal[1]);
			}else{
				$this->session->set_userdata('nilai', '<script type="text/javascript">
                                                            alert("nilai gagal di Publish."); 
                                                        </script>');
						redirect('krm/nilai/input/'.$jadwal[1]);
			}
		}
		function set_persentase(){
			$tugas = $this->input->post('ptugas');
			$puts = $this->input->post('puts');
			$puas = $this->input->post('puas');
			$url = $this->input->post('url');
			$id_jadwal = $this->input->post('id_jadwal');
			$jml = $tugas + $puts + $puas;
			$data = array(
							'id_jadwal' => $id_jadwal,
							'ntugas' => $tugas,
							'nuts' => $puts,
							'nuas' => $puas
						 );
			if ($jml != 100) {
						$this->session->set_userdata('nilai', '<script type="text/javascript">
                                                            alert("Jumlah Persentase Tugas, UTS, dan UAS tidak 100%"); 
                                                        </script>');
						redirect('krm/nilai/input/'.$url);
			}else{
				$cek = $this->db->get_where('master_persentase_nilai', array('id_jadwal' => $id_jadwal))->num_rows();
				if ($cek > 0) {
					# code...
					$this->db->update('master_persentase_nilai',$data,array('id_jadwal' => $id_jadwal));
					$this->session->set_userdata('nilai', '<script type="text/javascript">
                                                            alert("Jumlah Persentase Tugas, UTS, dan UAS Berhasil di Update"); 
                                                        </script>');
					redirect('krm/nilai/input/'.$url);
				}else{
					$this->db->insert('master_persentase_nilai',$data);
					$this->session->set_userdata('nilai', '<script type="text/javascript">
                                                            alert("Jumlah Persentase Tugas, UTS, dan UAS Berhasil di Simpan"); 
                                                        </script>');
					redirect('krm/nilai/input/'.$url);
				}
			}
		}
		function publish_nilai_uts($id_jadwal=''){
			if ($id_jadwal == '') {
				# code...
				redirect('krm/nilai');
			}else{
				$data = array('view_uts' => 1);
				$where = array('id_jadwal' => $id_jadwal);
				$this->db->update('master_nilai', $data, $where);
				redirect('krm/nilai/input/'.$this->session->userdata('url'));
			}
		}
		function publish_nilai_uas($id_jadwal=''){
			if ($id_jadwal == '') {
				# code...
				redirect('krm/nilai');
			}else{
				$data = array('view_uas' => 1);
				$where = array('id_jadwal' => $id_jadwal);
				$this->db->update('master_nilai', $data, $where);
				redirect('krm/nilai/input/'.$this->session->userdata('url'));
			}
		}
		function validasi_nilai_uts($id_jadwal=''){
			if ($id_jadwal == '') {
				# code...
				redirect('krm/nilai');
			}else{
				$data = array('validasi_uts' => 1);
				$where = array('id_jadwal' => $id_jadwal);
				$this->db->update('master_nilai', $data, $where);
				redirect('krm/nilai/input/'.$this->session->userdata('url'));
			}
		}
		function validasi_nilai_uas($id_jadwal=''){
			if ($id_jadwal == '') {
				# code...
				redirect('krm/nilai');
			}else{
				$data = array('validasi_uas' => 1);
				$where = array('id_jadwal' => $id_jadwal);
				$this->db->update('master_nilai', $data, $where);
				redirect('krm/nilai/input/'.$this->session->userdata('url'));
			}
		}
	}
?>