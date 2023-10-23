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
                                                        <a href="<?php echo base_url();?>master/kurikulum" class="btn btn-success btn-round"><font style="color: white;">KEMBALI MASTER KURIKULUM</font></a><hr>
                                                        <h5>TAMBAH KURIKULUM</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <form action="<?php echo base_url();?>/master/kurikulum/add_act" method="post">
                                                    <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                        Kode Kurikulum :
                                                        <p><input type="text" class="form-control" placeholder="Kode Kurikulum" name="kode_kurikulum" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Program Studi :
                                                        <p>
                                                        <select class="form-control" name="progdi" required="">
                                                          <option selected="" disabled="">--- Pilih Program Studi ---</option>
                                                          <?php foreach($progdi as $p){?>
                                                            <option value="<?php echo $p->kode ?>"><?php echo $p->nama_jurusan ?></option>
                                                          <?php } ?>
                                                        </select></p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        Tahun Ajaran :
                                                        <p><select name="tahun_ajar" class="form-control">
                                                          <?php foreach($ta as $a){?>
                                                          <option value="<?php echo $a->id ?>"><?php echo $a->awal." - ".$a->akhir; ?></option>
                                                        <?php } ?>
                                                        </select></p>
                                                    </div>
                                                     <div class="col-sm-6">
                                                        Untuk Angkatan :
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                              <p><input type="number" class="form-control" placeholder="Angkatan" name="angkatan1" required=""></p>
                                                            </div>
                                                            <div class="col-sm-1"><center>s/d</center></div>
                                                            <div class="col-sm-3">
                                                              <!-- <p>-</p> -->
                                                              <p><input type="number" class="form-control" placeholder="Angkatan" name="angkatan2" required=""></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        Status Kurikulum :
                                                        <p><select name="status" class="form-control">
                                                            <option selected="" disabled=""><center>---Status Kurikulum---</center></option>
                                                            <option value="1">Aktif</option>
                                                            <option value="0">Tidak Aktif</option>
                                                        </select></p>
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
