<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Jadwal extends CI_Controller
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
				$this->load->model('matakuliah/Matakuliah_Model');
				$this->load->model('jadwal/Jadwal_Model');
        }
    function index(){
        $data['title'] = "Jadwal Matakuliah - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $matakuliah['matakuliah'] = $this->Matakuliah_Model->v_matakuliah_jadwal();
        $matakuliah['list_jadwal'] = $this->db->select('master_jadwal_temp.*, pegawai_biodata.*, master_mata_kuliah.*, master_jadwal_temp.id as jadwal_id')
                                              ->from('master_jadwal_temp')
                                              ->join('pegawai_biodata', 'master_jadwal_temp.id_dosen = pegawai_biodata.id', 'left')
                                              ->join('master_mata_kuliah', 'master_jadwal_temp.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah', 'left')
                                              ->where(array('master_jadwal_temp.status' => 1))
                                              ->order_by('master_jadwal_temp.id', 'desc')
                                              ->get()->result();
        $data['content'] = $this->load->view('jadwal/v_jadwal',$matakuliah,true);
        $this->load->view('index',$data);
	}
	function upload_jadwal(){
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
                            	if ($row['F'] != '' || $row['G'] != '' || $row['H'] != '' || $row['I'] != ''  || $row['J'] != '' ) {
                            		$dosen = $this->db->get_where('pegawai_biodata', array('nidn' => $row['F']));
                            		// $npp = $this->db->get_where('pegawai_biodata', array('npp' => $row['F']));
                            		$get_ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row();
                            		if ($dosen->num_rows() > 0) {
                            			$id_dosen = $dosen->row()->id;
                            		}else{
                            			// if ($npp->num_rows() > 0) {
                            				// $id_dosen = $npp->row()->id;
                            			// }else{
                            				$id_dosen = 0;
                            			// }
                            		}
                            		$id_ta = $this->db->get_where('master_tahun_ajaran', array('id_tahun' => $row['B']));
                            		if ($id_ta->num_rows() > 0) {
                            			$ta = $id_ta->row()->id;
                            		}else{
                            			$ta = $get_ta;
                            		}
                            		$data = array(
                            					'kode_jadwal' => $row['C'],
                            					'id_dosen' => $id_dosen,
                            					'id_tahun' => $ta,
                            					'kode_mata_kuliah' => $row['D'],
                            					'hari' => $row['G'],
                            					'sesi' => $row['H'],
                            					'ruang' => $row['I'],
                            					'kelas' => $row['J'],
                            					'kuota_diambil' => 0,
                            					'status' => 1
                            		    	 );
                            		$cek = $this->db->get_where('master_jadwal_temp', array('kode_jadwal' => $row['C'],
                            					'id_dosen' => $id_dosen,
                            					'id_tahun' => $ta,
                            					'kode_mata_kuliah' => $row['D']))->num_rows();
                            		if ($cek > 0) {
                            			$this->db->update('master_jadwal_temp', $data, array('kode_jadwal' => $row['C'],
                            					'id_dosen' => $id_dosen,
                            					'id_tahun' => $ta,
                            					'kode_mata_kuliah' => $row['D']));
                            		}else{
                            			$this->db->insert('master_jadwal_temp', $data);
                            		}
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
            redirect('master/jadwal');
        }
	}
	function redir(){
		$this->session->set_userdata('kode_matkul', $this->input->post('kode'));
		$this->session->set_userdata('nama_matkul', $this->input->post('matkul'));
		redirect('master/jadwal/input');
	}
	function input(){
		// $this->session->set_userdata('kode_matkul', $this->input->post('kode'));
        // echo $this->session->userdata('kode_matkul');
		$id = $this->session->userdata('kode_matkul'); 
        $data['title'] = "Jadwal Matakuliah - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$cek_a = $this->Jadwal_Model->tampil_jadwal_new('1',$id)->num_rows();
        // echo $cek_a;
		$cek_b = $this->Jadwal_Model->tampil_jadwal_new('2',$id)->num_rows();
		$cek_c = $this->Jadwal_Model->tampil_jadwal_new('3',$id)->num_rows();
		$cek_d = $this->Jadwal_Model->tampil_jadwal_new('4',$id)->num_rows();
		$cek_e = $this->Jadwal_Model->tampil_jadwal_new('5',$id)->num_rows();
		$cek_f = $this->Jadwal_Model->tampil_jadwal_new('6',$id)->num_rows();
		if ($cek_a > 0) {
			# code...
			$jadwal['a'] = $this->Jadwal_Model->tampil_jadwal_new('1',$id)->row();
		}else{
			$jadwal_a = json_encode(['rombel' => '--Pilih Rombel--','id' => '', 'id_dosen' => '', 'dosen' => '--Pilih Dosen--', 'hari' => '--Pilih Hari--', 'sesi' => '--Pilih Sesi--', 'ruang' => '--Pilih Ruang--', 'status' => '--Pilih Status--']);
			$jadwal['a'] = json_decode($jadwal_a);
		}
		if ($cek_b > 0) {
			# code...
			$jadwal['b'] = $this->Jadwal_Model->tampil_jadwal_new('2',$id)->row();
		}else{
			$jadwal_b = json_encode(['rombel' => '--Pilih Rombel--','id' => '','id_dosen' => '', 'dosen' => '--Pilih Dosen--', 'hari' => '--Pilih Hari--', 'sesi' => '--Pilih Sesi--', 'ruang' => '--Pilih Ruang--', 'status' => '--Pilih Status--']);
			$jadwal['b'] = json_decode($jadwal_b);
		} 
		if ($cek_c > 0) {
			# code...
			$jadwal['c'] = $this->Jadwal_Model->tampil_jadwal_new('3',$id)->row();
		}else{
			$jadwal_c = json_encode(['rombel' => '--Pilih Rombel--','id' => '','id_dosen' => '', 'dosen' => '--Pilih Dosen--', 'hari' => '--Pilih Hari--', 'sesi' => '--Pilih Sesi--', 'ruang' => '--Pilih Ruang--', 'status' => '--Pilih Status--']);
			$jadwal['c'] = json_decode($jadwal_c);
		}
		if ($cek_d > 0) {
			# code...
			$jadwal['d'] = $this->Jadwal_Model->tampil_jadwal_new('4',$id)->row();
		}else{
			$jadwal_d = json_encode(['rombel' => '--Pilih Rombel--','id' => '','id_dosen' => '', 'dosen' => '--Pilih Dosen--', 'hari' => '--Pilih Hari--', 'sesi' => '--Pilih Sesi--', 'ruang' => '--Pilih Ruang--', 'status' => '--Pilih Status--']);
			$jadwal['d'] = json_decode($jadwal_d);
		}
		if ($cek_e > 0) {
			# code...
			$jadwal['e'] = $this->Jadwal_Model->tampil_jadwal_new('5',$id)->row();
		}else{
			$jadwal_e = json_encode(['rombel' => '--Pilih Rombel--','id' => '','id_dosen' => '', 'dosen' => '--Pilih Dosen--', 'hari' => '--Pilih Hari--', 'sesi' => '--Pilih Sesi--', 'ruang' => '--Pilih Ruang--', 'status' => '--Pilih Status--']);
			$jadwal['e'] = json_decode($jadwal_e);
		}
		if ($cek_f > 0) {
			# code...
			$jadwal['f'] = $this->Jadwal_Model->tampil_jadwal_new('6',$id)->row();
		}else{
			$jadwal_f = json_encode(['rombel' => '--Pilih Rombel--','id' => '','id_dosen' => '', 'dosen' => '--Pilih Dosen--', 'hari' => '--Pilih Hari--', 'sesi' => '--Pilih Sesi--', 'ruang' => '--Pilih Ruang--', 'status' => '--Pilih Status--']);
			$jadwal['f'] = json_decode($jadwal_f);
		}
		$jadwal['hari_1'] = $this->db->get('master_hari')->result();
		$jadwal['sesi_1'] = $this->db->order_by('mulai', 'ASC')->get('master_jam')->result();
        $jadwal['ruang_1'] = $this->db->get('master_ruang')->result();
		$jadwal['rombel'] = $this->db->get_where('tbl_rombel', array('is_aktif' => 1))->result();
		$jadwal['dosen_1'] = $this->Jadwal_Model->list_dosen()->result();
        $data['content'] = $this->load->view('jadwal/v_input',$jadwal,true);
		
		$this->load->view('index',$data); 
	}
	function input_act(){
		$r = $this->Jadwal_Model->new_input();
			if ($r == 1) {
				# code...
				$this->session->set_userdata('jadwal_input', '');
				redirect('master/jadwal/input');
			}else{
				$this->session->set_userdata('jadwal_input', '');
				redirect('master/jadwal/input');
			}
	}
	function edit($kode_mk=''){
		$data['title'] = "Jadwal Matakuliah - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $jadwal['data'] = $this->db->query("SELECT master_jadwal_temp.*, master_jadwal_temp.id as ids_jadwal, concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as dosen FROM `master_jadwal_temp` LEFT JOIN pegawai_biodata on master_jadwal_temp.id_dosen = pegawai_biodata.id where master_jadwal_temp.kode_mata_kuliah = '$kode_mk' and master_jadwal_temp.status = 1 order by master_jadwal_temp.kode_jadwal ASC")->result();
        $jadwal['rombel'] = $this->db->get('tbl_rombel')->result();
        $jadwal['dosen_1'] = $this->Jadwal_Model->list_dosen()->result();
		$jadwal['hari_1'] = $this->db->get('master_hari')->result();
		$jadwal['sesi_1'] = $this->db->order_by('mulai', 'ASC')->get('master_jam')->result();
        $jadwal['ruang_1'] = $this->db->get('master_ruang')->result();
        $data['content'] = $this->load->view('jadwal/v_edit',$jadwal,true);
        $this->load->view('index',$data);
	}
	function editSave(){
		$id = $this->input->post('id');
		$rombel = $this->input->post('rombel');
		$id_dosen = $this->input->post('dosen');
		$hari = $this->input->post('hari');
		$sesi = $this->input->post('sesi');
		$ruang = $this->input->post('ruang');
		$status = $this->input->post('status');

		$data = [
					'rombel' => $rombel,
					'id_dosen' => $id_dosen,
					'hari' => $hari,
					'sesi' => $sesi,
					'ruang' => $ruang,
					'status' => $status
				];
		$cek = $this->db->get_where('master_jadwal_temp', ['id' => $id])->num_rows();
		if ($cek > 0) {
			$this->db->update('master_jadwal_temp', $data, ['id' => $id]);
			$r = 1;
		}else{
			$r = 0;
		}
		echo $r;
	}
	function update_act_new(){
		$r = $this->Jadwal_Model->new_update();
			if ($r == 1) {
				# code...
				$this->session->set_userdata('jadwal_input', '');
				redirect('master/jadwal/input');
			}else{
				$this->session->set_userdata('jadwal_input', '<script type="text/javascript">
                                                            alert("Data Jadwal gagal di tambahkan."); 
                                                        </script>');
				redirect('master/jadwal/input');
			}
	}
    function rombel(){
        $data['title'] = "Rombel - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $content['rombel'] = $this->db->get('tbl_rombel')->result();
        // var_dump($pertemuan['temu']);
        $data['content'] = $this->load->view('jadwal/rombel',$content,true);
        $this->load->view('index',$data);
    }
    function save_rombel(){
        $rombel = $this->input->post('rombel');
        $status = $this->input->post('status');
        $data = array(
                        'rombel' => $rombel,
                        'is_aktif' => $status
                     );
        $cek = $this->db->get_where('tbl_rombel', array('rombel' => $rombel));
        if ($cek->num_rows() > 0) {
            $this->db->update('tbl_rombel', $data, array('id' => $cek->row()->id));
        }else{
            $this->db->insert('tbl_rombel', $data);
        }
        redirect('master/jadwal/rombel');
    }
    function edit_rombel(){
        $id = $this->input->post('id');
        $rombel = $this->input->post('rombel');
        $status = $this->input->post('status');
        $data = array(
                        'rombel' => $rombel,
                        'is_aktif' => $status
                     );
        $this->db->update('tbl_rombel', $data, array('id' => $id));
       
        redirect('master/jadwal/rombel');
    }
    function rombel_delete($id=''){
        $this->db->delete('tbl_rombel', array('id' => $id));
        redirect('master/jadwal/rombel');
    }
    function rombel_edit($id=''){
        $data['title'] = "Rombel - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $content['r'] = $this->db->get_where('tbl_rombel', array('id' => $id))->row();
        $data['content'] = $this->load->view('jadwal/rombel_edit',$content,true);
        $this->load->view('index',$data);
    }
	function update($ids){
		$id = base64_decode(base64_decode($ids));
		$data['title'] = "Jadwal Matakuliah - Academic Portal";
		$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$jadwal['edit_jadwal'] = $this->Jadwal_Model->edit_jadwal($id)->result();
		$jadwal['hari'] = $this->db->get('master_hari')->result();
		$jadwal['sesi'] = $this->db->get('master_jam')->result();
		$jadwal['ruang'] = $this->db->get('master_ruang')->result();
		$data['content'] = $this->load->view('jadwal/v_update',$jadwal,true);
		$this->load->view('index',$data);
	}
	function update_act(){
		// echo $this->input->post('status');
		$r = $this->Jadwal_Model->update_jadwal();
		// echo $r;
			if ($r == 1) {
				# code...
				$this->session->set_userdata('jadwal_input', '<script type="text/javascript">
                                                            alert("Data Jadwal di Ubah."); 
                                                        </script>');
				redirect('master/jadwal/input');
			}else{
				$this->session->set_userdata('jadwal_input', '<script type="text/javascript">
                                                            alert("Data Jadwal gagal di Ubah."); 
                                                        </script>');
				redirect('master/jadwal/input');
			}
	}
    function delete_jadwal($id = ''){
        $this->db->update('master_jadwal_temp', array('status' => 0), array('id' => $id));
        redirect('master/jadwal/');
    }
}
?>
