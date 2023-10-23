<div class="alert alert-primary" id="modal-ijazah<?php echo  $row->id ?>" aria-hidden="true">
  <div class="row">
    <div class="col-lg-6">
      <div class="card" role="document">
        <div class="card-header">
           <button type="button" class="close" onclick="$('#modal-ijazah<?php echo  $row->id ?>').hide()">
          <i class="icofont icofont-close-line-circled"></i>
          </button>
            <h4 class="modal-title">File Ijazah</h4>
            <hr />
        </div>
        <div class="card-block">
          <?php if (!empty($row->ijazah)){
                  $ekstensi = substr($row->ijazah, -3);
                if($ekstensi != "pdf"){
                ?>
                <img src="<?php echo base_url()?>assets/images/ijazah/<?php echo $row->ijazah?>" width="100%">
                <hr />
              <?php }else{
                ?>
                <object data="<?php echo base_url()?>/assets/images/ijazah/<?php echo $row->ijazah?>" type="application/pdf" width="100%" height="300">
                  <p><a href="<?php echo base_url()?>/assets/images/ijazah/<?php echo $row->ijazah?>">Download Here</a></p>
                </object>
                <?php
              } }?>
          <h5>
            Upload Ijazah
          </h5>

          <form method="POST" action="javascript:void(0)" id="form-ijazah<?php echo  $row->id ?>" enctype="multipart/form-data">
            <div class="form-group">
              <label for="jenjang">FIle Ijazah</label>
              <input type="file" name="ijazah" id="ijazah_update<?php echo $row->id ?>" class="form-control">
            </div>
            <input type="hidden" name="id" value="<?php echo $row->id?>">
            <div class="col-sm-12 col-form-label">
              <input type="submit" id="save_ijazah<?php echo $row->id ?>" class="btn btn-primary" value="Simpan" data-dismiss="modal">
              <input type="button" id="cancel1" class="btn" value="Tutup" data-dismiss="modal">
            </div>
          </form>
          <script>
            $("#save_ijazah<?php echo $row->id ?>").on("click",function(){
              var formIjazah<?php echo $row->id ?> = new FormData(document.getElementById("form-ijazah<?php echo  $row->id ?>"));
              //alert("clicked");

              $.ajax({
                  url : "<?php echo  base_url();?>simpeg/manage/update_ijazah",
                  method : "POST",
                  //data : "jenjang="+$("#jenjang").val()+"&jurusan="+$("#jurusan").val()+"&jurusan_lain="+$("#jurusan_lain").val()+"&universitas_lain="+$("#universitas_lain").val()+"&universitas="+$("#universitas").val()+"&tempat="+$("#tempat").val()+"&no_ijazah="+$("#no_ijazah").val()+"&tanggal_ijazah="+$("#tanggal").val()+"&tahun="+$("#tahun").val()+"&id_pegawai=<?php echo $id_pegawai?>",
                  data : formIjazah<?php echo $row->id ?>,
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
                    //alert($("#form_edit<?php echo $row->id?>").serialize());
                  }
              });
            });
          </script>
        </div>
      </div>
    </div>
  </div>
</div>