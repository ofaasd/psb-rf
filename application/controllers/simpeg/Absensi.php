<?php
	class Absensi extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if(!$this->authact->logged_in())
			{
				redirect(base_url() . 'login/simpeg');
			}
			$this->load->model('Model_simpeg');
			$this->load->model('Model_pegawai');
			$this->load->model('simpeg/Model_menu_tree');
		}

		function index()
		{
			$data['title'] = "Dashboard - SIMPEG";
			$data['menu'] = $this->Model_simpeg->getMenu($this->authact->getRole());
			$hasil['menu_tree'] = $this->Model_menu_tree->get_all_p0();

			
			$hasil['query'] = $this->Model_pegawai->get_all();

			$data['content'] = $this->load->view('simpeg/absensi/index',$hasil,true);
			$this->load->view('index_simpeg',$data);
		}
		function upload(){
			$config['upload_path'] = './assets/absensi/';
		    $config['allowed_types'] = '*';
		    $config['max_size']  = '1024';
		    $config['overwrite'] = TRUE;
		    $config['file_name'] = 'absensi-'. date('YmdHis');
		    //$config['remove_space'] = TRUE;
		    $this->load->library('upload', $config); 
		    //$nama_foto = "";
		    if($this->upload->do_upload('file')){ 
		    	//$nama_foto = $config['file_name'].$config['file_ext'];
		    	echo "sukses";

		    }
		    $db_path = "./assets/absensi/". $config['file_name'] . ".dbf";
		    $dbh = dbase_open($db_path, 0)
		    or die("Error! Could not open dbase database file '$db_path'.");
		    $column_info = dbase_get_header_info($dbh);
			$this->import_dbf("sianu", "absensi", $db_path);
			redirect("/simpeg/absensi");	
		    // else{
		    // 	//echo $_FILES['file']['name'];
		    // 	$error = array('error' => $this->upload->display_errors());
      //           echo '<div class="alert alert-danger">'.$error['error'].'</div>';
		    // 	var_dump($config);
		    // 	echo "gagal";
		    // }
		}

		function import_dbf($db, $table, $dbf_file){
			if (!$dbf = dbase_open ($dbf_file, 0)) die("Could not open $dbf_file for import.");
			
			$num_rec = dbase_numrecords($dbf);
			$num_fields = dbase_numfields($dbf);
			$fields = array();

			for ($i=1; $i<=$num_rec; $i++){
				$row = @dbase_get_record_with_names($dbf,$i);
				$q = "insert into $db.$table values ('',";
				foreach ($row as $key => $val){
					if ($key == 'deleted'){ continue; }
					$q .= "'" . addslashes(trim($val)) . "',"; // Code modified to trim out whitespaces
				}
				if (isset($extra_col_val)){ $q .= "'$extra_col_val',"; }
				$q = substr($q, 0, -1);
				$q .= ')';
				//if the query failed - go ahead and print a bunch of debug info
				if (!$result = $this->db->query($q)){
					print ("error");
					print (substr_count($q, ',') + 1) . " Fields total.";
					$problem_q = explode(',', $q);
					$q1 = "desc $db.$table";
					$result1 = $this->db->query($q1);
					$columns = array();
					$i = 1;
					while ($row1 = $result->result()){
						$columns[$i] = $row1['Field'];
						$i++;
					}
					$i = 1;
					foreach ($problem_q as $pq){
						print "$i column: {$columns[$i]} data: $pq
						\n";
						$i++;
					}
					die();
				}
			}
		}
	}
?>