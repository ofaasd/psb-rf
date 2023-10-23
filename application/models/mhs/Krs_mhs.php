<?php
class Krs_mhs extends CI_Model
{
	function history($nim, $id){
		$this->db->query("SELECT master_krs_temp.*, 
								 concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_dosen, 
								 master_jadwal.kode_mata_kuliah, 
								 master_tahun_ajaran.* 
								 FROM `master_krs_temp` 
								 INNER JOIN pegawai_biodata ON master_krs_temp.id_dosen = pegawai_biodata.id 
								 INNER JOIN master_jadwal ON master_krs_temp.id_jadwal = master_jadwal.id 
								 INNER JOIN master_tahun_ajaran ON master_krs_temp.id_tahun = master_tahun_ajaran.id
								 WHERE master_krs_temp.nim = $nim
								 AND master_krs_temp.is_publish = 1 
								 AND master_krs_temp.id_tahun = $id");
	}
}
?>