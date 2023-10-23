<?php
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	class Pmb extends CI_Controller{
		function __construct()
			{
				parent::__construct();
				if($this->session->userdata('status') != 'login_camaba')
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
				$this->load->model('pmb_model/Model_pmb');
				$this->load->model('Model_online');
			}
		

		function gelombang(){
			$data['title'] = "Gelombang - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$pmb['data'] = $this->db->get('pmb_gelombang')->result();
			$data['content'] = $this->load->view('pmb/gelombang_index',$pmb,true);
			$this->load->view('index',$data);
		}
		function gelombang_edit($id=''){
			$data['title'] = "Gelombang Edit - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$pmb['data'] = $this->db->get_where('pmb_gelombang', ['id' => $id])->result();
			$pmb['ta'] = $this->db->get_where('master_tahun_ajaran', ['is_aktif' => 1])->row();
			$data['content'] = $this->load->view('pmb/gelombang_edit',$pmb,true);
			$this->load->view('index',$data);
		}
		
		function gelombang_update(){
			$id = $this->input->post('id');
			$no_gel = $this->input->post('no_gel');
			$nama_gel = $this->input->post('nama_gel');
			$nama_gel_long = $this->input->post('nama_gel_long');
			$tgl_mulai = $this->input->post('tgl_mulai');
			$tgl_akhir = $this->input->post('tgl_akhir');
			$ujian = $this->input->post('ujian');
			$jam_ujian = $this->input->post('jam_ujian');
			$pengumuman = $this->input->post('pengumuman');
			$reg_mulai = $this->input->post('reg_mulai');
			$reg_akhir = $this->input->post('reg_akhir');
			$tahun = $this->input->post('tahun');
			$jenis = $this->input->post('jenis');
			$semester = 1;

			$data = [
						'no_gel' => $no_gel,
						'nama_gel' => $nama_gel,
						'nama_gel_long' => $nama_gel_long,
						'tgl_mulai' => $tgl_mulai,
						'tgl_akhir' => $tgl_akhir,
						'ujian' => $ujian,
						'jam_ujian' => $jam_ujian,
						'pengumuman' => $pengumuman,
						'reg_mulai' => $reg_mulai,
						'reg_akhir' => $reg_akhir,
						'tahun' => $tahun,
						'jenis' => $jenis,
						'semester' => 1
					];
			$this->db->update('pmb_gelombang', $data, ['id' => $id]);
		}
		function tambah_calon_mhs() 
		{
			$data['title'] = "Pendaftaran - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$pmb['warga_negara'] = $this->Model_pmb->warga_negara();
			$pmb['prodi'] = $this->Model_pmb->prodi();
			$pmb['kelas'] = $this->db->get_where('pmb_kelas', array('is_active' => 1))->result();
			$pmb['gelombang'] = $this->Model_pmb->get_gelombang('pmb_gelombang')->result();
			$pmb['wilayah'] = $this->db->get_where('wilayah', array('id_induk_wilayah' => '000000'))->result();
			// $pmb['random'] = rand(10000,99999);
			// $data['content'] = $this->load->view('pmb/tambah_calon_mhs',$pmb,true);
			$data['content'] = $this->load->view('pmb/add_cmhs',$pmb,true);
			$this->load->view('index',$data);
		}
		function tambah_calon_mhs_()
		{
			$data['title'] = "Pendaftaran - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$pmb['warga_negara'] = $this->Model_pmb->warga_negara();
			$pmb['prodi'] = $this->Model_pmb->prodi();
			$pmb['gelombang'] = $this->Model_pmb->get_gelombang('pmb_gelombang')->result();
			$pmb['wilayah'] = $this->db->get_where('wilayah', array('id_induk_wilayah' => '000000'))->result();
			// $pmb['random'] = rand(10000,99999);
			// $data['content'] = $this->load->view('pmb/tambah_calon_mhs',$pmb,true);
			$data['content'] = $this->load->view('pmb/tambah_calon_mhs',$pmb,true);
			$this->load->view('index',$data);
		}
		function cmhs_tambah_aksi(){
			$r = $this->Model_online->simpan_cmhs();
			if ($r != 1) {
				# code...
				$this->session->set_userdata('status_delete', '<script type="text/javascript">
                                                            alert("Data Calon Mahasiswa Gagal di tambahkan."); 
                                                        </script>');
				redirect('pmb');
			}else{
				$this->session->set_userdata('status_delete', '<script type="text/javascript">
                                                            alert("Data Calon Mahasiswa Berhasil di tambahkan."); 
                                                        </script>');
				redirect('pmb');
			}
		}
		
		function registrasi($id=''){
			$data['title'] = "Registrasi - Academic Portal";
			$q = $this->db->get_where('pmb_peserta', array('id' => $id))->row();
			$nopen = $q->nopen;
			$kelas = $q->kelas;
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$o = $this->db->get_where('pmb_keuangan', array('kelas' => $kelas))->row();
			$pmb['registrasi'] = $this->Model_pmb->get_where_reg($id);
			$pmb['warga_negara'] = $this->Model_pmb->warga_negara();
			$pmb['prodi'] = $this->Model_pmb->prodi();
			$pmb['gelombang'] = $this->db->get('pmb_gelombang')->result();
			$pmb['wilayah'] = $this->db->get_where('wilayah', array('id_induk_wilayah' => '000000'))->result();
			$pmb['data'] = $this->Model_pmb->detail_($id);
			$c = $this->db->get_where('pmb_registrasi',['nopen' => $nopen]);
			if ($c->num_rows() > 0) {
				$q = $c->row();
				$pmb['spi'] = $q->spi;
				$pmb['potongan_spi'] = $q->potongan_spi;
				$pmb['jml_tahap_1'] = $q->jml_tahap_1;
				$pmb['jml_tahap_2'] = $q->jml_tahap_2;
				$pmb['jml_tahap_3'] = $q->jml_tahap_3;
				$pmb['tgl_tahap_1'] = $q->tgl_tahap_1;
				$pmb['tgl_tahap_2'] = $q->tgl_tahap_2;
				$pmb['tgl_tahap_3'] = $q->tgl_tahap_3;
				$pmb['status_tahap_1'] = $q->status_tahap_1;
				$pmb['status_tahap_2'] = $q->status_tahap_2;
				$pmb['status_tahap_3'] = $q->status_tahap_3;
				$pmb['sks'] = $q->sks;
				$pmb['kemahasiswaan'] = $q->kemahasiswaan;
				$pmb['operasional'] = $q->operasional;
				$pmb['seragam'] = $q->seragam;
			}else{
				$pmb['spi'] = $o->total_spi;
				$pmb['potongan_spi'] = 0;
				$pmb['jml_tahap_1'] = 0;
				$pmb['jml_tahap_2'] = 0;
				$pmb['jml_tahap_3'] = 0;
				$pmb['tgl_tahap_1'] = 0;
				$pmb['tgl_tahap_2'] = 0;
				$pmb['tgl_tahap_3'] = 0;
				$pmb['status_tahap_1'] = 0;
				$pmb['status_tahap_2'] = 0;
				$pmb['status_tahap_3'] = 0;
				$pmb['sks'] = $o->total_sks;
				$pmb['kemahasiswaan'] = $o->kemahasiswaan;
				$pmb['operasional'] = $o->operasional;
				$pmb['seragam'] = $o->seragam;
			}
			$data['content'] = $this->load->view('pmb/registrasi_cmhs',$pmb,true);
			$this->load->view('index',$data);
		}
		function pengumuman($id=''){
			error_reporting(0);
			if(empty($id)){
				redirect('pmb/calon_mhs');
			}else{
				$data['title'] = "Pengumuman - Academic Portal";
				$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
				$pmb['registrasi'] = $this->Model_pmb->get_where_reg($id);
				$pmb['warga_negara'] = $this->Model_pmb->warga_negara();
				$pmb['prodi'] = $this->Model_pmb->prodi();
				$pmb['gelombang'] = $this->db->get('pmb_gelombang')->result();
				$pmb['wilayah'] = $this->db->get_where('wilayah', array('id_induk_wilayah' => '000000'))->result();
				$pmb['data'] = $this->Model_pmb->detail_($id);
				$data['content'] = $this->load->view('pmb/pengumuman',$pmb,true);
				$this->load->view('index',$data);
			}
		}
		function cmhs_upreg_aksi(){
			$r = $this->Model_pmb->update_cmhs();
			// echo $r;
			if ($r == 1) {
				$this->session->set_userdata('status', '<script type="text/javascript">
                                                            alert("Update Data Calon Mahasiswa Berhasil."); 
                                                        </script>');
				redirect('pmb/registrasi/'.$this->input->post('id'));
			}else{
				$this->session->set_userdata('status', '<script type="text/javascript">
                                                            alert("Update Data Calon Mahasiswa Gagal."); 
                                                        </script>');
				redirect('pmb/registrasi/'.$this->input->post('id'));
			}
		}
		function daftar_surat(){
			$data['title'] = "Pendaftaran - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$pmb['daftar_surat'] = $this->db->get_where('pmb_peserta', array('is_bayar' => 1, 'is_delete' => 0, 'is_mundur' =>0))->result();
			$data['content'] = $this->load->view('pmb/daftar_surat',$pmb,true);
			$this->load->view('index',$data);
		}
		function surat_pernyataan(){
			$r = $this->Model_pmb->export_mhs();
			if ($r == 1) {
				# code...
				$id = $this->input->post('id');
				$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
				$get_nopen = $this->db->get_where('pmb_peserta',array('id' => $id))->result_array();
				$nopen = $get_nopen[0]['nopen'];
				$spi = $this->input->post('spi');
				$potongan_spi = $this->input->post('potongan');
				$sks = $this->input->post('sks');
				$operasional = $this->input->post('operasional');
				$kemahasiswaan = $this->input->post('kemahasiswaan');
				$seragam = $this->input->post('seragam');
				$satuan_sks = $this->input->post('satuan_sks');
				$jml_tahap_1 = $this->input->post('jml_tahap_1');
				$jml_tahap_2 = $this->input->post('jml_tahap_2');
				$jml_tahap_3 = $this->input->post('jml_tahap_3');
				$tgl_tahap_1 = $this->input->post('tgl_tahap_1');
				$tgl_tahap_2 = $this->input->post('tgl_tahap_2');
				$tgl_tahap_3 = $this->input->post('tgl_tahap_3');

				$data_tagihan = array(
										'nopen' => $nopen,
										'spi' => $spi,
										'potongan_spi' => $potongan_spi,
										'sks' => $sks,
										'operasional' => $operasional,
										'kemahasiswaan' => $kemahasiswaan,
										'seragam' => $seragam,
										'jml_tahap_1' => $jml_tahap_1,
										'jml_tahap_2' => $jml_tahap_2,
										'jml_tahap_3' => $jml_tahap_3,
										'tgl_tahap_1' => $tgl_tahap_1,
										'tgl_tahap_2' => $tgl_tahap_2,
										'tgl_tahap_3' => $tgl_tahap_3
									 );
				$c = $this->db->get_where('pmb_registrasi', ['nopen' => $nopen])->num_rows();
				if ($c > 0) {
					$this->db->update('pmb_registrasi', $data_tagihan, ['nopen' => $nopen]);
				}else{
					$this->db->insert('pmb_registrasi', $data_tagihan);
				}

				$cek = $this->db->get_where('pmb_nilai_tes', array('nopen' => $get_nopen[0]['nopen']))->num_rows();
				if ($this->input->post('tes') == 0) {
					# code...
					$score = null;
				}else{
					$score = $this->input->post('tes');
				}
				if (($get_nopen[0]['jalur_pendaftaran'] != 2) || ($get_nopen[0]['jalur_pendaftaran'] != 1)) {
					# code...
					if ($cek > 0) {
					# code...
					$data_nilai = array(
								   'nopen' => $this->input->post('nopen'),
								   'total_score'  => $score
								);

					$this->db->update('pmb_nilai_tes', $data_nilai,array('nopen' => $nopen));
					}else{
						$this->db->insert('pmb_nilai_tes', array('nopen' => $this->input->post('nopen'),
															 'total_score' => $score));
					}
				}
				$pmb['cetak'] = $this->Model_pmb->get_where_reg($id);
				$pmb['get_nilai'] = $this->db->query('select * from pmb_nilai_tes where nopen = '.$nopen.' limit 1')->result();
				$pmb['get_gelombang'] = $this->db->get_where('pmb_gelombang',array('nama_gel' => $get_nopen[0]['gelombang']))->result();
				$pmb['t'] = $this->db->get_where('pmb_registrasi',array('nopen' => $nopen))->row();
				
				$data = $this->load->view('pmb/cetak_reg', $pmb, TRUE);
				
				$pdfFilePath ="Surat Pernyataan - ".$get_nopen[0]['nopen'].".pdf"; 
				
				$mpdf->WriteHTML($data);
				$mpdf->Output($pdfFilePath, "D");
				exit;
			}else{
				$this->session->set_userdata('status', '<font color="red"><p>Registrasi Gagal, Mohon Di Cek Sekali lagi.</p></font>');
				redirect('pmb/registrasi/'.$this->input->post('id'));
			}
		}
		function surat_pengumuman($id=''){
			// $id = $this->input->post('id');
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
			$get_nopen = $this->db->get_where('pmb_peserta',array('id' => $id))->result_array();
			$nopen = $get_nopen[0]['nopen'];
			$pmb['cetak'] = $this->Model_pmb->get_where_reg($id);
			$pmb['get_sks'] = $this->db->get_where('pmb_keuangan',array('kelas' => $get_nopen[0]['kelas']))->result();
			$qs = $this->db->get_where('pmb_keuangan',array('kelas' => $get_nopen[0]['kelas']))->row();
			$pmb['get_keuangan'] = $this->db->get_where('pmb_pernyataan',array('nopen' => $nopen))->result();
			$pmb['get_nilai'] = $this->db->query('select * from pmb_nilai_tes where nopen = '.$nopen.' limit 1')->result();
			$pmb['get_gelombang'] = $this->db->get_where('pmb_gelombang',array('nama_gel' => $get_nopen[0]['gelombang']))->result();
			$c = $this->db->get_where('pmb_registrasi',['nopen' => $nopen]);
			if ($c->num_rows() > 0) {
				$q = $c->row();
				$pmb['spi'] = $q->spi;
				$pmb['tgl_tahap_1'] = $q->tgl_tahap_1;
				$pmb['sks'] = $q->sks;
				$pmb['operasional'] = $q->operasional;
				$pmb['kemahasiswaan'] = $q->kemahasiswaan;
				$pmb['seragam'] = $q->seragam;
			}else{
				$date=date_create(date("Y-m-d"));
				date_add($date,date_interval_create_from_date_string("30 days"));
				$tgl = date_format($date,"Y-m-d");
				$pmb['spi'] = $qs->total_spi;
				$pmb['tgl_tahap_1'] = $tgl;
				$pmb['sks'] = $qs->total_sks;
				$pmb['operasional'] = $qs->operasional;
				$pmb['kemahasiswaan'] = $qs->kemahasiswaan;
				$pmb['seragam'] = $qs->seragam;
			}
			$data = $this->load->view('pmb/surat_pengumuman', $pmb, TRUE);
			$pdfFilePath ="Surat Pengumuman - ".$get_nopen[0]['nopen'].".pdf"; 
			$mpdf->WriteHTML($data);
			$mpdf->Output($pdfFilePath, "D");
			exit;
		}
		
		function cetak_regis($id, $nopen){
			$mpdf = new \Mpdf\Mpdf();
			$pmb['cetak'] = $this->Model_pmb->get_where_reg($id);
			$pmb['get_keuangan'] = $this->db->get_where('pmb_keuangan',array('nopen' => $nopen))->result();
			$pmb['data'] = $this->Model_pmb->detail_($id);
			$data = $this->load->view('pmb/cetak_reg', $pmb, TRUE);
			$pdfFilePath ="Surat Pernyataan - ".$get_nopen[0]['nopen'].".pdf"; 
			$mpdf->WriteHTML($data);
			$mpdf->Output($pdfFilePath, "D");
			exit;
		}

		function cetak_regis_btn($id){
			$mpdf = new \Mpdf\Mpdf();
			$get_nopen = $this->db->get_where('pmb_peserta',array('id' => $id))->result_array();
			$pmb['cetak'] = $this->Model_pmb->get_where_reg($id);
			$pmb['get_keuangan'] = $this->db->get_where('pmb_keuangan',array('nopen' => $get_nopen[0]['nopen']))->result();
			$pmb['data'] = $this->Model_pmb->detail_($id);
			$data = $this->load->view('pmb/cetak_reg', $pmb, TRUE);
			$pdfFilePath ="Surat Pernyataan - ".$get_nopen[0]['nopen'].".pdf"; 
			$mpdf->WriteHTML($data);
			$mpdf->Output($pdfFilePath, "D");
			exit;
		}
		function cmhs_detail($id){
			error_reporting(0);
			$data['title'] = "Detail Mahasiswa - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$pmb['detail_cmhs'] = $this->Model_pmb->get_where_reg($id);
			$pmb['warga_negara'] = $this->Model_pmb->warga_negara();
			$pmb['prodi'] = $this->Model_pmb->prodi();
			$pmb['gelombang'] = $this->Model_pmb->get_gelombang('pmb_gelombang')->result();
			$pmb['wilayah'] = $this->db->get_where('wilayah', array('id_induk_wilayah' => '000000'))->result();
			$pmb['data'] = $this->Model_pmb->detail_($id);
			$data['content'] = $this->load->view('pmb/detail_cmhs',$pmb,true);
			$this->load->view('index',$data);
			// var_dump($pmb['data']);
		}
		function update_detail(){
			$r = $this->Model_pmb->update_cmhs();
			// echo $r;
			if ($r == 1) {
				# code...
				$this->session->set_userdata('status_update', '<div class="alert alert-success">
                                                      <strong>Berhasil!</strong> Data Berhasil di Perbarui.
                                                    </div>');
				redirect('pmb/cmhs_detail/'.$this->input->post('id'),'refresh');
			}else{
				$this->session->set_userdata('status', '<div class="alert alert-danger">
                                                      <strong>Gagal!</strong> Gagal memperbarui data mohon periksa kembali.
                                                    </div>');
				redirect('pmb/cmhs_detail/'.$this->input->post('id'),'refresh');
			}
		}
		function delete_calon_mhs($id){
			$data = array('is_delete' => 1);
            $r = $this->db->update('pmb_peserta',$data,array('id' => $id));
            if($r == 1){
            	$this->session->set_userdata('status_delete', '<script type="text/javascript">
                                                            alert("Data Calon Mahasiswa Berhasil di Hapus."); 
                                                        </script>');
				redirect('pmb');
            }else{
            	$this->session->set_userdata('status_delete', '<script type="text/javascript">
                                                            alert("Data Calon Mahasiswa Gagal di Hapus."); 
                                                        </script>');
				redirect('pmb');
            }
		}
		function cetak_formulir($nopen){
			$mpdf = new \Mpdf\Mpdf();
			$pmb['cetak'] = $this->Model_pmb->cetak_where($nopen);
			$pmb['data'] = $this->Model_pmb->detail_cetak($nopen);
			$data = $this->load->view('pmb/cetak_formulir', $pmb, TRUE);
			$pdfFilePath ="Formulir Pendaftaran -".$nopen.".pdf"; 
			$mpdf->WriteHTML($data);
			$mpdf->Output($pdfFilePath, "D");
			exit;
		}

		function cetak_formulir_all(){
			$mpdf = new \Mpdf\Mpdf();
			$pmb['cetak'] = $this->Model_pmb->daftar_pmb();
			
			$nopendata=array();
			foreach($pmb['cetak'] as $data){
				$nopendata[]=$data->nopen;
			}
			
			$pmb['data']=array();
			foreach ($nopendata as $dt){
				$pmb['data'][]=$this->Model_pmb->detail_cetak($dt);
			}
			// $pmb['data'] = $this->Model_pmb->detail_cetak($nopen);
			
			// echo print_r($pmb['data'][0]);
			$data = $this->load->view('pmb/cetak_formulir_all', $pmb, TRUE);
			$pdfFilePath ="Formulir Pendaftaran All Data.pdf"; 
			$mpdf->WriteHTML($data);
			$mpdf->Output($pdfFilePath, "D");
			exit;
		}

		function nopen_pmdp(){
			$nopen_pmdp = $this->input->post('id');
			// $nopen_pmdp = 20000;
			$query = $this->db->get_where('pmb_peserta',array('nopen' => $nopen_pmdp));
			$cek = $query->num_rows();
			if ($cek < 1) {
				# code...
				$data = array(array("nopen" => "20000"));
			}else{
				$q = $this->db->query('select * from pmb_peserta where gelombang = "PMDP" order by id desc limit 1')->result_array();
				$nopen_baru = $q[0]['nopen'] + 1;
				$data = array(array("nopen" => "$nopen_baru"));
			}
			echo json_encode($data);
		}
		function nopen_gel(){
			$nopen_pmdp = $this->input->post('id');
			// $nopen_pmdp = 20000;
			$query = $this->db->get_where('pmb_peserta',array('nopen' => $nopen_pmdp));
			$cek = $query->num_rows();
			if ($cek < 1) {
				# code...
				$data = array(array("nopen" => "50000"));
			}else{
				$q = $this->db->query('select * from pmb_peserta where gelombang like "GEL%" order by id desc limit 1')->result_array();
				$nopen_baru = $q[0]['nopen'] + 1;
				$data = array(array("nopen" => "$nopen_baru"));
			}
			echo json_encode($data);
		}
		function daftar_prov(){
			$id=$this->input->post('id');
	        $data=$this->Model_pmb->daftar_prov($id);
	        echo json_encode($data);
		}
		function daftar_kotakab(){
			$id=$this->input->post('id');
	        $data=$this->Model_pmb->daftar_kotakab($id);
	        echo json_encode($data);
		}
		function daftar_kec(){
			$id=$this->input->post('id');
	        $data=$this->Model_pmb->daftar_kec($id);
	        echo json_encode($data);
		}
		function daftar_mou(){
			$id=$this->input->post('id');
			if ($id == 1) {
				# code...
				$data = $this->db->get('pmb_mou_afkar')->result();
				echo json_encode($data);
			}
		}
		function daftar_sekolah(){
			$id_prov=$this->input->post('id_prov');
			// $id_prov='010000';
			$id_kota=$this->input->post('id_kota');
			// $id_kota='016000';
			$get_kab = $this->db->get_where('wilayah', array('id_wil' => $id_kota))->result_array();
			$name_kab = $get_kab[0]['nm_wil'];
			$get_code_wil = $get_kab[0]['id_induk_wilayah'];
			$get_prov = $this->db->query('select * from wilayah where id_wil = "'.$get_code_wil.'" limit 1')->result_array();
			$name_prov = $get_prov[0]['nm_wil'];
			$get_name_prov = str_replace("Prop. ","", $name_prov);
			$get_name_kab = str_replace("Kab. ", "", $name_kab);
			// echo $get_name_prov;
	        $data=$this->Model_pmb->daftar_sekolah($get_name_kab, $get_name_prov);
	        echo json_encode($data);
		}

		function daftar_kelas(){
			$data['title'] = "Pendaftaran - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$pmb['kelas'] = $this->db->get_where('pmb_kelas')->result();
			$data['content'] = $this->load->view('pmb/pmb_kelas',$pmb,true);
			$this->load->view('index',$data);
		}
		function pmdp(){
			$data['title'] = "Peserta PMDP - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$pmb['list'] = $this->db->select('*')
									 ->from('pmb_peserta')
									 ->where('gelombang', 'PMDP')
									 ->order_by('peringkat_pmdp', 'DESC')
									 ->get()->result();
			$data['content'] = $this->load->view('pmb/pmdp',$pmb,true);
			$this->load->view('index',$data);
		}
		function download_pmdp(){
			$spreadsheet = new Spreadsheet;

	          $spreadsheet->setActiveSheetIndex(0)
	                      ->setCellValue('A1', 'NO.')
	                      ->setCellValue('B1', 'Nomor Pendaftaran')
	                      ->setCellValue('C1', 'NISN')
	                      ->setCellValue('D1', 'Nama Lengkap')
	                      ->setCellValue('E1', 'Jenis Pendaftaran')
	                      ->setCellValue('F1', 'Skor PMDP')
	                      ->setCellValue('G1', 'Jurusan');
	          $data = $this->db->select('*')
									 ->from('pmb_peserta')
									 ->where('gelombang', 'PMDP')
									 ->order_by('peringkat_pmdp', 'DESC')
									 ->get()->result();
	          $kolom = 2;
	          $no = 1;
	          foreach($data as $p) {
	          		if($p->jenis_pendaftaran == 1){
                    	$jenis_pendaftaran = 'Peserta Didik Baru';
                    }else if($p->jenis_pendaftaran == 2){
                        $jenis_pendaftaran = 'Pindahan';
                    }else if($p->jenis_pendaftaran == 11){
                        $jenis_pendaftaran = 'Alih Jenjang';
                    }else if($p->jenis_pendaftaran == 12){
                        $jenis_pendaftaran = 'Lintas Jalur';
                    }
	               $spreadsheet->setActiveSheetIndex(0)
	                           ->setCellValue('A' . $kolom, $no++)
	                           ->setCellValue('B' . $kolom, $p->nopen)
	                           ->setCellValue('C' . $kolom, $p->nisn)
	                           ->setCellValue('D' . $kolom, $p->nama)
	                           ->setCellValue('E' . $kolom, $jenis_pendaftaran)
	                           ->setCellValue('F' . $kolom, $p->peringkat_pmdp)
	                           ->setCellValue('G' . $kolom, $this->bantuan->pilihan_prodi($p->pilihan1));

	               $kolom++;

	          }

	        $writer = new Xlsx($spreadsheet);
	        $date = date('d-m-Y');
	        header('Content-Type: application/vnd.ms-excel');
	        header('Content-Disposition: attachment;filename="DAFTAR PESERTA PMDP '.$date.'.xls"');
	        header('Cache-Control: max-age=0');

	        $writer->save('php://output');
		}
		
	}
?>
