<div class="card">
    <div class="card-header">
        <?php 
          
          echo $this->session->userdata('status_delete'); 
              $this->session->set_userdata('status_delete','');
              ?>
        <h5>RIWAYAT HAKI</h5>
        <div class="alert alert-primary" id="alert">
                          
        </div>
    </div>
    <div class="card-block" id="tbl_pegawai" style="overflow-x: scroll;">
      <a href="#" id="add"  class="btn btn-primary waves-effect" data-toggle='modal' data-target='#tambah' onclick="">Tambah</a><br /><br /><br />
      <table class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>No.</th>
            <th>Pemilik</th>
            <th>Tahun Ajaran</th>
            <th>Judul</th>
            <th>Sertifikat</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach($riwayat as $row){
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $row->pemilik . "</td>";
            echo "<td>" . $row->tahun_ajaran . "</td>";
            echo "<td>" . $row->judul . "</td>";
            echo "<td>";
            if(!empty($row->sertifikat)){
              if(substr($row->sertifikat, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/haki/".$row->sertifikat . "' target='_blank' title='dokumen'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/haki/".$row->sertifikat . "' target='_blank' title='dokumen'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "</td>";
            echo "<td><a href='#form-edit' id='edit' onclick='get_form_edit(" . $row->id . ")' ><i class=\"fa fa-pencil\"></i></a> &nbsp;&nbsp;&nbsp;<a href='#' id='delete' onclick='delete_pendidikan(" . $row->id . ")'><i class=\"fa fa-trash\"></i></a></td>";
            $i++;

          ?>
          <?php
          }
          ?>
        </tbody>
      </table>
     
      
    </div>
    <div class="col-sm-12" id="form-edit">

    </div>
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Tambah Riwayat Buku</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="javascript:void(0)" id="formKaryaIlmiah" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Pemilik</label>
                        <div class="col-sm-6">
                          <input type="text" name="pemilik" id="pemilik" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Tahun Ajaran</label>
                        <div class="col-sm-6">
                          <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Judul</label>
                        <div class="col-sm-6">
                          <input type="text" name="judul" id="judul" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Sertifikat</label>
                        <div class="col-sm-6">
                          <input type="file" name="file" id="file" class="form-control" value="" placeholder="ex : https://google.com">
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
  function get_form_edit(id){
    $.ajax({
        url : "<?php echo base_url();?>simpeg/RiwayatHaki/edit_form",
        method : "POST",
        data : "id="+id,
        success: function(data){
          $("#form-edit").html(data);
        }
    });
  }
  $("#save").on("click",function(){
    var formKaryaIlmiah = new FormData(document.getElementById("formKaryaIlmiah"));
    formKaryaIlmiah.append("id_pegawai",<?php echo $id_pegawai?>);
    $.ajax({
        url : "<?php echo  base_url();?>simpeg/RiwayatHaki/insert",
        method : "POST",
        // data : "judul="+$("#judul").val()+
        //           "&nama_majalah="+$("#nama_majalah").val()+
        //           "&volume="+$("#volume").val()+
        //           "&nomor="+$("#nomor").val()+
        //           "&bulan="+$("#bulan").val()+
        //           "&tahun="+$("#tahun").val()+
        //           "&id_pegawai=<?php echo $id_pegawai?>",
        data : formKaryaIlmiah,
        processData: false,
        contentType: false,
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
        url : "<?php echo  base_url();?>simpeg/RiwayatHaki/delete",
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
        url : "<?php echo  base_url();?>simpeg/RiwayatHaki/refresh",
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
