<?php
	class Formulir extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if($this->session->userdata('status') != 'login_camaba')
			{
				redirect(base_url());
			}
			$this->load->model('pmb_model/Model_pmb');
			$this->load->model('Model_online');
			$gelombang = $this->Model_online->get_gelombang('pmb_gelombang');
			if($gelombang->num_rows() == 0){
				redirect("dashboard/index");
			}
		}

		function index()
		{
			$data['title'] = "Dashboard - Calon Mahasiswa Baru";			
			$hasil['asd'] = "";
			$data['content'] = $this->load->view('pmb_online/dashboard',$hasil,true);
			$this->load->view('pmb_online/index_layout',$data);
		}
		function info(){
			$id = $this->session->userdata("id_user");
			
			$gelombang = $this->Model_online->get_gelombang('pmb_gelombang');
			$pmb['gelombang'] = $gelombang->result();
				
			$query = $this->db->where(array("user_id"=>$id))->get("pmb_peserta_online");
			$query2 = $this->db->where(array("id"=>$id))->get("user_guest");
			if($query->num_rows() > 0 && empty($query2->row()->no_pendaftaran)){
				//redirect('formulir/info');
				$data['title'] = "Formulir Mahasiswa - Academic Portal";
				//$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
				//$pmb['detail_cmhs'] = $this->Model_pmb->get_where_reg($id);
				$pmb['detail_cmhs'] = $this->db->get_where('pmb_peserta_online', array('user_id' => $id))->result();
				$pmb['warga_negara'] = $this->Model_pmb->warga_negara();
				$pmb['prodi'] = $this->Model_pmb->prodi();
				$pmb['gelombang'] = $this->Model_pmb->get_gelombang('pmb_gelombang')->result();
				$pmb['kelas'] = $this->db->get_where('pmb_kelas', array('is_active' => 1))->result();
				$pmb['wilayah'] = $this->db->get_where('wilayah', array('id_induk_wilayah' => '000000'))->result();
				$pmb['data'] = $this->Model_online->detail_($id);
				$data['content'] = $this->load->view('formulir/update_cmhs',$pmb,true);
			}else{
				$cek_nopen = $this->db->where(array("id"=>$id))->get("user_guest")->row();
				if(empty($cek_nopen->no_pendaftaran)){
					$data['title'] = "Formulir Mahasiswa - Academic Portal";
					$pmb['warga_negara'] = $this->Model_pmb->warga_negara();
					$pmb['prodi'] = $this->Model_pmb->prodi();
					$pmb['kelas'] = $this->db->get_where('pmb_kelas', array('is_active' => 1))->result();
					$pmb['detail'] = $this->db->get_where('pmb_peserta_online', array('id' => $id))->row();
					$pmb['rapor'] = $this->db->get_where('pmb_nilai_rapor',array('id_user'=>$id))->row();
					$pmb['piagam'] = $this->db->get_where('piagam_pmb',array('user_id'=>$id))->row();
					//$pmb['gelombang'] = $this->Model_online->get_gelombang('pmb_gelombang')->row();
					$pmb['gelombang'] = $this->Model_pmb->get_gelombang('pmb_gelombang')->result();
					$pmb['wilayah'] = $this->db->get_where('wilayah', array('id_induk_wilayah' => '000000'))->result();
					$data['content'] = $this->load->view('formulir/add_cmhs',$pmb,true);
				}else{
					$data['title'] = "Formulir Mahasiswa - Academic Portal";
					$nopen = $cek_nopen->no_pendaftaran;
					$pmb['detail_cmhs'] = $this->db->get_where('pmb_peserta', array('nopen' => $nopen))->result();
					$pmb['warga_negara'] = $this->Model_pmb->warga_negara();
					$pmb['prodi'] = $this->Model_pmb->prodi();
					//$pmb['gelombang'] = $this->Model_pmb->get_gelombang('pmb_gelombang')->result();
					$pmb['kelas'] = $this->db->get_where('pmb_kelas', array('is_active' => 1))->result();
					$pmb['wilayah'] = $this->db->get_where('wilayah', array('id_induk_wilayah' => '000000'))->result();
					$pmb['data'] = $this->Model_online->detail_validated($nopen);
					
					$data['content'] = $this->load->view('formulir/cmhs',$pmb,true);
				}
			}
			$this->load->view('pmb_online/index_layout',$data);
			//error_reporting(0);
			
			// var_dump($pmb['data']);
		}
		function penpres(){
			$id = $this->session->userdata("id_user");
			$cek_nopen = $this->db->where(array("id"=>$id))->get("user_guest")->row();
			$data['title'] = "Formulir Mahasiswa - Academic Portal";
			$query = $this->db->where(array("user_id"=>$id))->get("pmb_peserta_online");
			if($query->num_rows() == 0 && empty($cek_nopen->no_pendaftaran)){
				redirect('formulir/info');
			}
			if(empty($cek_nopen->no_pendaftaran)){
				$pmb['detail'] = $this->db->get_where('pmb_peserta_online', array('id' => $id))->row();
				$pmb['rapor'] = $this->db->get_where('pmb_nilai_rapor',array('id_user'=>$id))->row();
				$pmb['piagam'] = $this->db->get_where('piagam_pmb',array('user_id'=>$id))->row();
				$data['content'] = $this->load->view('formulir/add_penpres',$pmb,true);
			}else{
				$pmb['detail'] = $this->db->get_where('pmb_peserta', array('nopen' => $cek_nopen->no_pendaftaran))->row();
				$pmb['rapor'] = $this->db->get_where('pmb_nilai_rapor',array('id_user'=>$id))->row();
				$data['content'] = $this->load->view('formulir/penpres',$pmb,true);
			}
			
			$this->load->view('pmb_online/index_layout',$data);
			
		}
		function cetak_formulir($nopen){
			$mpdf = new \Mpdf\Mpdf();
			$data['title'] = "Dashboard - Calon Mahasiswa Baru";	
			if($nopen == 0){
				$hasil['msg'] = "Harap Verifikasi Data Terlebih Dahuli";
				$data['content'] = $this->load->view('no_gelombang',$hasil,true);
				$this->load->view('pmb_online/index_layout',$data);
				//$hasil['pmb_peserta'] = $this->db->get_where("pmb_peserta_online",array("user_id"=>$id))->row();
			}else{
				$pmb['cetak'] = $this->Model_pmb->cetak_where($nopen);
				$pmb['data'] = $this->Model_pmb->detail_cetak($nopen);
				$data = $this->load->view('pmb/cetak_formulir', $pmb, TRUE);
				$pdfFilePath ="Formulir Pendaftaran -".$nopen.".pdf"; 
				$mpdf->WriteHTML($data);
				$mpdf->Output($pdfFilePath, "D");
				exit;
			}
			
			
		}
		function upload_bukti()
		{
			$id = $this->session->userdata("id_user");
			$data['title'] = "Dashboard - Calon Mahasiswa Baru";			
			$hasil['rekening'] = $this->db->get("master_rekening")->result();
			$hasil['nopen'] = $this->db->get_where("user_guest",array("id"=>$id))->row()->no_pendaftaran;
			
			if(empty($hasil['nopen'])){
				$hasil['msg'] = "Harap Verifikasi Data Terlebih Dahuli";
				$data['content'] = $this->load->view('no_gelombang',$hasil,true);
				//$hasil['pmb_peserta'] = $this->db->get_where("pmb_peserta_online",array("user_id"=>$id))->row();
			}else{
				$data['content'] = $this->load->view('formulir/upload_bukti',$hasil,true);
			}
			$this->load->view('pmb_online/index_layout',$data);
		}
		function upload_foto(){
			$query = $this->db->where(array("user_id"=>$id))->get("pmb_peserta_online");
			if($query->num_rows() == 0){
				redirect('formulir/info');
			}
			$id = $this->session->userdata("id_user");
			$data['title'] = "Dashboard - Calon Mahasiswa Baru";			
			$hasil['nopen'] = $this->db->get_where("user_guest",array("id"=>$id))->row()->no_pendaftaran;
			if(empty($hasil['nopen'])){
				$hasil['pmb_peserta'] = $this->db->get_where("pmb_peserta_online",array("user_id"=>$id))->row();
			}else{
				$hasil['pmb_peserta'] = $this->db->get_where("pmb_peserta",array("nopen"=>$hasil['nopen']))->row();
			}
			$data['content'] = $this->load->view('formulir/upload_foto',$hasil,true);
			$this->load->view('pmb_online/index_layout',$data);
		}
		function jadwal_ujian(){
			$id = $this->session->userdata("id_user");
			$data['title'] = "Dashboard - Calon Mahasiswa Baru";			
			$hasil['nopen'] = $this->db->get_where("user_guest",array("id"=>$id))->row()->no_pendaftaran;
			
			$query2 = $this->db->where(array("id"=>$id))->get("user_guest");
			
			if(empty($hasil['nopen'])){
				$hasil['msg'] = "Harap Verifikasi Data Terlebih Dahuli";
				$data['content'] = $this->load->view('no_gelombang',$hasil,true);
				//$hasil['pmb_peserta'] = $this->db->get_where("pmb_peserta_online",array("user_id"=>$id))->row();
			}else{
				//$cek_verif = $this->db->get_where("bukti_registrasi",array("nopen"=>$hasil['nopen']))->row()->verifikasi;
				$hasil['pmb_peserta'] = $this->db->get_where("pmb_peserta",array("nopen"=>$hasil['nopen']))->row();
				$cek_verif = $hasil['pmb_peserta']->registrasi_pendaftaran;
				if($cek_verif == 0){
					$hasil['msg'] = "Biaya Pendaftaran belum di verifikasi";
					
					$data['content'] = $this->load->view('no_gelombang',$hasil,true);
				}elseif($cek_verif == 1){
					$hasil['user'] = $query2->row();
					$hasil['jadwal'] = $this->db->get_where("pmb_gelombang",array("id"=>$hasil['pmb_peserta']->gelombang))->row();
					//$hasil['jadwal'] = $this->db->get_where("pmb_peserta",array("nopen"=>$hasil['pmb_peserta']->gelombang))->row();
					$data['content'] = $this->load->view('formulir/jadwal',$hasil,true);
				}else{
					$hasil['msg'] = "Biaya Pendaftaran gagal di verifikasi. Harap lakukan verifikasi ulang";
					$data['content'] = $this->load->view('no_gelombang',$hasil,true);
				}
			}
			
			$this->load->view('pmb_online/index_layout',$data);
		}
		function pengumuman_ujian(){
			$id = $this->session->userdata("id_user");
			$data['title'] = "Dashboard - Calon Mahasiswa Baru";			
			$hasil['nopen'] = $this->db->get_where("user_guest",array("id"=>$id))->row()->no_pendaftaran;
			
			
			if(empty($hasil['nopen'])){
				$hasil['msg'] = "Harap Verifikasi Data Terlebih Dahuli";
				$data['content'] = $this->load->view('no_gelombang',$hasil,true);
				//$hasil['pmb_peserta'] = $this->db->get_where("pmb_peserta_online",array("user_id"=>$id))->row();
			}else{
				$hasil['pmb_peserta'] = $this->db->get_where("pmb_peserta",array("nopen"=>$hasil['nopen']))->row();
				$hasil['jadwal'] = $this->db->get_where("pmb_gelombang",array("nama_gel"=>$hasil['pmb_peserta']->gelombang))->row();
				$hasil['pengumuman'] = $this->db->get_where("pmb_online_pengumuman",array("id_gelombang"=>$hasil['jadwal']->id))->result();
				if(empty($hasil['pengumuman'])){
					$hasil['msg'] = "Belum Ada Pengumuman";
					$data['content'] = $this->load->view('no_gelombang',$hasil,true);
				}else{
					$data['content'] = $this->load->view('formulir/pengumuman',$hasil,true);
				}
				
			}
			
			$this->load->view('pmb_online/index_layout',$data);
		}
		function cmhs_tambah_aksi(){
			$r = $this->Model_online->simpan_cmhs();
			if ($r != 1) {
				# code...
				$this->session->set_userdata('error', '<script type="text/javascript">
                                                            alert("Data Calon Mahasiswa Gagal di tambahkan."); 
                                                        </script>');
				redirect('formulir/info');
			}else{
				$r = $this->Model_online->simpan_penpres();
				if ($r == 1) {
					# code...
					$this->session->set_userdata('success', '<script type="text/javascript">
											alert("Data Calon Mahasiswa Berhasil di tambahkan."); 
										</script>');
				}else{
					$this->session->set_userdata('status', '<div class="alert alert-danger">
														  <strong>Gagal!</strong> Gagal memperbarui data mohon periksa kembali.
														</div>');
				}
				
				redirect('formulir/info');
			}
		}
		
		function update_detail(){
			$r = $this->Model_online->update_cmhs();
			// echo $r;
			if ($r == 1) {
				# code...
				$this->session->set_userdata('status_update', '<div class="alert alert-success">
                                                      <strong>Berhasil!</strong> Data Berhasil di Perbarui.
                                                    </div>');
				redirect('formulir/info');
			}else{
				$this->session->set_userdata('status', '<div class="alert alert-danger">
                                                      <strong>Gagal!</strong> Gagal memperbarui data mohon periksa kembali.
                                                    </div>');
				redirect('formulir/info');
			}
		}
		function simpan_penpres(){
			$r = $this->Model_online->simpan_penpres();
			// echo $r;
			if ($r == 1) {
				# code...
				$this->session->set_userdata('status_update', '<div class="alert alert-success">
                                                      <strong>Berhasil!</strong> Data Berhasil di Perbarui.
                                                    </div>');
				redirect('formulir/penpres');
			}else{
				$this->session->set_userdata('status', '<div class="alert alert-danger">
                                                      <strong>Gagal!</strong> Gagal memperbarui data mohon periksa kembali.
                                                    </div>');
				redirect('formulir/penpres');
			}
		}
		function validasi_biodata(){
			$r = $this->Model_online->validasi_biodata();
			// echo $r;
			if ($r == 1) {
				# code...
				$this->session->set_userdata('status_update', '<div class="alert alert-success">
                                                      <strong>Berhasil!</strong> Data Berhasil di Perbarui.
                                                    </div>');
				redirect('dashboard');
			}elseif($r == 2){
				$this->session->set_userdata('status_update', '<div class="alert alert-success">
                                                      <strong>Input Data Berhasil!</strong> Harap Melakukan Pembayaran Registrasi Terlebih Dahulu, Silahkan Menghubungi Pihak Kampus STIFERA (082243333409)
                                                    </div>');
				redirect('dashboard');
			}else{
				$this->session->set_userdata('status', '<div class="alert alert-danger">
                                                      <strong>Gagal!</strong> Gagal memperbarui data mohon periksa kembali.
                                                    </div>');
				redirect('dashboard');
			}
		}
		function simpan_sekolah(){
			$id_prov = $this->input->post("id_prov");
			$id_kota = $this->input->post("id_kota");
			$nama_sekolah = $this->input->post("nama_sekolah");
			
			$get_kab = $this->db->get_where('wilayah', array('id_wil' => $id_kota))->result_array();
			$name_kab = $get_kab[0]['nm_wil'];
			$get_code_wil = $get_kab[0]['id_induk_wilayah'];
			$get_prov = $this->db->query('select * from wilayah where id_wil = "'.$get_code_wil.'" limit 1')->result_array();
			$name_prov = $get_prov[0]['nm_wil'];
			$get_name_prov = str_replace("Prop. ","", $name_prov);
			$get_name_kab = str_replace("Kab. ", "", $name_kab);
			// echo $get_name_prov;
	        $data=$this->Model_online->simpan_sekolah($get_name_kab, $get_name_prov, $nama_sekolah);
	        echo json_encode($data);
		}
		function cmhs_tambah_bukti(){
			$r = $this->Model_online->tambah_bukti();
			// echo $r;
			if ($r == 1) {
				# code...
				$this->session->set_userdata('status_update', '<div class="alert alert-success">
                                                      <strong>Berhasil!</strong> Data Berhasil di Perbarui.
                                                    </div>');
				redirect('formulir/upload_bukti');
			}else{
				$this->session->set_userdata('status', '<div class="alert alert-danger">
                                                      <strong>Gagal!</strong> Gagal memperbarui data mohon periksa kembali.
                                                    </div>');
				redirect('formulir/upload_bukti');
			}
		}
		function cmhs_upload_foto(){
			$r = $this->Model_online->tambah_foto();
			// echo $r;
			if ($r == 1) {
				# code...
				$this->session->set_userdata('status_update', '<div class="alert alert-success">
                                                      <strong>Berhasil!</strong> Data Berhasil di Perbarui.
                                                    </div>');
				redirect('formulir/upload_foto');
			}else{
				$this->session->set_userdata('status', '<div class="alert alert-danger">
                                                      <strong>Gagal!</strong> Gagal memperbarui data mohon periksa kembali.
                                                    </div>');
				redirect('formulir/upload_foto');
			}
		}
	}
?>