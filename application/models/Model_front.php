<?php 
	class Model_front extends CI_Model
	{
		function getMenu($lev=null)
		{
			// $rs = $this->db->select("*")->from("menu")->where(array("aktif"=>1,"parent"=>0))->order_by("urut asc");
			$rs = $this->db->query("SELECT a.* FROM menu a JOIN menu_level b ON (a.id=b.menu_id) WHERE aktif=1 AND parent=0 AND level_id=$lev ORDER BY urut ASC");
			return $rs;
		}

		function getSubMenu($id,$lev=null)
		{
			// $rs = $this->db->select("*")->from("menu")->where("aktif",1)->where("parent",$id);
			$rs = $this->db->query("SELECT a.* FROM menu a JOIN menu_level b ON (a.id=b.menu_id) WHERE aktif=1 AND parent=$id AND level_id=$lev ORDER BY urut ASC");
			return $rs;
		}

		function getRole($id)
		{
			$rs = $this->db->get_where('users',array('userid'=>$id,'active'=>1));
			return $rs;
		}
		// ==
		// function getMenu()
		// {
		// 	// $rs = $this->db->select("*")->from("menu")->where(array("aktif"=>1,"parent"=>0))->order_by("urut asc");
		// 	$rs = $this->db->query("SELECT a.* FROM menu a JOIN menu_level b ON (a.id=b.menu_id) WHERE aktif=1 AND parent=0 AND level_id=1 ORDER BY urut ASC");
		// 	return $rs;
		// }

		// function getSubMenu($id)
		// {
		// 	// $rs = $this->db->select("*")->from("menu")->where("aktif",1)->where("parent",$id);
		// 	$rs = $this->db->query("SELECT a.* FROM menu a JOIN menu_level b ON (a.id=b.menu_id) WHERE aktif=1 AND parent=$id AND level_id=1 ORDER BY urut ASC");
		// 	return $rs;
		// }

		// function getRole()
		// {
		// 	$rs = $this->db->get_where('users',array('userid'=>1,'active'=>1));
		// 	return $rs;
		// }
	}
?>