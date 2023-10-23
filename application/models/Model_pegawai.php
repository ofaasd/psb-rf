<?php 
	class Model_pegawai extends CI_Model
	{
		public function get_all(){
			$r = $this->db->query("select p.*,b.*,j.nama as nama_jenis, f.jabatan_fungsional_sekarang, p.id as pid from pegawai p 
				inner join pegawai_biodata b on b.id_pegawai = p.id
				LEFT join pegawai_posisi ps on ps.kode = b.kd_posisi_pegawai
				LEFT join pegawai_jenis j on j.id = ps.id_jenis_pegawai		
				LEFT join pegawai_jabatan_fungsional f on f.id_pegawai = p.id
				where p.status = 1
				group by p.npp order by p.nama asc");
			return $r;
		}
		public function get_all_jk($jk){
			$r = $this->db->query("select p.*,b.*,j.nama as nama_jenis, f.jabatan_fungsional_sekarang, p.id as pid from pegawai p 
				inner join pegawai_biodata b on b.id_pegawai = p.id
				LEFT join pegawai_posisi ps on ps.kode = b.kd_posisi_pegawai
				LEFT join pegawai_jenis j on j.id = ps.id_jenis_pegawai		
				LEFT join pegawai_jabatan_fungsional f on f.id_pegawai = p.id
				where p.status = 1
				and b.jenis_kelamin = '" . $jk . "'
				group by p.npp order by p.nama asc");
			return $r;
		}
		public function get_status_jenis($id){
			$where = array('id_jenis_pegawai' => $id);
			$r = $this->db->get_where('pegawai_posisi', $where);
			return $r->result();
		}
	}
?>