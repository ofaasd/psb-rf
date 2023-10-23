<br /><br />
<form method="POST" onsubmit="return false" id="form_edit<?php echo  $row->id ?>" enctype="multipart/form-data">
    <div class="form-group row">
		<label class="col-sm-4 col-form-label" for="jenjang">Pemilik</label>
		<div class="col-sm-6">
		  <input type="text" name="pemilik" id="pemilik<?php echo  $row->id ?>" class="form-control" value="<?php echo  $row->pemilik ?>">
		</div>
	  </div>
	  <div class="form-group row">
		<label class="col-sm-4 col-form-label" for="jenjang">Tahun Ajaran</label>
		<div class="col-sm-6">
		  <input type="text" name="tahun_ajaran" id="tahun_ajaran<?php echo  $row->id ?>" class="form-control" value="<?php echo  $row->tahun_ajaran ?>">
		</div>
	  </div>
	  <div class="form-group row">
		<label class="col-sm-4 col-form-label" for="jenjang">Judul</label>
		<div class="col-sm-6">
		  <input type="text" name="judul" id="judul<?php echo  $row->id ?>" class="form-control" value="<?php echo  $row->judul ?>">
		</div>
	  </div>
	  <div class="form-group row">
		<label class="col-sm-4 col-form-label" for="jenjang">Sertifikat</label>
		<div class="col-sm-6">
		  <input type="file" name="file" id="file<?php echo  $row->id ?>" class="form-control" value="" placeholder="ex : https://google.com">
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
        url : "<?php echo  base_url();?>simpeg/RiwayatHaki/update",
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