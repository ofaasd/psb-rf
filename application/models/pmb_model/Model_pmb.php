<?php 
	class Model_pmb extends CI_Model
	{
		function daftar_pmb(){
			$where = array('is_delete' => '0',
							'is_mundur' => '0');
			$r = $this->db->get_where('pmb_peserta', $where);
			return $r->result();
		}
		function maba(){
			$where = array('is_delete' => '0',
							'is_mundur' => '0');
			$r = $this->db->get_where('pmb_peserta', $where);
			return $r;
		}
		function maba_jk($jk){
			$where = array('is_delete' => '0',
							'is_mundur' => '0',
							'jk'=>$jk);
			$r = $this->db->get_where('pmb_peserta', $where);
			return $r;
		}
		function detail_cmhs($id){
			$data_mhs = $this->db->get_where('pmb_peserta', array('id' => $id))->result();
			return $data_mhs();
		}
		function get_gelombang($table){
			// $where = "PMDP";
			// $this->db->where('nama_gel !=', $where);
			$q = $this->db->get($table);
			return $q;
		}
		function detail_($id){
			error_reporting(0);
			$data_mhs = $this->db->get_where('pmb_peserta', array('id' => $id));
			$data_negara = $data_mhs->result_array();
			$nama_negara = $this->db->get_where('negara', array('id_negara' => $data_negara[0]['warga_negara']))->result_array();
			$nm_negara   = $nama_negara[0]['nm_negara'];
			$data_prop = $this->db->get_where('wilayah', array('id_wil' => $data_negara[0]['provinsi']))->result_array();
			$data_kab = $this->db->get_where('wilayah', array('id_wil' => $data_negara[0]['kotakab']))->result_array();
			$data_kec = $this->db->get_where('wilayah', array('id_wil' => $data_negara[0]['kecamatan']))->result_array();
			$data_sekolah = $this->db->get_where('pmb_schools', array('id' => $data_negara[0]['asal_sekolah']))->result_array();
			$gelombang = $this->db->get_where('pmb_gelombang', array('nama_gel' => $data_negara[0]['gelombang']))->result_array();
			$jurusan1 = $this->db->get_where('program_studi', array('kode' => $data_negara[0]['pilihan1']))->result_array();
			$jurusan2 = $this->db->get_where('program_studi', array('kode' => $data_negara[0]['pilihan2']))->result_array();
			$mou = $this->db->get_where('pmb_mou_afkar', array('id_sekolah' => $data_negara[0]['is_mou']))->result_array();
			$data = array('nama_negara' => $nm_negara,
						  'nm_prop' => $data_prop[0]['nm_wil'],
						  'nm_kab' => $data_kab[0]['nm_wil'],
						  'nm_kec' => $data_kec[0]['nm_wil'],
						  'nm_sekolah' => $data_sekolah[0]['nama'],
						  'gelombang' => $gelombang[0]['nama_gel_long'],
						  'jurusan1' => $jurusan1[0]['nama_jurusan'],
						  'jurusan2' => $jurusan2[0]['nama_jurusan'],
						  'mou' => $mou[0]['nama_sekolah']
						  );
			return $data;
		}
		function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}

		function detail_cetak($nopen){
			error_reporting(0);
			$data_mhs = $this->db->get_where('pmb_peserta', array('nopen' => $nopen));
			$data_negara = $data_mhs->result_array();
			$nama_negara = $this->db->get_where('negara', array('id_negara' => $data_negara[0]['warga_negara']))->result_array();
			$nm_negara   = $nama_negara[0]['nm_negara'];
			$data_prop = $this->db->get_where('wilayah', array('id_wil' => $data_negara[0]['provinsi']))->result_array();
			$data_kab = $this->db->get_where('wilayah', array('id_wil' => $data_negara[0]['kotakab']))->result_array();
			$data_kec = $this->db->get_where('wilayah', array('id_wil' => $data_negara[0]['kecamatan']))->result_array();
			$data_sekolah = $this->db->get_where('pmb_schools', array('id' => $data_negara[0]['asal_sekolah']))->result_array();
			$gelombang = $this->db->get_where('pmb_gelombang', array('nama_gel' => $data_negara[0]['gelombang']))->result_array();
			$jurusan1 = $this->db->get_where('program_studi', array('kode' => $data_negara[0]['pilihan1']))->result_array();
			$jurusan2 = $this->db->get_where('program_studi', array('kode' => $data_negara[0]['pilihan2']))->result_array();
			$data = array('nama_negara' => $nm_negara,
						  'nm_prop' => $data_prop[0]['nm_wil'],
						  'nm_kab' => $data_kab[0]['nm_wil'],
						  'nm_kec' => $data_kec[0]['nm_wil'],
						  'nm_sekolah' => $data_sekolah[0]['nama'],
						  'gelombang' => $gelombang[0]['nama_gel_long'],
						  'jurusan1' => $jurusan1[0]['nama_jurusan'],
						  'jurusan2' => $jurusan2[0]['nama_jurusan']
						  );
			return $data;
		}
		function warga_negara(){
			$r = $this->db->get('negara');
			return $r->result();
		}
		function daftar_prov($id){
			$where = array('id_negara' => $id);
			$this->db->group_by("nama_prov", "ASC");
			$r = $this->db->get_where('prov_kota_new', $where);
			return $r->result();
		}
		function daftar_kotakab($id){
			$where = array('id_induk_wilayah' => $id);
			$r = $this->db->get_where('wilayah', $where);
			return $r->result();
		}
		function daftar_kec($id){
			$where = array('id_induk_wilayah' => $id);
			$r = $this->db->get_where('wilayah', $where);
			return $r->result();
		}
		function daftar_sekolah($get_name_kab, $get_name_prov){
			$query = $this->db->query('select * from prov_kota_new where (nama_prov like "%'.$get_name_prov.'%") and (nama_kota like "%'.$get_name_kab.'%")')->result_array();
			$prov_id = $query[0]['prov_id'];
			$kota_id = $query[0]['kota_id'];
			$where = array(  
							'propinsi' => $prov_id
							// 'daerah' => $kota_id
						   );
			$r = $this->db->get_where('pmb_schools', $where);
			return $r->result();
		}
		function prodi(){
			$r = $this->db->get_where('program_studi',array('off' => 0));
			return $r->result();
		}
		function update_cmhs(){
			// $pmdp = $this->input->post('pmdp1').",".$this->input->post('pmdp2').",".$this->input->post('pmdp3').",".$this->input->post('pmdp4');
			$config['upload_path'] = './assets/foto_pmb_peserta/';
		    $config['allowed_types'] = 'jpg|png|jpeg';
		    $config['max_size']  = '1048';
		    $config['overwrite'] = TRUE;
		    $config['file_name'] = 'pmb_peserta_'.$this->input->post('nopen');
		    $config['file_ext'] = '.'.pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
		    $config['remove_space'] = TRUE;

		    $this->load->library('upload', $config); 
		    $nama_foto = 'default.png';
		    if($this->upload->do_upload('foto')){ 
		      $nama_foto = $config['file_name'].$config['file_ext'];  
			}
			$data = array(
							'nisn' => $this->input->post('nisn'),
							'gelombang' => $this->input->post('gelombang'),
							'noktp' => $this->input->post('noktp'),
							'nama' => $this->input->post('nama'),
							'jk' => $this->input->post('jk'),
							'agama' => $this->input->post('agama'),
							'nama_ibu' => $this->input->post('nama_ibu'),
							'nama_ayah' => $this->input->post('nama_ayah'),
							'tinggi_badan' => $this->input->post('tinggi_badan'),
							'berat_badan' => $this->input->post('berat_badan'),
							'tempat_lahir' => $this->input->post('tempat_lahir'),
							'tanggal_lahir' => $this->input->post('tanggal_lahir'),
							'alamat' => $this->input->post('alamat'),
							'rt' => $this->input->post('rt'),
							'rw' => $this->input->post('rw'),
							'kelurahan' => $this->input->post('kelurahan'),
							'kecamatan' => $this->input->post('kecamatan'),
							'kotakab' => $this->input->post('kotakab'),
							'provinsi' => $this->input->post('provinsi'),
							'kodepos' => $this->input->post('kode_pos'),
							'telpon' => $this->input->post('telpon'),
							'hp' => $this->input->post('hp'),
							'foto_peserta' => $nama_foto,
							'asal_sekolah' => $this->input->post('asal_sekolah'),
							'warga_negara' => $this->input->post('warga_negara'),
							// 'peringkat_pmdp' => $pmdp,
							// 'kelas' => $this->input->post('kelas'),
							// 'jenis_pendaftaran' => $this->input->post('pendaftaran'),
							// 'kelas' => $this->input->post('kelas'),
							'pilihan1' => $this->input->post('pilihan1'),
							'pilihan2' => $this->input->post('pilihan2'),
							'info_pmb' => $this->input->post('info_pmb'),
							'is_bayar' => '0',
							'is_online' => '0',
							'admin_input' => $this->session->userdata("user_id"),
							// 'admin_input' => '1',
							'is_delete' => '0',
							'is_mundur' => '0',
							'admin_input_date' => date('Y-m-d H:i:s')
						 );
				$r = $this->db->update('pmb_peserta', $data, array('id' => $this->input->post('id')));
			return $r;
		}
		function simpan_cmhs(){
			// error_reporting(0);
			$cek_nopen = $this->db->order_by('id','DESC')->get_where('pmb_peserta', array('jalur_pendaftaran' => $this->input->post('jalur')));
			$count_nopen = $cek_nopen->num_rows();
			$jalur = $this->input->post('jalur');
			$set_nopen = 0;
			$get_nopen = $cek_nopen->result_array();
			if ($count_nopen > 0) {
				# code...
				$set_nopen = $get_nopen[0]['nopen'] + 1;
			}else{
				if ($this->input->post('jalur') == 1) {
					# code...
					$set_nopen = 20000;
				}elseif ($this->input->post('jalur') == 2) {
					# code...
					$set_nopen = 30000;
				}elseif ($this->input->post('jalur') == 3) {
					# code...
					$set_nopen = 50000;
				}
			}

			if ($jalur == 1) {
				# code...
				$pmdp = ($this->input->post('smt1')+$this->input->post('smt2')+$this->input->post('smt3')+$this->input->post('smt4')+$this->input->post('smt5'))/5;
				$is_kerjasama = null;
				$is_mou = null;
				$gelombang = 'PMDP';
				$config['upload_path'] = './assets/sertifikat/';
			    $config['allowed_types'] = 'jpg|png|jpeg|pdf';
			    $config['max_size']  = '1048';
			    $config['overwrite'] = TRUE;
				$config['file_name'] = 'sertifikat_peserta_'.$set_nopen.'_'.rand();
				
				$config['file_ext'] = '.'.pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
			    $config['remove_space'] = TRUE;
			    $this->load->library('upload', $config);
			    $file1 = NULL;
			    $file2 = NULL;
			    $file3 = NULL;
			    if($this->upload->do_upload('file1')){ 
			      $file1 = $config['file_name'].$config['file_ext'];
			    }
			    if($this->upload->do_upload('file2')){ 
			      $file2 = $config['file_name'].$config['file_ext'];
			    }
			    if($this->upload->do_upload('file3')){ 
			      $file3 = $config['file_name'].$config['file_ext'];
			    }
			    $up_serti = array(
			    				  'nopen' => $set_nopen,
			    				  'file1' => $file1,
			    				  'ket1' => $this->input->post('ket1'),
			    				  'file2' => $file2,
			    				  'ket2' => $this->input->post('ket2'),
			    				  'file3' => $file3,
			    				  'ket3' => $this->input->post('ket3')
			    				);
			    $this->db->insert('piagam_pmb', $up_serti);
			}elseif ($jalur == 2) {
				# code...
				$pmdp = null;
				$is_kerjasama = $this->input->post('kerjasama');
				$is_mou = $this->input->post('nama_sekolah_mou');
				$gelombang = $this->input->post('gelombang');
			}elseif ($jalur == 3) {
				# code...
				$pmdp = null;
				$is_kerjasama = null;
				$is_mou = null;
				$gelombang = $this->input->post('gelombang');
			}
			// echo $set_nopen."<br>".$pmdp."<br>".$is_kerjasama."<br>".$is_mou."<br>".$gelombang;

			$config['upload_path'] = './assets/foto_pmb_peserta/';
		    $config['allowed_types'] = 'jpg|png|jpeg';
		    $config['max_size']  = '1048';
		    $config['overwrite'] = TRUE;
			$config['file_name'] = 'pmb_peserta_'.$set_nopen;
			
			$config['file_ext'] = '.'.pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
		    $config['remove_space'] = TRUE;
		    $this->load->library('upload', $config); 
		    $data = '';
		    $ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row();
		    $kelas = explode('-', $this->input->post('kelas'));
		    $nama_foto = 'default.png';
		    if($this->upload->do_upload('foto')){ 
		      $nama_foto = $config['file_name'].$config['file_ext'];
		    }
		    $data = array(
							'nopen' => $set_nopen,
							'nisn' => $this->input->post('nisn'),
							'gelombang' => $gelombang,
							'noktp' => $this->input->post('ktp'),
							'nama' => $this->input->post('nama'),
							'jk' => $this->input->post('jk'),
							'agama' => $this->input->post('agama'),
							'nama_ibu' => $this->input->post('ibu'),
							'nama_ayah' => $this->input->post('ayah'),
							'hp_ortu' => $this->input->post('hp_ortu'),
							'alamat_semarang' => $this->input->post('alamat_semarang'),
							'tinggi_badan' => $this->input->post('tb'),
							'berat_badan' => $this->input->post('bb'),
							'tempat_lahir' => $this->input->post('tl'),
							'tanggal_lahir' => $this->input->post('tgl'),
							'alamat' => $this->input->post('alamat'),
							'rt' => $this->input->post('rt'),
							'rw' => $this->input->post('rw'),
							'kelurahan' => $this->input->post('kelurahan'),
							'kecamatan' => $this->input->post('kecamatan'),
							'kotakab' => $this->input->post('kotakab'),
							'provinsi' => $this->input->post('provinsi'),
							'kodepos' => $this->input->post('pos'),
							'telpon' => $this->input->post('telepon'),
							'hp' => $this->input->post('hp'),
							'foto_peserta' => $nama_foto,
							'asal_sekolah' => $this->input->post('asal_sekolah'),
							'warga_negara' => $this->input->post('warga_negara'),
							'peringkat_pmdp' => $pmdp,
							'kelas' => $kelas,
							'jalur_pendaftaran' => $jalur,
							'is_kerjasama' => $is_kerjasama,
							'is_mou' => $is_mou,
							'jenis_pendaftaran' => $this->input->post('pendaftaran'),
							'kelas' => $this->input->post('kelas'),
							'pilihan1' => $this->input->post('pilihan1'),
							'pilihan2' => $this->input->post('pilihan2'),
							'info_pmb' => $this->input->post('info_pmb'),
							'is_bayar' => '0',
							'is_online' => '0',
							'admin_input' => $this->session->userdata("user_id"),
							'angkatan' => date('Y'),
							'tahun_ajaran' => $ta->id,
							'is_delete' => '0',
							'is_mundur' => '0',
							'admin_input_date' => date('Y-m-d H:i:s')
						 );
		      $r = $this->db->insert('pmb_peserta', $data);
		    return $r;
		}
		function get_where_reg($id){
			$r = $this->db->get_where('pmb_peserta', array('id' => $id));
			return $r->result();
		}
		function cetak_where($nopen){
			$r = $this->db->get_where('pmb_peserta', array('nopen' => $nopen));
			return $r->result();
		}
		function export_mhs(){
			$password = $this->authact->generatepass('demo12345');
			// $cek = $this->db->get_where('mahasiswa', array('id' => $this->input->post('id')))->num_rows();
			$cek_bayar = $this->input->post('bayar');
			$generate_nim = $this->db->get_where('pmb_peserta', array('nopen' => $this->input->post('nopen')))->result_array();
			$new_nim = 'A'.$generate_nim[0]['kelas'].date('Y').$generate_nim[0]['nopen'];
			$email = $new_nim."@nusaputera.ac.id";
			$nopen = $this->input->post('nopen');
			// if ($cek > 0 || $cek_bayar == 0) {
			if ($cek_bayar == 0) {
				# code...
				$r = 0;
			}else{
				$data = array(
							  'nim' => $new_nim,
							  'nims' => $new_nim,
							  'nama' => $this->input->post('nama'),
							  'alamat' => $this->input->post('alamat'),
							  'rt' => $this->input->post('rt'),
							  'rw' => $this->input->post('rw'),
							  'kelurahan' => $this->input->post('kelurahan'),
							  'kecamatan' => $this->input->post('kecamatan'),
							  'kokab' => $this->input->post('kotakab'),
							  'provinsi' => $this->input->post('provinsi'),
							  'telp' => $this->input->post('telpon'),
							  'hp' => $this->input->post('hp'),
							  'email' => $email,
							  'paswd' => $password,
							  'status' => 1,
							  'foto_mhs' => $generate_nim[0]['foto_peserta'],
							  'hp_ortu' => $generate_nim[0]['hp_ortu'],
							  'alamat_semarang' => $generate_nim[0]['alamat_semarang'],
							  'ta' => $generate_nim[0]['tahun_ajaran'],
							  'id_program_studi' => $generate_nim[0]['pilihan1'],
							  'angkatan' => $generate_nim[0]['angkatan'],
							  'kelas' => $generate_nim[0]['kelas'],
							  'agama' => $generate_nim['0']['agama']
							 );
				$data_update = array(
										'is_bayar' => $cek_bayar,
									    'nim' => $new_nim,
									    // 'admin_registrasi' => $this->session->userdata("user_id"),
									    'admin_registrasi' => 1,
									    'admin_registrasi_date' => date('Y-m-d H:i:s'),
									);
				$this->db->update('pmb_peserta', $data_update, array('nopen' => $nopen));
				$cek = $this->db->get_where('mahasiswa', array('nim' => $new_nim))->num_rows();
				if ($cek > 0) {
					# code...
					$r = $this->db->update('mahasiswa',$data,array('nim' => $new_nim));
				}else{
					$r = $this->db->insert('mahasiswa', $data);
				}
			}
			return $r;
		}

		function getTagihan($id){
			return $this->db->select('pmb_peserta.*, pmb_keuangan.*')
			->from('pmb_peserta')
			->join('pmb_keuangan','pmb_peserta.kelas = pmb_keuangan.kelas','inner')
			// ->join('pmb_pernyataan','pmb_peserta.nopen = pmb_pernyataan.nopen','inner')
			->where('pmb_peserta.id',$id)
			->get()->row();
		}

	}
?>
