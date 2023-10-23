<?php
class Presensi extends CI_Controller
{
    function __construct()
		{
			# code..
			parent::__construct();
			if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
        }
    function index(){
    	$data['title'] = "Presensi - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $pertemuan['temu'] = $this->db->query("SELECT master_jadwal_temp.*, concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_dosen, master_mata_kuliah.nama_mata_kuliah FROM master_jadwal_temp INNER JOIN pegawai_biodata ON master_jadwal_temp.id_dosen = pegawai_biodata.id INNER JOIN master_mata_kuliah ON master_jadwal_temp.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah")->result();
        // var_dump($pertemuan['temu']);
        $data['content'] = $this->load->view('presensi/v_jadwal',$pertemuan,true);
        $this->load->view('index',$data);
    }
    function tanggal($id=''){
    	$data['title'] = "Presensi - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
    	$pertemuan['temu'] = $this->db->get_where('master_pertemuan', array('id_jadwal' => $id))->result();
        $pertemuan['id_jadwal'] = $id;
    	$data['content'] = $this->load->view('presensi/v_tanggal',$pertemuan,true);
        $this->load->view('index',$data);
    }
    function download_template($id=''){
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
        $mhs['data'] = $this->db->query("SELECT master_krs_temp.*, mahasiswa.nama from master_krs_temp INNER JOIN mahasiswa ON master_krs_temp.nim = mahasiswa.nim where master_krs_temp.id_jadwal=$id")->result();
        $mhs['temu'] = $this->db->get_where('master_pertemuan', array('id_jadwal' => $id))->result();
        $q = $this->db->get_where('master_jadwal_temp', array('id' => $id))->row();
        $kdmk = $q->kode_mata_kuliah;
        $idDosen = $q->id_dosen;
        $t = $this->db->get_where('master_tahun_ajaran', ['is_aktif' => 1])->row();
        $mhs['ta'] = $t->awal.'/'.$t->akhir;
        $dsn = $this->db->get_where('pegawai_biodata', array('id' => $idDosen))->row();
        $mhs['dosen'] = $dsn->gelar_depan.' '.$dsn->nama_lengkap.' '.$dsn->gelar_belakang;
        $mhs['nidn'] = $dsn->nidn;
        $idprodi = $this->db->get_where('master_mata_kuliah', array('kode_mata_kuliah' => $kdmk))->row()->id_program_studi;
        $mhs['prodi'] = $this->db->get_where('program_studi', array('id' => $idprodi))->row()->nama_jurusan;
        $data = $this->load->view('presensi/v_template_mhs', $mhs, TRUE);


        $berita['dosen'] = $dsn->gelar_depan.' '.$dsn->nama_lengkap.' '.$dsn->gelar_belakang;
        $berita['matkul'] = $this->db->get_where('master_mata_kuliah', array('kode_mata_kuliah' => $kdmk))->row()->nama_mata_kuliah;
        $berita['sks'] = $this->db->get_where('master_mata_kuliah', array('kode_mata_kuliah' => $kdmk))->row()->jumlah_sks;
        $berita['sesi'] = $q->sesi;
        $berita['jenis_ta'] = [1 => 'GANJIL', 2 => 'GENAP', 3 => 'ANTARA GANJIL GENAP', 4 => 'ANTARA GENAP GANJIL'];
        $berita['ta'] = $t->awal.'/'.$t->akhir;
        $berita['jenis'] = $t->jenis;
        $berita['ruang'] = $q->ruang;
        $berita['temu'] = $this->db->get_where('master_pertemuan', array('id_jadwal' => $id))->result();
        $data1 = $this->load->view('presensi/v_template_berita_acara', $berita, TRUE);
                
        $pdfFilePath ="PRESENSI & BERITA ACARA - ".$berita['ta']." ".$berita['jenis_ta'][$berita['jenis']].".pdf";
        $mpdf->WriteHTML($data);
        $mpdf->AddPage();
        $mpdf->WriteHTML($data1);
        $mpdf->Output($pdfFilePath, "D");
        exit;
    }
    function input($id=''){
        $data['title'] = "Presensi - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $id_jadwal = $this->db->get_where('master_pertemuan', array('id' => $id))->row();
        $pertemuan['mhs'] = $this->db->query("SELECT master_krs_temp.*, mahasiswa.nama from master_krs_temp INNER JOIN mahasiswa ON master_krs_temp.nim = mahasiswa.nim where master_krs_temp.id_jadwal=$id_jadwal->id_jadwal")->result();
        $pertemuan['tgl_pertemuan'] = $id_jadwal->tgl_pertemuan;
        $pertemuan['jadwal_id'] = $id_jadwal->id_jadwal;
        $pertemuan['memos'] = $this->db->get_where('tbl_memo', array('id_pertemuan' => $id))->row();
        $pertemuan['id_pertemuan'] = $id;
        // if ($q->num_rows() > 0) {
        //     $pertemuan['memos'] = $q->row();
        // }else{
        //     $pertemuan['memos'] =['memo' => NULL, 'mhs_hadir' => 0];
        // }
        // var_dump($q);
        $data['content'] = $this->load->view('presensi/v_mhs',$pertemuan,true);
        $this->load->view('index',$data);
    }
    function simpan(){
        $total = $this->input->post('total');
        $memo = $this->input->post('memo');
        $id_pertemuan = $this->input->post('id_pertemuan');
        $sub = $this->input->post('sub');
        $mhs_hadir = 0;
    	for ($i=1; $i <= $total; $i++) { 
    		# code...
    		$id_jadwal = $this->input->post('id_jadwal'.$i);
    		$nim = $this->input->post('nim'.$i);
            $tgl = $this->input->post('tgl'.$i);
    		$status = $this->input->post('status'.$i);
            if ($status == 1 || $status == 2) {
                $mhs_hadir = $mhs_hadir + 1;
            }
    		$where = array('nim' => $nim,
    					   'id_jadwal' => $id_jadwal,
    					   'tgl_pertemuan' => $tgl);
    		$data = array('nim' => $nim,
    					   'id_jadwal' => $id_jadwal,
    					   'tgl_pertemuan' => $tgl,
    					   'status' => $status
    					   );
            // var_dump($data);
    		$cek_row = $this->db->get_where('master_presensi', $where)->num_rows();
    		if ($cek_row > 0) {
    			# code...
    			$this->db->update('master_presensi', $data, $where);
    			$r = 1;
    			
    		}else{
    			$this->db->insert('master_presensi', $data);
    			$r = 1;
    		}
    	}
        $cek = $this->db->get_where('tbl_memo', array('id_pertemuan' => $id_pertemuan))->num_rows();
        $data_memo = array(
                            'id_pertemuan' => $id_pertemuan,
                            'memo' => $memo,
                            'sub' => $sub,
                            'mhs_hadir' => $mhs_hadir
                         );
        if ($cek > 0) {
            $this->db->update('tbl_memo',$data_memo, array('id_pertemuan' => $id_pertemuan));
        }else{
            $this->db->insert('tbl_memo', $data_memo);
        }
    	if ($r == 1) {
    		# code...
    		$this->session->set_userdata('presensi','Pertemuan sudah Di set');
				redirect('master/presensi/input/'.$id_pertemuan);
    	}else{
    		$this->session->set_userdata('presensi','Pertemuan gagal di set');
				redirect('master/presensi/input/'.$id_pertemuan);
    	}
    }
    function mahasiswa(){
        $data['title'] = "Presensi - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $pertemuan['temu'] = $this->db->get('mahasiswa')->result();
        $data['content'] = $this->load->view('presensi/v_mahasiswa',$pertemuan,true);
        $this->load->view('index',$data);
    }
    function input_mhs($nim){
        $data['title'] = "Presensi - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $pertemuan['temu'] = $this->db->get_where('master_krs_temp', array('nim' => $nim))->result();
        $data['content'] = $this->load->view('presensi/v_krs',$pertemuan,true);
        $this->load->view('index',$data);
    }
    function p($id){
        $id = explode("-", $this->openssl->convert("decrypt", $id));
        $data['title'] = "Presensi - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $pertemuan['temu'] = $this->db->get_where('master_pertemuan', array('id_jadwal' => $id[0]))->result();
        $nim = $this->db->get_where('mahasiswa', array('nim' => $id[1]))->row();
        $pertemuan['get_nim'] = $nim->nim;
        $data['content'] = $this->load->view('presensi/v_input_mhs',$pertemuan,true);
        $this->load->view('index',$data);
    }
    function simpan_p(){
        $total = $this->input->post('total');
        for ($i=1; $i <= $total ; $i++) { 
            # code...
            $id_jadwal = $this->input->post('id_jadwal'.$i);
            $nim = $this->input->post('nim'.$i);
            $tgl = $this->input->post('tgl'.$i);
            $status = $this->input->post('status'.$i);
            $where = array('nim' => $nim,
                           'id_jadwal' => $id_jadwal,
                           'tgl_pertemuan' => $tgl);
            $data = array('nim' => $nim,
                           'id_jadwal' => $id_jadwal,
                           'tgl_pertemuan' => $tgl,
                           'status' => $status
                           );
            $cek_row = $this->db->get_where('master_presensi', $where)->num_rows();
            if ($cek_row > 0) {
                # code...
                $this->db->update('master_presensi', $data, $where);
                $r = 1;
                
            }else{
                $r = $this->db->insert('master_presensi', $data);
                $r = 1;
            }
        }
        if ($r == 1) {
            # code...
                $this->session->set_userdata('presensi','Pertemuan sudah Di set');
                redirect('master/presensi/p/'.$this->openssl->convert("encrypt", $id_jadwal."-".$nim));
        }else{
                $this->session->set_userdata('presensi','Pertemuan gagal di set');
                redirect('master/presensi/p/'.$this->openssl->convert("encrypt", $id_jadwal."-".$nim));
        }
    }
}