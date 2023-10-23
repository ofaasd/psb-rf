<?php
	class Jabatan extends CI_Controller
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
			$this->load->model('simpeg/Model_menu_tree');
		}

		function index()
		{
			$data['title'] = "Dashboard - SIMPEG";
			$data['menu'] = $this->Model_simpeg->getMenu($this->authact->getRole());
			//$hasil['menu_tree'] = $this->Model_menu_tree->get_all_p0();

			
			$hasil['query'] = $this->Model_pegawai->get_all();
			$hasil['jabatan'] = $this->Model_simpeg->getListJabatan();
			$hasil['unit_kerja'] = $this->Model_simpeg->getUnitKerja();

			$data['content'] = $this->load->view('simpeg/jabatan/index',$hasil,true);
			$this->load->view('index_simpeg',$data);
		}
		
		function getBagian(){
			$id = $this->input->post("id");
			$hasil = $this->Model_simpeg->getBagianStruktural($id);
			echo '<select name="bagian" id="field_bagian" class="form-control">';
			foreach($hasil as $row){
						echo '<option value="'. $row->id .'">' . $row->nama_bagian . '</option> ';   	
						
			}
			echo '</select>';
		}
		function getJenis(){
			$id = $this->input->post("id");
			$hasil = $this->Model_simpeg->getJenisJabatan($id);
			echo '<select name="jenis_jabatan" id="field_jenis" class="form-control">';
			foreach($hasil as $row){
						echo '<option value="'. $row->id .'">' . $row->nama_jenis . '</option> ';   	
						
			}
			echo '</select>';
		}
		function insert(){
			$riwayat = array(
				"id_bagian" => $this->input->post("bagian"),
				"id_jenis_jabatan" => $this->input->post("jenis_jabatan"),
				"nama_jabatan" => $this->input->post("nama_jabatan"),
			);
			$r = $this->db->insert('pegawai_jabatan', $riwayat);
			if($r){
				echo 1;
			}else{
				echo 0;
			}
			
			
		}
		function refresh(){
			$hasil['query'] = $this->Model_pegawai->get_all();
			$hasil['jabatan'] = $this->Model_simpeg->getListJabatan();
			$hasil['unit_kerja'] = $this->Model_simpeg->getUnitKerja();

			$this->load->view('simpeg/jabatan/tbl_jabatan',$hasil);
		}
		function edit(){

		}
		function update(){

		}
		function delete(){

		}
	}
?>