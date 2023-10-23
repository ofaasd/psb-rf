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
                                                        <?php 

                                                        $kur_item=array();
                                                        foreach($kurikulum_item as $data){
                                                          $kur_item[]=$data['id_mata_kuliah'];
                                                        }

                                                        echo $this->session->userdata('matakuliah'); 
                                                        $this->session->set_userdata('matakuliah','');
                                                              ?>
                                                        <!-- <a href="<?php echo base_url()?>master/matakuliah/add" class="btn btn-success btn-round"><font style="color: white;">TAMBAH MATA KULIAH</font></a><hr> -->
                                                        <h5>Tambah Matakuliah  
                                                           
                                                        <?=$kurikulum[0]->nama_jurusan." - ".$kurikulum[0]->kode_kurikulum?></h5>
                                                        <hr>
                                                        <a href="<?php echo base_url()?>master/kurikulum" class="btn btn-success btn-round"><font style="color: white;">KEMBALI KE KURIKULUM</font></a>
                                                        <a href="<?=base_url('master/kurikulum/daftar_matkul/'.$kurikulum[0]->kur_id)?>" class="btn btn-info btn-round"><font style="color: white;">LIHAT MATKUL</font></a>
                                                    </div>
                                                    <div class="card-block">
                                                    <?=$this->session->flashdata('simpan_matkul_kurikulum');?>
                                                        <div class="dt-responsive table-responsive">
                                                            <!-- <form action=<?=base_url('master/kurikulum/simpan_matkul_kurikulum')?> method=post> -->
                                                            <!-- <input type="hidden" name="id_kurikulum" value="<?=$kurikulum[0]->kur_id?>"> -->
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th width="5">No</th>
                                                                    <th width="20px">Kode</th>
                                                                    <th>Nama Mata Kuliah</th>
                                                                    <th>Aksi</th>
                                                                    <!-- <th width="10px"><input type=checkbox id=pilihsemua> Pilih Semua</th> -->
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($matakuliah as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a->kode_mata_kuliah ?></td>
                                                                    <td><?php echo $a->nama_mata_kuliah." / ".$a->nama_mata_kuliah_eng; ?></td>
                                                                    <td><input type="checkbox" id="matkul" onclick="submit_matkul(this.value)" name="matkul[]" value="<?=$a->id?>"
                                                                    <?=in_array($a->id, $kur_item)? "checked":"";?>
                                                                    > Pilih</td>
                                                                    
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                <th width="5">No</th>
                                                                    <th width="20px">Kode</th>
                                                                    <th>Nama Mata Kuliah</th>
                                                                    <th>Aksi</th>
                                                                    <!-- <th width="5"></th>
                                                                    <th width="20px"></th>
                                                                    <th></th> -->
                                                                    <!-- <th width="10px"><input type="submit" class="btn btn-primary" value="Simpan"></th> -->
                                                                    
                                                                </tr>
                                                            </tfoot>
                                                          </table>
                                                          <!-- </form> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="myModal" class="modal">

                                              <!-- Modal content -->
                                              <div class="modal-content">
                                                <span class="close">&times;</span>
                                                <form action="<?php echo base_url()?>master/matakuliah/add_act" method="post">
                                                    <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                        Kode Mata Kuliah :
                                                        <p><input type="text" class="form-control" placeholder="Kode Mata Kuliah" name="kode_mata_kuliah" required=""></p>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        Nama Mata Kuliah :
                                                        <p><input type="text" class="form-control" placeholder="Nama Mata Kuliah" name="nama_mata_kuliah" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Jumlah SKS :
                                                        <p><input type="number" class="form-control" name="sks" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Kelompok Mata Kuliah :
                                                        <p><input type="text" class="form-control" placeholder="Kelompok Mata Kuliah" name="kel_mata_kuliah" required=""></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Rumpun Mata Kuliah :
                                                        <p><select name="rumpun_mata_kuliah" class="form-control">
                                                            <option selected="" disabled=""><center>---Rumpun Mata Kuliah---</center></option>
                                                            <?php foreach($rumpun as $a){?>
                                                            <option value="<?php echo $a->id ?>"><?php echo $a->nama_rumpun ?></option>
                                                            <?php } ?>
                                                            <!-- <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="6">6</option> -->
                                                        </select></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Status Mata Kuliah :
                                                        <p><select name="status" class="form-control">
                                                            <option selected="" disabled=""><center>---Status Mata Kuliah---</center></option>
                                                            <option value="0">Tidak Aktif</option>
                                                            <option value="1">Aktif</option>
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
function submit_matkul(val) {
  var kdkurikulum=<?=$kurikulum[0]->kur_id?>;
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>master/kurikulum/kurikulum_item",
        data: { isi : val,kdkur : kdkurikulum },
        success: function(data) {
            alert(data);
        }
    });
}

document.getElementById('pilihsemua').onclick = function() {
  var checkboxes = document.getElementsByName('matkul[]');
  for (var checkbox of checkboxes) {
    checkbox.checked = this.checked;
  }
}

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
