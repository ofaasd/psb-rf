<style type="text/css">
/*body {font-family: Arial, Helvetica, sans-serif;}*/

/* The Modal (background) */
.modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1; /* Sit on top */
padding-top: 100px; /* Location of the box */
left: 120px;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
background-color: #fefefe;
margin: auto;
padding: 25px;
border: 1px solid #888;
width: 30%;
}

/* The Close Button */
.close {
color: #aaaaaa;
float: right;
font-size: 28px;
font-weight: bold;
}

.close:hover, 
.close:focus {
color: #000;
text-decoration: none;
cursor: pointer;
}
</style>
<div class="page-body">
<div class="row">
  <div class="col-sm-12">
      <div class="card">
          <div class="card-header">
              <h5>Daftar Matakuliah</h5>
          </div>
          <div class="card-block">
              <div class="dt-responsive table-responsive">
                <table class="table nowrap">
                  <thead>
                      <tr>
                          <th width="10px">No</th>
                          <th width="20px">Kode Mata Kuliah</th>
                          <th>Nama Mata Kuliah</th>
                          <th width="10px">SKS</th>
                          <th width="10px">Semester</th>
                          <th width="10px">Status</th>
                          <th style="text-align: right;">Nilai (Grade)</th>
                      </tr>
                  </thead>
                  <tbody>
                        <?php $no = 1; 
                        foreach($daftar as $t){?>
                          <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $t->kode_mata_kuliah ?></td>
                            <td><?php echo $t->nama_mata_kuliah ?></td>
                            <td><?php echo $t->jumlah_sks ?></td>
                            <td><?php echo $t->semester ?></td>
                            <td><?php
                                $cek_sudah = $this->db->select('master_krs.*, table_transkrip.*')
                                                      ->from('master_krs')
                                                      ->join('table_transkrip', 'master_krs.id_jadwal = table_transkrip.id_jadwal', 'left')
                                                      ->where(array('master_krs.mata_kuliah' => $t->nama_mata_kuliah,
                                                                    'master_krs.nim' => $this->session->userdata('nim')))
                                                      ->get();
                                $grade = '';
                                $sedang_diambil = $this->db->get_where('master_krs_temp', array('mata_kuliah' => $t->nama_mata_kuliah, 'nim' => $this->session->userdata('nim')))->num_rows();
                                if ($cek_sudah->num_rows() > 0) {
                                  echo "<font color='green'><b>Sudah diambil</b></font>";
                                  $grade = $this->openssl->convert("decrypt", $cek_sudah->row()->grade);
                                }elseif ($sedang_diambil > 0) {
                                  echo "<font color='orange'><b>Sedang Diambil</b></font>";
                                  $grade = '-';
                                }else{
                                  echo "Belum Diambil";
                                  $grade = '-';
                                }
                            ?></td>
                            <td style="text-align: right;"><?php echo $grade; ?></td>
                          </tr>
                        <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>
</div>
</div>

