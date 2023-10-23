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
                                                        <a href="<?php echo base_url();?>master/keuangan/biaya_pendaftaran" class="btn btn-success btn-round"><font style="color: white;">KEMBALI BIAYA PENDAFTARAN</font></a><hr>
                                                        <h5>DETAIL TAHAPAN BIAYA PENDAFTARAN</h5>
                                                    </div>
                                                    <?php if($detail != 0){?>
                                                      <div class="card-block">
                                                        <form action="<?php echo base_url();?>master/keuangan/biaya_pendaftaran_save" method="post">
                                                          <?php foreach($detail as $d){?>
                                                            <div class="row">
                                                              <div class="col-sm-12">
                                                                <div class="row">
                                                                  <div class="col-sm-2"><b>Tahap Pertama (50%)</b></div>
                                                                  <div class="col-sm-2">
                                                                      <input type="text" name="nopen" class="form-control" value="<?php echo $nopen ?>" hidden="">
                                                                      <input type="number" name="tahap_1" class="form-control" value="<?php echo $d->tahap_1 ?>"><br>
                                                                      <input type="date" name="tgl_tahap_1" class="form-control" value="<?php echo $d->tgl_tahap_1 ?>"><br>
                                                                      <select class="form-control" name="stat_tahap_1">
                                                                          <option selected="" value="<?php echo $d->stat_tahap_1 ?>"><?php if($d->stat_tahap_1 == 1){echo "Terbayar";}else{echo "Belum Terbayar";}?></option>
                                                                          <option value="1">Terbayar</option>
                                                                          <option value="0">Belum Terbayar</option>
                                                                      </select>
                                                                  </div>  
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                  <div class="col-sm-2"><b>Tahap Kedua (25%)</b></div>
                                                                  <div class="col-sm-2">
                                                                      <input type="number" name="tahap_2" class="form-control" value="<?php echo $d->tahap_2 ?>"><br>
                                                                      <input type="date" name="tgl_tahap_2" class="form-control" value="<?php echo $d->tgl_tahap_2 ?>"><br>
                                                                      <select class="form-control" name="stat_tahap_2">
                                                                          <option selected="" value="<?php echo $d->stat_tahap_2 ?>"><?php if($d->stat_tahap_2 == 1){echo "Terbayar";}else{echo "Belum Terbayar";}?></option>
                                                                          <option value="1">Terbayar</option>
                                                                          <option value="0">Belum Terbayar</option>
                                                                      </select>
                                                                  </div>  
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                  <div class="col-sm-2"><b>Tahap Ketiga (25%)</b></div>
                                                                  <div class="col-sm-2">
                                                                      <input type="number" name="tahap_3" class="form-control" value="<?php echo $d->tahap_3 ?>"><br>
                                                                      <input type="date" name="tgl_tahap_3" class="form-control" value="<?php echo $d->tgl_tahap_3 ?>"><br>
                                                                      <select class="form-control" name="stat_tahap_3">
                                                                          <option selected="" value="<?php echo $d->stat_tahap_3 ?>"><?php if($d->stat_tahap_3 == 1){echo "Terbayar";}else{echo "Belum Terbayar";}?></option>
                                                                          <option value="1">Terbayar</option>
                                                                          <option value="0">Belum Terbayar</option>
                                                                      </select>
                                                                  </div>  
                                                                </div>
                                                                <br><br>
                                                                  <center><input type="submit" class="btn btn-success btn-round" value="Update"></center>
                                                              </div>
                                                            </div>
                                                          <?php } ?>
                                                        </form>
                                                    </div>
                                                  <?php }else{?>
                                                    <div class="card-block">
                                                        <form action="<?php echo base_url();?>master/keuangan/biaya_pendaftaran_save" method="post">
                                                            <div class="row">
                                                              <div class="col-sm-12">
                                                                <div class="row">
                                                                  <div class="col-sm-2"><b>Tahap Pertama (50%)</b></div>
                                                                  <div class="col-sm-2">
                                                                      <input type="text" name="nopen" class="form-control" value="<?php echo $nopen ?>" hidden="">
                                                                      <input type="number" name="tahap_1" class="form-control"><br>
                                                                      <input type="date" name="tgl_tahap_1" class="form-control"><br>
                                                                      <select class="form-control" name="stat_tahap_1">
                                                                          <option selected="" disabled="">--Pilih Status Pembayaran--</option>
                                                                          <option value="1">Terbayar</option>
                                                                          <option value="0">Belum Terbayar</option>
                                                                      </select>
                                                                  </div>  
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                  <div class="col-sm-2"><b>Tahap Kedua (25%)</b></div>
                                                                  <div class="col-sm-2">
                                                                      <input type="number" name="tahap_2" class="form-control"><br>
                                                                      <input type="date" name="tgl_tahap_2" class="form-control"><br>
                                                                      <select class="form-control" name="stat_tahap_2">
                                                                          <option selected="" disabled="">--Pilih Status Pembayaran--</option>
                                                                          <option value="1">Terbayar</option>
                                                                          <option value="0">Belum Terbayar</option>
                                                                      </select>
                                                                  </div>  
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                  <div class="col-sm-2"><b>Tahap Ketiga (25%)</b></div>
                                                                  <div class="col-sm-2">
                                                                      <input type="number" name="tahap_3" class="form-control"><br>
                                                                      <input type="date" name="tgl_tahap_3" class="form-control"><br>
                                                                      <select class="form-control" name="stat_tahap_3">
                                                                          <option selected="" disabled="">--Pilih Status Pembayaran--</option>
                                                                          <option value="1">Terbayar</option>
                                                                          <option value="0">Belum Terbayar</option>
                                                                      </select>
                                                                  </div>  
                                                                </div>
                                                                <br><br>
                                                                  <center><input type="submit" class="btn btn-success btn-round" value="Update"></center>
                                                              </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                  <?php } ?>
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
