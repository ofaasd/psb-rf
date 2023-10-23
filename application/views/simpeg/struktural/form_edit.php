<br /><br />
<form method="POST" onsubmit="return false" id="form_edit<?php echo  $row->id ?>" enctype="multipart/form-data">
  <div class="form-group row">
    <label class="col-sm-4 col-form-label" for="jenjang">Unit Kerja</label>
    <div class="col-sm-6">
      <select class="form-control" name="unit_kerja" id="edit_unit_kerja">
          <option value="0">-- Unit Kerja --</option>
          <?php
              foreach($unit_kerja as $value){
                  echo "<option value='" . $value->id . "' ";
                  if(!empty($curr_jabatan) && $value->id == $curr_jabatan->id_unit_kerja){
                      echo "selected";
                  }
                  echo ">" . $value->unit_kerja . "</option>";
              }
          ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-4 col-form-label" for="jenjang">Bagian</label>
    <div class="col-sm-6" id="pl_edit_bagian">
      <select class="form-control" name="bagian" id="edit_bagian">
          <option value="0">-- Bagian --</option>
          <?php
              foreach($bagian as $value){
                  echo "<option value='" . $value->id . "' ";
                  if(!empty($curr_jabatan) && $value->id == $curr_jabatan->id_bagian){
                      echo "selected";
                  }
                  echo ">" . $value->nama_bagian . "</option>";
              }
          ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-4 col-form-label" for="jenjang">Jenis Jabatan</label>
    <div class="col-sm-6" id="pl_edit_jenis_jabatan">
      <select class="form-control" name="jenis_jabatan" id="edit_jenis_jabatan">
        <option value="0">-- Jenis Jabatan --</option>
        <?php
            foreach($jenis_jabatan as $value){
                echo "<option value='" . $value->id . "' ";
                if(!empty($curr_jabatan) && $value->id == $curr_jabatan->id_jenis_jabatan){
                    echo "selected";
                }
                echo ">" . $value->nama_jenis . "</option>";
                if($curr_jabatan->id_bagian != 5){
                    break;
                }
            }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-4 col-form-label" for="jenjang">Jabatan</label>
    <div class="col-sm-6" id="pl_edit_jabatan">
      <select class="form-control" name="jabatan_struktural" id="edit_jabatan">
          <option value="0">-- Jabatan Struktural --</option>
          <?php
          foreach($jabatan_struktural as $jabatan){
          ?>
          <?php echo "<option value='" . $jabatan->id . "'";
          if(!empty($curr_jabatan) && $jabatan->id == $curr_jabatan->id){
              echo "selected";
          }
          echo ">" . $jabatan->nama_jabatan . "</option>";?>
           
          <?php
          }
          ?>
      </select>
    </div>
  </div>
                          
  <div class="form-group row">
    <label class="col-sm-4 col-form-label" for="jenjang">No. SK</label>
    <div class="col-sm-6">
      <input type="text" name="no_sk" id="no_sk<?php echo $row->id?>" class="form-control" value="<?php echo  $row->no_sk_struktural ?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-4 col-form-label" for="jenjang">Tanggal SK</label>
    <div class="col-sm-6">
     <input type="date" name="tanggal_sk" id="tgl_sk<?php echo $row->id?>" class="form-control" value="<?php echo  $row->tanggal_sk_struktural ?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-4 col-form-label" for="jenjang">TMT SK</label>
    <div class="col-sm-6">
      <input type="date" name="tempat" id="tmt_sk<?php echo $row->id?>" class="form-control" value="<?php echo  $row->tmt_sk_struktural ?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-4 col-form-label" for="jenjang">Status</label>
    <div class="col-sm-6">
      <select name="status" class="form-control" id="status<?php echo $row->id?>">
        <option value="1" <?php echo  ($row->status == 1)?"selected":""?>>Aktif</option>
        <option value="0"  <?php echo  ($row->status == 0)?"selected":""?>>Tidak Aktif</option>
      </select>
    </div>
  </div>
  <div class="col-sm-12 col-form-label">
      <input type="submit" id="edit_submit<?php echo $row->id?>" class="btn btn-primary" value="Simpan" data-dismiss="modal">
  </div>
</form>
<script>
  function tutup_edit(){
    $("#form-edit").html("");
  }

  $("#edit_submit<?php echo $row->id?>").on("click",function(){
    $.ajax({
        url : "<?php echo base_url();?>simpeg/RiwayatJabatanStruktural/update",
        method : "POST",
        data : "unit_kerja="+$("#edit_unit_kerja").val()+
          "&id_jabatan_struktural="+$("#edit_jabatan").val()+
          "&no_sk="+$("#no_sk<?php echo $row->id?>").val()+
          "&tgl_sk="+$("#tgl_sk<?php echo $row->id?>").val()+
          "&tmt_sk="+$("#tmt_sk<?php echo $row->id?>").val()+
          "&status="+$("#status<?php echo $row->id?>").val()+
          "&id_pegawai=<?php echo $row->id_pegawai?>"+
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
          $("#form-edit").html("");
          //alert($("#form_edit<?php echo $row->id?>").serialize());
        }
    });
  });
  $("#edit_unit_kerja").change(function(){
      var id=$(this).val();
      $.ajax({
          url : "<?php echo base_url();?>simpeg/RiwayatJabatanStruktural/get_bagian/",
          method : "POST",
          data : "id_unit="+id,
          success: function(data){
              $('#pl_edit_bagian').html(data);
          }
      });
  });
  $(document).on("change","#edit_bagian",function(){
      var id=$(this).val();
      var id_unit = $("#edit_unit_kerja").val();
      $.ajax({
          url : "<?php echo base_url();?>simpeg/RiwayatJabatanStruktural/get_jenis_jabatan/",
          method : "POST",
          data : "id_bagian="+id+"&id_unit="+id_unit,
          success: function(data){
              $('#pl_edit_jenis_jabatan').html(data);
          }
      });
  });
  $(document).on("change","#edit_jenis_jabatan",function(){
      var id=$(this).val();
      var id_bagian = $("#edit_bagian").val();
      $.ajax({
          url : "<?php echo base_url();?>simpeg/RiwayatJabatanStruktural/get_jabatan_struktural/",
          method : "POST",
          data : "id_jenis_jabatan="+id+"&id_bagian="+id_bagian,
          success: function(data){
              $('#pl_edit_jabatan').html(data);
          }
      });
  });
</script>
