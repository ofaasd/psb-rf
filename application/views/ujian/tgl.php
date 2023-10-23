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
                                                        <a href="<?php echo base_url('master/ujian/'); ?>" class="btn btn-warning">Kembali</a>
                                                        <hr>
                                                        <h5>Setting Tanggal Ujian</h5>
                                                    </div>
                                                    <div class="card-block">
                                                      <form method="post" action="<?php echo base_url('master/ujian/tgl_act'); ?>">
                                                        <?php $no = 1;
                                                            foreach($ujian as $a){?>
                                                            <input type="text" name="id" value="<?php echo $a->id;?>" hidden="">
                                                        <table width="50%">
                                                            <tr>
                                                              <td>Kode</td>
                                                              <td>:</td>
                                                              <td><?php echo $a->kode_mata_kuliah ?></td>
                                                            </tr>
                                                            <tr>
                                                              <td>Nama Mata Kuliah</td>
                                                              <td>:</td>
                                                              <td><?php echo $a->nama_mata_kuliah ?></td>
                                                            </tr>
                                                            <tr>
                                                              <td>Hari</td>
                                                              <td>:</td>
                                                              <td><?php echo $a->hari ?></td>
                                                            </tr>
                                                            <tr>
                                                              <td>Sesi</td>
                                                              <td>:</td>
                                                              <td><?php echo $a->sesi ?></td>
                                                            </tr>
                                                            <tr>
                                                              <td>Ruang</td>
                                                              <td>:</td>
                                                              <td><?php echo $a->ruang ?></td>
                                                            </tr>
                                                            <tr>
                                                              <td>Tanggal Ujian</td>
                                                              <td>:</td>
                                                              <td><input type="date" name="tgl" value="<?php echo $a->tgl_ujian ?>" class="form-control"></td>
                                                            </tr>
                                                            <tr>
                                                              <td>Jenis Ujian</td>
                                                              <td>:</td>
                                                              <td><select name="ju" class="form-control"><?php
                                                              if (empty($a->jenis_ujian)) {
                                                                # code...
                                                                echo "<option selected='' disabled=''>-- Jenis Ujian --</option>";
                                                              }else{
                                                                if ($a->jenis_ujian == 1) {
                                                                  # code...
                                                                  $jenis = "Ujian Tengah Semester";
                                                                }else{
                                                                  $jenis = "Ujian Akhir Semester";
                                                                }
                                                                echo "<option selected='' value='".$a->jenis_ujian."'>".$jenis."</option>";
                                                              }
                                                              ?>
                                                              <option value="1">Ujian Tengah Semester</option>
                                                              <option value="2">Ujian Akhir Semester</option>
                                                              </select></td>
                                                            </tr>
                                                            <tr>
                                                              <td colspan="3"><br><center><input type="submit" class="btn btn-success" value="Simpan"></center></td>
                                                            </tr>
                                                        </table>
                                                        <?php } ?>
                                                      </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
