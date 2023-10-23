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
    
    <?php
    // $temp=array();
    // foreach($jadwal as $k){
    //     $temp[$k['kode_mata_kuliah']]['kuota']=$k['kuota_diambil'];
    //     $temp[$k['kode_mata_kuliah']]['tampung']=$k['kuota_tampung'];
    //     $temp[$k['kode_mata_kuliah']]['idjadwal']=$k['id'];
    // }
    
    ?>

                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <?php 
                                                        echo $this->session->userdata('jadwal'); 
                                                        $this->session->set_userdata('jadwal','');
                                                              ?>
                                                        <!-- <a href="<?php echo base_url()?>master/matakuliah/add" class="btn btn-success btn-round"><font style="color: white;">TAMBAH MATA KULIAH</font></a><hr> -->
                                                        <h5>
                                                        <?php echo $detail_matkul->nama_mata_kuliah.
                                                        " (".$detail_matkul->kode_mata_kuliah.") ";?></h5>
                                                    </div>
                                                    <div class="card-block">
                                                 
                                                       <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th width="5">No</th>
                                                                    <th width="20px">NIM</th>
                                                                    <th>Nama</th>
                                                                    <th width="10px">Telp</th>
                                                                    <th width="10px">HP</th>
                                                                    <th width="10px">Email</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($daftar_mhs as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a['nim'] ?></td>
                                                                    <td><?php echo $a['nama'] ?></td>
                                                                    <td><?php echo $a['telp'] ?></td>
                                                                    <td><?php echo $a['hp'] ?></td>
                                                                    <td><?php echo $a['email'] ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th width="5">No</th>
                                                                    <th width="20px">NIM</th>
                                                                    <th>Nama</th>
                                                                    <th width="10px">Telp</th>
                                                                    <th width="10px">HP</th>
                                                                    <th width="10px">Email</th>
                                                                </tr>
                                                            </tfoot>
                                                          </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
