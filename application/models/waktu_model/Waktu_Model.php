<?php 
	class Waktu_Model extends CI_Model
	{
		function v_waktu(){
			// $q = $this->db->query("SELECT master_kurikulum.*,program_studi.nama_jurusan FROM master_kurikulum LEFT JOIN program_studi on master_kurikulum.progdi = program_studi.kode");
			$r = $this->db->get('master_jam');
			return $r->result();
		}
		function add(){
			$data = array(
							'nama_sesi' => $this->input->post('nama'),
							'mulai' => $this->input->post('mulai'),
							'selesai' => $this->input->post('selesai'),
							'sks' => $this->input->post('sks'),
							'status' => $this->input->post('status')
						 );
			$insert = $this->db->insert('master_jam',$data);
				if ($insert) {
					# code...
					$r = 1;
				}else{
					$r = 0;
				}
			return $r;
		}

		function update(){
			$where = array('id' => $this->input->post('id'));
			$data = array(
							'nama_sesi' => $this->input->post('nama'),
							'mulai' => $this->input->post('mulai'),
							'selesai' => $this->input->post('selesai'),
							'sks' => $this->input->post('sks'),
							'status' => $this->input->post('status')
						 );
			$update = $this->db->update('master_jam',$data,$where);
				if ($update) {
					# code...
					$r = 1;
				}else{
					$r = 0;
				}
			return $r;
		}
		function v_detail($id){
			$data = array('id' => $id);
			// $q = $this->db->query("SELECT master_kurikulum.*,program_studi.nama_jurusan FROM master_kurikulum LEFT JOIN program_studi on master_kurikulum.progdi = program_studi.kode where master_kurikulum.id = '$id'");
			$q = $this->db->get_where('master_jam',$data);
			return $q->result();
		}
	}
?>