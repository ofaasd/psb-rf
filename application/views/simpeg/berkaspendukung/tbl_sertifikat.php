<table class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Kegiatan</th>
            <th>Penyelenggara</th>
            <th>Tanggal Kegiatan</th>
            <th>Peran Sebagai</th>
            <th>File</th>
            <th><a href="#" id="add" class="btn btn-primary waves-effect"  data-toggle="modal" data-target="#tambah">Tambah</a></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach($sertifikat as $row){
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $row->nama_kegiatan . "</td>";
            echo "<td>" . $row->penyelenggara . "</td>";
            echo "<td>" . date('d-m-Y', strtotime($row->tanggal_kegiatan)) . "</td>";
            echo "<td>" . $row->peran_sebagai . "</td>";
            echo "<td>";
            echo (empty($row->file))?"<a href='#' id='lihat_dokumen' data-toggle='modal' data-target='#modal-dokumen" . $row->id  . "' class='btn btn-danger'>Belum Ada</a>":"<a href='#' id='lihat_dokumen' class='btn btn-success' data-toggle='modal' data-target='#modal-dokumen" . $row->id  . "'>Lhat Dokumen</a>";
            echo "</td>";
            echo "<td><a href='#' id='edit'   data-toggle='modal' data-target='#edit" . $row->id . "'><i class=\"fa fa-pencil\"></i></a> &nbsp;&nbsp;&nbsp;<a href='#' id='delete' onclick='delete_pendidikan(" . $row->id . ")'><i class=\"fa fa-trash\"></i></a>";
            $i++;

          ?>
          <div class="modal fade" id="edit<?php echo  $row->id ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Riwayat Karya Ilmiah</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" onsubmit="return false" id="form_edit<?php echo  $row->id ?>" enctype="multipart/form-data">
                            
                            <div class="form-group">
                              <label for="jenjang">Nama Kegiatan</label>
                              <input type="text" name="nama_kegiatan" class="form-control" value="<?php echo  $row->nama_kegiatan; ?>">
                            </div>
                            <div class="form-group">
                              <label for="jenjang">Penyelenggara</label>
                              <input type="text" name="penyelenggara" class="form-control" value="<?php echo  $row->penyelenggara; ?>">
                            </div>
							<div class="form-group">
                              <label for="jenjang">Tanggal Kegiatan</label>
                              <input type="date" name="tanggal_kegiatan" class="form-control" value="<?php echo  $row->tanggal_kegiatan; ?>">
                            </div>
							<div class="form-group">
                              <label for="jenjang">Peran Sebagai</label>
                              <select name="peran_sebagai" class="form-control" >
								<?php $peran = array("Peserta","Panitia","Pembicara","Moderator");
								foreach($peran as $value){
									echo "<option value='". $value . "' ";
									echo ($row->peran_sebagai == $value)?"selected":"";
									echo ">" . $value . "</option>";
								}
								?>
							  </select>
                            </div>
                            <div class="col-sm-12 col-form-label">
                                <input type="submit" id="edit_submit<?php echo $row->id?>" class="btn btn-primary" value="Simpan" data-dismiss="modal">
                            </div>
                        </form>
                    </div>
                 </div>
            </div>
        </div>
        <div class="modal fade" id="modal-dokumen<?php echo $row->id ?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">File Sertifikat</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <?php if (!empty($row->file)){
                      $ekstensi = substr($row->file, -3);
                    if($ekstensi != "pdf"){
                    ?>
                    <img src="<?php echo base_url()?>assets/images/sertifikat/<?php echo $row->file?>" width="100%">
                    <hr />
                  <?php }else{
                    ?>
                    <object data="<?php echo base_url()?>/assets/images/sertifikat/<?php echo $row->file?>" type="application/pdf" width="100%" height="300">
                      <p><a href="<?php echo base_url()?>/assets/images/sertifikat/<?php echo $row->file?>">Download Here</a></p>
                    </object>

                    <?php
                  } 
                  echo "<a href='#' id='hapus_sertifikat" . $row->id . "' class='btn btn-danger' data-dismiss='modal'>Hapus</a>";
                  }else{?>
                  <h3>
                    Upload Sertifikat
                  </h3>
                  <form method="POST" action="javascript:void(0)" id="form-dokumen<?php echo $row->id ?>" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="jenjang">FIle Sertifikat</label>
                      <input type="file" name="sertifikat" class="form-control">
                    </div>
                    <input type="hidden" name="id" value="<?php echo $row->id ?>">
                    <div class="col-sm-12 col-form-label">
                      <input type="submit" id="save_sk<?php echo $row->id ?>" class="btn btn-primary" value="Simpan" data-dismiss="modal">
                      <input type="button" id="cancel1" class="btn" value="Tutup" data-dismiss="modal">
                    </div>
                  </form>
                  <?php 
                  }
                  ?>
                  <script>
                    $("#hapus_sertifikat<?php echo $row->id ?>").on("click",function(){
                        $.ajax({
                          url : "<?php echo  base_url();?>simpeg/BerkasPendukung/delete_file_sertifikat",
                          method : "POST",
                          data : "id=<?php echo $row->id ?>",
                          //async : false,
                          //dataType : 'json',
                          success: function(data){
                            
                            if(data == "1"){
                              refresh_table2();
                            }else{
                              $(".alert").html("DATA GAGAL DI HAPUS");
                            }
                            $('.modal-backdrop').remove();
                          }
                      });
                    });
                    $("#save_sk<?php echo $row->id ?>").on("click",function(){
                      var formDokumen = new FormData(document.getElementById("form-dokumen<?php echo $row->id ?>"));
                      //alert("clicked");

                      $.ajax({
                          url : "<?php echo  base_url();?>simpeg/BerkasPendukung/update_file_sertifikat",
                          method : "POST",
                          //data : "jenjang="+$("#jenjang").val()+"&jurusan="+$("#jurusan").val()+"&jurusan_lain="+$("#jurusan_lain").val()+"&universitas_lain="+$("#universitas_lain").val()+"&universitas="+$("#universitas").val()+"&tempat="+$("#tempat").val()+"&no_ijazah="+$("#no_ijazah").val()+"&tanggal_ijazah="+$("#tanggal").val()+"&tahun="+$("#tahun").val()+"&id_pegawai=<?php echo $id_pegawai?>",
                          data : formDokumen,
                          processData: false,
                          contentType: false,
                          //async : false,
                          //dataType : 'json',
                          success: function(data){
                            
                            if(data == "1"){
                              refresh_table2();
                            }else{
                              $(".alert").html("DATA GAGAL DI TAMBAHKAN");
                            }
                            $('.modal-backdrop').remove();
                           
                          }
                      });
                    });
                  </script>
                </div>
              </div>
          </div>
        </div>
        <script>
          $("#edit_submit<?php echo $row->id?>").on("click",function(){
            var myForm = new FormData(document.getElementById("form_edit<?php echo  $row->id ?>"));
            myForm.append("id","<?php echo $row->id ?>");
            $.ajax({
                url : "<?php echo  base_url();?>simpeg/BerkasPendukung/update_sertifikat",
                method : "POST",
                data : myForm,
                processData: false,
                contentType: false,
                //async : false,
                //dataType : 'json',
                success: function(data){
                  
                  if(data == "1"){
                    refresh_table2();
                  }else{
                    $(".alert").html("DATA GAGAL DI TAMBAHKAN");
                  }
                  $('.modal-backdrop').remove();
                  //alert($("#form_edit<?php echo $row->id?>").serialize());
                }
            });
          });

        </script>
        </td>
      </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
     