<style>
table.dataTable td {
    padding: 10px;
}
</style>
<div class="card">
    <div class="card-header">
        <?php 
          $jenjang = array("SLTA","D-I", "D-II", "D-III", "D-IV", "S1","S2","S3");
          echo $this->session->userdata('status_delete'); 
              $this->session->set_userdata('status_delete','');
              ?>
        <h5>RIWAYAT PENGABDIAN</h5>
        <div class="alert alert-primary" id="alert">
                          
        </div>
    </div>
    <div class="card-block" id="tbl_pegawai" style="overflow-x: scroll;">
      <a href="#form-add" id="add"  class="btn btn-primary waves-effect" onclick="add_form()">Tambah</a> <br /><br /><br />
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Kegiatan</th>
            <th>Tahun</th>
            <th>Tempat</th>
            <th>Link</th>
            <th>Bukti Kegiatan</th>
            <th>Proposal Kegiatan</th>
            <th>Anggota</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach($riwayat as $row){
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $row->nama_kegiatan . "</td>";
            echo "<td>" . $row->tahun . "</td>";
            echo "<td>" . $row->tempat . "</td>";
            echo "<td>" . $row->link_url . "</td>";
            echo "<td align='left'>";
            if(!empty($row->bukti)){
              if(substr($row->bukti, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/pengabdian/".$row->bukti . "' target='_blank' title='bukti'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/pengabdian/".$row->bukti . "' target='_blank' title='bukti'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "&nbsp;&nbsp;&nbsp;";
            echo "</td>";
			echo "<td align='left'>";
            if(!empty($row->proposal)){
              if(substr($row->proposal, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/pengabdian/".$row->proposal . "' target='_blank' title='Proposal'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/pengabdian/".$row->proposal . "' target='_blank' title='Proposal'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "&nbsp;&nbsp;&nbsp;";
            echo "</td>";
			echo "<td>";
            echo "<ul>";
            echo "<li><a href='javascript:void(0)'>" . $row->nama_ketua . " (Ketua)</a></li>";
            $query = $this->db->query("select * from pegawai_anggota_pengabdian where id_pengabdian='" . $row->p_id . "'")->result();


            foreach($query as $anggota){

              if($anggota->jenis_anggota == 1){
                $pegawai = $this->db->query("select * from pegawai where id='" . $anggota->id_anggota . "'")->row();
                echo "<li><a href='javascript:void(0)'>" . $pegawai->nama . "(Anggota)</a></li>";
              }else{
                $mahasiswa = $this->db->query("select * from mahasiswa where id='" . $anggota->id_anggota . "'")->row();
                echo "<li><a href='javascript:void(0)'>" . $mahasiswa->nama . "(Anggota)</a></li>";
              }
              
            }
            echo "</ul>";
            echo "</td>";
            
            echo "<td><a href='#form-edit' id='edit' onclick='get_form_edit(" . $row->p_id . ")' ><i class=\"fa fa-pencil\"></i></a> &nbsp;&nbsp;&nbsp;<a href='#' id='delete' onclick='delete_pendidikan(" . $row->p_id . ")'><i class=\"fa fa-trash\"></i></a></td>";
            $i++;
            echo "</tr>";
          ?>
        
          <?php
          }
          ?>
        </tbody>
      </table>
      
      
    
</div>
</div>
<div class="col-sm-12" id="form-edit">

</div>
<div class="col-sm-12" id="form-add" >
     <form method="POST" action="javascript:void(0)" id="formPenelitian" enctype="multipart/form-data">
        <div class="row">
         <div class="col-sm-6">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Nama Kegiatan</label>
            <div class="col-sm-6">
              <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Tahun</label>
            <div class="col-sm-6">
              <input type="text" name="tahun" id="tahun" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Tempat Kegiatan</label>
            <div class="col-sm-6">
              <input type="text" name="tempat" id="tempat" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Link Bukti</label>
            <div class="col-sm-8">
              <input type="text" name="link_url" id="link_url" class="form-control" value="" placeholder="ex : http://google.com">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Bukti Kegiatan</label>
            <div class="col-sm-8">
              <input type="file" name="bukti" id="bukti" class="form-control" value="">
            </div>
          </div>
		  <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Proposal Kegiatan</label>
            <div class="col-sm-8">
              <input type="file" name="proposal" id="proposal" class="form-control" value="">
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Ketua</label>
            <div class="col-sm-8">
              <select name="ketua" id="ketua" class="js-example-basic-single col-sm-12" placeholder="--Nama Ketua--">
                  <?php
                      //echo "<option value='0'></option>";
                      foreach($pegawai as $value){
                          echo "<option value=" . $value->npp . "  >" . $value->npp . " - " . $value->nama . "</option>";
                      }
                  ?> 
              </select>
            </div>
          </div>
          <div class="form-group row" id="anggota">
            <!-- <label class="col-sm-12 col-form-label" for="jenjang">Anggota</label> -->
              <table class="mytable" width="100%">
                <thead>
                  <tr>
                    <td>Jenis Anggota</td>
                    <td>Nama Anggota</td>
                    <td><a href="javascript:void(0)" class="text-primary" style="margin-top:8px;" id="add_anggota"><i class="fa fa-plus"></i> Anggota</a> </td>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
              <!-- <div class="col-sm-1">        
                <a href="#" class="text-danger" style="margin-top:8px;"><i class="fa fa-trash"></i></i></a>
              </div> -->
            </div>
          
        </div>
        </div>
          <div class="col-sm-12 col-form-label">
              <input type="submit" id="save" class="btn btn-primary" value="Simpan" data-dismiss="modal">
          </div>
      </form>
      </div>
    </div>
<script>
  function get_form_edit(id){
    $.ajax({
        url : "<?php echo base_url();?>simpeg/RiwayatPengabdian/edit_form",
        method : "POST",
        data : "id="+id,
        success: function(data){
          $("#form-edit").html(data);
        }
    });
  }
  $(".js-example-basic-single").select2({
    //dropdownParent: $("#tambah")
  });
  $("#save").on("click",function(){
    var formPenelitian = new FormData(document.getElementById("formPenelitian"));
    formPenelitian.append("id_pegawai",<?php echo $id_pegawai?>);
    $.ajax({
        url : "<?php echo base_url();?>simpeg/RiwayatPengabdian/insert",
        method : "POST",
        // data : "nomor="+$("#nomor").val()+
        //           "&judul="+$("#judul").val()+
        //           "&id_fakultas="+$("#fakultas").val()+
        //           "&jenis_penelitian="+$("#jenis_penelitian").val()+
        //           "&tahun="+$("#tahun").val()+
        //           "&sumber_dana="+$("#sumber_dana").val()+
        //           "&dana="+$("#dana").val()+
        //           "&no_surat="+$("#no_surat").val()+
        //           "&penyelenggara="+$("#penyelenggara").val()+
        //           "&ketua="+$("#ketua").val()+
        //           "&anggota="+$("#anggota").val()+
        //           "&id_pegawai=<?php echo $id_pegawai?>",
        //async : false,
        //dataType : 'json',
        data : formPenelitian,
        processData: false,
        contentType: false,
        success: function(data){
          
          if(data == "1"){
			$("#form-edit").html("");
            refresh_table();
          }else{
            $(".alert").html("DATA GAGAL DI TAMBAHKAN");
          }
          $('.modal-backdrop').remove();
          
        }
    });
  });
  function add_form(){
    $("#form-add").toggle();
  }
  $(document).ready(function(){
    $("#form-add").hide();
    var t = $(".mytable").DataTable({
      "paging":   false,
      "ordering": false,
      "info":     false

    });
    var counter = 1;

    $("#add_anggota").on("click", function(){
      t.row.add([
        '<select name="jenis[]" id="jenis_anggota'+counter+'" onclick="getAnggota(\'#jenis_anggota'+counter+'\',\'#list_anggota'+counter+'\');"> \
            <option value=0>Jenis Anggota</option> \
            <option value=1>Dosen</option>\
            <option value=2>Mahasiswa</option>\
          </select>',
        '<div id="list_anggota'+counter+'" style="width:150px">\
            <select name="anggota[]" class="jenis_anggota" style="width:100px">\
              <option value=0>Nama Anggota</option>\
            </select>\
          </div>',
        '<a href="javascript:void(0)" class="delete_row" class="text-danger" style="margin-top:8px;"><i class="fa fa-trash"></i></i></a>',
      ]).draw();
      counter++;
    });
    $("#add_anggota").click();
    $('.mytable tbody').on( 'click', '.delete_row', function () {
                t
                    .row( $(this).parents('tr') )
                    .remove()
                    .draw();
            } );
  });
  
  
  function getAnggota(source,destination){
    $(source).on("change",function(){
      $.ajax({
          url : "<?php echo base_url();?>simpeg/RiwayatPengabdian/getAnggota",
          method : "POST",
          data : "jenis="+$(this).val(),
          //async : false,
          //dataType : 'json',
          success: function(data){
            $(destination).html(data);
            $(".jenis_anggota").select2({
              //dropdownParent: $("#tambah"),
              width: '100px' 
            });
          }
        });
    });

  }
  
  function delete_pendidikan(id){
    var r = confirm("Yakin Ingin Menghapus ?")
    if(r == true){
      $.ajax({
        url : "<?php echo base_url();?>simpeg/RiwayatPengabdian/delete",
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
        url : "<?php echo base_url();?>simpeg/RiwayatPengabdian/refresh",
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
