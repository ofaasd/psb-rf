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
                                                        <a href="<?php echo base_url();?>master/gelombang" class="btn btn-success btn-round"><font style="color: white;">KEMBALI DATA GELOMBANG</font></a><hr>
                                                        <h5>UBAH DATA GELOMBANG</h5>
                                                    </div>
                                                    <div class="card-block">
                                                  <form action="<?php echo base_url();?>master/gelombang/update_act" method="post">
                                                    <input type="text" class="form-control" value="<?php echo $data->id ?>" name="id" hidden=''>
                                                    <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                        Kode Gelombang :
                                                        <p><input type="text" class="form-control" value="<?php echo $data->nama_gel ?>" name="kode" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Nama Gelombang :
                                                        <p><input type="text" class="form-control" value="<?php echo $data->nama_gel_long ?>" name="nama" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Tanggal Mulai Gelombang :
                                                        <p><input type="date" class="form-control" value="<?php echo $data->tgl_mulai ?>" name="tgl_mulai" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Tanggal Akhir Gelombang :
                                                        <p><input type="date" class="form-control" value="<?php echo $data->tgl_akhir ?>" name="tgl_akhir" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Tanggal Ujian Gelombang :
                                                        <p><input type="date" class="form-control" value="<?php echo $data->ujian ?>" name="tgl_ujian" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Waktu Ujian Gelombang :
                                                        <p><input type="time" class="form-control" value="<?php echo $data->jam_ujian ?>" name="waktu_ujian" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Hari Ujian Gelombang :
                                                        <p><select class="form-control" name="hari_ujian">
                                                          <option disabled="">-- Hari Ujian Gelombang --</option>
                                                          <option selected="" value="<?php echo $data->hari_ujian ?>"><?php echo $data->nama_hari ?></option>
                                                          <?php foreach($hari as $h){?>
                                                          <option value="<?php echo $h->id ?>"><?php echo $h->nama_hari ?></option>
                                                          <?php } ?>
                                                        </select></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Pengumuman Gelombang :
                                                        <p><input type="date" class="form-control" value="<?php echo $data->pengumuman ?>" name="pengumuman" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Registrasi Mulai Gelombang :
                                                        <p><input type="date" class="form-control" value="<?php echo $data->reg_mulai ?>" name="reg_mulai" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Registrasi Akhir Gelombang :
                                                        <p><input type="date" class="form-control" value="<?php echo $data->reg_akhir ?>" name="reg_akhir" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Tahun Gelombang :
                                                        <p><input type="text" class="form-control" value="<?php echo $data->tahun ?>" name="tahun" placeholder="ex:2020/2021" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                      Jenis Gelombang :
                                                      <p>
                                                        <select name="jenis" class="form-control">
                                                            <option disabled="">--Jenis--</option>
                                                            <option value="1" <?php if($data->jenis == 1){ echo "selected=''"; }?>>Reguler</option>
                                                            <option value="2" <?php if($data->jenis == 2){ echo "selected=''"; }?>>Khusus</option>
                                                            <option value="3" <?php if($data->jenis == 3){ echo "selected=''"; }?>>PMDK</option>
                                                        </select>
                                                      </p>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <center><input type="submit" class="btn btn-success btn-round" value="Simpan"></center>
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
