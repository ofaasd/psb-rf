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
                                                        <div class="dt-responsive table-responsive">
                                                            <table width="60%">
                                                              <tr>
                                                                <td>Matakuliah</td>
                                                                <td> : </td>
                                                                <td> <?php echo $jadwal->mata_kuliah ?> </td>
                                                              </tr>
                                                              <tr>
                                                                <td>SKS</td>
                                                                <td> : </td>
                                                                <td> <?php echo $jadwal->sks ?> </td>
                                                              </tr>
                                                              <tr>
                                                                <td>Hari, Jam & Ruang</td>
                                                                <td> : </td>
                                                                <td> <?php echo $jadwal->hari.", ".$jadwal->sesi." ".$jadwal->ruang; ?> </td>
                                                              </tr>
                                                              <tr>
                                                                <td>Total Pertemuan</td>
                                                                <td> : </td>
                                                                <td> <?php echo $total." / 16"; ?> </td>
                                                              </tr>
                                                            </table>
                                                            <hr>
                                                            <table width="80%">
                                                              <?php
                                                                  $no=1; $i=1;
                                                                  foreach ($detail as $a) {
                                                              ?>
                                                              <tr>
                                                                <td><?php echo $no++ ?></td>
                                                                <td><?php echo "Pertemuan ke- ".$i++; ?></td>
                                                                <td><?php $date = date_create($a->tgl_pertemuan); echo date_format($date,"d/m/Y"); ?></td>
                                                                <td><?php 
                                                                    if ($a->status == 1 || $a->status == 2) { ?>
                                                                      <img src="<?php echo base_url('assets/images/icon/in.png')?>" width="50x" height="50px">
                                                                    <?php }else{?>
                                                                      &nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url('assets/images/icon/del.png')?>" width="20x" height="20px">
                                                                    <?php }?>
                                                                  </td>
                                                              </tr>
                                                            <?php }?>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
