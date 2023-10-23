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
                                                    <div class="card-block">
                                                      <div class="col-sm-4">
                                                          <form action="<?php echo base_url('master/jadwal_krs/save'); ?>" method="post">
                                                              <div class="form-group">
                                                                  <label>Status Input KRS</label>
                                                                  <select class="form-control" name="status">
                                                                      <option selected="" value="<?php echo $status ?>"><?php if($status == 1){echo "Di Buka"; }else{echo "Di Tutup";}?></option>
                                                                      <option value="1">Di Buka</option>
                                                                      <option value="0">Di Tutup</option>
                                                                  </select>
                                                                  <br>
                                                                  <input type="submit" value="Simpan" class="btn btn-primary">
                                                              </div>
                                                          </form>
                                                      </div>
                                                      <div class="dt-responsive table-responsive">
                                                        <h5>Status Input KRS</h5>
                                                            <table class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                                    foreach ($krs as $d) {?>
                                                                    <tr>
                                                                         <td><?php echo $no++; ?></td>
                                                                        <td><?php if ($d->status == 1) {
                                                                            echo "INPUT KRS BUKA";
                                                                        }else{
                                                                            echo "INPUT KRS TUTUP";
                                                                            } ?></td>
                                                                    </tr>
                                                                    <?php }?>
                                                            </tbody>
                                                          </table>
                                                          <!-- <p align='right'><input type="submit" class="btn btn-success btn-round" value="SELESAI / PUBLISH" /></p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="myModal" class="modal">

                                              <!-- Modal content -->
                                              <div class="modal-content">
                                                <span class="close">&times;</span>
                                                <form action="<?php echo base_url();?>master/ruang/add_act" method="post">
                                                    <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                        Nama Ruang :
                                                        <p><input type="text" class="form-control" placeholder="Nama Ruang" name="nama" required=""></p>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        Kapasitas :
                                                        <p><input type="number" class="form-control" placeholder="Kapasitas" name="kapasitas" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Luas Ruang :
                                                        <p><input type="text" class="form-control" placeholder="ex:5x5" name="luas" required=""></p>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <center><input type="submit" class="btn btn-success btn-round" value="Tambah"></center>
                                                    </div>
                                                </div>
                                                </form>
                                              </div>

                                            </div>
