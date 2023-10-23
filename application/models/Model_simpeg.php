<?php 
	class Model_simpeg extends CI_Model
	{
		function getMenu($lev=null)
		{
			// $rs = $this->db->select("*")->from("menu")->where(array("aktif"=>1,"parent"=>0))->order_by("urut asc");
			$query = "SELECT a.* FROM menu_simpeg a JOIN menu_level_simpeg b ON (a.id=b.menu_id) WHERE aktif=1 AND parent=0 AND level_id=" . $lev . " ORDER BY urut ASC";
			$result = $this->db->query($query);
			return $result;
		}

		function getSubMenu($id,$lev=null)
		{
			// $rs = $this->db->select("*")->from("menu")->where("aktif",1)->where("parent",$id);
			$query = $this->db->query("SELECT a.* FROM menu_simpeg a JOIN menu_level_simpeg b ON (a.id=b.menu_id) WHERE aktif=1 AND parent=$id AND level_id=$lev ORDER BY urut ASC");
			return $query;
		}
		function getAllNpp(){
			$query = $this->db->query("SELECT p.id,p.npp,p.nama FROM `pegawai` p
				INNER JOIN pegawai_biodata b on b.id_pegawai = p.id
				INNER JOIN pegawai_golongan g on g.id_pegawai= p.id
				INNER JOIN pegawai_jabatan_fungsional f on f.id_pegawai= p.id
				INNER JOIN pegawai_jabatan_struktural s on s.id_pegawai= p.id group by p.id")->result();
			return $query;
		}
		function getPegawai($npp){
			$query = $this->db->query("SELECT *,p.id as pegawai_id,b.id as id_biodata, p.nama as nama_pegawai FROM `pegawai` p
				LEFT JOIN pegawai_biodata b on b.id_pegawai = p.id
				LEFT JOIN pegawai_posisi s on s.kode = b.kd_posisi_pegawai
				where p.npp = '".$npp."'")->row();
			return $query;
		}
		function getIdPegawai($id){
			$query = $this->db->query("select id from pegawai where npp='" . $id ."'")->row()->id;
			return $query;
		}

		function getRole($id)
		{
			$query = $this->db->get_where('users',array('userid'=>$id,'active'=>1));
			return $query;
		}
		function getJenisPegawai(){
			$query = $this->db->query("select * from pegawai_jenis")->result();
			return $query;
		}
		function getProgdi(){
			$query = $this->db->query("select * from program_studi")->result();
			return $query;
		
		}
		function getHomebase(){
			$query = $this->db->query("select * from pegawai_homebase")->result();
			return $query;
		
		}
		function getProvinsi(){
			$query = $this->db->query("select * from prov_kota_new")->result();
			return $query;
		}
		function getBagian(){
			$query = $this->db->query("select bagian from jabatan_struktural group by bagian")->result();
			return $query;
		}
		function getLastIdPegawai(){
			$query = $this->db->query("select id from pegawai order by id desc limit 1")->row()->id;
			return $query;
		}
		function getFakultas(){
			$query = $this->db->query("select * from fakultas")->result();
			return $query;
		}
		function getMasterProgdi(){
			$query = $this->db->query("select * from master_program_studi")->result();
			return $query;
		}
		function getMasterUniversitas(){
			$query = $this->db->query("select * from master_universitas order by id asc")->result();
			return $query;
		}
		function getMasterKota(){
			$query = $this->db->query("select * from prov_kota_new")->result();
			return $query;
		}
		function getUniversitas(){
			$query = $this->db->query("select * from master_universitas order by id asc")->result();
			return $query;
		}
		function getRiwayatPendidikan($id_pegawai, $jenjang){
			$query = $this->db->query("select * from pegawai_riwayat_pendidikan where id_pegawai=" . $id_pegawai . " and jenjang='" . $jenjang . "'")->row();
			return $query;
		}
		function getRiwayatPendidikan2($id){
			$query = $this->db->query("select *,(select nama_universitas from master_universitas where id=r.universitas) as nama_universitas,(select nama_jurusan from master_program_studi where id=r.jurusan) as nama_prodi,(select nama_kota from prov_kota_new where id=r.tempat) as nama_kota from pegawai_riwayat_pendidikan r where id_pegawai = '$id'")->result();
			return $query;
		}
		function getRiwayatPendidikanDetail($id){
			$query = $this->db->query("select *,(select nama_universitas from master_universitas where id=r.universitas) as nama_universitas,(select nama_jurusan from master_program_studi where id=r.jurusan) as nama_prodi,(select nama_kota from prov_kota_new where id=r.tempat) as nama_kota from pegawai_riwayat_pendidikan r where r.id = '$id'")->row();
			return $query;
		}
		function getPosisi(){
			$query = $this->db->query("select * from pegawai_posisi")->result();
			return $query;
		}
		function getUnitResult($id){
			$query = $this->db->query("select * from program_studi where id=" . $id)->row()->nama_jurusan;
			return $query;
		}
		function getRiwayatStruktural($id){
			$query = $this->db->query("select s.*,u.unit_kerja,b.nama_bagian as bagian,j.nama_jabatan as jabatan from pegawai_jabatan_struktural s inner join pegawai_jabatan j on j.id=s.id_jabatan_struktural inner join pegawai_bagian b on b.id=j.id_bagian inner join pegawai_unit_kerja u on u.id=b.id_unit_kerja where id_pegawai='$id'")->result();
			return $query;
		}
		function getJabatanStruktural(){
			$query = $this->db->query("select * from jabatan_struktural")->result();
			return $query;
		}
		function menuSimpegUser(){
			$query = $this->db->query("select * from menu_tree where parent=0")->result();
			return $query;
		}
		function getBiodataSU($id){
			$query = $this->db->query("SELECT *,p.id as pegawai_id,b.id as id_biodata, p.nama as nama_pegawai FROM `pegawai` p
				INNER JOIN pegawai_biodata b on b.id_pegawai = p.id
				INNER JOIN pegawai_posisi s on s.kode = b.kd_posisi_pegawai
				where p.id = '".$id."'")->row();
			return $query;
		}
		function menuSimpegUserDash(){
			$query = $this->db->query("select * from menu_tree_user where parent=0")->result();
			return $query;
		}
		function getRiwayatPenelitian($id){
			$query = $this->db->query("select *,p.id as p_id from pegawai_penelitian p inner join fakultas f on f.id = p.id_fakultas where id_pegawai=" . $id)->result();
			return $query;
		}
		function getBerkasPendukung($id){
			
		}
		function getMahasiswa(){
			$query = $this->db->query("select * from mahasiswa")->result();
			return $query;
		}
		function getListJabatan(){
			$query = $this->db->query("select j.*,b.nama_bagian,jj.nama_jenis,u.unit_kerja from pegawai_jabatan j inner join pegawai_bagian b on b.id=j.id_bagian inner join pegawai_jenis_jabatan jj on jj.id=j.id_jenis_jabatan inner join pegawai_unit_kerja u on u.id=b.id_unit_kerja ")->result();
			return $query;
		}
		function getUnitKerja(){
			$query = $this->db->query("select * from pegawai_unit_kerja ")->result();
			return $query;
		}	
		function getBagianStruktural($id){
			$query = $this->db->query("select * from pegawai_bagian where id_unit_kerja = " . $id)->result();
			return $query;
		}	
		function getJenisJabatan($id){
			$query = $this->db->query("select jj.* ,u.unit_kerja from pegawai_jenis_jabatan jj inner join pegawai_unit_kerja u on u.id = jj.id_unit_kerja where id_unit_kerja=" . $id)->result();
			return $query;
		}
		function getJabatan($id_bagian,$id_jenis_jabatan){
			$query = $this->db->query("select * from pegawai_jabatan where id_bagian=" . $id_bagian . " and id_jenis_jabatan = " . $id_jenis_jabatan)->result();
			return $query;
		}
		function getDetailJabatan($id){
			$query = $this->db->query("select j.*,b.id_unit_kerja from pegawai_jabatan j inner join pegawai_bagian b on b.id=j.id_bagian where j.id=" . $id)->row();
			return $query;
		}
		function getDetailJabatanStruktural($id_pegawai){
			$where_id_pegawai = array("id_pegawai"=>$id_pegawai);
			$query = $this->db->order_by("id","desc")->limit(1)->get_where("pegawai_jabatan_struktural",$where_id_pegawai)->row();
			return $query;
		}
		function getDetailJabatanFungsional($id_pegawai){
			$where_id_pegawai = array("id_pegawai"=>$id_pegawai);
			$query = $this->db->order_by("id","desc")->limit(1)->get_where("pegawai_jabatan_fungsional",$where_id_pegawai)->row();
			return $query;
		}
		function getDetailGolongan($id_pegawai){
			$where_id_pegawai = array("id_pegawai"=>$id_pegawai);
			$query = $this->db->order_by("id","desc")->limit(1)->get_where("pegawai_golongan",$where_id_pegawai)->row();
			return $query;
		}
		
		
	}
?>