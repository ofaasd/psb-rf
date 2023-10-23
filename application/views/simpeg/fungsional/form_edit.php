<br /><br />
<form method="POST" onsubmit="return false" id="form_edit<?php echo  $row->id ?>" enctype="multipart/form-data">
     <div class="form-group row">
      <label class="col-sm-4 col-form-label" for="jenjang">Jabatan Fungsional</label>
      <div class="col-sm-6">
        <select class="form-control" name="fungsional" id="jabatan_fungsional_sekarang<?php echo $row->id?>">
          <?php
          foreach($jabatan_fungsional as $value){
            echo "<option value='" . $value . "'";
            if($row->jabatan_fungsional_sekarang == $value)
              echo "selected";
            echo ">" . $value ."</option>";
            }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-4 col-form-label" for="jenjang">No. SK</label>
      <div class="col-sm-6">
        <input type="text" name="no_sk" id="no_sk<?php echo $row->id?>" class="form-control" value="<?php echo  $row->no_sk_fungsional; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-4 col-form-label" for="jenjang">Tanggal SK</label>
      <div class="col-sm-6">
        <input type="date" name="tanggal_sk" id="tgl_sk<?php echo $row->id?>" class="form-control" value="<?php echo  $row->tgl_sk_fungsional ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-4 col-form-label" for="jenjang">TMT SK</label>
      <div class="col-sm-6">
        <input type="date" name="tempat" id="tmt_sk<?php echo $row->id?>" class="form-control" value="<?php echo  $row->tmt_sk_fungsional ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-4 col-form-label" for="jenjang">KUM</label>
      <div class="col-sm-6">
        <input type="text" name="kum" id="kum<?php echo $row->id?>" class="form-control" value="<?php echo  $row->kum ?>">
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
        <input type="button" id="tutup_edit<?php echo $row->id ?>" class="btn" value="Tutup"  onclick="tutup_edit()">
    </div>
</form>
<script>
  function tutup_edit(){
    $("#form-edit").html("");
  }

  $("#edit_submit<?php echo $row->id?>").on("click",function(){
    $.ajax({
        url : "<?php echo  base_url();?>simpeg/RiwayatJabatanFungsional/update",
        method : "POST",
        data : "jabatan_fungsional_sekarang="+$("#jabatan_fungsional_sekarang<?php echo $row->id ?>").val()+
          "&no_sk="+$("#no_sk<?php echo $row->id?>").val()+
          "&tgl_sk="+$("#tgl_sk<?php echo $row->id?>").val()+
          "&tmt_sk="+$("#tmt_sk<?php echo $row->id?>").val()+
          "&kum="+$("#kum<?php echo $row->id?>").val()+
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

</script>
