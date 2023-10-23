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
          width: 60%;
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
                                                    <?php 
                                                        echo $this->session->userdata('nilai'); 
                                                        $this->session->set_userdata('nilai','');
                                                    ?>
                                                <div class="card">
                                                    <div class="card-header">
                                                  <form action="<?php echo base_url().'krm/nilai/input_aksi'; ?>" method="post">
                                                      <input name="total_row" value="<?php echo $t_mhs; ?>" hidden="">
                                                      <input name="url" value="<?php echo $url_encode; ?>" hidden="">
                                                      <h5><?php 
                                                      foreach($matkul as $m){?>
                                                        <input name="id_jadwal" value="<?php echo $m->id; ?>" hidden="">
                                                        <input name="id_dosen" value="<?php echo $m->id_dosen; ?>" hidden="">
                                                          <table>
                                                            <tr>
                                                              <td>Matakuliah</td>
                                                              <td> : </td>
                                                              <td><?php echo $m->makul ?></td>
                                                            </tr>
                                                            <tr>
                                                              <td>Pengampu</td>
                                                              <td> : </td>
                                                              <td><?php echo $m->nama_dosen ?></td>
                                                            </tr>
                                                            <tr>
                                                              <td>Umumkan Nilai</td>
                                                              <td>:</td>
                                                              <td><a class="btn btn-primary" href="<?php echo base_url('krm/nilai/publish_nilai_uts/'.$m->id); ?>">UTS</a> <a class="btn btn-primary" href="<?php echo base_url('krm/nilai/publish_nilai_uas/'.$m->id); ?>">UAS</a></td>
                                                            </tr>
                                                            <tr>
                                                              <td>Validasi Nilai</td>
                                                              <td>:</td>
                                                              <td><a class="btn btn-primary" href="<?php echo base_url('krm/nilai/validasi_nilai_uts/'.$m->id); ?>">UTS</a> <a class="btn btn-primary" href="<?php echo base_url('krm/nilai/validasi_nilai_uas/'.$m->id); ?>">UAS</a></td>
                                                            </tr>
                                                          </table>
                                                        <?php }?>
                                                        <br>
                                                        <?php foreach($persentase as $p){?>
                                                        <table>
                                                          <tr>
                                                            <td>Persentase Nilai Tugas</td>
                                                            <td> : </td>
                                                            <td><?php echo $p->ntugas ?>%</td>
                                                          </tr>
                                                          <tr>
                                                            <td>Persentase Nilai UTS</td>
                                                            <td> : </td>
                                                            <td><?php echo $p->nuts ?>%</td>
                                                          </tr>
                                                          <tr>
                                                            <td>Persentase Nilai UAS</td>
                                                            <td> : </td>
                                                            <td><?php echo $p->nuas ?>%</td>
                                                          </tr>
                                                        </table>
                                                        <?php } ?></h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <a href="#" class="btn btn-primary" id="myBtn" style="text-align: right;"><font size="3px"><b>Set Persentase Nilai</b></font></a>
                                                        <!-- <a href="<?php echo base_url()?>krm/nilai" class="btn btn-success"><font style="color: white;">Kembali</font></a> -->
                                                        <div class="dt-responsive table-responsive">
                                                            <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>##</th>
                                                                    <th>NIM</th>
                                                                    <th>Nama Mahasiswa</th>
                                                                    <th>Status Bayar</th>
                                                                    <th>Nilai Harian</th>
                                                                    <th>Nilai UTS</th>
                                                                    <th>Nilai UAS</th>
                                                                    <th>Nilai Akhir</th>
                                                                    <th>Nilai Huruf</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1; $tgs = 0; $uts = 0; $uas = 0; $na = 0; $nh = 0; $nim = 0; $idjadwal = '';
                                                            foreach($r_mhs as $a){
                                                              $idjadwal = $a->id_jadwal; ?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><img src="<?php echo base_url('assets/foto_pmb_peserta/'.$a->foto_peserta); ?>" style="width: 45px; height: 60px;"></td>
                                                                    <td><?php echo $a->nim ?><br><span><i class="feather icon-phone"></i> <?php echo $a->hp; ?></span><input name="nim<?php echo $nim++?>" value="<?php echo $a->nim; ?>" hidden=""></td>
                                                                    <td><?php echo $a->nama ?></td>
                                                                    <td><?php if($a->is_bayar == 1){echo "LUNAS";}else{ echo "AKTIF KEUANGAN"; }; ?></td>
                                                                    <td><input style="width: 50px; text-align: center;" type="text" name="ntugas<?php echo $tgs++;?>" value="<?php if (!empty($a->ntugas)) {
                                                                            echo $this->openssl->convert("decrypt",$a->ntugas);
                                                                      }else{ echo ''; }?>"></input></td>

                                                                    <td>
                                                                    <?php if($a->is_bayar == 1){?>
                                                                    <input style="width: 50px; text-align: center;" type="text" name="nuts<?php echo $uts++;?>" value="<?php if (!empty($a->nuts)) {
                                                                          echo $this->openssl->convert("decrypt",$a->nuts);
                                                                    }else{ echo ''; }?>"></input>
                                                                    <?php }else{ 
                                                                      echo '<img src="'.base_url('assets/images/icon/del.png').'" width="20x" height="20px">';
                                                                      }
                                                                    ?></td>
                                                                    <td>
                                                                    <?php
                                                                      $get_presensi = $this->db->get_where('master_presensi', array('id_jadwal' => $idjadwal, 'nim' => $a->nim))->num_rows();
                                                                      $jumlah_presensi = $get_presensi * 7.142;
                                                                      if ($jumlah_presensi < 75) {
                                                                        # code...
                                                                        echo '<center><img src="'.base_url('assets/images/icon/del.png').'" width="20x" height="20px"></center>';
                                                                      }else{
                                                                    ?>
                                                                      <input style="width: 50px; text-align: center;" type="text" name="nuas<?php echo $uas++;?>" value="<?php if (!empty($a->nuas)) {
                                                                          echo $this->openssl->convert("decrypt",$a->nuas);
                                                                          }else{ echo ''; }?>"></input>
                                                                      <?php } ?>
                                                                    </td>
                                                                    <td><center><?php if (!empty($a->nakhir)) {
                                                                      $nakhir = $this->openssl->convert("decrypt",$a->nakhir);
                                                                      echo number_format($nakhir,2);
                                                                    }else{ echo ''; }?></center></td>

                                                                    <td><center><b><?php if (!empty($a->nhuruf)) {
                                                                      $nilai_huruf = $this->openssl->convert("decrypt",$a->nhuruf);
                                                                      if ($nilai_huruf == 'E') {
                                                                        echo '<font color="red">E</font>';
                                                                      }elseif ($nilai_huruf == 'D') {
                                                                        echo '<font color="brown">D</font>';
                                                                      }elseif ($nilai_huruf == 'C') {
                                                                        echo '<font color="orange">C</font>';
                                                                      }elseif ($nilai_huruf == 'B') {
                                                                        echo '<font color="green">B</font>';
                                                                      }elseif ($nilai_huruf == 'A') {
                                                                        echo '<font color="black">A</font>';
                                                                      }
                                                                    }else{ echo '<font color="red">E</font>'; }?></center></b></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>##</th>
                                                                    <th>NIM</th>
                                                                    <th>Nama Mahasiswa</th>
                                                                    <th>Status Bayar</th>
                                                                    <th>Nilai Harian</th>
                                                                    <th>Nilai UTS</th>
                                                                    <th>Nilai UAS</th>
                                                                    <th>Nilai Akhir</th>
                                                                    <th>Nilai Huruf</th>
                                                                </tr>
                                                            </tfoot>
                                                          </table>
                                                              <input type="submit" class="btn btn-success" value="Simpan" >
                                                          </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- The Modal -->
                                            <div id="myModal" class="modal">

                                              <!-- Modal content -->
                                              <div class="modal-content">
                                                <span class="close">&times;</span>
                                                  <form action="<?php echo base_url().'krm/nilai/set_persentase'; ?>" method="post">
                                                      <input name="id_jadwal" value="<?php echo $m->id; ?>" hidden="">
                                                      <input name="url" value="<?php echo $url_encode; ?>" hidden="">
                                                  <table class="table">
                                                    <tr>
                                                      <td><h5>Persentase Nilai Tugas</h5></td>
                                                      <td><h5> : </h5></td>
                                                      <td><input type="number" name="ptugas" class="form-control" placeholder="Persentase Nilai Tugas(%)"></td>
                                                    </tr>
                                                    <tr>
                                                      <td><h5>Persentase Nilai UTS</h5></td>
                                                      <td><h5> : </h5></td>
                                                      <td><input type="number" name="puts" class="form-control" placeholder="Persentase Nilai UTS(%)"></td>
                                                    </tr>
                                                    <tr>
                                                      <td><h5>Persentase Nilai UAS</h5></td>
                                                      <td><h5> : </h5></td>
                                                      <td><input type="number" name="puas" class="form-control" placeholder="Persentase Nilai UAS(%)"></td>
                                                    </tr>
                                                    <tr>
                                                      <td colspan="3"><b>NOTE : JUMLAH PERSENTASE NILAI TUGAS, UTS, DAN UAS HARUS 100%</b></td>
                                                    </tr>
                                                  </table>
                                                  <input type="submit" value="Simpan" class="btn btn-success">
                                                </form>
                                              </div>

                                            </div>
                                        </div>
                                    </div>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
