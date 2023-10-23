<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->authact->logged_in())
		{
			redirect('dashboard');
		}
	}

	public function simpeg()
	{
		$data['title'] = "ACADEMIC PORTAL";
		$this->load->view('login_simpeg',$data);
	}

	function genpass($string)
	{
		echo $this->authact->generatepass($string);
	}

}
