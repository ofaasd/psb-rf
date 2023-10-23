<div class="card">
    <div class="card-header">
        <?php 
          
          echo $this->session->userdata('status_delete'); 
              $this->session->set_userdata('status_delete','');
              ?>
        <h5>RIWAYAT BUKU</h5>
        <div class="alert alert-primary" id="alert">
                          
        </div>
    </div>
    <div class="card-block" id="tbl_pegawai" style="overflow-x: scroll;">
      <a href="#" id="add"  class="btn btn-primary waves-effect" data-toggle='modal' data-target='#tambah' onclick="">Tambah</a><br /><br /><br />
      <table class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>No.</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>ISBN</th>
            <th>Tahun</th>
            <th>Dokumen</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach($riwayat as $row){
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $row->judul_buku . "</td>";
            echo "<td>" . $row->penulis . "</td>";
            echo "<td>" . $row->isbn . "</td>";
            echo "<td>" . $row->tahun . "</td>";
            echo "<td><a href='" . $row->link_dokumen . "' target='_blank'>" . $row->link_dokumen . "</a></td>";
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
                        <label class="col-sm-4 col-form-label" for="jenjang">Judul</label>
                        <div class="col-sm-6">
                          <input type="text" name="judul_buku" id="judul" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Penulis</label>
                        <div class="col-sm-6">
                          <input type="text" name="penulis" id="penulis" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">ISBN</label>
                        <div class="col-sm-6">
                          <input type="text" name="isbn" id="isbn" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Tahun</label>
                        <div class="col-sm-6">
                          <input type="text" name="tahun" id="tahun" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Link Dokumen</label>
                        <div class="col-sm-6">
                          <input type="text" name="link_dokumen" id="link_dokumen" class="form-control" value="" placeholder="ex : https://google.com">
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
        url : "<?php echo base_url();?>simpeg/RiwayatBuku/edit_form",
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
        url : "<?php echo  base_url();?>simpeg/RiwayatBuku/insert",
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
        url : "<?php echo  base_url();?>simpeg/RiwayatBuku/delete",
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
        url : "<?php echo  base_url();?>simpeg/RiwayatBuku/refresh",
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
