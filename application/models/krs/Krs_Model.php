<?php
class Krs_Model extends CI_Model
{
    function tampil_mhs($ta){
        $r = $this->db->query("SELECT 
                                master_keuangan_mhs.krs,
                                master_tahun_ajaran.*, 
                                mahasiswa.nama, 
                                mahasiswa.nim,
                                get_jumlah_sks(mahasiswa.nim) as jumlah_sks 
                                from mahasiswa 
                                LEFT JOIN master_keuangan_mhs ON master_keuangan_mhs.id_mahasiswa = mahasiswa.id 
                                LEFT JOIN master_tahun_ajaran ON master_keuangan_mhs.id_tahun_ajaran = master_tahun_ajaran.id 
                                where mahasiswa.status = 1 
                                and
                                master_keuangan_mhs.id_tahun_ajaran = ".$ta."
                                ORDER BY mahasiswa.nim ASC");
		return $r;
    }
	function total_input_krs($ta){
        $r = $this->db->select('*')
                      ->from('master_krs_temp')
                      ->where(['id_tahun' => $ta])
                      ->group_by('nim', 'ASC')->get();
		// $r = $this->db->query("SELECT * FROM `master_krs_temp` WHERE log_date between '2021-04-09 13:00:00' and '2021-04-15 17:12:00'  group by nim");
		return $r;
	}
	function total_mhs(){
		$r = $this->db->query("SELECT * FROM mahasiswa where status = 1");
		return $r;
	}
    function tampil_mk(){
        //$r = $this->db->get_where('master_mata_kuliah',array('is_aktif' => 1));
		$r = $this->db->query("select * from master_mata_kuliah where (select count(*) from master_jadwal_temp where kode_mata_kuliah=master_mata_kuliah.kode_mata_kuliah) > 0");
        return $r;
    }
	function tampil_mk_by_prodi($id_program_studi){
        //$r = $this->db->get_where('master_mata_kuliah',array('is_aktif' => 1));
		$r = $this->db->query("select * from master_mata_kuliah where (select count(*) from master_jadwal_temp where kode_mata_kuliah=master_mata_kuliah.kode_mata_kuliah) > 0 and id_program_studi=" . $id_program_studi);
        return $r;
    }
    function input_jadwal(){
        $kode_matkul = $this->input->post('kode');

        $id1 = $this->input->post('id1');
		$dosen1 = $this->input->post('dosen1');
		$hari1 = $this->input->post('hari1');
		$sesi1 = $this->input->post('sesi1');
		$ruang1 = $this->input->post('ruang1');
        $status1 = $this->input->post('status1');
        
		$id2 = $this->input->post('id2');
		$dosen2 = $this->input->post('dosen2');
		$hari2 = $this->input->post('hari2');
        $sesi2 = $this->input->post('sesi2');
        $ruang2 = $this->input->post('ruang2');
        $status2 = $this->input->post('status2');
        
		$id3 = $this->input->post('id3');
		$dosen3 = $this->input->post('dosen3');
		$hari3 = $this->input->post('hari3');
        $sesi3 = $this->input->post('sesi3');
        $ruang3 = $this->input->post('ruang3');
        $status3 = $this->input->post('status3');

        $where1 = array(
            // 'id_dosen' => $dosen1,
            'hari' => $hari1,
            'sesi' => $sesi1,
            'ruang' => $ruang1
            // 'status' => 1
        );
        $where2 = array(
            // 'id_dosen' => $dosen2,
            'hari' => $hari2,
            'sesi' => $sesi2,
            'ruang' => $ruang2
            // 'status' => 1
        );
        $where3 = array(
            // 'id_dosen' => $dosen3,
            'hari' => $hari3,
            'sesi' => $sesi3,
            'ruang' => $ruang3
            // 'status' => 1
        );

        if (!empty($dosen1) && !empty($hari1) && !empty($sesi1) && !empty($status1)) {
            $q = $this->db->get_where('master_jadwal',$where1);
            $qs = $q->result_array();
            $data = array(
                'kode_mata_kuliah' => $kode_matkul,
                'kode_jadwal' => '01',
                'id_dosen' => $dosen1,
                'hari' => $hari1,
                'sesi' => $sesi1,
                'ruang' => $ruang1,
                'status' => $status1
            );
            if ($q->num_rows() > 0) {
                # code...
                if($qs[0]['kode_mata_kuliah'] == $kode_matkul){
                    $this->session->set_userdata('jadwal_bentrok', 'Jadwal berhasil di Perbaharui');
                    $r = $this->db->update('master_jadwal',$data,array('id' => $id1));
                }else{
                    if($qs[0]['status'] == 1){
                        $this->session->set_userdata('jadwal_bentrok', 'Jadwal bentrok dengan kode mata kuliah '.$qs[0]['kode_mata_kuliah'].' pada hari '.$qs[0]['hari'].' dengan sesi perkuliahan '.$qs[0]['sesi'].' di ruangan '.$qs[0]['ruang']);
                    }else{
                        $this->session->set_userdata('jadwal_bentrok', 'Jadwal berhasil di Perbaharui');
                        $r = $this->db->update('master_jadwal',$data,array('id' => $id1));
                    }
                }
            }else{
                $this->session->set_userdata('jadwal_bentrok', 'Jadwal berhasil di Tambahkan');
                $r = $this->db->insert('master_jadwal',$data);
            }
        }
        if (!empty($dosen2) && !empty($hari2) && !empty($sesi2) && !empty($status2)) {
            $q = $this->db->get_where('master_jadwal',$where2);
            $qs = $q->result_array();
            $data = array(
                'kode_mata_kuliah' => $kode_matkul,
                'kode_jadwal' => '02',
                'id_dosen' => $dosen2,
                'hari' => $hari2,
                'sesi' => $sesi2,
                'ruang' => $ruang2,
                'status' => $status2
            );
            if ($q->num_rows() > 0) {
                # code...
                if($qs[0]['kode_mata_kuliah'] == $kode_matkul){
                    $r = $this->db->update('master_jadwal',$data,array('id' => $id2));
                    $this->session->set_userdata('jadwal_bentrok', 'Jadwal berhasil di Perbaharui');
                }else{
                    if($qs[0]['status'] == 1){
                        $this->session->set_userdata('jadwal_bentrok', 'Jadwal bentrok dengan kode mata kuliah '.$qs[0]['kode_mata_kuliah'].' pada hari '.$qs[0]['hari'].' dengan sesi perkuliahan '.$qs[0]['sesi'].' di ruangan '.$qs[0]['ruang']);
                    }else{
                        $this->session->set_userdata('jadwal_bentrok', 'Jadwal berhasil di Perbaharui');
                        $r = $this->db->update('master_jadwal',$data,array('id' => $id2));
                    }
                }
            }else{
                $r = $this->db->insert('master_jadwal',$data);
                $this->session->set_userdata('jadwal_bentrok', 'Jadwal berhasil di Tambahkan');
            }
        }
        if (!empty($dosen3) && !empty($hari3) && !empty($sesi3) && !empty($status3)) {
            $q = $this->db->get_where('master_jadwal',$where3);
            $qs = $q->result_array();
            $data = array(
                'kode_mata_kuliah' => $kode_matkul,
                'kode_jadwal' => '03',
                'id_dosen' => $dosen3,
                'hari' => $hari3,
                'sesi' => $sesi3,
                'ruang' => $ruang3,
                'status' => $status3
            );
            if ($q->num_rows() > 0) {
                # code...
                if($qs[0]['kode_mata_kuliah'] == $kode_matkul){
                    $r = $this->db->update('master_jadwal',$data,array('id' => $id3));
                    $this->session->set_userdata('jadwal_bentrok', 'Jadwal berhasil di Perbaharui');
                }else{
                    if($qs[0]['status'] == 1){
                        $this->session->set_userdata('jadwal_bentrok', 'Jadwal bentrok dengan kode mata kuliah '.$qs[0]['kode_mata_kuliah'].' pada hari '.$qs[0]['hari'].' dengan sesi perkuliahan '.$qs[0]['sesi'].' di ruangan '.$qs[0]['ruang']);
                    }else{
                        $this->session->set_userdata('jadwal_bentrok', 'Jadwal berhasil di Perbaharui');
                        $r = $this->db->update('master_jadwal',$data,array('id' => $id3));
                    }
                }
            }else{
                $r = $this->db->insert('master_jadwal',$data);
                $this->session->set_userdata('jadwal_bentrok', 'Jadwal berhasil di Tambahkan');
            }
        }
        return $r;
    }
    function list_dosen(){
        $r = $this->db->query("SELECT pegawai_biodata.id, pegawai_biodata.kd_posisi_pegawai,concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_pegawai, pegawai_posisi.nama, program_studi.nama_jurusan FROM `pegawai_biodata` LEFT join pegawai_posisi on pegawai_posisi.kode = pegawai_biodata.kd_posisi_pegawai LEFT JOIN program_studi on program_studi.id = pegawai_biodata.id_progdi where pegawai_biodata.kd_posisi_pegawai = '07' OR pegawai_biodata.kd_posisi_pegawai = '17' OR pegawai_biodata.kd_posisi_pegawai = '27'");
        return $r;
    }
}

?>