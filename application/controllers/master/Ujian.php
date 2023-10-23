<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Ujian extends CI_Controller
{
    function __construct()
		{
			# code...
			parent::__construct();
			if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
        }
    function index(){
		$data['title'] = "Jadwal Ujian - Academic Portal";
		$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$matakuliah['matakuliah'] = $this->db->get_where('master_mata_kuliah', array('is_aktif' => 1))->result();
		$data['content'] = $this->load->view('ujian/v_matakuliah',$matakuliah,true);
		$this->load->view('index',$data);
	}
    function input($kode=''){
        $data['title'] = "Jadwal Ujian - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $ujian['jadwal'] = $this->db->select('master_jadwal_temp.*,master_jadwal_temp.id as jadwal_id, pegawai_biodata.*, master_mata_kuliah.*,tbl_jadwal_ujian.*')->from('master_jadwal_temp')->join('pegawai_biodata', 'master_jadwal_temp.id_dosen = pegawai_biodata.id', 'left')->join('master_mata_kuliah', 'master_jadwal_temp.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah', 'inner')->join('tbl_jadwal_ujian', 'master_jadwal_temp.id = tbl_jadwal_ujian.id_jadwal', 'left')->where('master_jadwal_temp.kode_mata_kuliah', $kode)->order_by('master_jadwal_temp.kelas')->group_by('master_jadwal_temp.id')->get()->result();
        $ujian['sesi_ujian'] = $this->db->get('master_jam')->result();
        $data['content'] = $this->load->view('ujian/ujian',$ujian,true);
        $this->load->view('index',$data);
	}
	function save(){
		$id_jadwal = $this->input->post('id_jadwal');
		$kelas = $this->input->post('kelas');
		$tanggal_uts_t = $this->input->post('tanggal_uts_t');
		$id_jam_uts_t = $this->input->post('id_jam_uts_t');
		$tanggal_uas_t = $this->input->post('tanggal_uas_t');
		$id_jam_uas_t = $this->input->post('id_jam_uas_t');
		$tanggal_uts_p = $this->input->post('tanggal_uts_p');
		$id_jam_uts_p = $this->input->post('id_jam_uts_p');
		$tanggal_uas_p = $this->input->post('tanggal_uas_p');
		$id_jam_uas_p = $this->input->post('id_jam_uas_p');
		$ta = $this->input->post('ta');
		$cek = $this->db->get_where('tbl_jadwal_ujian', array('id_jadwal' => $id_jadwal))->num_rows();
		$data = array(
						'id_jadwal' => $id_jadwal,
						'tanggal_uts_t' => $tanggal_uts_t,
						'id_jam_uts_t' => $id_jam_uts_t,
						'tanggal_uas_t' => $tanggal_uas_t,
						'id_jam_uas_t' => $id_jam_uas_t,
						'tanggal_uts_p' => $tanggal_uts_p,
						'id_jam_uts_p' => $id_jam_uts_p,
						'tanggal_uas_p' => $tanggal_uas_p,
						'id_jam_uas_p' => $id_jam_uas_p,
						'ta' => $ta
					 );
		if ($cek > 0) {
			$this->db->update('tbl_jadwal_ujian', $data, array('id_jadwal' => $id_jadwal));
			$res = array('result' => 1);
		}else{
			$this->db->insert('tbl_jadwal_ujian', $data);
			$res = array('result' => 1);
		}
		echo json_encode($res);
	}
	function format_excel(){
		$spreadsheet = new Spreadsheet;

          $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A1', 'NO.')
                      ->setCellValue('B1', 'ID JADWAL')
                      ->setCellValue('C1', 'KODE MATAKULIAH')
                      ->setCellValue('D1', 'NAMA MATAKULIAH')
                      ->setCellValue('E1', 'DOSEN PENGAMPU')
                      ->setCellValue('F1', 'TANGGAL UTS TEORI')
                      ->setCellValue('G1', 'ID JAM UTS TEORI')
                      ->setCellValue('H1', 'TANGGAL UAS TEORI')
                      ->setCellValue('I1', 'ID JAM UAS TEORI')
                      ->setCellValue('J1', 'TANGGAL UTS PRAKTEK')
                      ->setCellValue('K1', 'ID JAM UTS PRAKTEK')
                      ->setCellValue('L1', 'TANGGAL UAS PRAKTEK')
                      ->setCellValue('M1', 'ID JAM UAS PRAKTEK')
                      ->setCellValue('N1', 'ID TAHUN AJARAN');
          $data = $this->db->select('master_jadwal_temp.*,master_jadwal_temp.id as jadwal_id, pegawai_biodata.*, master_mata_kuliah.*,tbl_jadwal_ujian.*')
        							->from('master_jadwal_temp')
        							->join('pegawai_biodata', 'master_jadwal_temp.id_dosen = pegawai_biodata.id', 'left')
        							->join('master_mata_kuliah', 'master_jadwal_temp.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah', 'left')
        							->join('tbl_jadwal_ujian', 'master_jadwal_temp.id = tbl_jadwal_ujian.id_jadwal', 'left')
        							// ->join('master_jam', 'tbl_jadwal_ujian.')
        							->get()->result();
          $kolom = 2;
          $no = 1;
          foreach($data as $p) {

               $spreadsheet->setActiveSheetIndex(0)
                           ->setCellValue('A' . $kolom, $no++)
                           ->setCellValue('B' . $kolom, $p->jadwal_id)
                           ->setCellValue('C' . $kolom, $p->kode_mata_kuliah)
                           ->setCellValue('D' . $kolom, $p->nama_mata_kuliah)
                           ->setCellValue('E' . $kolom, $p->gelar_depan.$p->nama_lengkap.' '.$p->gelar_belakang)
                           ->setCellValue('F' . $kolom, '')
                           ->setCellValue('G' . $kolom, '')
                           ->setCellValue('H' . $kolom, '')
                           ->setCellValue('I' . $kolom, '')
                           ->setCellValue('J' . $kolom, '')
                           ->setCellValue('K' . $kolom, '')
                           ->setCellValue('L' . $kolom, '')
                           ->setCellValue('M' . $kolom, '')
                           ->setCellValue('N' . $kolom, $p->id_tahun);

               $kolom++;

          }

        $writer = new Xlsx($spreadsheet);
        $date = date('d-m-Y');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="FORMAT UPLOAD UJIAN MAHASISWA '.$date.'.xls"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
	}
	function upload_jadwal_ujian(){
		error_reporting(0);
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		// echo realpath('assets/ujian');
		$config['upload_path'] = 'assets/ujian';
        $config['allowed_types'] = 'xlsx|xls|csv';
        // $config['max_size'] = '10000';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
		if(!is_dir($config['upload_path']))
		{
			mkdir($config['upload_path'],0775,true);
		}
        if (!$this->upload->do_upload('file_excel')) {

            //upload gagal
            $this->session->set_userdata('notif', '<script type="text/javascript">
            swal("Oops!", "Upload File Gagal", "error");
            </script>');
            //redirect halaman
            redirect('master/ujian');

        } else {

            $data_upload = $this->upload->data();

            $excelreader     = new PHPExcel_Reader_Excel2007();
            $loadexcel         = $excelreader->load('assets/ujian/'.$data_upload['file_name']); // Load file yang telah diupload ke folder excel
            $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

            $data = array();
            $data_kontrak = array();

            $numrow = 0;
            foreach($sheet as $row){
                            if($numrow > 0){
                            	$data = array(
										'id_jadwal' => $row['B'],
										'tanggal_uts_t' => $row['F'],
										'id_jam_uts_t' => $row['G'],
										'tanggal_uas_t' => $row['H'],
										'id_jam_uas_t' => $row['I'],
										'tanggal_uts_p' => $row['J'],
										'id_jam_uts_p' => $row['K'],
										'tanggal_uas_p' => $row['L'],
										'id_jam_uas_p' => $row['M'],
										'ta' => $row['N'] 
										);
                            	$cek = $this->db->get_where('tbl_jadwal_ujian', array('id_jadwal' => $row['B']))->num_rows();
                            	if ($cek > 0) {
                            		$this->db->update('tbl_jadwal_ujian', $data, array('id_jadwal' => $row['B']));
                            	}else{
                            		$this->db->insert('tbl_jadwal_ujian', $data);
                            	}
                    		}
               $numrow++;
            }
            // // var_dump($data);
            $index = count($data);
            unset($data[$index]);
            //delete file from server
            unlink(realpath('assets/ujian/'.$data_upload['file_name']));

            //upload success
            $this->session->set_userdata('notif', '<script type="text/javascript">
            swal("Berhasil!", "Upload File Berhasil", "success");
            </script>');
            // redirect halaman
            redirect('master/ujian');
        }
	}
	function detail($id_jadwal){
		$data['title'] = "Jadwal Ujian - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $ujian['detail'] = $this->db->select('master_krs_temp.*, master_krs_temp.id_jadwal as jadwal_id, mahasiswa.*, mahasiswa.nim as nim1,tbl_tempat_ujian.*')
        							->from('master_krs_temp')
        							->join('mahasiswa', 'master_krs_temp.nim = mahasiswa.nim', 'left')
        							->join('tbl_tempat_ujian', 'master_krs_temp.id_jadwal = tbl_tempat_ujian.id_jadwal', 'left')
        							->where('master_krs_temp.id_jadwal', $id_jadwal)
        							->get()->result();
        $ujian['kode_mk'] = $this->db->get_where('master_jadwal_temp', array('id' => $id_jadwal))->row()->kode_mata_kuliah;
        $ujian['ruang'] = $this->db->get('master_ruang')->result();
        $data['content'] = $this->load->view('ujian/detail',$ujian,true);
        $this->load->view('index',$data);
	}
	function save_ruang(){
		$id_jadwal = $this->input->post('id_jadwal');
		$nim = $this->input->post('nim');
		$no_kursi = $this->input->post('no_kursi');
		$ruang = $this->input->post('ruang');
		$ta = $this->input->post('ta');

		$cek = $this->db->get_where('tbl_tempat_ujian', array('id_jadwal' => $id_jadwal))->num_rows();
		$data = array(
						'id_jadwal' => $id_jadwal,
						'nim' => $nim,
						'no_kursi' => $no_kursi,
						'ruang' => $ruang,
						'ta' => $ta
					 );
		if ($cek > 0) {
			$this->db->update('tbl_tempat_ujian', $data, array('id_jadwal' => $id_jadwal));
			$res = array('result' => 1);
		}else{
			$this->db->insert('tbl_tempat_ujian', $data);
			$res = array('result' => 1);
		}
		echo json_encode($res);
	}
	function publish(){
		$this->db->update('tbl_ujian', array('is_publish' => 1));
		redirect('master/ujian/');
	}
}
?>