<?php 
	class Model_user extends CI_Model
	{
		function getWhereRow($col,$tb,$where){
			return $data = $this->db->select($col)
                  ->get_where($tb, $where)
                  ->row();
		}
	}
?>