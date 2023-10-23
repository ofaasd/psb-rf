<?php
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use Zend\Crypt\Password\Bcrypt;
	class Mahasiswa extends CI_Controller{
		function __construct()
			{
				parent::__construct();
				if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
				$this->load->model('pmb_model/Model_pmb');
			}
		function index(){
			$data['title'] = "Mahasiswa - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$mhs['daftar_mhs'] = $this->db->get('mahasiswa')->result();
			$data['content'] = $this->load->view('list_mhs/list',$mhs,true);
			$this->load->view('index',$data);
		}
		function detail($nim = ''){
			$cek = $this->db->get_where('mahasiswa', array('nim' => $nim))->num_rows();
			if ($nim == '') {
				redirect('mahasiswa');
			}elseif ($cek == 0) {
				redirect('mahasiswa');
			}else{
				$data['title'] = "Mahasiswa - Academic Portal";
				$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
				$mhs['detail'] = $this->db->query("SELECT mahasiswa.*, wilayah.* FROM `mahasiswa` LEFT JOIN wilayah ON mahasiswa.provinsi = wilayah.id_wil or mahasiswa.kokab = wilayah.id_wil or mahasiswa.kecamatan = wilayah.id_wil LEFT JOIN pmb_peserta ON mahasiswa.nim = pmb_peserta.nim where mahasiswa.nim = '".$nim."'")->result_array();
				$mhs['wilayah'] = $this->db->get_where('wilayah', array('id_induk_wilayah' => '000000'))->result();
				$mhs['prodi'] = $this->db->get_where('program_studi', ['off' => 0])->result();
				$data['content'] = $this->load->view('list_mhs/detail',$mhs,true);
				$this->load->view('index',$data);
			}
		}
		function update(){
			$w = array('nim' => $this->input->post('nim'));
			$data = array(
							'nama' => $this->input->post('nama'),
							'telp' => $this->input->post('telp'),
							'hp' => $this->input->post('hp'),
							'id_program_studi' => $this->input->post('prodi'),
							'email' => $this->input->post('email'),
							'alamat' => $this->input->post('alamat'),
							'rt' => $this->input->post('rt'),
							'rw' => $this->input->post('rw'),
							'provinsi' => $this->input->post('provinsi'),
							'angkatan' => $this->input->post('angkatan'),
							'kokab' => $this->input->post('kokab'),
							'kecamatan' => $this->input->post('kecamatan'),
							'kelurahan' => $this->input->post('kelurahan'),
							'status' => $this->input->post('status'),
							'hp_ortu' => $this->input->post('hp_ortu'),
							'alamat_semarang' => $this->input->post('alamat_semarang')
						 );
			$r = $this->db->update('mahasiswa',$data,$w);
			if ($r) {
				# code...
				redirect('mahasiswa/detail/'.$this->input->post('nim'));
			}else{
				redirect('mahasiswa/detail/'.$this->input->post('nim'));
			}
		}
		function generate_password(){
			$cek = $this->db->get('mahasiswa')->result();
			$i = 1;
			foreach($cek as $row){
				
					$paswd = substr($row->nim,1,10);
					//echo $row->id;
					echo md5($paswd);
					$data = array(
						'paswd' => md5($paswd),
					);
					$w = array(
						'id' => $row->id,
					);
					$r = $this->db->update('mahasiswa',$data,$w);
					if($r){
						echo "berhasil";
					}
					echo "<br />";
					$i++;
			}
		}
		function generate_prodi(){
			$mhs = $this->db->get('mahasiswa')->result();
			foreach($mhs as $row){
				//echo $row->nim;
				
				if(substr($row->nim,0,2) == "A1"){
					//echo "D3 Farmasi";
					$jurusan = 1;
				}else{
					//echo "S1 Farmasi";
					$jurusan = 2;
				}
				echo $row->nim . "-";
				$kelas = 0;
				if(substr($row->nim,4,1) == '2'){
					$kelas = 1;
					echo 'reguler';
				}else{
					$kelas = 2;
					echo 'karyawan';
				}
				$array = array(
					'kelas' => $kelas,
					
				);
				echo $row->kelas;
				$tahun_angkatan = 20 . (substr($row->nim,2,2));
				/* $array = array(
					'id_program_studi' => $jurusan,
					'tahun_angkatan' => $tahun_angkatan,
				); */
				/* $update = $this->db->update('mahasiswa',$array,array('id'=>$row->id));
				if($update){
					echo "berhasil";
				}else{
					echo "gagal";
				} */
				echo "<br />";
			}
		}
	function upload_mhs(){
		error_reporting(0);
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		$bcrypt = new Bcrypt();
		// echo realpath('assets/ujian');
		$config['upload_path'] = 'assets/arsip/excel_mhs';
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
            redirect('mahasiswa');

        } else {

            $data_upload = $this->upload->data();

            $excelreader     = new PHPExcel_Reader_Excel2007();
            $loadexcel         = $excelreader->load('assets/arsip/excel_mhs/'.$data_upload['file_name']); // Load file yang telah diupload ke folder excel
            $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

            $data = array();

            $numrow = 0;
            foreach($sheet as $row){
                            if($numrow > 0){
                            	$nim = $row['B'];
                            	$nama = $row['C'];
                            	$no_ktp = $row['D'];
                            	if ($row['E'] == 'Laki-Laki') {
                            		$jk = 1;
                            	}else{
                            		$jk = 2;
                            	}

                            	if ($row['F'] == 'Islam') {
                            		$agama = 1;
                            	}elseif($row['F'] == 'Kristen'){
                            		$agama = 2;
                            	}
                            	elseif($row['F'] == 'Katolik'){
                            		$agama = 3;
                            	}elseif($row['F'] == 'Hindu'){
                            		$agama = 4;
                            	}elseif($row['F'] == 'Budha'){
                            		$agama = 5;
                            	}elseif($row['F'] == 'Konghucu'){
                            		$agama = 6;
                            	}elseif($row['F'] == 'Lainnya'){
                            		$agama = 99;
                            	}
                            	$tempat_lahir = $row['G'];
                            	$tgl_lahir = $row['H'];
                            	$nama_ibu = $row['I'];
                            	$nama_ayah = $row['J'];
                            	$hp_ortu = $row['K'];
                            	$alamat = $row['L'];
                            	$alamat_semarang = $row['M'];
                            	$rt = $row['N'];
                            	$rw = $row['O'];
                            	$kelurahan = $row['P'];
                            	$telp = $row['Q'];
                            	$hp = $row['R'];
                            	$email = $row['S'];
                            	if ($row['T'] == 'Aktif') {
                            		$status = 1;
                            	}elseif ($row['T'] == 'Cuti') {
                            		$status = 2;
                            	}elseif ($row['T'] == 'Keluar') {
                            		$status = 3;
                            	}elseif ($row['T'] == 'Lulus') {
                            		$status = 4;
                            	}elseif ($row['T'] == 'Meninggal') {
                            		$status = 5;
                            	}elseif ($row['T'] == 'DO') {
                            		$status = 6;
                            	}
                            	if ($row['W'] == 'Reguler') {
                            		$kelas = 1;
                            	}else{
                            		$kelas = 2;
                            	}
                            	$id_prodi = $this->db->get_where('program_studi', ['kode' => $row['U']])->row()->id;
                            	$ta = $this->db->get_where('master_tahun_ajaran', array('is_aktif' => 1))->row()->id;
                            	$angkatan = $row['V'];

                            	$data = array(
                            					'nim' => $nim,
                            					'nims' => $nim,
                            					'nama' => $nama,
                            					'no_ktp' => $no_ktp,
                            					'jk' => $jk,
                            					'agama' => $agama,
                            					'tempat_lahir' => $tempat_lahir,
                            					'tgl_lahir' => $tgl_lahir,
                            					'nama_ibu' => $nama_ibu,
                            					'nama_ayah' => $nama_ayah,
                            					'hp_ortu' => $hp_ortu,
                            					'alamat' => $alamat,
                            					'alamat_semarang' => $alamat_semarang,
                            					'rt' => $rt,
                            					'rw' => $rw,
                            					'kelurahan' => $kelurahan,
                            					'telp' => $telp,
                            					'hp' => $hp,
                            					'email' => $email,
                            					'paswd' => $bcrypt->create($nim),
                            					'status' => $status,
                            					'kelas' => $kelas,
                            					'angkatan' => $angkatan,
                            					'id_program_studi' => $id_prodi,
                            					'ta' => $ta
                            				 );
                            	$cek = $this->db->get_where('mahasiswa', ['nim' => $nim])->num_rows();
                            	if ($cek < 1) {
                            		$this->db->insert('mahasiswa', $data);
                            		$id_mhs = $this->db->get_where('mahasiswa', ['nim' => $nim])->row()->id;
                            		$data_mhs = array(
										'id_mahasiswa' => $id_mhs,
										'id_tahun_ajaran' => $ta,
									);
									$this->db->insert('master_keuangan_mhs',$data_mhs);
									$data_tagihan = array(
										'id_ta' => $ta,
										'nim' => $nim,
										'status' => 0
									);
									$this->db->insert('detail_tagihan', $data_tagihan);
	                            }
                    		}
               $numrow++;
            }
            // // var_dump($data);
            $index = count($data);
            unset($data[$index]);
            //delete file from server
            unlink(realpath('assets/arsip/excel_mhs'.$data_upload['file_name']));

            //upload success
            $this->session->set_userdata('notif', '<script type="text/javascript">
            swal("Berhasil!", "Upload File Berhasil", "success");
            </script>');
            // redirect halaman
            redirect('mahasiswa');
        }
	}
}
?>