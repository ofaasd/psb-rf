<div class="card">
    <div class="card-header">
        <?php 
          $jenjang = array("SLTA","D-I", "D-II", "D-III", "D-IV", "S1","S2","S3");
          echo $this->session->userdata('status_delete'); 
              $this->session->set_userdata('status_delete','');
              ?>
        <h5>RIWAYAT ORGANISASI</h5>
        <div class="alert alert-primary" id="alert">
                          
        </div>
    </div>
    <div class="card-block" id="tbl_pegawai">
      <a href="#" id="add" class="btn btn-primary waves-effect"  data-toggle="modal" data-target="#tambah">Tambah</a> <br /><br />
      <table class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Organisasi</th>
            <th>Jabatan</th>
            <th>Tahun</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach($riwayat as $row){
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $row->nama_organisasi . "</td>";
            echo "<td>" . $row->jabatan . "</td>";
            echo "<td>" . $row->tahun . "</td>";
            
            echo "<td><a href='#' id='edit'   data-toggle='modal' data-target='#edit" . $row->id . "'><i class=\"fa fa-pencil\"></i></a> &nbsp;&nbsp;&nbsp;<a href='#' id='delete' onclick='delete_pendidikan(" . $row->id . ")'><i class=\"fa fa-trash\"></i></a></td>";
            $i++;

          ?>
          <div class="modal fade" id="edit<?php echo  $row->id ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Riwayat Organisasi</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" onsubmit="return false" id="form_edit<?php echo  $row->id ?>" enctype="multipart/form-data">
                            
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Nama Organisasi</label>
                              <div class="col-sm-6">
                                <input type="text" name="nama_organisasi" id="nama_organisasi<?php echo $row->id?>" class="form-control" value="<?php echo  $row->nama_organisasi; ?>">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Jabatan</label>
                              <div class="col-sm-6">
                                <input type="text" name="jabatan" id="jabatan<?php echo $row->id?>" class="form-control" value="<?php echo  $row->jabatan; ?>">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Tahun</label>
                              <div class="col-sm-6">
                                  <input type="text" name="tahun" id="tahun<?php echo $row->id?>" class="form-control" value="<?php echo  $row->tahun; ?>">
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
                url : "<?php echo base_url();?>simpeg/RiwayatOrganisasi/update",
                method : "POST",
                data : "nama_organisasi="+$("#nama_organisasi<?php echo $row->id ?>").val()+
                  "&jabatan="+$("#jabatan<?php echo $row->id?>").val()+
                  "&tahun="+$("#tahun<?php echo $row->id?>").val()+
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
                  <h4 class="modal-title">Tambah Riwayat Organisasi</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="javascript:void(0)" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Nama Organisasi</label>
                        <div class="col-sm-6">
                          <input type="text" name="nama_organisasi" id="nama_organisasi" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Jabatan</label>
                        <div class="col-sm-6">
                          <input type="text" name="jabatan" id="jabatan" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Tahun</label>
                        <div class="col-sm-6">
                          <input type="text" name="tahun" id="tahun" class="form-control" value="">
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
        url : "<?php echo base_url();?>simpeg/RiwayatOrganisasi/insert",
        method : "POST",
        data : "nama_organisasi="+$("#nama_organisasi").val()+
              "&jabatan="+$("#jabatan").val()+
              "&tahun="+$("#tahun").val()+
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
        url : "<?php echo base_url();?>simpeg/RiwayatOrganisasi/delete",
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
        url : "<?php echo base_url();?>simpeg/RiwayatOrganisasi/refresh",
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
