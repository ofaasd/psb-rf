<?php

	use Zend\Crypt\Password\Bcrypt;

	class RiwayatMengajar extends CI_Controller
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
			// $hasil['npp'] = $this->db->query("SELECT npp,p.nama FROM `pegawai` p
			// 	INNER JOIN pegawai_biodata b on b.id_pegawai = p.id
			// 	INNER JOIN pegawai_golongan g on g.id_pegawai= p.id
			// 	INNER JOIN pegawai_mengajar f on f.id_pegawai= p.id
			// 	INNER JOIN pegawai_jabatan_struktural s on s.id_pegawai= p.id")->result();
			$hasil['npp'] = $this->Model_simpeg->getAllNpp();
			//$hasil['riwayat_tree'] = $this->load->view('simpeg/manage/riwayat_tree',NULL,true);
			$hasil['url'] = "RiwayatMengajar/all";
			$this->load->view('simpeg/manage/content_profil',$hasil);

			//$this->load->view('index_simpeg',$data);
		}
		function all($id){
			$id = $this->Model_simpeg->getIdPegawai($id);
			$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->db
								->select("pegawai_mengajar.*,master_tahun_ajaran.awal,master_tahun_ajaran.akhir,master_tahun_ajaran.jenis")
								->join("master_tahun_ajaran",'master_tahun_ajaran.id=pegawai_mengajar.tahun')
								->where($where)->get("pegawai_mengajar")->result();
			$hasil['id_pegawai'] = $id;
			$hasil['riwayat_jadwal'] = $this->db->select("master_jadwal.*,program_studi.nama_jurusan,master_mata_kuliah.nama_mata_kuliah,master_tahun_ajaran.awal,master_tahun_ajaran.akhir,master_tahun_ajaran.jenis,master_mata_kuliah.jumlah_sks as sks")
			->join("master_mata_kuliah",'master_mata_kuliah.kode_mata_kuliah=master_jadwal.kode_mata_kuliah')
			->join("program_studi",'program_studi.id=master_mata_kuliah.id_program_studi')
			->join("master_tahun_ajaran",'master_tahun_ajaran.id=master_jadwal.id_tahun')
			->where("id_dosen",$id)->get("master_jadwal")->result();
			
			$hasil['rombel'] = array("Rombel A","Rombel B","Rombel C");
			$hasil['kelas'] = array("1"=>"Reguler","Karyawan");
			$hasil['tahun_ajaran'] = $this->db->get("master_tahun_ajaran")->result();
			//$hasil['jabatan_mengajar'] = array("Asisten Ahli","Lektor","Lektor kepala","Guru Besar");
			$this->load->view('simpeg/mengajar/index',$hasil);
		}
		function insert(){
			$riwayat = array(
				"id_pegawai" => $this->input->post("id_pegawai"),
				"institusi" => $this->input->post("institusi"),
				"prodi" => $this->input->post("prodi"),
				"mata_kuliah" => $this->input->post("mata_kuliah"),
				"tahun" => $this->input->post("tahun"),
				"rombel" => $this->input->post("rombel"),
				"kelas" => $this->input->post("kelas"),
				"sks" => $this->input->post("sks"),
			);
			$r = $this->db->insert('pegawai_mengajar', $riwayat);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function refresh(){
			$id = $this->input->get("id");
			$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->db
								->select("pegawai_mengajar.*,master_tahun_ajaran.awal,master_tahun_ajaran.akhir,master_tahun_ajaran.jenis")
								->join("master_tahun_ajaran",'master_tahun_ajaran.id=pegawai_mengajar.tahun')
								->where($where)->get("pegawai_mengajar")->result();
			$hasil['id_pegawai'] = $id;
			$hasil['riwayat_jadwal'] = $this->db->select("master_jadwal.*,program_studi.nama_jurusan,master_mata_kuliah.nama_mata_kuliah,master_tahun_ajaran.awal,master_tahun_ajaran.akhir,master_tahun_ajaran.jenis,master_mata_kuliah.jumlah_sks as sks")
			->join("master_mata_kuliah",'master_mata_kuliah.kode_mata_kuliah=master_jadwal.kode_mata_kuliah')
			->join("program_studi",'program_studi.id=master_mata_kuliah.id_program_studi')
			->join("master_tahun_ajaran",'master_tahun_ajaran.id=master_jadwal.id_tahun')
			->where("id_dosen",$id)->get("master_jadwal")->result();
			
			$hasil['rombel'] = array("Rombel A","Rombel B","Rombel C");
			$hasil['kelas'] = array("1"=>"Reguler","Karyawan");
			$hasil['tahun_ajaran'] = $this->db->get("master_tahun_ajaran")->result();
			$this->load->view('simpeg/mengajar/tbl_riwayat',$hasil);
		}
		function update(){
			$id = $this->input->post("id");
			$riwayat = array(
				"institusi" => $this->input->post("institusi"),
				"prodi" => $this->input->post("prodi"),
				"mata_kuliah" => $this->input->post("mata_kuliah"),
				"tahun" => $this->input->post("tahun"),
				"rombel" => $this->input->post("rombel"),
				"kelas" => $this->input->post("kelas"),
				"sks" => $this->input->post("sks"),
			);
			$where_riwayat = array("id"=>$id);
			$r = $this->db->update('pegawai_mengajar',$riwayat,$where_riwayat);
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
			$r = $this->db->delete("pegawai_mengajar",$id);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function updatedokumen(){
			$id = $this->input->post("id");
			$config['upload_path'] = './assets/images/mengajar/';
		    $config['allowed_types'] = 'gif|jpg|png|pdf';
		    $config['max_size']  = '10480';
		    $config['overwrite'] = TRUE;
		    $config['file_name'] = 'dokumen-'. date('YmdHis');
		    //$config['remove_space'] = TRUE;
		    $this->load->library('upload', $config); 
		    //$nama_foto = "";
		    if($this->upload->do_upload('dokumen')){
		    	$nama_foto = $this->upload->data("file_name"); 
		    	$riwayat = array(
					"dokumen" => $nama_foto,
				);
				$where_biodata = array("id"=>$id);
				$r = $this->db->update('pegawai_mengajar', $riwayat,$where_biodata);
				if($r){
					echo 1;
				}else{
					echo 2;
				}
		    }else{
				echo "gagal upload";
			}
		}
		function updatesk(){
			$id = $this->input->post("id");
			$config['upload_path'] = './assets/images/sk_mengajar/';
		    $config['allowed_types'] = 'gif|jpg|png|pdf';
		    $config['max_size']  = '10480';
		    $config['overwrite'] = TRUE;
		    $config['file_name'] = 'dokumen-'. date('YmdHis');
		    //$config['remove_space'] = TRUE;
		    $this->load->library('upload', $config); 
		    //$nama_foto = "";
		    if($this->upload->do_upload('dokumen')){
		    	$nama_foto = $this->upload->data("file_name"); 
		    	$riwayat = array(
					"sk_mengajar" => $nama_foto,
				);
				$where_biodata = array("id"=>$id);
				$r = $this->db->update('pegawai_mengajar', $riwayat,$where_biodata);
				if($r){
					echo 1;
				}else{
					echo 2;
				}
		    }else{
				echo "gagal upload";
			}
		}
	}
?>