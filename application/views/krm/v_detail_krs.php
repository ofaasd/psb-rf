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
                                                        <h5>Daftar KRS yang di ajukan.</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <table width="40%">
                                                          <tr>
                                                            <td>NIM</td>
                                                            <td>:</td>
                                                            <td><?php echo $detail_mhs->nim ?></td>
                                                          </tr>
                                                          <tr>
                                                            <td>Nama Mahasiswa</td>
                                                            <td>:</td>
                                                            <td><?php echo $detail_mhs->nama ?></td>
                                                          </tr>
                                                          <tr>
                                                            <td>No. HP</td>
                                                            <td>:</td>
                                                            <td><?php echo $detail_mhs->telpon ?></td>
                                                          </tr>
                                                          <tr>
                                                            <td>Status Validasi</td>
                                                            <td>:</td>
                                                            <td><?php if ($detail_mhs->is_publish == 1) {
                                                              echo "Sudah Validasi";
                                                            }else{
                                                              echo "Belum Validasi";
                                                              } ?></td>
                                                          </tr>
                                                        </table>
                                                        <br>
                                                        <a href="<?php echo base_url('krm/validasi/save/'. $detail_mhs->nim); ?>" class="btn btn-primary">Validasi</a>
                                                        <hr>
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Kode Mata Kuliah</th>
                                                                    <th>Nama Mata Kuliah</th>
                                                                    <th>SKS</th>
                                                                    <th>Kelas</th>
                                                                    <th>Waktu</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($detail_krs as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a->kode_mata_kuliah ?></td>
                                                                    <td><?php echo $a->mata_kuliah ?></td>
                                                                    <td><?php echo $a->sks ?></td>
                                                                    <td><?php echo $a->kelas ?></td>
                                                                    <td><?php echo $a->hari.', '.$a->sesi; ?></td>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Kode Mata Kuliah</th>
                                                                    <th>Nama Mata Kuliah</th>
                                                                    <th>SKS</th>
                                                                    <th>Kelas</th>
                                                                    <th>Waktu</th>
                                                                </tr>
                                                            </tfoot>
                                                          </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
