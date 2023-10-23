<?php 
	class Matakuliah_Model extends CI_Model
	{
		function v_matakuliah(){
			// $where = array('is_aktif' => '1');
			// $r = $this->db->get_where('master_mata_kuliah', $where);
			$r = $this->db->query("SELECT master_mata_kuliah.*, master_rumpun.nama_rumpun as rumpun from master_mata_kuliah inner join master_rumpun on master_mata_kuliah.rumpun_mata_kuliah = master_rumpun.id order by master_mata_kuliah.semester ASC");
			return $r->result();
		}
		function v_matakuliah_jadwal(){
			// $where = array('is_aktif' => '1');
			// $r = $this->db->get_where('master_mata_kuliah', $where);
			$r = $this->db->query("SELECT master_mata_kuliah.*, master_rumpun.nama_rumpun as rumpun from master_mata_kuliah inner join master_rumpun on master_mata_kuliah.rumpun_mata_kuliah = master_rumpun.id where master_mata_kuliah.is_aktif = 1 order by master_mata_kuliah.semester ASC");
			return $r->result();
		}
		function tambah_matakuliah(){
			$data = array(
							'kode_mata_kuliah' => $this->input->post('kode_mata_kuliah'),
							'nama_mata_kuliah' => $this->input->post('nama_mata_kuliah'),
							'nama_mata_kuliah_eng' => $this->input->post('nama_mata_kuliah_eng'),
							'jumlah_sks' => $this->input->post('sks'),
							'semester' => $this->input->post('smt'),
							'tp' => $this->input->post('tp'),
							'kelompok_mata_kuliah' => $this->input->post('kel_mata_kuliah'),
							'rumpun_mata_kuliah' => $this->input->post('rumpun_mata_kuliah'),
							'is_aktif' => $this->input->post('status')
						 );
			$r = $this->db->insert('master_mata_kuliah',$data);
			return $r;
		}
		function update_matakuliah($id){
			$r = $this->db->query("select master_mata_kuliah.*, master_rumpun.nama_rumpun as rumpun from master_mata_kuliah inner join master_rumpun on master_mata_kuliah.rumpun_mata_kuliah = master_rumpun.id where master_mata_kuliah.id = $id");
			return $r->result();
		}
		function update_act(){
			$where = array('id' => $this->input->post('id'));
			$data = array(
							'kode_mata_kuliah' => $this->input->post('kode_mata_kuliah'),
							'nama_mata_kuliah' => $this->input->post('nama_mata_kuliah'),
							'nama_mata_kuliah_eng' => $this->input->post('nama_mata_kuliah_eng'),
							'jumlah_sks' => $this->input->post('sks'),
							'semester' => $this->input->post('smt'),
							'tp' => $this->input->post('tp'),
							'kelompok_mata_kuliah' => $this->input->post('kel_mata_kuliah'),
							'rumpun_mata_kuliah' => $this->input->post('rumpun_mata_kuliah'),
							'is_aktif' => $this->input->post('status')
						 );
			$r = $this->db->update('master_mata_kuliah',$data, $where);
			return $r;
		}
	}
?>