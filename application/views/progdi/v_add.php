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
                                                        <a href="<?php echo base_url();?>master/progdi" class="btn btn-success btn-round"><font style="color: white;">KEMBALI DATA PROGRAM STUDI</font></a><hr>
                                                        <h5>TAMBAH DATA PROGRAM STUDI</h5>
                                                    </div>
                                                    <div class="card-block">
                                                  <form action="<?php echo base_url();?>master/progdi/add_act" method="post">
                                                    <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                        Kode Program Studi :
                                                        <p><input type="text" class="form-control" placeholder="Kode Program Studi" name="kode" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Jenjang Program Studi :
                                                        <p><input type="text" class="form-control" placeholder="Jenjang Program Studi" name="jenjang" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Nama Program Studi :
                                                        <p><input type="text" class="form-control" placeholder="Nama Program Studi" name="nama" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                      Nama Fakultas :
                                                      <p>
                                                        <select name="fakultas" class="form-control">
                                                            <option selected="" disabled="">--Nama Fakultas--</option>
                                                            <?php foreach($fakultas as $f){?>
                                                            <option value="<?php echo $f->id ?>"><?php echo $f->nama_fakultas ?></option>
                                                            <?php } ?>
                                                        </select>
                                                      </p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                      Status Program Studi :
                                                      <p>
                                                        <select name="status" class="form-control">
                                                            <option selected="" disabled="">--Status Program Studi--</option>
                                                            <option value="1">Aktif</option>
                                                            <option value="0">Tidak Aktif</option>
                                                        </select>
                                                      </p>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <center><input type="submit" class="btn btn-success btn-round" value="Tambah"></center>
                                                    </div>
                                                </div>
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
