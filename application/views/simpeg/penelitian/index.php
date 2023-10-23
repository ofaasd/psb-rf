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
        <h5>RIWAYAT PENELITIAN</h5>
        <div class="alert alert-primary" id="alert">
                          
        </div>
    </div>
    <div class="card-block" id="tbl_pegawai" style="overflow-x: scroll;">
      <a href="#form-add" id="add"  class="btn btn-primary waves-effect" onclick="add_form()">Tambah</a> <br /><br /><br />
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nomor/Judul</th>
            <th>Fakultas/Jenis Penelitian</th>
            <th>Tahun</th>
            <th>Sumber Dana</th>
            <th>Jumlah Dana</th>
            <th>No. Surat Perjanjian</th>
            <th>Penyelenggara</th>
            <th>Lampiran</th>
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
            echo "<td>" . $row->nomor . " " . $row->judul . "</td>";
            echo "<td>" . $row->nama_fakultas . " " . $row->jenis_penelitian ."</td>";
            echo "<td>" . $row->tahun . "</td>";
            echo "<td>" . $row->sumber_dana . "</td>";
            echo "<td>" . $row->dana . "</td>";
            echo "<td>" . $row->no_surat . "</td>";
            echo "<td>" . $row->penyelenggara . "</td>";
            echo "<td align='left'>";
            if(!empty($row->dokumen)){
              if(substr($row->dokumen, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->dokumen . "' target='_blank' title='dokumen'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->dokumen . "' target='_blank' title='dokumen'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "&nbsp;&nbsp;&nbsp;";
            if(!empty($row->proposal)){
              if(substr($row->proposal, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->proposal . "' target='_blank' title='proposal'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->proposal . "' target='_blank' title='proposal'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "&nbsp;&nbsp;&nbsp;";
            if(!empty($row->lap_kemajuan)){
              if(substr($row->lap_kemajuan, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_kemajuan . "' target='_blank' title='Laporan Kemajuan'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_kemajuan . "' target='_blank' title='Laporan Kemajuan'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "&nbsp;&nbsp;&nbsp;";  
            if(!empty($row->lap_keuangan)){
              if(substr($row->lap_keuangan, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_keuangan . "' target='_blank' title='Laporan Keuangan'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_keuangan . "' target='_blank' title='Laporan Keuangan'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "&nbsp;&nbsp;&nbsp;";
            if(!empty($row->lap_akhir)){
              if(substr($row->lap_akhir, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_akhir . "' target='_blank' title='Laporan Akhir'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_akhir . "' target='_blank' title='Laporan Akhir'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "<td>";
            echo "<ul>";
            echo "<li><a href='javascript:void(0)'>" . $row->nama_ketua . " (Ketua)</a></li>";
            $query = $this->db->query("select * from pegawai_anggota_penelitian where id_penelitian='" . $row->p_id . "'")->result();


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
            <label class="col-sm-4 col-form-label" for="jenjang">Nomor</label>
            <div class="col-sm-6">
              <input type="text" name="nomor" id="nomor" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">judul</label>
            <div class="col-sm-6">
              <input type="text" name="judul" id="judul" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Fakultas</label>
            <div class="col-sm-6">
              <select name="fakultas" id="fakultas" class="form-control">
                <?php
                foreach($fakultas as $value){
                  echo "<option value=" . $value->id ." ";
                  echo ">" . $value->nama_fakultas . "</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Jenis Penelitian</label>
            <div class="col-sm-6">
              <input type="text" name="jenis_penelitian" id="jenis_penelitian" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Tahun</label>
            <div class="col-sm-6">
              <input type="text" name="tahun" id="tahun" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Sumber Dana</label>
            <div class="col-sm-6">
              <input type="text" name="sumber_dana" id="sumber_dana" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Dokumen Publikasi</label>
            <div class="col-sm-8">
              <input type="file" name="dokumen" id="dokumen" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Proposal</label>
            <div class="col-sm-8">
              <input type="file" name="proposal" id="proposal" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Lap. Kemajuan</label>
            <div class="col-sm-8">
              <input type="file" name="lap_kemajuan" id="lap_kemajuan" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Lap. Keuangan</label>
            <div class="col-sm-8">
              <input type="file" name="lap_keuangan" id="lap_keuangan" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Lap. Akhir</label>
            <div class="col-sm-8">
              <input type="file" name="lap_akhir" id="lap_akhir" class="form-control" value="">
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Dana</label>
            <div class="col-sm-6">
              <input type="text" name="dana" id="dana" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">No. Surat Perjanjian</label>
            <div class="col-sm-6">
              <input type="text" name="no_surat" id="no_surat" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Penyelenggara</label>
            <div class="col-sm-8">
              <input type="text" name="penyelenggara" id="penyelenggara" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="jenjang">Ketua</label>
            <div class="col-sm-8">
              <select name="ketua" id="ketua" class="js-example-basic-single col-sm-12" placeholder="--Nama Ketua--">
                  <?php
                      //echo "<option value='0'></option>";
                      foreach($all_pegawai as $value){
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
	<script src="<?php echo base_url()?>assets/js/select2.full.min.js"></script>
	<script src="<?php echo base_url()?>assets/pages/advance-elements/select2-custom.js"></script>
<script>
  function get_form_edit(id){
    $.ajax({
        url : "<?php echo base_url();?>simpeg/RiwayatPenelitian/edit_form",
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
        url : "<?php echo base_url();?>simpeg/RiwayatPenelitian/insert",
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
          url : "<?php echo base_url();?>simpeg/RiwayatPenelitian/getAnggota",
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
        url : "<?php echo base_url();?>simpeg/RiwayatPenelitian/delete",
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
        url : "<?php echo base_url();?>simpeg/RiwayatPenelitian/refresh",
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
