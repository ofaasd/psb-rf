<?php 
	class Hari_Model extends CI_Model
	{
		function v_hari(){
			$r = $this->db->get('master_hari');
			return $r->result();
		}
		function hapus_hari($kdhari){
			return $this->db->where('id',$kdhari)
							->delete('master_hari');
		}	
	}
?>