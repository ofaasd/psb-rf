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
                                                        <a href="<?php echo base_url();?>master/jadwal/input" class="btn btn-success btn-round"><font style="color: white;">KEMBALI</font></a><hr>
                                                        <h5>UPDATE DATA RUANG</h5>
                                                    </div>
                                                    <div class="card-block">
                                                            <div class="col-sm-12"><br>
                                                                <p><b>NAMA MATA KULIAH : (<?php echo $this->session->userdata('kode_matkul'); ?>)<?php echo $this->session->userdata('nama_matkul'); ?></b></p>
                                                            <form action="<?php echo base_url('master/jadwal/update_act');?>" method="post">
                                                                <?php foreach($edit_jadwal as $a){?>
                                                                <input hidden="" value="<?php echo $a->id ?>" name="id" type="text" />
                                                                Hari :
                                                                <p><select class="form-control" name="hari">
                                                                    <option value="<?php echo $a->hari ?>" selected=""><?php echo $a->hari ?></option>
                                                                    <?php foreach($hari as $hari){?>
                                                                        <option value="<?php echo $hari->nama_hari ?>"><?php echo $hari->nama_hari ?></option>
                                                                    <?php } ?>
                                                                </select></p>
                                                                Sesi :
                                                                <p><select class="form-control" name="sesi">
                                                                    <option value="<?php echo $a->sesi ?>" selected=""><?php echo $a->sesi ?></option>
                                                                    <?php foreach($sesi as $sesi){?>
                                                                        <option value="<?php echo $sesi->nama_sesi ?>"><?php echo $sesi->nama_sesi ?></option>
                                                                    <?php } ?>
                                                                </select></p>
                                                                Ruang :
                                                                <p><select class="form-control" name="ruang">
                                                                    <option value="<?php echo $a->ruang ?>" selected=""><?php echo $a->ruang ?></option>
                                                                    <?php foreach($ruang as $ruang){?>
                                                                        <option value="<?php echo $ruang->nama_ruang ?>"><?php echo $ruang->nama_ruang ?></option>
                                                                    <?php } ?>
                                                                </select></p>
                                                                Status :
                                                                <p><select class="form-control" name="status">
                                                                        <option value="<?php echo $a->status ?>" selected=""><?php if($a->status == 1){ echo "Buka";}else{echo "Tutup";}  ?></option>
                                                                        <option value="1">Buka</option>
                                                                        <option value="0">Tutup</option>
                                                                </select></p>
                                                                <div class="col-md-12">
                                                                    <center><input type="submit" class="btn btn-success btn-round" value="Update"></center>
                                                                </div>
                                                                    <?php } ?>
                                                                </form>
                                                            </div>
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
