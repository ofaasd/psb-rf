<?php 
	class Model_menu_tree extends CI_Model
	{
		public function get_all_p0(){
			$r = $this->db->query("select * from menu_tree where parent=0")->result();
			return $r;
		}
		public function get_all_user_p0(){
			$r = $this->db->query("select * from menu_tree_user where parent=0")->result();
			return $r;
		}
	}
?>