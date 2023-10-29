<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->authact->logged_in())
		{
			redirect('dashboard');
		}
	}

	public function index()
	{
			$data['title'] = "PPDB - PPATQ RADLATUL FALAH PATI";
			//$data['menu'] = $this->Model_simpeg->getMenu($this->authact->getSimpegRole());
			//$hasil['menu_tree'] = $hasil['menu_tree'] = $this->Model_menu_tree->get_all_p0();

			
			//$hasil['query'] = $this->Model_pegawai->get_all();
			$hasil['artikel1'] = $this->db->limit(4)->order_by("id","desc")->get_where("master_post",array("kategori"=>1))->result();
			$hasil['artikel2'] = $this->db->limit(4)->order_by("id","desc")->get_where("master_post",array("kategori"=>2))->result();
			$hasil['artikel3'] = $this->db->limit(4)->order_by("id","desc")->get_where("master_post",array("kategori"=>3))->result();
			$hasil['slide'] = $this->db->limit(5)->order_by("id","desc")->get("master_slide")->result();

			$data['content'] = $this->load->view('landing',$hasil,true);
			$this->load->view('index_login',$data);
	}
	public function landing()
	{
		$data['title'] = "Landing - STIFERA";
		//$data['menu'] = $this->Model_simpeg->getMenu($this->authact->getSimpegRole());
		//$hasil['menu_tree'] = $hasil['menu_tree'] = $this->Model_menu_tree->get_all_p0();

		
		$hasil['artikel1'] = $this->db->limit(4)->order_by("id","desc")->get_where("master_post",array("kategori"=>1))->result();
		$hasil['artikel2'] = $this->db->limit(4)->order_by("id","desc")->get_where("master_post",array("kategori"=>2))->result();
		$hasil['artikel3'] = $this->db->limit(4)->order_by("id","desc")->get_where("master_post",array("kategori"=>3))->result();
		$hasil['slide'] = $this->db->limit(5)->order_by("id","desc")->get("master_slide")->result();

		$data['content'] = $this->load->view('landing',$hasil,true);
		$this->load->view('index_login',$data);
	}
	public function register()
	{
		$data['title'] = "PPDB - PPATQ RADLATUL FALAH PATI";
			//$data['menu'] = $this->Model_simpeg->getMenu($this->authact->getSimpegRole());
			//$hasil['menu_tree'] = $hasil['menu_tree'] = $this->Model_menu_tree->get_all_p0();
			$hasil = '';
			$data['content'] = $this->load->view('form_register',$hasil,true);
			$this->load->view('index_login',$data);
	}

	function genpass($string)
	{
		echo $this->authact->generatepass($string);
	}
	function send() {
        $this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $email = $this->input->post('email');
        $nama = $this->input->post('nama');
        $tgl_lahir = $this->input->post('tgl_lahir');
		
		$subject = "Penerimaan Mahasiswa Baru STIFERA";
		$tanggal = date("Ymd",strtotime($tgl_lahir));
        $message = "Selamat kepada " . $nama . ". Anda sudah tergabung sebagai Calon Mahasiswa di Sekolah Tinggi Farmasi Nusaputera \n Berikut Username dan Password anda adalah : \n username : " . $email  . "\n Password : " . $tanggal . "\n\n Terimakasih, \n Admin PMB";

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }
	public function artikel($id){
		$data['title'] = "Detaiil Artikel - STIFERA";
		//$data['menu'] = $this->Model_simpeg->getMenu($this->authact->getSimpegRole());
		//$hasil['menu_tree'] = $hasil['menu_tree'] = $this->Model_menu_tree->get_all_p0();

		
		$hasil['artikel'] = $this->db->get_where("master_post",array("id"=>$id))->row();

		$data['content'] = $this->load->view('detail_artikel',$hasil,true);
		$this->load->view('index_login',$data);
	}
	public function artikel_all($kategori){
		$data['title'] = "Artikel All - STIFERA";
		//$data['menu'] = $this->Model_simpeg->getMenu($this->authact->getSimpegRole());
		//$hasil['menu_tree'] = $hasil['menu_tree'] = $this->Model_menu_tree->get_all_p0();
		$list_kategori = array(1=>"Pengumuman","Agenda","Berita");
		$hasil['kategori'] = $list_kategori[$kategori];
		$hasil['artikel'] = $this->db->get_where("master_post",array("kategori"=>$kategori))->result();

		$data['content'] = $this->load->view('artikel',$hasil,true);
		$this->load->view('index_login',$data);
	}
}
