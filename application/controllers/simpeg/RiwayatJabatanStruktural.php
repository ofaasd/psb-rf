<?php

	use Zend\Crypt\Password\Bcrypt;

	class RiwayatJabatanStruktural extends CI_Controller
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
		}
		function index(){
			$hasil['npp'] = $this->Model_simpeg->getAllNpp();
			//$hasil['riwayat_tree'] = $this->load->view('simpeg/manage/riwayat_tree',NULL,true);
			$hasil['url'] = "RiwayatJabatanStruktural/all";
			$this->load->view('simpeg/manage/content_profil',$hasil);

			//$this->load->view('index_simpeg',$data);
		}
		function all($id){
			$id = $this->Model_simpeg->getIdPegawai($id);
			$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->Model_simpeg->getRiwayatStruktural($id);
			$hasil['jabatan_struktural'] = $this->Model_simpeg->getJabatanStruktural();
			$hasil['unit_kerja'] = $this->Model_simpeg->getUnitKerja();
			$hasil['id_pegawai'] = $id;
			
			$this->load->view('simpeg/struktural/index',$hasil);
		}
		function insert(){
			$riwayat = array(
				"id_pegawai" => $this->input->post("id_pegawai"),
				"unit_kerja" => $this->input->post("unit_kerja"),
				"id_jabatan_struktural" => $this->input->post("id_jabatan_struktural"),
				"no_sk_struktural" => $this->input->post("no_sk"),
				"tanggal_sk_struktural" => $this->input->post("tgl_sk"),
				"tmt_sk_struktural" => $this->input->post("tmt_sk"),
				"status" => $this->input->post("status"),
			);
			$r = $this->db->insert('pegawai_jabatan_struktural', $riwayat);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function refresh(){
			$id = $this->input->get("id");
			$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->Model_simpeg->getRiwayatStruktural($id);
			$hasil['fakultas'] = $this->Model_simpeg->getFakultas();
			$hasil['jabatan_struktural'] = $this->Model_simpeg->getJabatanStruktural();
			$this->load->view('simpeg/struktural/tbl_riwayat',$hasil);
		}
		function update(){
			$id = $this->input->post("id");
			$id_pegawai = $this->input->post("id_pegawai");
			$where_riwayat = array("id"=>$id);
			$where_pegawai = array("id_pegawai" => $id_pegawai);
			$status = $this->input->post("status");
			
			$riwayat = array(
				"unit_kerja" => $this->input->post("unit_kerja"),
				"id_jabatan_struktural" => $this->input->post("id_jabatan_struktural"),
				"no_sk_struktural" => $this->input->post("no_sk"),
				"tanggal_sk_struktural" => $this->input->post("tgl_sk"),
				"tmt_sk_struktural" => $this->input->post("tmt_sk"),
				"status" => $status,	
			);
			$r = $this->db->update('pegawai_jabatan_struktural',$riwayat,$where_riwayat);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function delete(){
			$id = array(
				"id"=>$this->input->post("id"),
			);
			$r = $this->db->delete("pegawai_jabatan_struktural",$id);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function get_bagian(){
			$id_unit = $this->input->post("id_unit");
			$bagian = $this->Model_simpeg->getBagianStruktural($id_unit);
			echo '<select class="form-control" name="bagian" id="edit_bagian">
                    <option value="0">-- Bagian --</option>
                   ';
                        foreach($bagian as $row){
                            echo "<option value='" . $row->id . "' ";
                            echo ">" . $row->nama_bagian . "</option>";
                        }
            echo '</select>';
		}
		function get_jenis_jabatan(){
			$id_unit = $this->input->post("id_unit");
			$id_bagian = $this->input->post("id_bagian");
			$jenis_jabatan = $this->Model_simpeg->getJenisJabatan($id_unit);
			echo '<select class="form-control" name="jenis_jabatan" id="edit_jenis_jabatan" >
                    <option value="0">-- Jenis Jabatan --</option>';
                        foreach($jenis_jabatan as $row){
                            
                            if($id_bagian != 5){
                            	echo "<option value='" . $row->id . "' ";
                            	echo ">" . $row->nama_jenis . "</option>";
                                break;
                            }else{
                            	echo "<option value='" . $row->id . "' ";
                            	echo ">" . $row->nama_jenis . "</option>";
                            }
                        }
            echo '</select>';
		}
		function get_jabatan_struktural(){
			$id_bagian = $this->input->post("id_bagian");
			$id_jenis_jabatan = $this->input->post("id_jenis_jabatan");
			$jabatan_struktural = $this->Model_simpeg->getJabatan($id_bagian,$id_jenis_jabatan);
			echo '<select class="form-control" name="jabatan_struktural" id="edit_jabatan">
                    <option value="0">-- Jabatan Struktural --</option>';
                    
                    foreach($jabatan_struktural as $jabatan){
                    echo "<option value='" . $jabatan->id . "'";
                    echo ">" . $jabatan->nama_jabatan . "</option>";
                    }
            echo "</select>";
		}
		function edit_form(){
			$id = $this->input->post("id");
			$where = array("id"=>$id);
			$hasil['row'] = $this->db->get_where("pegawai_jabatan_struktural",$where)->row();
			
			$hasil['id_pegawai'] = $hasil['row']->id_pegawai;
			$hasil['curr_jabatan'] = $this->Model_simpeg->getDetailJabatan($hasil['row']->id_jabatan_struktural);
			$hasil['unit_kerja'] = $this->Model_simpeg->getUnitKerja();
			$hasil['bagian'] = $this->Model_simpeg->getBagianStruktural($hasil['curr_jabatan']->id_unit_kerja);
			$hasil['jenis_jabatan'] = $this->Model_simpeg->getJenisJabatan($hasil['curr_jabatan']->id_unit_kerja);
			$hasil['jabatan_struktural'] = $this->Model_simpeg->getJabatan($hasil['curr_jabatan']->id_bagian,$hasil['curr_jabatan']->id_jenis_jabatan);

			$this->load->view('simpeg/struktural/form_edit',$hasil);
		}
		function updatedokumen(){
			$id = $this->input->post("id");
			$config['upload_path'] = './assets/images/struktural/';
		    $config['allowed_types'] = 'gif|jpg|png|pdf';
		    $config['max_size']  = '10480';
		    $config['overwrite'] = TRUE;
		    $config['file_name'] = 'dokumen-'. date('YmdHis');
		    //$config['remove_space'] = TRUE;
		    $this->load->library('upload', $config); 
		    //$nama_foto = "";
		    if($this->upload->do_upload('dokumen')){
		    	$nama_foto = $this->upload->data("file_name"); 
		    	$riwayat = array(
					"dokumen" => $nama_foto,
				);
				$where_biodata = array("id"=>$id);
				$r = $this->db->update('pegawai_jabatan_struktural', $riwayat,$where_biodata);
				if($r){
					echo 1;
				}else{
					echo 2;
				}
		    }else{
				echo "gagal upload";
			}
		}
	}
?>