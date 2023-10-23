<br /><br />
<form method="POST" onsubmit="return false" id="form_edit<?php echo  $row->id ?>" enctype="multipart/form-data">
    <div class="form-group row">
      <label class="col-sm-4 col-form-label" for="judul">Judul</label>
      <div class="col-sm-6">
        <input type="text" name="judul" id="judul<?php echo $row->id?>" class="form-control" value="<?php echo  $row->judul; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-4 col-form-label" for="nama_majalah">Nama Majalah</label>
      <div class="col-sm-6">
        <input type="text" name="nama_majalah" id="nama_majalah<?php echo $row->id?>" class="form-control" value="<?php echo  $row->nama_majalah; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-4 col-form-label" for="volume">Volume</label>
      <div class="col-sm-6">
        <input type="text" name="volume" id="volume<?php echo $row->id?>" class="form-control" value="<?php echo  $row->volume; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-4 col-form-label" for="nomor">Nomor</label>
      <div class="col-sm-6">
        <input type="text" name="nomor" id="nomor<?php echo $row->id?>" class="form-control" value="<?php echo  $row->nomor; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-4 col-form-label" for="bulan">Bulan</label>
      <div class="col-sm-6">
        <select name="bulan" id="bulan<?php echo $row->id?>" class="form-control">
          <?php
          foreach($bulan as $key=>$value){
            echo "<option value=" . $value ." ";
            if($value == $row->bulan){
              echo "selected";
            }
            echo ">" . $value . "</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-4 col-form-label" for="tahun">Tahun</label>
      <div class="col-sm-6">
        <input type="number" name="tahun" id="tahun<?php echo $row->id?>" class="form-control" value="<?php echo  $row->tahun; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-4 col-form-label" for="jenjang">Link Url</label>
      <div class="col-sm-6">
        <input type="url" name="link_url" id="link_url" class="form-control" value="<?php echo $row->link_url?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-4 col-form-label" for="jenjang">File</label>
      <div class="col-sm-6">
        <input type="file" name="file" id="file" class="form-control" value="">
      </div>
    </div>
    <div class="col-sm-12 col-form-label">
        <input type="submit" id="edit_submit<?php echo $row->id?>" class="btn btn-primary" value="Simpan" data-dismiss="modal">
    </div>
</form>
<script>
  $("#edit_submit<?php echo $row->id?>").on("click",function(){
    var formKaryaIlmiah = new FormData(document.getElementById("form_edit<?php echo  $row->id ?>"));
    formKaryaIlmiah.append("id",<?php echo $row->id ?>);
    $.ajax({
        url : "<?php echo  base_url();?>simpeg/RiwayatKaryaIlmiah/update",
        method : "POST",
        // data : "judul="+$("#judul<?php echo $row->id ?>").val()+
        //   "&nama_majalah="+$("#nama_majalah<?php echo $row->id?>").val()+
        //   "&volume="+$("#volume<?php echo $row->id?>").val()+
        //   "&nomor="+$("#nomor<?php echo $row->id?>").val()+
        //   "&bulan="+$("#bulan<?php echo $row->id?>").val()+
        //   "&tahun="+$("#tahun<?php echo $row->id?>").val()+
        //   "&id=<?php echo $row->id ?>",
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
          $("#form-edit").html("");
          //alert($("#form_edit<?php echo $row->id?>").serialize());
        }
    });
  });

</script>