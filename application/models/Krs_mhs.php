<?php
class Krs_mhs extends CI_Model
{
	function history($nim,$id){
		return $this->db->query("SELECT master_krs.*, 
								 concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_dosen, 
								 master_jadwal.kode_mata_kuliah, 
								 master_tahun_ajaran.*, 
								 master_mata_kuliah.jumlah_sks 
								 FROM `master_krs` 
								 INNER JOIN pegawai_biodata ON master_krs.id_dosen = pegawai_biodata.id 
								 INNER JOIN master_jadwal ON master_krs.id_jadwal = master_jadwal.id 
								 INNER JOIN master_tahun_ajaran ON master_krs.id_tahun = master_tahun_ajaran.id 
								 INNER JOIN master_mata_kuliah ON master_jadwal.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah 
								 WHERE master_krs.nim = '$nim'
								 AND master_krs.id_tahun = $id")->result();
	}
	function khs_history($nim,$id){
		$r = $this->db->query("SELECT 
								master_nilai.*, 
								concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_dosen, master_jadwal.*,
								master_mata_kuliah.nama_mata_kuliah as mata_kuliah,
								detail_tagihan.status as keuangan, 
								master_mata_kuliah.jumlah_sks 
								FROM `master_nilai` 
								LEFT JOIN master_jadwal 
									ON master_jadwal.id_jadwal = master_nilai.id_jadwal 
								LEFT JOIN pegawai_biodata 
									ON pegawai_biodata.id = master_nilai.ndosen 
								LEFT JOIN master_mata_kuliah 
									ON master_mata_kuliah.kode_mata_kuliah = master_jadwal.kode_mata_kuliah 
								LEFT JOIN detail_tagihan
									ON master_nilai.nim = detail_tagihan.nim
								WHERE 
									master_nilai.nim = '".$nim."' AND detail_tagihan.id_ta = $id AND master_nilai.id_tahun = $id")->result();
		return $r;
	}
	function list_nilai($nim){
		return $this->db->query("SELECT 
									master_nilai.*, 
									master_jadwal.*, 
									master_mata_kuliah.nama_mata_kuliah as mata_kuliah, 
									master_mata_kuliah.jumlah_sks 
									FROM 
										`master_nilai` 
									LEFT JOIN master_jadwal ON master_jadwal.id_jadwal = master_nilai.id_jadwal 
									LEFT JOIN master_mata_kuliah ON master_mata_kuliah.kode_mata_kuliah = master_jadwal.kode_mata_kuliah 
									WHERE master_nilai.nim = '$nim' order by master_nilai.nhuruf DESC")
									->result();
	}
}
?>