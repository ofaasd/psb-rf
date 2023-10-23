<?php
class Jadwal_Model extends CI_Model
{
    function get_data_jadwal($id){
        $r = $this->db->query("SELECT master_jadwal_temp.*, concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as dosen FROM `master_jadwal_temp` LEFT JOIN pegawai_biodata on master_jadwal_temp.id_dosen = pegawai_biodata.id where master_jadwal_temp.kode_mata_kuliah = '$id'");
        return $r;
    }
    function tampil_jadwal_1($id){
        $r = $this->db->query("SELECT master_jadwal_temp.*, concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as dosen FROM `master_jadwal_temp` LEFT JOIN pegawai_biodata on master_jadwal_temp.id_dosen = pegawai_biodata.id where master_jadwal_temp.kode_jadwal = '1' AND master_jadwal_temp.kode_mata_kuliah = '$id'");
        return $r;
    }
    function tampil_jadwal_2($id){
        $r = $this->db->query("SELECT master_jadwal_temp.*, concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as dosen FROM `master_jadwal_temp` LEFT JOIN pegawai_biodata on master_jadwal_temp.id_dosen = pegawai_biodata.id where master_jadwal_temp.kode_jadwal = '2' AND master_jadwal_temp.kode_mata_kuliah = '$id'");
        return $r;
    }
    function tampil_jadwal_3($id){
        $r = $this->db->query("SELECT master_jadwal_temp.*, concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as dosen FROM `master_jadwal_temp` LEFT JOIN pegawai_biodata on master_jadwal_temp.id_dosen = pegawai_biodata.id where master_jadwal_temp.kode_jadwal = '3' AND master_jadwal_temp.kode_mata_kuliah = '$id'");
        return $r;
    }
	function tampil_jadwal_new($kode_jadwal,$id){
        $r = $this->db->query("SELECT master_jadwal_temp.*, concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as dosen FROM `master_jadwal_temp` LEFT JOIN pegawai_biodata on master_jadwal_temp.id_dosen = pegawai_biodata.id where master_jadwal_temp.kode_jadwal = '$kode_jadwal' AND master_jadwal_temp.kode_mata_kuliah = '$id'");
        return $r;
    }
    function dsn2($id){
        $r = $this->db->query("SELECT 
        CONCAT(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) 
        AS dosen2, id_dosen
        FROM `master_jadwal_temp` LEFT JOIN pegawai_biodata ON master_jadwal_temp.id_dosen2 = pegawai_biodata.id 
        WHERE master_jadwal_temp.kode_mata_kuliah = '$id'");
        return $r;
    }
    function dsn2_jadwal_2($id){
        $r = $this->db->query("SELECT 
        CONCAT(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) 
        AS dosen2, id_dosen
        FROM `master_jadwal_temp` LEFT JOIN pegawai_biodata ON master_jadwal_temp.id_dosen2 = pegawai_biodata.id 
        WHERE master_jadwal_temp.kode_jadwal = '2' AND master_jadwal_temp.kode_mata_kuliah = '$id'");
        return $r;
    }
    function dsn2_jadwal_3($id){
        $r = $this->db->query("SELECT 
        CONCAT(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) 
        AS dosen2, id_dosen
        FROM `master_jadwal_temp` LEFT JOIN pegawai_biodata ON master_jadwal_temp.id_dosen2 = pegawai_biodata.id 
        WHERE master_jadwal_temp.kode_jadwal = '3' AND master_jadwal_temp.kode_mata_kuliah = '$id'");
        return $r;
    }
    function edit_jadwal($id){
        $r = $this->db->get_where('master_jadwal_temp',array('id' => $id));
        return $r;
    }
    function jadwal_aktif(){
        $query = $this->db->select('*');
        $query = $this->db->from('master_jadwal_temp');
        $query = $this->db->where('status',1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getMhs($kd_jadwal){
        $query = $this->db->select('nim');
        $query = $this->db->from('master_krs_temp');
        $query = $this->db->where('id_jadwal',$kd_jadwal);
        $query = $this->db->get()->result_array();

        $arr=array();
        foreach ($query as $data){
            array_push($arr,$data['nim']);
        }

        $datamhs = $this->db->select('*');
        $datamhs = $this->db->from('mahasiswa');
        $datamhs = $this->db->where_in('nim',$arr);
        $datamhs = $this->db->get()->result_array();
        return $datamhs;

    }

    function getMataKuliah($kd_matkul){
        $query = $this->db->select('kode_mata_kuliah,nama_mata_kuliah');
        $query = $this->db->from('master_mata_kuliah');
        $query = $this->db->where('kode_mata_kuliah',$kd_matkul);
        $query = $this->db->get()->row();
        return $query;

    }

    function new_input(){
        $kode_matkul = $this->input->post('kode');
        $id_jadwal = $this->input->post('id_jadwal');
        $rombel = $this->input->post('rombel');
        $dosen = $this->input->post('dosen');
        $hari = $this->input->post('hari');
        $sesi = $this->input->post('sesi');
        $ruang = $this->input->post('ruang');
        $status = $this->input->post('status');
        $kelas = $this->input->post('kelas');
        $ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row();
        $id = 1;
		$pesan = array();
        for ($i=0; $i < count($dosen); $i++) { 
          $data = array(
                'kode_mata_kuliah' => $kode_matkul,
                'kode_jadwal' => $id++,
                'id_tahun' => $ta->id,
                'rombel' => $rombel[$i],
                'id_dosen' => $dosen[$i],
                'hari' => $hari[$i],
                'sesi' => $sesi[$i],
                'ruang' => $ruang[$i],
                'kelas' => $kelas[$i],
                'status' => $status[$i]
            );
            $where = array(
              'hari' => $hari[$i],
              'rombel' => $rombel[$i],
              'sesi' => $sesi[$i],
              'ruang' => $ruang[$i]
            );
          $q = $this->db->get_where('master_jadwal_temp',$where);
          $qs = $q->result_array();
		  if($hari[$i] != '--Pilih Hari--'  && $rombel[$i]!='--Pilih Rombel--' && $sesi[$i]!='--Pilih Sesi--' && $ruang[$i]!='--Pilih Ruang--'){
          if ($q->num_rows() > 0) {
			  
                  # code...
                  if($qs[0]['kode_mata_kuliah'] == $kode_matkul && $qs[0]['id_dosen'] == $dosen[$i]){
                      //$this->session->set_userdata('jadwal_bentrok', 'Jadwal berhasil di Perbaharui');
					  $pesan[$i] = 'Jadwal berhasil di perbaharui';
                      $r = $this->db->update('master_jadwal_temp',$data,array('id' => $id_jadwal[$i]));
                  }else{
                      if($qs[0]['status'] == 1){
                          //$this->session->set_userdata('jadwal_bentrok', 'Jadwal bentrok dengan kode mata kuliah '.$qs[0]['kode_mata_kuliah'].' pada hari '.$qs[0]['hari'].' dengan sesi perkuliahan '.$qs[0]['sesi'].' di ruangan '.$qs[0]['ruang']);
						  $pesan[$i] = 'Jadwal bentrok dengan kode mata kuliah '.$qs[0]['kode_mata_kuliah'].' pada hari '.$qs[0]['hari'].' dengan sesi perkuliahan '.$qs[0]['sesi'].' di ruangan '.$qs[0]['ruang'];
                      }else{
                          //$this->session->set_userdata('jadwal_bentrok', 'Jadwal berhasil di Perbaharui');
						  $pesan[$i] = 'Jadwal berhasil di Perbaharui';
                          $r = $this->db->update('master_jadwal_temp',$data,array('id' => $id_jadwal[$i]));
                      }
                  }
          }else{
                  $c = $this->db->get_where('master_jadwal_temp', array('id' => $id_jadwal[$i]))->num_rows();
                  if ($c > 0) {
                    //$this->session->set_userdata('jadwal_bentrok', 'Jadwal berhasil di Ubah');
					$pesan[$i] = 'Jadwal berhasil di Ubah';
                    $r = $this->db->update('master_jadwal_temp',$data,array('id' => $id_jadwal[$i]));
                  }else{
                    //$this->session->set_userdata('jadwal_bentrok', 'Jadwal berhasil di Tambahkan');
					$pesan[$i] = 'Jadwal berhasil di Tambahkan';
                    $r = $this->db->insert('master_jadwal_temp',$data);
					//echo $rombel[$i];
					//echo "<br/>";
                  }
                  // $get_id = $this->db->query("SELECT * from master_jadwal_temp ORDER BY id DESC LIMIT 1")->row();
                  // $jadwal_id = $get_id->id;
                  
                  // $r = $this->db->insert('tbl_ujian', array('id_jadwal' => $jadwal_id));
			}
		  }else{
			  $r = 2;
		  }
        }
		$this->session->set_userdata('jadwal_bentrok',$pesan);
        return $r;
    }
	function new_update(){
		$kode_matkul = $this->input->post('kode');
        $id_jadwal = $this->input->post('id_jadwal');
        $rombel = $this->input->post('rombel');
        $dosen = $this->input->post('dosen');
        $hari = $this->input->post('hari');
        $sesi = $this->input->post('sesi');
        $ruang = $this->input->post('ruang');
        $status = $this->input->post('status');
        $kelas = $this->input->post('kelas');
        $ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row();
        $id = 1;
		$r = 0;
        for ($i=0; $i < count($dosen); $i++) { 
			//echo $id;
			$data = array(
                'kode_mata_kuliah' => $kode_matkul,
                'kode_jadwal' => $id++,
                'id_tahun' => $ta->id,
                'rombel' => $rombel[$i],
                'id_dosen' => $dosen[$i],
                'hari' => $hari[$i],
                'sesi' => $sesi[$i],
                'ruang' => $ruang[$i],
                'kelas' => (int) $kelas[$i],
                'status' => $status[$i]
            );
			$where = array(
              'hari' => $hari[$i],
              'rombel' => $rombel[$i],
              'sesi' => $sesi[$i],
              'ruang' => $ruang[$i]
            );
			$q = $this->db->get_where('master_jadwal_temp',$where);
			if ($q->num_rows() == 1) {
				if (!empty($id_jadwal[$i])) {
				  
				  //$this->session->set_userdata('jadwal_bentrok', 'Jadwal berhasil di Perbaharui');
				  $this->db->where('id',$id_jadwal[$i]);
				  $r = $this->db->update('master_jadwal_temp',$data);
				  if($r){
					echo "berhasil update";
				  }else{
					echo "gagal";
				  }
				  
				}else{
					if(!empty($dosen[$i])){
						$this->session->set_userdata('jadwal_bentrok', 'Jadwal berhasil di Tambahkan');
						$r = $this->db->insert('master_jadwal_temp',$data);
						echo "berhasil insert";
					}
				}
			}elseif($q->num_rows() > 1){
				$hasil = $q->row();
				echo $q->num_rows();
				$this->session->set_userdata('jadwal_bentrok', 'Jadwal bentrok ' .  $hasil->kode_mata_kuliah);
			}elseif($q->num_rows() < 1){
				if($hari[$i] != '--Pilih Hari--'  && $rombel[$i]!='--Pilih Rombel--' && $sesi[$i]!='--Pilih Sesi--' && $ruang[$i]!='--Pilih Ruang--'){
					if(!empty($dosen[$i])){
						$this->session->set_userdata('jadwal_bentrok', 'Jadwal berhasil di Tambahkan');
						$r = $this->db->insert('master_jadwal_temp',$data);
						echo "berhasil insert";
					}
				}
			}
			echo "<br />";
        }
        return $r;
	}
    function list_dosen(){
        $r = $this->db->query("SELECT pegawai_biodata.id, pegawai_biodata.kd_posisi_pegawai,concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_pegawai, pegawai_posisi.nama, program_studi.nama_jurusan FROM `pegawai_biodata` LEFT join pegawai_posisi on pegawai_posisi.kode = pegawai_biodata.kd_posisi_pegawai LEFT JOIN program_studi on program_studi.id = pegawai_biodata.id_progdi where pegawai_biodata.kd_posisi_pegawai = '07' OR pegawai_biodata.kd_posisi_pegawai = '17' OR pegawai_biodata.kd_posisi_pegawai = '27'");
        return $r;
    }
}

?>

