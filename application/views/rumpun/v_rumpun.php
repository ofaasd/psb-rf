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
                                                        <?php echo $this->session->userdata('rumpun'); 
                                                              $this->session->set_userdata('rumpun','');
                                                              ?>
                                                        <a href="<?php echo base_url();?>master/rumpun/add" class="btn btn-success btn-round"><font style="color: white;">TAMBAH DATA RUMPUN</font></a><hr>
                                                        <h5>MASTER RUMPUN</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama Rumpun</th>
                                                                    <th>Status</th>
                                                                    <th style="width: 50px;"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($daftar_rumpun as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a->nama_rumpun ?></td>
                                                                    <td><?php if($a->status == 1){
                                                                        echo '<a href="#" class="btn btn-success">AKTIF</a>';
                                                                        }else if($a->status == 0){
                                                                            echo '<a href="#" class="btn btn-danger">TIDAK AKTIF</a>';
                                                                        }?></td>
                                                                    <td><a href="<?php echo base_url()?>master/rumpun/update/<?php echo str_replace('=','',base64_encode(base64_encode($a->id))); ?>" class="btn btn-warning">EDIT</a>
                                                                        <a href="<?php echo base_url()?>master/rumpun/delete/<?php echo str_replace('=','',base64_encode(base64_encode($a->id))); ?>" onclick="return confirm('Delete data rumpun yaitu membuat status rumpun menjadi tidak aktif!')" class="btn btn-danger">DELETE</a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama Rumpun</th>
                                                                    <th>Status</th>
                                                                    <th style="width: 50px;"></th>
                                                                </tr>
                                                            </tfoot>
                                                          </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="myModal" class="modal">

                                              <!-- Modal content -->
                                              <div class="modal-content">
                                                <span class="close">&times;</span>
                                                <form action="<?php echo base_url();?>master/rumpun/add_act" method="post">
                                                    <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                        Nama Rumpun :
                                                        <p><input type="text" class="form-control" placeholder="Nama Rumpun" name="nama" required=""></p>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        Status :
                                                        <p><select name="status" class="form-control">
                                                            <option selected="" disabled=""><center>---Status Rumpun---</center></option>
                                                            <option value="1">Aktif</option>
                                                            <option value="2">Tidak Aktif</option>
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
