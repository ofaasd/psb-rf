<?php
class Keuangan_mhs extends CI_Controller
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
				$this->load->model('Model_keuangan');
        }
    function index(){
        $data['title'] = "Keuangan - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$keuangan['keuangan'] = $this->Model_keuangan->get_all();
        $data['content'] = $this->load->view('keuangan/v_new_keuangan',$keuangan,true);
        $this->load->view('index',$data);
	}
	function generate(){
		$data = $this->Model_keuangan->generate_keuangan();
		if($data == 1){
			$this->session->set_userdata('uang', '<script type="text/javascript">
                                                            alert("Berhasil Generate Data"); 
                                                        </script>');
			redirect('master/keuangan_mhs');
		}else{
			$this->session->set_userdata('uang', '<script type="text/javascript">
                                                            alert("Data Sudah Ada"); 
                                                        </script>');
			redirect('master/keuangan_mhs');
		}
	}
	function detail($id=''){
		error_reporting(0);
		$data['title'] = "Keuangan - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $mhs = $this->db->get_where('mahasiswa', array('id' => $id));
        if ($mhs->num_rows() > 0) {
        	$nim = $mhs->row()->nim;
        }else{
        	$nim = 0;
        }
        $pmb = $this->db->get_where('master_keuangan_temp', array('nim' => $nim));
        $k['nom_thp_1'] = 0;
        $k['tgl_thp_1'] = date_format(date_create(date('Y-m-d')), 'd-m-Y');
        $k['stat_thp_1'] = 'Lunas';
        $k['nom_thp_2'] = 0;
        $k['tgl_thp_2'] = date_format(date_create(date('Y-m-d')), 'd-m-Y');
        $k['stat_thp_2'] = 'Lunas';
        $k['nom_thp_3'] = 0;
        $k['tgl_thp_3'] = date_format(date_create(date('Y-m-d')), 'd-m-Y');
        $k['stat_thp_3'] = 'Lunas';
        if ($pmb->num_rows() > 0) {
        	$pq = $pmb->row();
        	$stat1 = 'Belum';
        	$stat2 = 'Belum';
        	$stat3 = 'Belum';
        	if ($pq->status_tahap_1 == 1) {
        		$stat1 = 'Terbayar';
        	}
        	if ($pq->status_tahap_2 == 1) {
        		$stat2 = 'Terbayar';
        	}
        	if ($pq->status_tahap_3 == 1) {
        		$stat3 = 'Terbayar';
        	}
        	$k['nom_thp_1'] = $pq->jml_tahap_1;
	        $k['tgl_thp_1'] = date_format(date_create($pq->tgl_tahap_1), 'd-m-Y');
	        $k['stat_thp_1'] = $stat1;
	        $k['nom_thp_2'] = $pq->jml_tahap_2;
	        $k['tgl_thp_2'] = date_format(date_create($pq->tgl_tahap_2), 'd-m-Y');
	        $k['stat_thp_2'] = $stat2;
	        $k['nom_thp_3'] = $pq->jml_tahap_3;
	        $k['tgl_thp_3'] = date_format(date_create($pq->tgl_tahap_3), 'd-m-Y');
	        $k['stat_thp_3'] = $stat3;
        }
        $k['m'] = $this->db->get_where('mahasiswa', array('id' => $id))->row();
        $k['tagihan'] = $this->db->get_where('pmb_keuangan', array('kelas' => $mhs->row()->kelas))->result_array();
        $q_sks = $this->db->select('sum(sks) as jml_sks')->get_where('master_krs_temp', array('nim' => $nim))->row()->jml_sks;
        if (is_null($q_sks)) {
        	$k['sks'] = 0;
        }else{
        	$k['sks'] = $q_sks;
        }
        $k['id_mhs'] = $id;
        $k['keuangan'] = $this->Model_keuangan->get_by_id($id)->result();
		$ta = $this->db->get_where('master_tahun_ajaran', array('is_aktif' => 1))->row()->id;
        $cek = $this->db->get_where('detail_tagihan', array('id_ta' => $ta, 'nim' => $nim));
        $k['terbayar'] = 0;
    	$k['batas_tgl'] = '';
    	$k['status'] = 0;
        if ($cek->num_rows() > 0) {
        	$k['terbayar'] = $cek->row()->terbayar;
        	$k['batas_tgl'] = $cek->row()->tgl;
        	$k['status'] = $cek->row()->status;
        	
        }
        $k['aktif'] = $this->db->get_where('tagihan', array('id_mhs' => $id, 'ta' => $ta))->result();
        // var_dump($k['tagihan']);
        $data['content'] = $this->load->view('keuangan/detail',$k,true);
        $this->load->view('index',$data);
	}
	function simpan_tagihan(){
		$ta = $this->db->get_where('master_tahun_ajaran', array('is_aktif' => 1))->row()->id;
		$id_mhs = $this->input->post('id_mhs');
		$nim = $this->db->get_where('mahasiswa', array('id' => $id_mhs))->row()->nim;
		$terbayar = $this->input->post('terbayar');
		$total = $this->input->post('total');
		$sisa = $total - $terbayar;
		$tgl = $this->input->post('tgl');
		$status = $this->input->post('status');

		if ($status == 1) {
			$q = $this->db->get_where('tagihan', array('ta' => $ta, 'id_mhs' => $id_mhs))->result();
			foreach ($q as $q) {
				if ($q->jenis == 'TAHAP I') {
					$this->db->update('master_keuangan_temp', array('status_tahap_1' => 1), array('nim' => $nim));
				}
				if ($q->jenis == 'TAHAP II') {
					$this->db->update('master_keuangan_temp', array('status_tahap_2' => 1), array('nim' => $nim));
				}
				if ($q->jenis == 'TAHAP III') {
					$this->db->update('master_keuangan_temp', array('status_tahap_3' => 1), array('nim' => $nim));
				}
			}
		}

		$data = array(
						'id_ta' => $ta,
						'nim' => $nim,
						'total' => $total,
						'tgl' => $tgl, 
						'terbayar' => $terbayar,
						'sisa' => $sisa,
						'status' => $status
					);
		$cek = $this->db->get_where('detail_tagihan', array('id_ta' => $ta, 'nim' => $nim))->num_rows();
		if ($cek > 0) {
			$this->db->update('detail_tagihan', $data, array('id_ta' => $ta, 'nim' => $nim));
		}else{
			$this->db->insert('detail_tagihan', $data);
		}
		redirect('master/keuangan_mhs/detail/'.$id_mhs);
	}
	function hapus_tagihan($id=''){
		$id_mhs = $this->db->get_where('tagihan', array('id' => $id))->row()->id_mhs;
		$this->db->delete('tagihan', array('id' => $id));
		$this->session->set_userdata('notif_tagihan', '<script type="text/javascript">
            swal("", "Berhasil Menghapus Tagihan", "success");
            </script>');
		redirect('master/keuangan_mhs/detail/'.$id_mhs);
	}
	function tambah_tagihan($slug=''){
		$s = explode('-', $slug);
		$nominal = $s[0];
		$jenis = str_replace('_', ' ', $s[1]);
		$id_mhs = $s[2];
		$ta = $this->db->get_where('master_tahun_ajaran', array('is_aktif' => 1))->row()->id;
		$data = array(
						'id_mhs' => $id_mhs,
						'jenis' => $jenis,
						'nominal' => $nominal,
						'ta' => $ta
					 );
		$cek = $this->db->get_where('tagihan', $data)->num_rows();
		if ($cek > 0) {
			$this->session->set_userdata('notif_tagihan', '<script type="text/javascript">
            swal("", "Gagal Menambahkan Tagihan", "error");
            </script>');
		}else{
			$this->db->insert('tagihan', $data);
			$this->session->set_userdata('notif_tagihan', '<script type="text/javascript">
            swal("", "Berhasil Menambahkan Tagihan", "success");
            </script>');
		}
		redirect('master/keuangan_mhs/detail/'.$id_mhs);
	}
	function ubah_krs(){
		$id = $this->input->post("id");
		$krs = $this->input->post("krs");
		$ta = $this->db->get_where('master_tahun_ajaran', array('is_aktif' => 1))->row()->id;
		$cek = $this->db->get_where('master_keuangan_mhs', array('id_mahasiswa'=>$id, 'id_tahun_ajaran' => $ta ))->num_rows();
		if ($cek > 0) {
			$r = $this->db->update('master_keuangan_mhs',array('krs'=>$krs), array('id_mahasiswa'=>$id, 'id_tahun_ajaran' => $ta));
		}else{
			$r = $this->db->insert('master_keuangan_mhs', array('krs'=>1,'id_mahasiswa'=>$id));
		}
		
		if($r){
			echo 1;
		}else{
			echo 0;
		}
	}
	function ubah_uts(){
		$id = $this->input->post("id");
		$uts = $this->input->post("uts");
		$ta = $this->db->get_where('master_tahun_ajaran', array('is_aktif' => 1))->row()->id;
		$cek = $this->db->get_where('master_keuangan_mhs', array('id_mahasiswa'=>$id, 'id_tahun_ajaran' => $ta ))->num_rows();
		if ($cek > 0) {
			$r = $this->db->update('master_keuangan_mhs',array('uts'=>$uts), array('id_mahasiswa'=>$id, 'id_tahun_ajaran' => $ta));
		}else{
			$r = $this->db->insert('master_keuangan_mhs', array('uts'=>1,'id_mahasiswa'=>$id));
		}
		
		if($r){
			echo 1;
		}else{
			echo 0;
		}
	}
	function ubah_uas(){
		$id = $this->input->post("id");
		$uas = $this->input->post("uas");
		$ta = $this->db->get_where('master_tahun_ajaran', array('is_aktif' => 1))->row()->id;
		$cek = $this->db->get_where('master_keuangan_mhs', array('id_mahasiswa'=>$id, 'id_tahun_ajaran' => $ta ))->num_rows();
		if ($cek > 0) {
			$r = $this->db->update('master_keuangan_mhs',array('uas'=>$uas), array('id_mahasiswa'=>$id, 'id_tahun_ajaran' => $ta));
		}else{
			$r = $this->db->insert('master_keuangan_mhs', array('uas'=>1,'id_mahasiswa'=>$id));
		}
		
		if($r){
			echo 1;
		}else{
			echo 0;
		}
	}
	
}
?>