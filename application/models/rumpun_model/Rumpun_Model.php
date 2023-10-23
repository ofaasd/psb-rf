<?php
	/**
	* 
	*/
	class Rumpun_Model extends CI_Model
	{
		function daftar_rumpun(){
			$r = $this->db->get('master_rumpun');
			return $r->result();
		}
		function tambah_rumpun(){
			$data = array(
							'nama_rumpun' => $this->input->post('nama'),
							'status' => $this->input->post('status')
						 );
			$r = $this->db->insert('master_rumpun', $data);

			return $r;
		}
		function update_rumpun($id){
			$r = $this->db->get_where('master_rumpun', array('id' => $id));
			return $r->result();
		}
		function update_act_model(){
			$where = array('id' => $this->input->post('id'));
			$data = array('nama_rumpun' => $this->input->post('nama_rumpun'),
						  'status' => $this->input->post('status') 
						  );
			$r = $this->db->update('master_rumpun',$data,$where);
			return $r;
		}
	}
?>