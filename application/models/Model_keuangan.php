<?php 
	class Model_keuangan extends CI_Model
	{
		public function get_all(){
			$tahun_ajaran = $this->db->query("select * from master_tahun_ajaran where is_aktif=1")->row()->id;
			$query = $this->db->select('master_keuangan_mhs.*,mahasiswa.nim,mahasiswa.nama,(select count(*) from master_krs_temp where nim=mahasiswa.nim) as jumlah_krs')
							  ->join('mahasiswa','mahasiswa.id = master_keuangan_mhs.id_mahasiswa','inner')
							  ->get_where('master_keuangan_mhs',array('id_tahun_ajaran'=> $tahun_ajaran));
							  
			return $query;
		}
		public function get_by_id($id=''){
			$tahun_ajaran = $this->db->query("select * from master_tahun_ajaran where is_aktif=1")->row()->id;
			$query = $this->db->select('master_keuangan_mhs.*,mahasiswa.nim,mahasiswa.nama,(select count(*) from master_krs_temp where nim=mahasiswa.nim) as jumlah_krs')
							  ->join('mahasiswa','mahasiswa.id = master_keuangan_mhs.id_mahasiswa','inner')
							  ->get_where('master_keuangan_mhs',array('id_mahasiswa' => $id, 'id_tahun_ajaran'=> $tahun_ajaran));
							  
			return $query;
		}
		public function cek_keuangan(){
			$tahun_ajaran = $this->db->query("select * from master_tahun_ajaran where is_aktif=1")->row()->id;
			$query = $this->db->select("*")->from('master_keuangan_mhs')->where(array('tahun_ajaran'=>$tahun_ajaran));
			if($query->num_rows() > 0){
				return 0;
			}else{
				return $query->num_rows();
			}
		}
		public function generate_keuangan(){
			$tahun_ajaran = $this->db->query("select * from master_tahun_ajaran where is_aktif=1")->row()->id;
			$query = $this->db->select("*")->get_where('master_keuangan_mhs',array('id_tahun_ajaran'=>$tahun_ajaran));
			if($query->num_rows() < 1){
				$mahasiswa = $this->db->get('mahasiswa')->result();
				foreach($mahasiswa as $row){
					$data_mhs = array(
						'id_mahasiswa' => $row->id,
						'id_tahun_ajaran' => $tahun_ajaran,
					);
					$hasil = $this->db->insert('master_keuangan_mhs',$data_mhs);
					$data_tagihan = array(
						'id_ta' => $tahun_ajaran,
						'nim' => $row->nim,
						'status' => 0
					);
					$this->db->insert('detail_tagihan', $data_tagihan);
					if($hasil){
						echo "berhasil";
					}else{
						echo "gagal";
					} 
				}
				echo 1;
				
			}else{
				$mahasiswa = $this->db->get('mahasiswa')->result();
				foreach($mahasiswa as $row){
					$data_mhs = array(
						'id_mahasiswa' => $row->id,
						'id_tahun_ajaran' => $tahun_ajaran,
					);
					$cek_exist = $this->db->get_where('master_keuangan_mhs', array('id_mahasiswa'=>$row->id));
					if($cek_exist->num_rows() > 0){
						echo "sudah ada";
					}else{
						echo "belum ada";
						$hasil = $this->db->insert('master_keuangan_mhs',$data_mhs);
						if($hasil){
							echo "berhasil ada";
						}else{
							echo "gagal";
						}
					}
					echo "<br />";
				}
				echo "0";
			}
		}
	}
?>