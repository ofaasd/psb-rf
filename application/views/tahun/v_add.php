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
                                                        <a href="<?php echo base_url();?>master/tahun" class="btn btn-success btn-round"><font style="color: white;">KEMBALI DATA TAHUN AJARAN</font></a><hr>
                                                        <h5>TAMBAH DATA TAHUN AJARAN</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <form action="<?php echo base_url();?>master/tahun/add_act" method="post">
                                                    <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                        Tahun Awal :
                                                        <p><input type="number" class="form-control" placeholder="Tahun Awal" name="awal" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Tahun Akhir :
                                                        <p><input type="number" class="form-control" placeholder="Tahun Akhir" name="akhir" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Jenis Tahun Ajaran :
                                                        <p><select name="jenis" class="form-control">
                                                          <option selected="" disabled="">Pilih Jenis Tahun Ajaran</option>
                                                          <option value="1">Ganjil</option>
                                                          <option value="2">Genap</option>
                                                          <option value="3">Antara Ganjil Genap</option>
                                                          <option value="4">Antara Genap Ganjil</option>
                                                        </select></p>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <center><input type="submit" onclick="return confirm('Pastikan sudah melakukan Update Transkrip sebelum menambahkan Tahun Ajaran.')" class="btn btn-success btn-round" value="Tambah"></center>
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
