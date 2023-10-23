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
                                                        <a href="<?php echo base_url();?>master/ruang" class="btn btn-success btn-round"><font style="color: white;">KEMBALI DATA RUANG</font></a><hr>
                                                        <h5>UPDATE DATA RUANG</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <form action="<?php echo base_url();?>master/ruang/update_act" method="post">
                                                          <?php foreach($detail as $d){?>
                                                            <div class="row">
                                                              <div class="col-sm-12">
                                                                <div class="row">
                                                                  <div class="col-sm-2"><b>Nama Ruang</b></div>
                                                                  <div class="col-sm-2">
                                                                      <input type="text" name="id" class="form-control" value="<?php echo $d->id ?>" hidden="">
                                                                      <input type="text" name="nama" class="form-control" value="<?php echo $d->nama_ruang ?>" required="">
                                                                  </div>  
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                  <div class="col-sm-2"><b>Kapasitas</b></div>
                                                                  <div class="col-sm-2">
                                                                      <input type="number" name="kapasitas" class="form-control" value="<?php echo $d->kapasitas ?>" required="">
                                                                  </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                  <div class="col-sm-2"><b>Luas Ruang</b></div>
                                                                  <div class="col-sm-2">
                                                                      <input type="text" name="luas" class="form-control" value="<?php echo $d->luas ?>" required="">
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
