<?php

	use Zend\Crypt\Password\Bcrypt;

	class Profil extends CI_Controller
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
			$this->load->model('pmb_model/Model_pmb');
		}
		function index(){
			// $hasil['npp'] = $this->db->query("SELECT npp,p.nama FROM `pegawai` p
			// 	INNER JOIN pegawai_biodata b on b.id_pegawai = p.id
			// 	INNER JOIN pegawai_golongan g on g.id_pegawai= p.id
			// 	INNER JOIN pegawai_karya_ilmiah f on f.id_pegawai= p.id
			// 	INNER JOIN pegawai_jabatan_struktural s on s.id_pegawai= p.id")->result();
			$hasil['npp'] = $this->Model_simpeg->getAllNpp();
			$hasil['url'] = "Profil/all";
			$this->load->view('simpeg/manage/content_profil',$hasil);

		}
		function all($id){
			if(!empty($id)){
				$_SESSION['npp'] = $id;
			}
			$data['title'] = "Tambah Pegawai - Academic Portal";
			$data['menu'] = $this->Model_simpeg->getMenu($this->authact->getRole());

			$query['query'] = $this->Model_simpeg->getPegawai($id);
			//$id = $query['query']->pegawai_id;
			$id_pegawai = $query['query']->id_pegawai;

			$where_id_pegawai = array("id_pegawai"=>$id_pegawai);
			$query['pegawai_golongan'] = $this->db->order_by("id","desc")->limit(1)->get_where("pegawai_golongan",$where_id_pegawai)->row();
			$query['pegawai_jabatan_fungsional'] = $this->db->order_by("id","desc")->limit(1)->get_where("pegawai_jabatan_fungsional",$where_id_pegawai)->row();
			$query['pegawai_jabatan_struktural'] = $this->db->order_by("id","desc")->limit(1)->get_where("pegawai_jabatan_struktural",$where_id_pegawai)->row();
			
			$where = array("id" => $id_pegawai);
			$query['universitas'] = $this->db->get_where("pegawai_riwayat_pendidikan",$where);
			$query['jenis_pegawai'] = $this->Model_simpeg->getJenisPegawai();
			$query['progdi'] = $this->Model_simpeg->getProgdi();
			$query['fakultas'] = $this->Model_simpeg->getFakultas();
			$query['last_id'] = $this->Model_simpeg->getLastIdPegawai();
			$query['jenis_kelamin'] = array("L"=>"Laki-laki","P"=>"Perempuan");
			$query['golongan_darah'] = array("A","B","AB","O");
			$query['jabatan_fungsional'] = array("Asisten Ahli","Lektor","Lektor kepala","Guru Besar");
			$query['bagian'] = $this->Model_simpeg->getBagian();
			$query['status_kawin'] = array("Lajang","Kawin");
			$query['agama'] = array("Islam","Kristen","Katholik","Budha","Hindhu");
			$query['status'] = array('aktif','cuti','keluar','meninggal');
			$where_id_jabatan = array("id" => $query['pegawai_jabatan_struktural']->id_jabatan_struktural);
			$query['jabatan_struktural'] = $this->db->get_where("jabatan_struktural",$where_id_jabatan)->row();
			$where_bagian = array("bagian"=>$query['jabatan_struktural']->bagian);
			//echo $query['jabatan_struktural']->bagian;
			$where_kd_posisi = array("id_jenis_pegawai"=>$query['query']->id_jenis_pegawai);
			$query['posisi'] = $this->db->get_where("pegawai_posisi",$where_kd_posisi)->result();

			$query['jabatan_struktural_list'] = $this->db->get_where("jabatan_struktural",$where_bagian)->result();
			$query['s1'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S1");
			$query['s2'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S2");
			$query['s3'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S3");

			//$data['content'] = $this->load->view('pegawai/_form_edit',$query,true);
			$this->load->view('simpeg/manage/_form_edit',$query);
			//echo "berhasil";
			// if(!$this->input->is_ajax_request()){
			// 	// $this->load->view("pegawai/testing");
			// 	$this->load->view('index_simpeg',$data);
			// }
		}
		function insert(){
			$riwayat = array(
				"id_pegawai" => $this->input->post("id_pegawai"),
				"judul" => $this->input->post("judul"),
				"nama_majalah" => $this->input->post("nama_majalah"),
				"volume" => $this->input->post("volume"),
				"nomor" => $this->input->post("nomor"),
				"bulan" => $this->input->post("bulan"),
				"tahun" => $this->input->post("tahun"),
			);
			$r = $this->db->insert('pegawai_karya_ilmiah', $riwayat);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function refresh(){
			$id = $this->input->get("id");
			$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->db->get_where("pegawai_karya_ilmiah",$where)->result();
			$this->load->view('simpeg/karyailmiah/tbl_riwayat',$hasil);
		}
		function update(){
			$id = $this->input->post("id");
			$riwayat = array(
				"judul" => $this->input->post("judul"),
				"nama_majalah" => $this->input->post("nama_majalah"),
				"volume" => $this->input->post("volume"),
				"nomor" => $this->input->post("nomor"),
				"bulan" => $this->input->post("bulan"),
				"tahun" => $this->input->post("tahun"),
			);
			$where_riwayat = array("id"=>$id);
			$r = $this->db->update('pegawai_karya_ilmiah',$riwayat,$where_riwayat);
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
			$r = $this->db->delete("pegawai_karya_ilmiah",$id);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function cv($id){
			// $id = $this->input->post('id');
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
			$cv['pegawai'] = $this->db->get_where('pegawai',array('id'=>$id))->row();
			$cv['biodata'] = $this->db->get_where('pegawai_biodata',array('id_pegawai'=>$id))->row();
			$cv['pendidikan'] = $this->db->get_where('pegawai_riwayat_pendidikan',array('id_pegawai'=>$id))->result();
			$cv['karya_ilmiah'] = $this->db->get_where('pegawai_karya_ilmiah',array('id_pegawai'=>$id))->result();
			$cv['pekerjaan'] = $this->db->get_where('pegawai_pekerjaan',array('id_pegawai'=>$id))->result();
			$cv['golongan'] = $this->db->get_where('pegawai_golongan', array('id_pegawai'=>$id))->row();
			$cv['fungsional'] = $this->db->get_where('pegawai_jabatan_fungsional', array('id_pegawai'=>$id))->row();
			
			$cv['homebase'] = $this->db->get_where('program_studi', array('id'=>$cv['biodata']->homebase))->row();
			$cv['provinsi'] = $this->db->get_where('wilayah', array('id_wil' => $cv['biodata']->provinsi))->row();
			$cv['kotakab'] = $this->db->get_where('wilayah', array('id_wil' => $cv['biodata']->kotakab))->row();
			$cv['kecamatan'] = $this->db->get_where('wilayah', array('id_wil' => $cv['biodata']->kecamatan))->row();
			 $this->load->view('simpeg/manage/cv', $cv);
			// $data = $this->load->view('simpeg/manage/cv', $cv, true);
			// $stylesheet = file_get_contents(base_url() . 'assets/css/cv.css');
			// $pdfFilePath ="CV - ".$cv['pegawai']->npp.".pdf"; 
			// $mpdf->WriteHTML($stylesheet,1);
			// $mpdf->WriteHTML($data,2);
			// $mpdf->Output($pdfFilePath, "D");
			// exit;
		}
	}
?>