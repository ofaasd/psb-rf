<?php

	use Zend\Crypt\Password\Bcrypt;

	class RiwayatOrganisasi extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if(!$this->authact->logged_in())
			{
				redirect(base_url() . 'login/simpeg');
			}
			$this->load->model('Model_front');
			$this->load->model('Model_simpeg');
			$this->load->model('Model_pegawai');
		}
		
		function ajax(){
			$id = $this->authact->get_user_id();
			$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->db->get_where("pegawai_organisasi",$where)->result();
			$hasil['id_pegawai'] = $id;
			//$hasil['jabatan_organisasi'] = array("Asisten Ahli","Lektor","Lektor kepala","Guru Besar");
			$this->load->view('simpeg/organisasi/index',$hasil);
		}
		function index(){
			$data['title'] = "Tambah Pegawai - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			
			$id = $this->authact->get_user_id();
			$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->db->query("select *,p.id as p_id,(select nama from pegawai where npp=p.ketua) as nama_ketua from pegawai_penelitian p inner join fakultas f on f.id = p.id_fakultas where id_pegawai=" . $id)->result();

			$hasil['fakultas'] = $this->db->query("select * from fakultas")->result();
			$hasil['id_pegawai'] = $id;
			$hasil['all_pegawai'] = $this->Model_simpeg->getAllNpp();
			//var_dump($hasil['pegawai']);
			$hasil['all_mahasiswa'] = $this->Model_simpeg->getMahasiswa();
			//$data['content'] = $this->load->view('simpeg/penelitian/index',$hasil,true);
			$data['content'] = "";
			$data['url'] = 'riwayatOrganisasi/index';
			$this->load->view('dosen/index3',$data);
		}
		
	}
?>