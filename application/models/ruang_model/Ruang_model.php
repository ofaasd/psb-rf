<?php 
	class Ruang_Model extends CI_Model
	{
		function v_ruang(){
			$r = $this->db->get('master_ruang');
			return $r->result();
		}
		function add(){
			$data = array(
							'nama_ruang' => $this->input->post('nama'),
							'kapasitas' => $this->input->post('kapasitas'),
							'luas' => $this->input->post('luas')
						 );
			$insert = $this->db->insert('master_ruang',$data);
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
							'nama_ruang' => $this->input->post('nama'),
							'kapasitas' => $this->input->post('kapasitas'),
							'luas' => $this->input->post('luas')
						 );
			$update = $this->db->update('master_ruang',$data,$where);
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
			$q = $this->db->get_where('master_ruang', $data);
			return $q->result();
		}
	}
?>