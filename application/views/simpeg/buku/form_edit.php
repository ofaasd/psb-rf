<br /><br />
<form method="POST" onsubmit="return false" id="form_edit<?php echo  $row->id ?>" enctype="multipart/form-data">
    <div class="form-group row">
		<label class="col-sm-4 col-form-label" for="jenjang">Judul</label>
		<div class="col-sm-6">
		  <input type="text" name="judul_buku" id="judul<?php echo  $row->id ?>" class="form-control" value="<?php echo  $row->judul_buku; ?>">
		</div>
	  </div>
	  <div class="form-group row">
		<label class="col-sm-4 col-form-label" for="jenjang">Penulis</label>
		<div class="col-sm-6">
		  <input type="text" name="penulis" id="penulis<?php echo  $row->id ?>"" class="form-control" value="<?php echo  $row->penulis; ?>">
		</div>
	  </div>
	  <div class="form-group row">
		<label class="col-sm-4 col-form-label" for="jenjang">ISBN</label>
		<div class="col-sm-6">
		  <input type="text" name="isbn" id="isbn<?php echo  $row->id ?>"" class="form-control" value="<?php echo  $row->isbn; ?>">
		</div>
	  </div>
	  <div class="form-group row">
		<label class="col-sm-4 col-form-label" for="jenjang">Tahun</label>
		<div class="col-sm-6">
		  <input type="text" name="tahun" id="tahun<?php echo  $row->id ?>"" class="form-control" value="<?php echo  $row->tahun; ?>">
		</div>
	  </div>
	  <div class="form-group row">
		<label class="col-sm-4 col-form-label" for="jenjang">Link Dokumen</label>
		<div class="col-sm-6">
		  <input type="text" name="link_dokumen" id="link_dokumen<?php echo  $row->id ?>"" class="form-control" value="<?php echo  $row->link_dokumen; ?>" placeholder="ex : https://google.com">
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
        url : "<?php echo  base_url();?>simpeg/RiwayatBuku/update",
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