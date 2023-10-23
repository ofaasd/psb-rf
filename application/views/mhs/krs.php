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
                                                        <h5>Kartu Rencana Studi</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <b><?php echo $ta; ?> <font color="green">(Aktif)</font></b> &nbsp; <a href="<?php echo base_url();?>mhs/krs/cetak_krs">Download KRS</a> 
                                                        <div class="dt-responsive table-responsive">
                                                            <table class="table table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Kode</th>
                                                                    <th>Nama Matakuliah</th>
                                                                    <th>Jml SKS</th>
                                                                    <th>Hari, Jam</th>
                                                                    <th>Ruang</th>
                                                                    <th>Kehadiran</th>
                                                                    <!-- <th>Status</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1; $jumlah = 0; $val = 6.25; $kehadiran = 0;
                                                            foreach($krs as $a){
                                                                $presensi = 0; 
                                                                $get_status = $this->db->get_where('master_presensi', array('id_jadwal' => $a->jadwal_id, 'nim' => $this->session->userdata('nim')))->result();
                                                                foreach ($get_status as $get_status) {
                                                                  # code...
                                                                  if (empty($get_status->status) || $get_status->status == 3) {
                                                                    # code...
                                                                    $kehadiran = 0;
                                                                  }elseif ($get_status->status == 1 || $get_status->status == 2) {
                                                                    # code...
                                                                    $kehadiran = 1;
                                                                  }
                                                                  $presensi += $kehadiran * $val;
                                                                }
                                                              ?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a->kode_mata_kuliah ?></td>
                                                                    <td><?php echo $a->mata_kuliah ?></td>
                                                                    <td><?php echo $a->jumlah_sks ?></td>
                                                                    <td><?php echo $a->hari.', '.$a->sesi; ?></td>
                                                                    <td><?php echo urldecode($a->ruang) ?></td>
                                                                    <td><?php echo $presensi."% <a href='".base_url()."mhs/krs/detail_presensi/".$a->jadwal_id."'>Detail</a>"; ?></td>
                                                                    <!-- <td><?php if ($a->is_publish == 1) {
                                                                      # code...
                                                                      echo "Sudah di Verifikasi";
                                                                    }else{ echo "Belum Verifikasi"; } ?></td> -->
                                                                </tr>
                                                            <?php $jumlah += $a->jumlah_sks; } ?>
                                                            </tbody>
                                                          </table>
                                                          <table width="100%">
                                                            <tr>
                                                              <td align="right"><b>Jumlah SKS : <?php echo $jumlah; ?></b></td>
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
                                                                echo "<b>".$h->awal." - ".$h->akhir." ".$jenis."</b>";
                                                                $nim = $this->session->userdata('nim');
                                                                $krs_history = $this->mhs->history($nim, $ta_id);?>
                                                          <div class="dt-responsive table-responsive">
                                                            <table class="table table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <!-- <th>Dosen</th> -->
                                                                    <th>Kode</th>
                                                                    <th>Nama Matakuliah</th>
                                                                    <th>SKS</th>
                                                                    <th>Hari, Jam</th>
                                                                    <th>Ruang</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $jumlah_history = 0; foreach($krs_history as $krs_history){?>
                                                                <tr>
                                                                    <!-- <td><?php echo $krs_history->nama_dosen ?></td> -->
                                                                    <td><?php echo $krs_history->kode_mata_kuliah ?></td>
                                                                    <td><?php echo $krs_history->mata_kuliah ?></td>
                                                                    <td><?php echo $krs_history->jumlah_sks ?></td>
                                                                    <td><?php echo "-"; ?></td>
                                                                    <td><?php echo "-"; ?></td>
                                                                </tr>
                                                              <?php $jumlah_history += $krs_history->jumlah_sks; } ?>
                                                            </tbody>
                                                          </table>
                                                          <table width="100%">
                                                            <tr>
                                                              <td align="right"><b>Jumlah SKS : <?php echo $jumlah_history; ?></b></td>
                                                            </tr>
                                                          </table>
                                                        </div>
                                                      <?php }?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
