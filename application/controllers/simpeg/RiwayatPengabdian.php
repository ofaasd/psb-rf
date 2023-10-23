<?php

	use Zend\Crypt\Password\Bcrypt;

	class RiwayatPengabdian extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if(!$this->authact->logged_in())
			{
				redirect(base_url() . 'login/simpeg');
			}
			$this->load->model('Model_simpeg');
			$this->load->model('Model_pegawai');
		}
		function index(){
			$hasil['npp'] = $this->Model_simpeg->getAllNpp();
			// $hasil['npp'] = $this->db->query("SELECT npp,p.nama FROM `pegawai` p
			// 	INNER JOIN pegawai_biodata b on b.id_pegawai = p.id
			// 	INNER JOIN pegawai_golongan g on g.id_pegawai= p.id
			// 	INNER JOIN pegawai_pengabdian f on f.id_pegawai= p.id
			// 	INNER JOIN pegawai_jabatan_struktural s on s.id_pegawai= p.id")->result();
			$hasil['url'] = "RiwayatPengabdian/all";
			$this->load->view('simpeg/manage/content_profil',$hasil);

		}
		function all($id){
			$id = $this->Model_simpeg->getIdPegawai($id);
			$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->db->query("select *,p.id as p_id,(select nama from pegawai where npp=p.ketua) as nama_ketua from pegawai_pengabdian p where id_pegawai=" . $id)->result();
			$hasil['id_pegawai'] = $id;
			$hasil['pegawai'] = $this->Model_simpeg->getAllNpp();
			$hasil['mahasiswa'] = $this->Model_simpeg->getMahasiswa();
			$this->load->view('simpeg/pengabdian/index',$hasil);
		}
		function refresh(){
			$id = $this->input->get("id");
			$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->db->query("select *,p.id as p_id,(select nama from pegawai where npp=p.ketua) as nama_ketua from pegawai_pengabdian p where id_pegawai=" . $id)->result();
			$hasil['id_pegawai'] = $id;
			$hasil['pegawai'] = $this->Model_simpeg->getAllNpp();
			$hasil['mahasiswa'] = $this->Model_simpeg->getMahasiswa();
			$this->load->view('simpeg/pengabdian/tbl_riwayat',$hasil);
		}
		function edit_form(){
			$id = $this->input->post("id");
			$hasil['row'] = $this->db->query("select *,p.id as p_id,(select nama from pegawai where npp=p.ketua) as nama_ketua from pegawai_pengabdian p where p.id=" . $id)->row();
			$hasil['id_pegawai'] = $id;
			$hasil['pegawai'] = $this->Model_simpeg->getAllNpp();
			$hasil['mahasiswa'] = $this->Model_simpeg->getMahasiswa();
			$this->load->view('simpeg/pengabdian/form_edit',$hasil);
		}
		function insert(){
			$anggota = $this->input->post("anggota");
			$jenis = $this->input->post("jenis");

			$riwayat = array(
				"id_pegawai" => $this->input->post("id_pegawai"),
				"nama_kegiatan" => $this->input->post("nama_kegiatan"),
				"tahun" => $this->input->post("tahun"),
				"tempat" => $this->input->post("tempat"),
				"link_url" => $this->input->post("link_url"),
				"ketua" => $this->input->post("ketua"),
			);
			$hasil = $this->db->insert('pegawai_pengabdian', $riwayat);
			$id_penelitian = $this->db->insert_id();
			$where = array('id' => $id_penelitian);
			$config['upload_path'] = './assets/images/pengabdian/';
			$config['allowed_types'] = 'gif|jpg|png|pdf';
		    $config['max_size']  = '10240';
		    $config['overwrite'] = TRUE;
		    //$config['remove_space'] = TRUE;
			$config['file_name'] = 'bukti-'. date('YmdHis');
			$this->load->library('upload', $config); 
			
		    if(!empty($_FILES['bukti']['name'])){
		    	
		    	
			    //$nama_foto = "";
			    if($this->upload->do_upload('bukti')){
			    	$nama_foto = $this->upload->data("file_name"); 
			    	$riwayat = array(
						"bukti" => $nama_foto,
					);
					$r = $this->db->update('pegawai_pengabdian', $riwayat,$where);
			    }
		    }
			if(!empty($_FILES['proposal']['name'])){
		    	
		    	$config['file_name'] = 'proposal-'. date('YmdHis'); 
			    $this->upload->initialize($config); 
			    //$nama_foto = "";
			    if($this->upload->do_upload('proposal')){
			    	$nama_foto = $this->upload->data("file_name"); 
			    	$riwayat = array(
						"proposal" => $nama_foto,
					);
					$r = $this->db->update('pegawai_pengabdian', $riwayat,$where);
			    }
		    }
			foreach($anggota as $key=>$value){
				$array_anggota = array(
					'id_pengabdian' => $id_penelitian,
					'jenis_anggota' => $jenis[$key],
					'id_anggota' => $value,
				);
				$r = $this->db->insert('pegawai_anggota_pengabdian', $array_anggota);
			}
			if($hasil){
				echo 1;
			}else{
				echo 2;
			}
		}
		
		function update(){
			$anggota = $this->input->post("anggota");
			$jenis = $this->input->post("jenis");
			$id_detail = $this->input->post('id_detail');
			$id = $this->input->post("id");
			$riwayat = array(
				"nama_kegiatan" => $this->input->post("nama_kegiatan"),
				"tahun" => $this->input->post("tahun"),
				"tempat" => $this->input->post("tempat"),
				"link_url" => $this->input->post("link_url"),
				"ketua" => $this->input->post("ketua"),
			);

			$where_riwayat = array("id"=>$id);
			$r = $this->db->update('pegawai_pengabdian',$riwayat,$where_riwayat);
			$config['upload_path'] = './assets/images/pengabdian/';
			$config['allowed_types'] = 'gif|jpg|png|pdf';
		    $config['max_size']  = '10240';
		    $config['overwrite'] = TRUE;
		    //$config['remove_space'] = TRUE;
			$config['file_name'] = 'bukti-'. date('YmdHis');
			$this->load->library('upload', $config); 
		    if(!empty($_FILES['bukti']['name'])){
		    	
		    	
			    //$nama_foto = "";
			    if($this->upload->do_upload('bukti')){
			    	$nama_foto = $this->upload->data("file_name"); 
			    	$riwayat = array(
						"bukti" => $nama_foto,
					);
					$r = $this->db->update('pegawai_pengabdian', $riwayat,$where);
			    }
		    }
			
			if(!empty($_FILES['proposal']['name'])){
		    	
		    	$config['file_name'] = 'proposal-'. date('YmdHis'); 
			    $this->upload->initialize($config); 
			    //$nama_foto = "";
			    if($this->upload->do_upload('proposal')){
			    	$nama_foto = $this->upload->data("file_name"); 
			    	$riwayat = array(
						"proposal" => $nama_foto,
					);
					$r = $this->db->update('pegawai_pengabdian', $riwayat,$where);
			    }
		    }
			
			
			foreach($id_detail as $key=>$value){
				if($value == 0){
					$array_anggota = array(
						'id_pengabdian' => $id,
						'jenis_anggota' => $jenis[$key],
						'id_anggota' => $anggota[$key],
					);
					$r = $this->db->insert('pegawai_anggota_pengabdian', $array_anggota);
				}else{
					$array_anggota = array(
						'jenis_anggota' => $jenis[$key],
						'id_anggota' => $anggota[$key],
					);
					$where_detail = array("id"=>$value);
					$r = $this->db->update('pegawai_anggota_pengabdian',$array_anggota,$where_detail);
				}
			}
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function delete(){
			$id = array(
				"id"=>$this->input->post("id"),
			);
			$r = $this->db->delete("pegawai_pengabdian",array('id'=>$id));
			$r = $this->db->delete("pegawai_anggota_pengabdian",array('id_penelitian'=>$id));
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function delete_detail(){
			$id = $this->input->post("id");
			$r = $this->db->delete("pegawai_anggota_pengabdian",array('id'=>$id));
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}

		function getAnggota(){
			$jenis = $this->input->post("jenis");
			if($jenis == 1){
				$hasil = $this->Model_simpeg->getAllNpp();
				echo '<select name="anggota[]" class="jenis_anggota" style="width:100px !important">';
            foreach($hasil as $row){
            	echo "<option value='" . $row->id . "'>" . $row->npp . " - " . $row->nama . "</option>";
            }            
            echo '</select>';
			}else{
				$hasil = $this->Model_simpeg->getMahasiswa();
				echo '<select name="anggota[]" class="jenis_anggota form-control js-example-basic-single">';
	            foreach($hasil as $row){
	            	echo "<option value='" . $row->id . "'>" . $row->nim . " - " . $row->nama . "</option>";
	            }            
	            echo '</select>';
			}

			
		}
	}
?>