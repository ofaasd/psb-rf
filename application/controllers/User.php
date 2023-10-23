<?php
	class User extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if(!$this->authact->logged_in())
			{
				redirect(base_url());
			}
			$this->load->model('Model_front');
			$this->load->model('Model_user');
		}

		function index()
		{
			$data['title'] = "Setting - User";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			
			$user['biodata'] = $this->Model_user->getWhereRow('*','pegawai_biodata',array('id'=>$this->authact->get_user_id()));
			$user['posisi'] = $this->Model_user->getWhereRow('nama','pegawai_posisi',array('kode'=>$user['biodata']->kd_posisi_pegawai));
			$user['prodi'] = $this->Model_user->getWhereRow('*','program_studi',array('id'=>$user['biodata']->id_progdi));
			
			$data['content'] = $this->load->view('user/setting',$user,true);
			$this->load->view('index',$data);
		}
		
	}
?>