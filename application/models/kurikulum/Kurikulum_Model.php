<?php 
	class Kurikulum_Model extends CI_Model
	{
		function v_kurikulum(){
			$q = $this->db->select('master_kurikulum.*,program_studi.nama_jurusan,master_tahun_ajaran.awal,master_tahun_ajaran.akhir')
						  ->from('master_kurikulum')
						  ->join('program_studi', 'master_kurikulum.progdi = program_studi.kode', 'left')
						  ->join('master_tahun_ajaran', 'master_kurikulum.thn_ajar = master_tahun_ajaran.id', 'left')
						  ->get();
			// query("SELECT master_kurikulum.*,program_studi.nama_jurusan,master_tahun_ajaran.* FROM master_kurikulum LEFT JOIN program_studi on master_kurikulum.progdi = program_studi.kode LEFT JOIN master_tahun_ajaran on master_kurikulum.thn_ajar = master_tahun_ajaran.id");
			// $r = $this->db->get('master_kurikulum');
			return $q->result();
		}
		function v_progdi(){
			$where = array('off' => '0');
			$r = $this->db->get_where('program_studi', $where);
			return $r->result();
		}
		

		function simpan_data($tabel,$data){
			return $this->db->insert($tabel,$data);
		}

		function getKurikulumItem($id){
			$query = $this->db->select('id_mata_kuliah');
			$query = $this->db->from('kurikulum_item');
			$query = $this->db->where('id_kurikulum',$id);
			$query = $this->db->get()->result_array();
			return $query;
		}

		function getDaftarMatkul($idkur){
				$query = $this->db->select('id_mata_kuliah');
				$query = $this->db->from('kurikulum_item');
				$query = $this->db->where('id_kurikulum',$idkur);
				$query = $this->db->get()->result_array();
		
				$arr=array();
				foreach ($query as $data){
					array_push($arr,$data['id_mata_kuliah']);
				}
				if(!empty($arr)){
				$getmatkul = $this->db->select('*');
				$getmatkul = $this->db->from('master_mata_kuliah');
				$getmatkul = $this->db->where_in('id',$arr);
				$getmatkul = $this->db->get()->result_array();
				}else{
				$getmatkul='';
				}
				return $getmatkul;
		}

		function getWhere($select,$tb,$where){
			return $this->db->select($select)
				->from($tb)
				->where($where)
				->get()
				->result_array();
		}

		function getStatMatkul($idkur,$idmatkul){
			return $this->db->select('*')
				->from('kurikulum_item')
				->where('id_kurikulum',$idkur)
				->where('id_mata_kuliah',$idmatkul)
				->get()->row();
		}

		function hapus_data($tb,$where){
			return $this->db->where($where)
							->delete($tb);
		}

		function update_data($tb,$where,$data){
			return $this->db->where($where)
							->update($tb, $data);
		}

		function add(){
			$data = array(
							'kode_kurikulum' => $this->input->post('kode_kurikulum'),
							'progdi' => $this->input->post('progdi'),
							'thn_ajar' => $this->input->post('tahun_ajar'),
							'angkatan' => $this->input->post('angkatan1').'-'.$this->input->post('angkatan2'),
							'status' => $this->input->post('status')
						 );
			$insert = $this->db->insert('master_kurikulum',$data);
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
							'kode_kurikulum' => $this->input->post('kode_kurikulum'),
							'progdi' => $this->input->post('progdi'),
							'thn_ajar' => $this->input->post('tahun_ajar'),
							'angkatan' => $this->input->post('angkatan1').'-'.$this->input->post('angkatan2'),
							'status' => $this->input->post('status')
						 );
			$update = $this->db->update('master_kurikulum',$data,$where);
				if ($update) {
					# code...
					$r = 1;
				}else{
					$r = 0;
				}
			return $r;
		}
		function v_detail($id){
			// $data = array('id' => $id);
			$q = $this->db->query("SELECT  master_kurikulum.id as kur_id,master_kurikulum.*,program_studi.nama_jurusan,master_tahun_ajaran.* FROM master_kurikulum LEFT JOIN program_studi on master_kurikulum.progdi = program_studi.kode LEFT JOIN master_tahun_ajaran on master_kurikulum.thn_ajar = master_tahun_ajaran.id where master_kurikulum.id = '$id'");
			return $q->result();
		}
	}
?>