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
                                                        <!-- <a href="<?php echo base_url()?>master/matakuliah/add" class="btn btn-success btn-round"><font style="color: white;">TAMBAH MATA KULIAH</font></a><hr> -->
                                                        <h5>Kartu Hasil Studi</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <b><?php echo $ta; ?> <font color="green">(Aktif)</font> <a href="<?php echo base_url();?>master/khs/cetak_khs">Download KHS</a></b>
                                                        <div class="dt-responsive table-responsive">
                                                            <table class="table table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Dosen</th>
                                                                    <th>Kode</th>
                                                                    <th>Nama Matakuliah</th>
                                                                    <th>SKS</th>
                                                                    <th>Tugas</th>
                                                                    <th>UTS</th>
                                                                    <th>UAS</th>
                                                                    <th>Nilai Akhir</th>
                                                                    <th>Nilai Huruf</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1; $jumlah_aktif = 0; $total_point_aktif = 0; $pecah_nhuruf = '';
                                                            foreach($khs as $a){
                                                              $v_tugas = ($a->validasi_tugas == 0)?'-':'v';
                                                              $v_uts = ($a->validasi_uts == 0)?'-':'v';
                                                              $v_uas = ($a->validasi_uas == 0)?'-':'v';
                                                              ?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a->nama_dosen ?></td>
                                                                    <td><?php echo $a->kode_mata_kuliah ?></td>
                                                                    <td><?php echo $a->mata_kuliah ?></td>
                                                                    <td><center><?php echo $a->jumlah_sks ?></center></td>
                                                                    <td><center><?php if (is_null($a->ntugas) || $a->publish_tugas == 0 || $a->keuangan == 0 || is_null($a->keuangan) || empty($a->keuangan)) {
                                                                      echo "- | ".$v_tugas; 
                                                                    }else{
                                                                      echo $a->ntugas.' | '.$v_tugas;
                                                                      } ?></center></td>
                                                                    <td><center><?php if(is_null($a->nuts) || $a->publish_uts == 0 || $a->keuangan == 0 || is_null($a->keuangan) || empty($a->keuangan)) {
                                                                      # code...
                                                                      echo "- | ".$v_uts;
                                                                    }else{
                                                                      echo $a->nuts.' | '.$v_uts;
                                                                      } ?></center></td>
                                                                    <td><center><?php if(is_null($a->nuas) || $a->publish_uas == 0 || $a->keuangan == 0 || is_null($a->keuangan) || empty($a->keuangan)) {
                                                                      # code...
                                                                      echo "- | ".$v_uas;
                                                                    }else{
                                                                      echo $a->nuas.' | '.$v_uas;
                                                                      } ?></center></td>
                                                                    <td><center><?php if (is_null($a->nakhir) || $a->publish_tugas == 0 || $a->publish_uts == 0 || $a->publish_uas == 0) {
                                                                      # code...
                                                                      echo "- | ".$v_uas;
                                                                    }else{
                                                                      echo $a->nakhir.' | '.$v_uas;
                                                                      } ?></center></td>
                                                                    <td><center><?php if (is_null($a->nhuruf) || $a->publish_tugas == 0 || $a->publish_uts == 0 || $a->publish_uas == 0) {
                                                                      # code...
                                                                      echo $nhuruf = "- | ".$v_uas;
                                                                    }else{
                                                                      $pecah_nhuruf = $a->nhuruf;
                                                                      // $pecah_nhuruf[1];
                                                                        if ($pecah_nhuruf == 'E') {
                                                                          echo '<font color="red">E</font>';
                                                                        }elseif ($pecah_nhuruf == 'D') {
                                                                          echo '<font color="brown">D</font>';
                                                                        }elseif ($pecah_nhuruf == 'CD') {
                                                                          echo '<font color="brown">CD</font>';
                                                                        }elseif ($pecah_nhuruf == 'C') {
                                                                          echo '<font color="orange">C</font>';
                                                                        }elseif ($pecah_nhuruf == 'BC') {
                                                                          echo '<font color="orange">BC</font>';
                                                                        }elseif ($pecah_nhuruf == 'B') {
                                                                          echo '<font color="green">B</font>';
                                                                        }elseif ($pecah_nhuruf == 'AB') {
                                                                          echo '<font color="green">AB</font>';
                                                                        }elseif ($pecah_nhuruf == 'A') {
                                                                          echo '<font color="black">A</font>';
                                                                        }
                                                                      } 
                                                                      $point_aktif = $this->bantuan->nbobot($pecah_nhuruf);
                                                                      $total_point_aktif += $point_aktif * $a->jumlah_sks;
                                                                      $jumlah_aktif += $a->jumlah_sks;
                                                                      ?></center></td>
                                                                </tr>
                                                            <?php } 
                                                              $ips_aktif = 0;
                                                              if($total_point_aktif == 0 || $jumlah_aktif == 0){
                                                                  $ips_aktif = 0;
                                                                }else{
                                                                    $ips_aktif = $total_point_aktif / $jumlah_aktif;
                                                                  }?>
                                                            </tbody>
                                                          </table>
                                                          <table width="100%">
                                                            <tr>
                                                              <td align="left"><b>Jumlah SKS : <?php echo $jumlah_aktif; ?></b></td>
                                                              <td align="right"><b>Indeks Prestasi Sementara (IPS) : <?php echo number_format($ips_aktif,2); ?></b></td>
                                                            </tr>
                                                          </table>
                                                        </div>
                                                        <?php 
                                                        foreach($ta_history as $h){?>
                                                          <hr>
                                                          <?php 
                                                                $ta_id = $h->id;
                                                                if ($h->jenis == 1) {
                                                                  # code...
                                                                  $jenis = 'Ganjil';
                                                                }elseif ($h->jenis == 2) {
                                                                  # code...
                                                                  $jenis = 'Genap';
                                                                }elseif ($h->jenis == 3) {
                                                                  # code...
                                                                  $jenis = 'Antara Ganjil Genap';
                                                                }elseif ($h->jenis == 4) {
                                                                  # code...
                                                                  $jenis = 'Antara Genap Ganjil';
                                                                }
                                                                echo "<b>".$h->awal." - ".$h->akhir." ".$jenis." <a href='". base_url('master/khs/cetak_khs_history/'.$ta_id.'-'.$nim) ."'>Download KHS</a></b>";
                                                                $nim = $this->session->userdata('nim');
                                                                $krs_history = $this->mhs->khs_history($nim, $ta_id);?>
                                                          <div class="dt-responsive table-responsive">
                                                            <table class="table table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>Dosen</th>
                                                                    <th>Kode</th>
                                                                    <th>Nama Matakuliah</th>
                                                                    <th>SKS</th>
                                                                    <th>Tugas</th>
                                                                    <th>UTS</th>
                                                                    <th>UAS</th>
                                                                    <th>Nilai Akhir</th>
                                                                    <th>Nilai Huruf</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $jumlah = 0; $total_point = 0; $nhuruf_ = ''; foreach($krs_history as $krs_history){?>
                                                                <tr>
                                                                    <td><?php echo $krs_history->nama_dosen ?></td>
                                                                    <td><?php echo $krs_history->kode_mata_kuliah ?></td>
                                                                    <td><?php echo $krs_history->mata_kuliah ?></td>
                                                                    <td><center><?php echo $krs_history->jumlah_sks ?></center></td>
                                                                    <td><center><?php echo round($krs_history->ntugas, 2); ?></center></td>
                                                                    <td><center><?php echo round($krs_history->nuts, 2); ?></center></td>
                                                                    <td><center><?php echo round($krs_history->nuas, 2); ?></center></td>
                                                                    <td><center><?php echo round($krs_history->nakhir, 2); ?></center></td>
                                                                    <td><center><?php if (empty($krs_history->nhuruf)) {
                                                                      # code...
                                                                      echo $nhuruf_ = "E";
                                                                    }else{
                                                                      $nhuruf_ = $krs_history->nhuruf;
                                                                        if ($nhuruf_ == 'E') {
                                                                          echo '<font color="red">E</font>';
                                                                        }elseif ($nhuruf_ == 'D') {
                                                                          echo '<font color="brown">D</font>';
                                                                        }elseif ($nhuruf_ == 'CD') {
                                                                          echo '<font color="brown">CD</font>';
                                                                        }elseif ($nhuruf_ == 'C') {
                                                                          echo '<font color="orange">C</font>';
                                                                        }elseif ($nhuruf_ == 'BC') {
                                                                          echo '<font color="orange">BC</font>';
                                                                        }elseif ($nhuruf_ == 'B') {
                                                                          echo '<font color="green">B</font>';
                                                                        }elseif ($nhuruf_ == 'AB') {
                                                                          echo '<font color="green">AB</font>';
                                                                        }elseif ($nhuruf_ == 'A') {
                                                                          echo '<font color="black">A</font>';
                                                                        }
                                                                      } 
                                                                      $point = $this->bantuan->nbobot($nhuruf_);
                                                                      $total_point += $point * $krs_history->jumlah_sks;
                                                                      $jumlah += $krs_history->jumlah_sks; ?></center></td>
                                                                </tr>
                                                              <?php }?>
                                                            </tbody>
                                                          </table>
                                                            <?php 
                                                              $ips = 0;
                                                              if($total_point == 0 || $jumlah == 0){
                                                                  $ips = 0;
                                                                }else{
                                                                    $ips = $total_point / $jumlah;
                                                                  }
                                                             $ips = $total_point / $jumlah;?>
                                                          <table width="100%">
                                                            <tr>
                                                              <td align="left"><b>Jumlah SKS : <?php echo $jumlah; ?></b></td>
                                                              <td align="right"><b>Indeks Prestasi Sementara (IPS) : <?php echo number_format($ips,2); ?></b></td>
                                                            </tr>
                                                          </table>
                                                        </div>
                                                      <?php }?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
