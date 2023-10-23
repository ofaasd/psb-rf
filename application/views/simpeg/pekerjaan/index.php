<div class="card">
    <div class="card-header">
        <?php 
          $jenjang = array("SLTA","D-I", "D-II", "D-III", "D-IV", "S1","S2","S3");
          echo $this->session->userdata('status_delete'); 
              $this->session->set_userdata('status_delete','');
              ?>
        <h5>RIWAYAT PEKERJAAN</h5>
        <div class="alert alert-primary" id="alert">
                          
        </div>
    </div>
    <div class="card-block" id="tbl_pegawai">
      <a href="#" id="add" class="btn btn-primary waves-effect"  data-toggle="modal" data-target="#tambah">Tambah</a><br /><br />
      <table class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>No.</th>
            <th>Sebagai</th>
            <th>Perusahaan</th>
            <th>Tahun Masuk</th>
            <th>Tahun Keluar</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach($riwayat as $row){
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $row->posisi . "</td>";
            echo "<td>" . $row->perusahaan . "</td>";
            echo "<td>" . $row->tahun_masuk . "</td>";
            echo "<td>" . $row->tahun_keluar . "</td>";
            
            echo "<td><a href='#' id='edit'   data-toggle='modal' data-target='#edit" . $row->id . "'><i class=\"fa fa-pencil\"></i></a> &nbsp;&nbsp;&nbsp;<a href='#' id='delete' onclick='delete_pendidikan(" . $row->id . ")'><i class=\"fa fa-trash\"></i></a></td>";
            $i++;

          ?>
          <div class="modal fade" id="edit<?php echo  $row->id ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Riwayat Pekerjaan</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" onsubmit="return false" id="form_edit<?php echo  $row->id ?>" enctype="multipart/form-data">
                            
                             <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Sebagai</label>
                              <div class="col-sm-6">
                                <input type="text" name="posisi" id="posisi<?php echo $row->id?>" class="form-control" value="<?php echo  $row->posisi; ?>">
                              </div>
                            </div>
                             <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Perusahaan</label>
                              <div class="col-sm-6">
                                <input type="text" name="perusahaan" id="perusahaan<?php echo $row->id?>" class="form-control" value="<?php echo  $row->perusahaan; ?>">
                              </div>               
                            </div>
                             <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Tahun Masuk</label>
                              <div class="col-sm-6">
                                <input type="number" name="tahun_masuk" id="tahun_masuk<?php echo $row->id?>" class="form-control" value="<?php echo  $row->tahun_masuk; ?>">
                              </div>
                            </div>
                             <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Tahun Keluar</label>
                              <div class="col-sm-6">
                                <input type="number" name="tahun_keluar" id="tahun_keluar<?php echo $row->id?>" class="form-control" value="<?php echo  $row->tahun_keluar; ?>">
                              </div>
                            </div>
                            <div class="col-sm-12 col-form-label">
                                <input type="submit" id="edit_submit<?php echo $row->id?>" class="btn btn-primary" value="Simpan" data-dismiss="modal">
                            </div>
                        </form>
                    </div>
                 </div>
            </div>
        </div>
        <script>
          $("#edit_submit<?php echo $row->id?>").on("click",function(){
            $.ajax({
                url : "<?php echo base_url();?>simpeg/RiwayatPekerjaan/update",
                method : "POST",
                data : "posisi="+$("#posisi<?php echo $row->id ?>").val()+
                  "&perusahaan="+$("#perusahaan<?php echo $row->id?>").val()+
                  "&tahun_masuk="+$("#tahun_masuk<?php echo $row->id?>").val()+
                  "&tahun_keluar="+$("#tahun_keluar<?php echo $row->id?>").val()+
                  "&id=<?php echo $row->id ?>",
                //async : false,
                //dataType : 'json',
                success: function(data){
                  
                  if(data == "1"){
                    refresh_table();
                  }else{
                    $(".alert").html("DATA GAGAL DI TAMBAHKAN");
                  }
                  $('.modal-backdrop').remove();
                  //alert($("#form_edit<?php echo $row->id?>").serialize());
                }
            });
          });

        </script>
          <?php
          }
          ?>
        </tbody>
      </table>
     
      
    </div>
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Tambah Riwayat Pekerjaan</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="javascript:void(0)" enctype="multipart/form-data">
                       <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Sebagai</label>
                        <div class="col-sm-6">
                          <input type="text" name="posisi" id="posisi" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Perusahaan</label>
                        <div class="col-sm-6">
                          <input type="text" name="perusahaan" id="perusahaan" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Tahun Masuk</label>
                        <div class="col-sm-6">
                          <input type="number" name="tahun_masuk" id="tahun_masuk" class="form-control" value="">
                        </div>
                      </div>
                     <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Tahun Keluar</label>
                        <div class="col-sm-6">
                          <input type="number" name="tahun_keluar" id="tahun_keluar" class="form-control" value="">
                        </div>
                      </div>
                      
                      <div class="col-sm-12 col-form-label">
                          <input type="submit" id="save" class="btn btn-primary" value="Simpan" data-dismiss="modal">
                      </div>
              </form>
          </div>
       </div>
  </div>
</div>
</div>
<script>
  $("#save").on("click",function(){
    $.ajax({
        url : "<?php echo base_url();?>simpeg/RiwayatPekerjaan/insert",
        method : "POST",
        data : "posisi="+$("#posisi").val()+
                  "&perusahaan="+$("#perusahaan").val()+
                  "&tahun_masuk="+$("#tahun_masuk").val()+
                  "&tahun_keluar="+$("#tahun_keluar").val()+
                  "&id_pegawai=<?php echo $id_pegawai?>",
        //async : false,
        //dataType : 'json',
        success: function(data){
          
          if(data == "1"){
            refresh_table();
          }else{
            $(".alert").html("DATA GAGAL DI TAMBAHKAN");
          }
          $('.modal-backdrop').remove();
          
        }
    });
  });
  function delete_pendidikan(id){
    var r = confirm("Yakin Ingin Menghapus ?")
    if(r == true){
      $.ajax({
        url : "<?php echo base_url();?>simpeg/RiwayatPekerjaan/delete",
        method : "POST",
        data : "id="+id,
        //async : false,
        //dataType : 'json',
        success: function(data){
          
          if(data == "1"){
            refresh_table();
          }else{
            $(".alert").html("DATA GAGAL DI TAMBAHKAN");
          }
          $('.modal-backdrop').remove();
          
        }
      });
    }
  }
  
  function refresh_table(){
      $.ajax({
        url : "<?php echo base_url();?>simpeg/RiwayatPekerjaan/refresh",
        data : "id=<?php echo $id_pegawai?>",
        type : "GET",
        //async : false,
        //dataType : 'json',
        success: function(data){
          $("#tbl_pegawai").html(data);
          
        }
    });        
  }
</script>
