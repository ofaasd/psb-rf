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
                                                        <a href="<?php echo base_url();?>master/waktu" class="btn btn-success btn-round"><font style="color: white;">KEMBALI MASTER WAKTU</font></a><hr>
                                                        <h5>UPDATE DATA WAKTU PERKULIAHAN</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <form action="<?php echo base_url();?>master/waktu/update_act" method="post">
                                                          <?php foreach($detail as $d){?>
                                                            <div class="row">
                                                              <div class="col-sm-12">
                                                                <div class="row">
                                                                  <div class="col-sm-2"><b>Nama Sesi</b></div>
                                                                  <div class="col-sm-2">
                                                                      <input type="text" name="id" class="form-control" value="<?php echo $d->id ?>" hidden="">
                                                                      <input type="text" name="nama" class="form-control" value="<?php echo $d->nama_sesi ?>" required="">
                                                                  </div>  
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                  <div class="col-sm-2"><b>Waktu Mulai</b></div>
                                                                  <div class="col-sm-2">
                                                                      <input type="time" name="mulai" class="form-control" value="<?php echo $d->mulai ?>" required="">
                                                                  </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                  <div class="col-sm-2"><b>Waktu Selesai</b></div>
                                                                  <div class="col-sm-2">
                                                                      <input type="time" name="selesai" class="form-control" value="<?php echo $d->selesai ?>" required="">
                                                                  </div>  
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                      <!-- <?php $angkatan = explode('-',$d->angkatan);?> -->
                                                                  <div class="col-sm-2"><b>Jumlah SKS</b></div>
                                                                  <div class="col-sm-2">
                                                                      <input type="number" name="sks" class="form-control" value="<?php echo $d->sks ?>" required="">
                                                                  </div> 
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                  <div class="col-sm-2"><b>Status</b></div>
                                                                  <div class="col-sm-2">
                                                                      <select name="status" class="form-control" required="">
                                                                        <option selected="" value="<?php echo $d->status?>"><?php echo $d->status == 1? 'AKTIF' : 'TIDAK AKTIF'?></option>
                                                                        <option value="1">AKTIF</option>
                                                                        <option value="2">TIDAK AKTIF</option>
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
