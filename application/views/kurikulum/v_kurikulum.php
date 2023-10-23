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
                                                    <!-- <div class="card-header"> -->
                                                        <?php //echo $this->session->userdata('kurikulum'); 
                                                              //$this->session->set_userdata('kurikulum','');
                                                              ?>
                                                        <!-- <a href="<?php echo base_url();?>master/kurikulum/add" class="btn btn-success btn-round"><font style="color: white;">TAMBAH KURIKULUM</font></a><hr>
                                                        <h5>MASTER KURIKULUM</h5> -->




                                                        
                                                    <!-- </div> -->

                                                    <div class="col-lg-12">
                                                    <div class="card-header">
                                                        <h5 class="card-header-text">MASTER KURIKULUM</h5>

                                                        <?php echo $this->session->userdata('kurikulum'); 
                                                              $this->session->set_userdata('kurikulum','');
                                                           
                                                              
                                                              ?>

                                                    </div>
                                                    <div class="card-block accordion-block">
                                                        <div id="accordion" role="tablist" aria-multiselectable="true">
                                                            <div class="accordion-panel">
                                                                <div class="accordion-heading" role="tab" id="headingOne">
                                                                    <h3 class="card-title accordion-title">
                                                                    <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                        Mata Kuliah
                                                                    </a>
                                                                </h3>
                                                                </div>
                                                                <div id="collapseOne" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne" style="">
                                                                    <div class="accordion-content accordion-desc">
                                                                    <a href="<?php echo base_url()?>master/matakuliah/add" class="btn btn-success btn-round"><font style="color: white;">TAMBAH MATA KULIAH</font></a><hr>
                                                         <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th width="5">No</th>
                                                                    <th width="20px">Kode</th>
                                                                    <th>Nama Mata Kuliah</th>
                                                                    <th width="10px">T/P</th>
                                                                    <!-- <th width="10px">SKS</th> -->
                                                                    <!-- <th width="10px">Smt</th> -->
                                                                    <th width="20px">Kelompok Mata Kuliah</th>
                                                                    <th width="20px">Rumpun Mata Kuliah</th>
                                                                    <th width="20px">Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($matakuliah as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a->kode_mata_kuliah ?></td>
                                                                    <td><?php echo $a->nama_mata_kuliah." / ".$a->nama_mata_kuliah_eng; ?></td>
                                                                    <td><?php echo $a->tp ?></td>
                                                                    <!-- <td><?php //echo $a->jumlah_sks ?></td> -->
                                                                    <!-- <td><?php //echo $a->semester ?></td> -->
                                                                    <td><?php echo $a->kelompok_mata_kuliah ?></td>
                                                                    <td><?php echo $a->rumpun ?></td>
                                                                    <td><?php if($a->is_aktif == 1){
                                                                        echo '<a href="'.base_url("master/matakuliah/update_togle_matkul/".$a->id).'" class="btn btn-success">AKTIF</a>';
                                                                        }else if($a->is_aktif == 0){
                                                                            echo '<a href="'.base_url("master/matakuliah/update_togle_matkul/".$a->id).'" class="btn btn-danger">TIDAK AKTIF</a>';
                                                                        }?></td>
                                                                    <td><a href="<?php echo base_url()?>master/matakuliah/update/<?php echo str_replace('=','',base64_encode(base64_encode($a->id))); ?>" class="btn btn-success">Edit</a>
                                                                        <a href="<?php echo base_url()?>master/matakuliah/delete/<?php echo str_replace('=','',base64_encode(base64_encode($a->id))); ?>" onclick="return confirm('Yakin Delete Data Matakuliah?')" class="btn btn-danger">Delete</a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th width="5">No</th>
                                                                    <th width="20px">Kode</th>
                                                                    <th>Nama Mata Kuliah</th>
                                                                    <th width="10px">T/P</th>
                                                            
                                                                    <!-- <th width="10px">Smt</th> -->
                                                                    <th width="20px">Kelompok Mata Kuliah</th>
                                                                    <th width="20px">Rumpun Mata Kuliah</th>
                                                                    <th width="20px">Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </tfoot>
                                                          </table>
                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion-panel">
                                                                <div class="accordion-heading" role="tab" id="headingTwo">
                                                                    <h3 class="card-title accordion-title">
                                                                    <a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                        Kurikulum
                                                                    </a>
                                                                </h3>
                                                                </div>
                                                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" style="">
                                                                    <div class="accordion-content accordion-desc">
                                                                    <a href="<?php echo base_url();?>master/kurikulum/add" class="btn btn-success btn-round"><font style="color: white;">TAMBAH KURIKULUM</font></a><hr>
                                                                    <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Kode Kurikulum</th>
                                                                    <th>Program Studi</th>
                                                                    <th>Tahun Ajaran</th>
                                                                    <th>Untuk Angkatan</th>
                                                                    <th>Status Kurikulum</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($kurikulum as $k){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><a href="<?=base_url('master/kurikulum/daftar_matkul/'.$k->id)?>"><?php echo $k->kode_kurikulum ?></a></td>
                                                                    <td><?php echo $k->nama_jurusan ?></td>
                                                                    <td><?php echo $k->awal." - ".$k->akhir;  ?></td>
                                                                    <td><?php echo $k->angkatan ?></td>
                                                                    <td><?php if($k->status == 1){
                                                                        echo '<a href="'.base_url("master/kurikulum/update_togle_kur/".$k->id).'" class="btn btn-success">AKTIF</a>';
                                                                        }else if($k->status == 0){
                                                                            echo '<a href="'.base_url("master/kurikulum/update_togle_kur/".$k->id).'" class="btn btn-danger">TIDAK AKTIF</a>';
                                                                        }?></td>
                                                                    <td><a href="<?php echo base_url()?>master/kurikulum/update/<?php echo $k->id; ?>" class="btn btn-warning">EDIT</a>
                                                                        <!-- <a href="<?php echo base_url()?>pmb/pmb/surat_pengumuman/<?php echo $a->id?>" class="btn btn-primary">Surat Pernyataan</a> -->
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Kode Kurikulum</th>
                                                                    <th>Program Studi</th>
                                                                    <th>Tahun Ajaran</th>
                                                                    <th>Untuk Angkatan</th>
                                                                    <th>Status Kurikulum</th>
                                                                    <th></th>
                                                                </tr>
                                                            </tfoot>
                                                          </table>
                                                        </div>
                                                                    </div>
                                                                </div>
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
                                                <form action="<?php echo base_url();?>/master/kurikulum/add_act" method="post">
                                                    <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                        Kode Kurikulum :
                                                        <p><input type="text" class="form-control" placeholder="Kode Kurikulum" name="kode_kurikulum" required=""></p>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        Program Studi :
                                                        <p>
                                                        <select class="form-control" name="progdi" required="">
                                                          <option selected="" disabled="">--- Pilih Program Studi ---</option>
                                                          <?php foreach($progdi as $p){?>
                                                            <option value="<?php echo $p->kode ?>"><?php echo $p->nama_jurusan ?></option>
                                                          <?php } ?>
                                                        </select></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Tahun Ajaran :
                                                        <p><input type="number" class="form-control" placeholder="Tahun Ajaran" name="tahun_ajar" required=""></p>
                                                    </div>
                                                     <div class="col-sm-12">
                                                        Untuk Angkatan :
                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                              <p><input type="number" class="form-control" placeholder="Tahun Ajaran" name="angkatan1" required=""></p>
                                                            </div>
                                                            <div class="col-sm-1">
                                                              <p>-</p>
                                                            </div>
                                                            <div class="col-sm-5">
                                                              <p><input type="number" class="form-control" placeholder="Tahun Ajaran" name="angkatan2" required=""></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Status Kurikulum :
                                                        <p><select name="status" class="form-control">
                                                            <option selected="" disabled=""><center>---Status Kurikulum---</center></option>
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
