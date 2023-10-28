<?php 
	class Model_online extends CI_Model
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
			$data_mhs = $this->db->get_where('pmb_peserta_online', array('id' => $id))->result();
			return $data_mhs();
		}
		function get_gelombang($table){
			// $where = "PMDP";
			// $this->db->where('nama_gel !=', $where);
			$q = $this->db->order_by("id","desc")->limit("1")->get_where($table,array("pmb_online"=>1));
			return $q;
		}
		function detail_($id){
			error_reporting(0);
			$data_mhs = $this->db->get_where('pmb_peserta_online', array('user_id' => $id));
			$data_negara = $data_mhs->result_array();
			$nama_negara = $this->db->get_where('negara', array('id_negara' => $data_negara[0]['warga_negara']))->result_array();
			$nm_negara   = $nama_negara[0]['nm_negara'];
			$data_prop = $this->db->get_where('wilayah', array('id_wil' => $data_negara[0]['provinsi']))->result_array();
			$data_kab = $this->db->get_where('wilayah', array('id_wil' => $data_negara[0]['kotakab']))->result_array();
			$data_kec = $this->db->get_where('wilayah', array('id_wil' => $data_negara[0]['kecamatan']))->result_array();
			$data_sekolah = $this->db->get_where('pmb_schools', array('id' => $data_negara[0]['asal_sekolah']))->result_array();
			$gelombang = $this->db->get_where('psb_gelombang', array('nama_gel' => $data_negara[0]['gelombang']))->result_array();
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
		function detail_validated($id){
			error_reporting(0);
			$data_mhs = $this->db->get_where('pmb_peserta', array('nopen' => $id));
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
		function simpan_sekolah($get_name_kab, $get_name_prov,$nama_sekolah){
			$query = $this->db->query('select * from prov_kota_new where (nama_prov like "%'.$get_name_prov.'%") and (nama_kota like "%'.$get_name_kab.'%")')->result_array();
			$prov_id = $query[0]['prov_id'];
			$kota_id = $query[0]['kota_id'];
			$data = array(  
							'propinsi' => $prov_id,
							'daerah' => $kota_id,
							'nama' => $nama_sekolah,
						   );
			$r = $this->db->insert('pmb_schools', $data);
			
			return $this->db->insert_id();
		}
		function prodi(){
			$r = $this->db->get_where('program_studi',array('off' => 0));
			return $r->result();
		}
		function update_cmhs(){
			$user_id = $this->session->userdata("id_user");
			// $pmdp = $this->input->post('pmdp1').",".$this->input->post('pmdp2').",".$this->input->post('pmdp3').",".$this->input->post('pmdp4');
			$jalur = $this->input->post('jalur');
			/* $config['upload_path'] = './assets/foto_pmb_peserta/';
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
			} */
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
							'kelas' => $this->input->post('kelas'),
							'jalur_pendaftaran' => $jalur,
							'pilihan1' => $this->input->post('pilihan1'),
							'pilihan2' => $this->input->post('pilihan2'),
							'info_pmb' => $this->input->post('info_pmb'),
							'is_bayar' => '0',
							'is_online' => '1',
							'admin_input' => $this->session->userdata("user_id"),
							// 'admin_input' => '1',
							'is_delete' => '0',
							'is_mundur' => '0',
							'admin_input_date' => date('Y-m-d H:i:s')
						 );
				$r = $this->db->update('pmb_peserta_online', $data, array('user_id' => $user_id));
			return $r;
		}
		function tambah_foto(){
			
			$config['upload_path'] = './assets/foto_pmb_peserta/';
		    $config['allowed_types'] = 'jpg|png|jpeg';
		    $config['max_size']  = '1024';
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
				'foto_peserta'=>$nama_foto,
			);
			$nopen = $this->input->post('nopen');
			$user_id = $this->session->userdata("id_user");
			if(empty($nopen)){
				$r = $this->db->update('pmb_peserta_online', $data, array('id' => $user_id));
			}else{
				$r = $this->db->update('pmb_peserta', $data, array('nopen' => $nopen));
			}
			return $r;
		}
		function simpan_penpres(){
			$id = $this->session->userdata("id_user");
			$pmdp = ($this->input->post('smt1')+$this->input->post('smt2')+$this->input->post('smt3')+$this->input->post('smt4')+$this->input->post('smt5'))/5;
			$cek_piagam = $this->db->get_where("piagam_pmb",array("user_id"=>$id));
			$cek_nilai_rapor = $this->db->get_where("pmb_nilai_rapor",array("id_user"=>$id));
			if($cek_nilai_rapor->num_rows() == 0 ){
				$data = array(
					'id_user'=>$id
				);
				$this->db->insert('pmb_nilai_rapor', $data);
			}
			
			$config['upload_path'] = './assets/rapor/';
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$config['max_size']  = '10480';
			$config['overwrite'] = TRUE;
			$config['file_name'] = 'rapor1_'.$id.'_'.md5(date('Y-m-d H:i:s'));
			
			$config['file_ext'] = '.'.pathinfo($_FILES['file_smt1']['name'], PATHINFO_EXTENSION);
			$config['remove_space'] = TRUE;
			$this->load->library('upload', $config);
			$file_smt1 = NULL;
			$file_smt2 = NULL;
			$file_smt3 = NULL;
			$file_smt4 = NULL;
			$file_smt5 = NULL;
			$nilai_rapor = array(
				'nilai_smt1' => $this->input->post('smt1'),
				'nilai_smt2' => $this->input->post('smt2'),
				'nilai_smt3' => $this->input->post('smt3'),
				'nilai_smt4' => $this->input->post('smt4'),
				'nilai_smt5' => $this->input->post('smt5'),
				
			);
			if($this->upload->do_upload('file_smt1')){ 
			  $file_smt1 = $config['file_name'].$config['file_ext'];
			  $nilai_rapor['file_smt1'] = $file_smt1;
			}
			$a = array();
			for($i = 2; $i<=5; $i++){
				$config['file_name'] = 'rapor' . $i . '_'.$id.'_'.md5(date('Y-m-d H:i:s'));
				$config['file_ext'] = '.'.pathinfo($_FILES['file_smt' . $i]['name'], PATHINFO_EXTENSION);
				$this->upload->initialize($config);
				$a[$i] = NULL;
				if($this->upload->do_upload('file_smt' . $i)){ 
				  $a[$i] = $config['file_name'].$config['file_ext'];
				  $nilai_rapor['file_smt' . $i] = $a[$i];
				}
			}
			
			
			
			$this->db->update('pmb_nilai_rapor', $nilai_rapor, array('id_user'=>$id));
			$pmdp = array(
				'peringkat_pmdp' => $pmdp,
			);
			$update = $this->db->update('pmb_peserta_online', $pmdp, array('user_id'=>$id));
			
			if($cek_piagam->num_rows() > 0){
				$config['upload_path'] = './assets/sertifikat/';
				$config['file_name'] = 'sertifikat_peserta_'.$id.'_'.rand();
				$config['file_ext'] = '.'.pathinfo($_FILES['file1']['name'], PATHINFO_EXTENSION);
				$this->upload->initialize($config);
				$file1 = NULL;
				$file2 = NULL;
				$file3 = NULL;
				if($this->upload->do_upload('file1')){ 
				  $file1 = $config['file_name'].$config['file_ext'];
				}
				$config['upload_path'] = './assets/sertifikat/';
				$config['file_name'] = 'sertifikat_peserta_'.$id.'_'.rand();
				$config['file_ext'] = '.'.pathinfo($_FILES['file2']['name'], PATHINFO_EXTENSION);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file2')){ 
				  $file2 = $config['file_name'].$config['file_ext'];
				}
				$config['upload_path'] = './assets/sertifikat/';
				$config['file_name'] = 'sertifikat_peserta_'.$id.'_'.rand();
				$config['file_ext'] = '.'.pathinfo($_FILES['file3']['name'], PATHINFO_EXTENSION);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file3')){ 
				  $file3 = $config['file_name'].$config['file_ext'];
				}
				$up_serti = array(
								  'user_id' => $id,
								  'file1' => $file1,
								  'ket1' => $this->input->post('ket1'),
								  'file2' => $file2,
								  'ket2' => $this->input->post('ket2'),
								  'file3' => $file3,
								  'ket3' => $this->input->post('ket3')
								);
				$this->db->update('piagam_pmb', $up_serti, array('user_id'=>$id));
			}else{
				$config['upload_path'] = './assets/sertifikat/';
				$config['file_name'] = 'sertifikat_peserta_'.$id.'_'.rand();
				$config['file_ext'] = '.'.pathinfo($_FILES['file1']['name'], PATHINFO_EXTENSION);
				$this->upload->initialize($config);
				$file1 = NULL;
				$file2 = NULL;
				$file3 = NULL;
				$up_serti = array(
								  'user_id' => $id,
								  
								  'ket1' => $this->input->post('ket1'),
								  
								  'ket2' => $this->input->post('ket2'),
								  
								  'ket3' => $this->input->post('ket3')
								);
				if($this->upload->do_upload('file1')){ 
				  $file1 = $config['file_name'].$config['file_ext'];
				  $up_serti['file1'] = $file1;
				}
				$config['upload_path'] = './assets/sertifikat/';
				$config['file_name'] = 'sertifikat_peserta_'.$id.'_'.rand();
				$config['file_ext'] = '.'.pathinfo($_FILES['file2']['name'], PATHINFO_EXTENSION);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file2')){ 
				  $file2 = $config['file_name'].$config['file_ext'];
				  $up_serti['file2'] = $file2;
				}
				$config['upload_path'] = './assets/sertifikat/';
				$config['file_name'] = 'sertifikat_peserta_'.$id.'_'.rand();
				$config['file_ext'] = '.'.pathinfo($_FILES['file3']['name'], PATHINFO_EXTENSION);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file3')){ 
				  $file3 = $config['file_name'].$config['file_ext'];
				  $up_serti['file3'] = $file3;
				}
				
				$this->db->insert('piagam_pmb', $up_serti);

			}
			return $update;
			
		}
		function validasi_biodata(){
			$user_id = $this->session->userdata("id_user");
			$qr = $this->db->get_where('bukti_registrasi', ['user_id' => $user_id]);
			if ($qr->num_rows() < 1) {
				return $r = 2;
			}else{
				$pmb_online = $this->db->get_where("pmb_peserta_online",array("user_id"=>$user_id))->row();
				$user = $this->db->get_where("user_guest",array("id"=>$user_id))->row();
				$jalur = $pmb_online->jalur_pendaftaran;
				$gel_ta = $this->db->get_where('pmb_ta', ['is_active'=>1])->row();
				$cek_nopen = $this->db->order_by('id','DESC')->get_where('pmb_peserta', array('angkatan' => $gel_ta->awal));
				
				$count_nopen = $cek_nopen->num_rows();
				
				$set_nopen = 0;
				$get_nopen = $cek_nopen->result_array();
				if ($count_nopen > 0) {
					# code...
					$set_nopen = $get_nopen[0]['nopen'] + 1;
				}else{
					/* if ($jalur == 1) {
						# code...
						$set_nopen = 20000;
					}elseif ($jalur == 2) {
						# code...
						$set_nopen = 30000;
					}elseif ($jalur == 3) {
						# code...
						$set_nopen = 50000;
					} */
					$set_nopen = substr($gel_ta->kode,2,2)."01"."001";
				}
				
				//2301.001
				//echo $gel_ta->kode;
				//echo substr($gel_ta->kode,2,2);
				
				//echo $set_nopen;
				//exit;
				$data = array(
							'nopen' => $set_nopen,
							//'user_id' => $user_id,
							//'is_online' => 1,
							'nisn' => $pmb_online->nisn,
							'gelombang' => $pmb_online->gelombang,
							'noktp' => $pmb_online->noktp,
							'nama' => $pmb_online->nama,
							'jk' => $pmb_online->jk,
							'agama' => $pmb_online->agama,
							'nama_ibu' => $pmb_online->nama_ibu,
							'nama_ayah' => $pmb_online->nama_ayah,
							'hp_ortu' => $pmb_online->hp_ortu,
							'email' => $user->email,
							'alamat_semarang' => $pmb_online->alamat_semarang,
							'tinggi_badan' => $pmb_online->tinggi_badan,
							'berat_badan' => $pmb_online->berat_badan,
							'tempat_lahir' => $pmb_online->tempat_lahir,
							'tanggal_lahir' => $pmb_online->tanggal_lahir,
							'alamat' => $pmb_online->alamat,
							'rt' => $pmb_online->rt,
							'rw' => $pmb_online->rw,
							'kelurahan' => $pmb_online->kelurahan,
							'kecamatan' => $pmb_online->kecamatan,
							'kotakab' => $pmb_online->kotakab,
							'provinsi' => $pmb_online->provinsi,
							'kodepos' => $pmb_online->kodepos,
							'telpon' => $pmb_online->telpon,
							'hp' => $pmb_online->hp,
							'foto_peserta' => $pmb_online->foto_peserta,
							'ukuran_seragam' => $pmb_online->ukuran_seragam,
							'asal_sekolah' => $pmb_online->asal_sekolah,
							'warga_negara' => $pmb_online->warga_negara,
							'peringkat_pmdp' => $pmb_online->peringkat_pmdp,
							'kelas' => $pmb_online->kelas,
							'jalur_pendaftaran' => $pmb_online->jalur_pendaftaran,
							'is_kerjasama' => $pmb_online->is_kerjasama,
							'is_mou' => $pmb_online->is_mou,
							'jenis_pendaftaran' => $pmb_online->jenis_pendaftaran,
							'pilihan1' => $pmb_online->pilihan1,
							'pilihan2' => $pmb_online->pilihan2,
							'info_pmb' => $pmb_online->info_pmb,
							'is_bayar' => $pmb_online->is_bayar,
							'is_online' => $pmb_online->is_online,
							'admin_input' => $user_id,
							'angkatan' => $pmb_online->angkatan,
							'tahun_ajaran' => $pmb_online->tahun_ajaran,
							'is_delete' => $pmb_online->is_delete,
							'is_mundur' => $pmb_online->is_mundur,
							'registrasi_pendaftaran' => 1,
							'admin_input_date' => $pmb_online->admin_input_date
						 );
					$r = $this->db->insert('pmb_peserta', $data);
					$data_user = array(
						"no_pendaftaran"=>$set_nopen,
					);
					$data_user2 = array(
						"nopen"=>$set_nopen,
					);
					$r2 = $this->db->update("user_guest",$data_user,array("id"=>$user_id));
					$r3 = $this->db->update("bukti_registrasi",$data_user2,array("user_id"=>$user_id));
					
					//$del = $this->db->delete("pmb_peserta_online",array("user_id"=>$user_id));
					
					return $r;
			}
		}
		function tambah_bukti(){
			$nopen = $this->input->post("nopen");
			$config['upload_path'] = './assets/bukti/';
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$config['max_size']  = '1048';
			$config['overwrite'] = TRUE;
			$config['file_name'] = 'bukti'.$nopen.'_'.rand();
			
			$config['file_ext'] = '.'.pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
			$config['remove_space'] = TRUE;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('bukti')){ 
			  $bukti = $config['file_name'].$config['file_ext'];
			}
			
			$data = array(
						'id_rekening'=>$this->input->post("id_rekening"),
						'nopen'=>$this->input->post("nopen"),
						'norek_pengirim'=>$this->input->post("norek"),
						'an_pengirim'=>$this->input->post("an_rekening"),
						'tgl_tf'=>$this->input->post("tgl_tf"),
						'bukti'=>$bukti,
					 );
			$r = $this->db->insert('bukti_registrasi', $data);
			
			return $r;
		}
		function simpan_cmhs(){
			$user_id = $this->session->userdata("id_user");
			// error_reporting(0);
			
			
			if ($jalur == 1) {
				# code...
				$is_kerjasama = null;
				$is_mou = null;
				$gelombang = 'PMDP';
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
			$config['file_name'] = 'pmb_peserta_online_'.$user_id;
			
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
			$gelombang = $this->input->post('gelombang');
		    $data = array(
							//'nopen' => $set_nopen, tidak ada karena blm verifikasi
							'user_id' => $user_id,
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
							'ukuran_seragam' => $this->input->post('ukuran_seragam'),
							'foto_peserta' => $nama_foto,
							'asal_sekolah' => $this->input->post('asal_sekolah'),
							'warga_negara' => $this->input->post('warga_negara'),
							//'peringkat_pmdp' => $pmdp,
							'kelas' => $kelas[1],
							'jalur_pendaftaran' => $this->input->post('jalur'),
							'is_kerjasama' => $is_kerjasama,
							'is_mou' => $is_mou,
							'jenis_pendaftaran' => $this->input->post('pendaftaran'),
							//'kelas' => $this->input->post('kelas'),
							'pilihan1' => $this->input->post('pilihan1'),
							'pilihan2' => $this->input->post('pilihan2'),
							'info_pmb' => $this->input->post('info_pmb'),
							'is_bayar' => '0',
							'is_online' => '1',
							'admin_input' => $user_id,
							'angkatan' => $this->input->post('gel_ta'),
							'tahun_ajaran' => $ta->id,
							'is_delete' => '0',
							'is_mundur' => '0',
							'admin_input_date' => date('Y-m-d H:i:s')
						 );
		      $r = $this->db->insert('pmb_peserta_online', $data);
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
