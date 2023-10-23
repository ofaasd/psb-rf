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
                                                        <h5>Kartu Ujian</h5>
                                                    </div>

                                                    <div class="card-block"> &nbsp; <a href="<?php echo base_url();?>mhs/ujian/cetak_ujian">Download Kartu Ujian</a> 
                                                        <div class="dt-responsive table-responsive">
                                                            <table class="table table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="3"><center>No</center></th>
                                                                    <th rowspan="3"><center>Kode</center></th>
                                                                    <th rowspan="3"><center>Nama Matakuliah</center></th>
                                                                    <th rowspan="3"><center>Jml SKS</center></th>
                                                                    <th rowspan="3"><center>Ruang</center></th>
                                                                    <th rowspan="3"><center>No. Kursi</center></th>
                                                                    <th colspan="2"><center>Tanggal Ujian UTS</center></th>
                                                                    <th colspan="2"><center>Tanggal Ujian UAS</center></th>
                                                                </tr>
                                                               <!--<tr>
                                                                  <th colspan="2"><center>Teori</center></th>
                                                                  <th colspan="2"><center>Praktek</center></th>
                                                                  <th colspan="2"><center>Teori</center></th>
                                                                  <th colspan="2"><center>Praktek</center></th>
                                                                </tr>-->
                                                                <tr>
                                                                  <td><center>Tanggal</center></td>
                                                                  <td><center>Waktu</center></td>
                                                                  <td><center>Tanggal</center></td>
                                                                  <td><center>Waktu</center></td>
                                                                  <!--<td><center>Tanggal</center></td>
                                                                  <td><center>Waktu</center></td>
                                                                  <td><center>Tanggal</center></td>
                                                                  <td><center>Waktu</center></td>-->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1; $jumlah = 0; $val = 6.25; $presensi = 0; $kehadiran = 0;
                                                            foreach($detail as $a){
                                                                $get_status = $this->db->get_where('master_presensi', array('id_jadwal' => $a->jadwal_id, 'nim' => $this->session->userdata('nim')))->result();
                                                                // var_dump($get_status);
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
                                                                    <td><center><?php echo $a->jml_sks ?></center></td>
                                                                    <td><center><?php echo $a->ruang ?></center></td>
                                                                    <td><center><?php echo $a->no_kursi ?></center></td>
                                                                    <td><center><?php 
                                                                        if($m->uts == 0){
                                                                          echo "<font size='1px' color='red'><i>Aktif Keuangan</i></font>";
                                                                        }elseif (($a->tanggal_uts_t == '0000-00-00') || is_null($a->tanggal_uts_t) || empty($a->tanggal_uts_t)) {
                                                                            echo '-';
                                                                        }else{
                                                                            echo date_format(date_create($a->tanggal_uts_t),"d-m-Y");
                                                                        }
                                                                    ?></center></td>
                                                                    <td><center><?php 
                                                                        if($m->uts == 0){
                                                                          echo "<font size='1px' color='red'><i>Aktif Keuangan</i></font>";
                                                                        }elseif (($a->id_jam_uts_t == 0) || is_null($a->id_jam_uts_t) || empty($a->id_jam_uts_t)) {
                                                                            echo '-';
                                                                        }else{
                                                                            echo $this->bantuan->jam($a->id_jam_uts_t);
                                                                        }
                                                                    ?></center></td>
                                                                    <td><center><?php 
                                                                        if($presensi < 75){
                                                                          echo "<font size='1px' color='red'><i>Kehadiran kurang dari 75%</i></font>";
                                                                        }elseif (($a->tanggal_uas_t == '0000-00-00') || is_null($a->tanggal_uas_t) || empty($a->tanggal_uas_t)) {
                                                                            echo '-';
                                                                        }elseif($m->uas == 0){
                                                                            echo "<font size='1px' color='red'><i>Belum dibuka</i></font>";
                                                                        }else{
                                                                            echo date_format(date_create($a->tanggal_uas_t),"d-m-Y");
                                                                        }
                                                                    ?></center></td>
                                                                    <td><center><?php 
                                                                        if($presensi < 75){
                                                                          echo "<font size='1px' color='red'><i>Kehadiran kurang dari 75%</i></font>";
                                                                        }elseif (($a->id_jam_uas_t == 0) || is_null($a->id_jam_uas_t) || empty($a->id_jam_uas_t)) {
                                                                            echo '-';
                                                                        }elseif($m->uas == 0){
                                                                            echo "<font size='1px' color='red'><i>Belum dibuka</i></font>";
                                                                        }else{
                                                                            echo $this->bantuan->jam($a->id_jam_uas_t);
                                                                        }
                                                                    ?></center></td>
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
                                    
