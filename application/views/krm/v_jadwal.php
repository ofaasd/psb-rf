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
                                                        <h5>Daftar Jadwal Mengajar</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Kode Mata Kuliah</th>
                                                                    <th>Nama Mata Kuliah</th>
                                                                    <th>Hari-Sesi(Ruang)</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($jadwal as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a->kode_mata_kuliah ?></td>
                                                                    <td><?php echo $a->matkul ?></td>
                                                                    <td><?php echo $a->hari.' - '.$a->sesi.' ('.$a->ruang.')'; ?></td>
                                                                    <td>
                                                                        <a href="<?php echo base_url()?>krm/nilai/input/<?php echo str_replace('=','',base64_encode(base64_encode($a->matkul.'-'.$a->hari.'-'.$a->sesi.'-'.$a->ruang.'-'.$dosen.'-'.$a->id))); ?>" class="btn btn-primary">INPUT NILAI</a>
                                                                        <a href="" class="btn btn-success">CETAK NILAI</a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Kode Mata Kuliah</th>
                                                                    <th>Nama Mata Kuliah</th>
                                                                    <th>Hari-Sesi(Ruang)</th>
                                                                    <th></th>
                                                                </tr>
                                                            </tfoot>
                                                          </table>
                                                        </div>
                                                        <h5>KRM SEBELUMNYA</h5><hr>
                                                        <?php foreach ($ta as $t): 
                                                          if ($t->jenis == 1) {
                                                              $jenis = "Ganjil";
                                                          }elseif ($t->jenis == 2) {
                                                              $jenis = "Genap";
                                                          }elseif ($t->jenis == 3) {
                                                              $jenis = "Antara Ganjil Genap";
                                                          }else{
                                                            $jenis = "Antara Genap Ganjil";
                                                          }
                                                          $get_jadwal = $this->db->select('master_jadwal.*, master_mata_kuliah.*')
                                                                                 ->from('master_jadwal')
                                                                                 ->join('master_mata_kuliah', 'master_jadwal.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah', 'left')
                                                                                 ->where(array('master_jadwal.id_tahun' => $t->id, 'master_jadwal.id_dosen' => $dosen))
                                                                                 ->get()->result();
                                                        ?>
                                                          <p><?php echo "Tahun Ajaran ".$t->awal.'-'.$t->akhir.' ['.$jenis.']'; ?></p>
                                                          <table class="table table-striped table-bordered nowrap">
                                                              <tr>
                                                                  <th>No</th>
                                                                  <th>Kode Mata Kuliah</th>
                                                                  <th>Nama Mata Kuliah</th>
                                                                  <th>Hari-Sesi(Ruang)</th>
                                                              </tr>
                                                              <?php $n=1; foreach ($get_jadwal as $g): ?>
                                                                <tr>
                                                                    <td><?php echo $n++ ?></td>
                                                                    <td><?php echo $g->kode_mata_kuliah ?></td>
                                                                    <td><?php echo $g->nama_mata_kuliah ?></td>
                                                                    <td><?php echo $g->hari.'-'.$g->sesi.'('.$g->ruang.')'; ?></td>
                                                                </tr>
                                                              <?php endforeach ?>
                                                          </table>
                                                        <?php endforeach ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
