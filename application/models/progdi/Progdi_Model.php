<?php
/**
* 
*/
class Progdi_Model extends CI_Model
{
	function v_progdi(){
		$r = $this->db->query("select program_studi.*, fakultas.nama_fakultas as fak from program_studi inner join fakultas on program_studi.fakultas = fakultas.id");
		return $r->result();
	}
	function v_progdis($id){
		$r = $this->db->query("select program_studi.*, fakultas.nama_fakultas as fak from program_studi inner join fakultas on program_studi.fakultas = fakultas.id where program_studi.id=$id");
		return $r->result();
	}
	function list_fakultas(){
		$r = $this->db->get_where('fakultas',array('is_aktif' => 1));
		return $r->result();
	}
	function add_data(){
		$data = array(
						'kode' => $this->input->post('kode'),
						'jenjang' => $this->input->post('jenjang'),
						'nama_jurusan' => $this->input->post('nama'),
						'fakultas' => $this->input->post('fakultas'),
						'off' => $this->input->post('status')
					 );
		$r = $this->db->insert('program_studi', $data);
		return $r;
	}
	function update_data(){
		$where = array('id'=>$this->input->post('id'));
		$data = array(
						'kode' => $this->input->post('kode'),
						'jenjang' => $this->input->post('jenjang'),
						'nama_jurusan' => $this->input->post('nama'),
						'fakultas' => $this->input->post('fakultas'),
						'off' => $this->input->post('status')
					 );
		$r = $this->db->update('program_studi', $data,$where);
		return $r;
	}
}
?>