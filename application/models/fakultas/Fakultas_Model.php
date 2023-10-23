<?php

/**
* 
*/
class Fakultas_Model extends CI_Model
{
	function v_fakultas(){
		$r = $this->db->get('fakultas');
		return $r->result();
	}
	function add_data(){
		$data = array(
						'kode' => $this->input->post('kode'),
						'nama_fakultas' => $this->input->post('nama'),
						'tgl_berdiri' => $this->input->post('tgl_berdiri'),
						'is_aktif' => $this->input->post('status')
					 );
		$r = $this->db->insert('fakultas', $data);
		return $r;
	}
	function v_detail($id){
		$where = array('id' => $id);
		$r = $this->db->get_where('fakultas', $where);
		return $r->result();
	}
	function update_data(){
		$where = array('id' => $this->input->post('id'));
		$data = array(
						'kode' => $this->input->post('kode'),
						'nama_fakultas' => $this->input->post('nama'),
						'tgl_berdiri' => $this->input->post('tgl_berdiri'),
						'is_aktif' => $this->input->post('status')
					 );
		$r = $this->db->update('fakultas', $data, $where);
		return $r;
	}
}
?>