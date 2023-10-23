<?php
	use Zend\Crypt\Password\Bcrypt;

	class Authact
	{
		function __construct()
		{
			$this->ci =& get_instance();
			//load libraries
			$this->ci->load->library('session');
			$this->ci->load->database();
			spl_autoload_register( array( $this, 'autoload') );
		}

		function autoload($className)
		{
			$className = ltrim($className, '\\');
			$fileName  = '';
			$namespace = '';
			if ($lastNsPos = strrpos($className, '\\')) {
				$namespace = substr($className, 0, $lastNsPos);
				$className = substr($className, $lastNsPos + 1);
				$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
			}
			$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
		
			require $fileName;
		}

		function logged_in()
		{
			$CI =& get_instance();
			return ($CI->session->userdata('user_id')) ? true : false;
		}

		function get_user_id()
		{
			return $this->ci->session->userdata('user_id');
		}
		
		function get_nama()
		{
			return $this->ci->session->userdata('nama');
		}

		function getRole()
		{
			return $this->ci->session->userdata('role');
		}
		function getSimpegRole()
		{
			return $this->ci->session->userdata('simpeg_role');
		}

	 	function get_user_name()
	 	{
			 return $this->ci->session->userdata('username');
	 	}

		function login($username,$password)
		{
			 $CI =& get_instance();
			// $CI->db->select("*")->from("user")->where("username",$username);
			 $q = "SELECT * FROM pegawai WHERE usrnm=?";
			$rs = $CI->db->query($q,array($username));
			if($rs->num_rows()!==1)
			{
				return false;
			}
			else
			{

				$rss = $rs->row();
				$CI->db->select("*");
				$CI->db->where("userid",$rss->id);
				$user = $CI->db->get("users");
				$rsUser = $user->row();
				$bcrypt = new Bcrypt();
				if($bcrypt->verify($password,$rss->paswd))
				{
					$CI->session->set_userdata("user_id", $rss->id);
					$CI->session->set_userdata("npp", $rss->npp);
     				$CI->session->set_userdata("role", $rsUser->role);
     				$CI->session->set_userdata("simpeg_role", $rsUser->simpeg_role);
     				$CI->session->set_userdata("username", $rss->usrnm);
     				$CI->session->set_userdata("nama", $rss->nama);
     				$datalog1 = array(
     					'last_login_ip'=>$rsUser->login_log_ip,
     					'last_login_date'=>$rsUser->login_log_date
     				);
     				$CI->db->where('userid',$rss->id);
     				$CI->db->update('users',$datalog1);
     				$datalog2 = array(
     					'login_log_ip'=>$CI->input->ip_address(),
     					'login_log_date' =>date("Y-m-d H:i:s")
     				);
     				$CI->db->where('userid',$rss->id);
     				$CI->db->update('users',$datalog2);
					return true;
				}
				else
				{
					return false;
				}
			}
		}

		function logout()
		{
			 $this->ci->session->sess_destroy();
		}

		function generateref($string)
		{
			$bcrypt = new Bcrypt();
			return $bcrypt->create('mis'.$string);
		}

		function generatepass($string)
		{
			$bcrypt = new Bcrypt();
			return $bcrypt->create($string);
		}
	}
?>