<table class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>KTP</th>
            <th>KK</th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
          
            <td>
              <?php 
                if(empty($berkas->ktp )){
                echo "<a href='#' id='ktp_btn' class='btn btn-danger waves-effect'   data-toggle='modal' data-target='#ktp_modal'>Belum Ada</a>";  
              }else{
                echo "<a href='#' id='ktp_btn' class='btn btn-primary waves-effect'   data-toggle='modal' data-target='#ktp_modal'>Lihat</a>";  
              }
              ?>
            </td>
            <td>
              <?php 
                if(empty($berkas->kk )){
                echo "<a href='#' id='kk_btn' class='btn btn-danger waves-effect' data-toggle='modal' data-target='#kk_modal'>Belum Ada</a>";  
              }else{
                echo "<a href='#' id='kk_btn' class='btn btn-primary waves-effect' data-toggle='modal' data-target='#kk_modal'>Lihat</a>";  
              }
              ?>
              
              </a>
              <div class="modal fade" id="ktp_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Lihat KTP</h4>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <?php
                            if(empty($berkas->ktp)){
                            ?>
                              <form method="POST" action="javascript:void(0)" id="form_ktp">
                                <label for="upload_ktp"> Upload KTP</label>
                                <input type="file" name="ktp" class="form-control">
                                <input type="hidden" name="id" value="<?php echo $id_pegawai ?>">
                                <div class="col-sm-12 col-form-label">
                                  <input type="submit" id="save_ktp" class="btn btn-primary" value="Simpan" data-dismiss="modal">
                                  <input type="button" id="cancel1" class="btn" value="Tutup" data-dismiss="modal">
                                </div>
                              </form>
                            <?php
                            }else{
                              $ekstensi = substr($berkas->ktp, -3);
                              if($ekstensi != "pdf"){
                                ?>
                                <img src="<?php echo base_url()?>assets/images/ktp/<?php echo $berkas->ktp?>" width="100%">
                                <hr />
                              <?php }else{ ?>
                                <object data="<?php echo base_url()?>/assets/images/ktp/<?php echo $berkas->ktp?>" type="application/pdf" width="100%" height="300">
                                  <p><a href="<?php echo base_url()?>/assets/images/ktp/<?php echo $berkas->ktp?>">Download Here</a></p>
                                </object>
                                <?php
                              }
                              echo "<a href='#' id='hapus_ktp' class='btn btn-danger' data-dismiss='modal'>Hapus</a>";
                            }
                            ?>
                        </div>
                     </div>
                </div>
              </div>

              <div class="modal fade" id="kk_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Lihat KK</h4>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <?php
                            if(empty($berkas->kk)){
                            ?>
                              <form method="POST" action="javascript:void(0)" id="form_kk">
                                <label for="upload_ktp"> Upload KK</label>
                                <input type="file" name="kk" class="form-control">
                                <input type="hidden" name="id" value="<?php echo $id_pegawai ?>">
                                <div class="col-sm-12 col-form-label">
                                  <input type="submit" id="save_kk" class="btn btn-primary" value="Simpan" data-dismiss="modal">
                                  <input type="button" id="cancel1" class="btn" value="Tutup" data-dismiss="modal">
                                </div>
                              </form>
                            <?php
                            }else{
                              $ekstensi = substr($berkas->kk, -3);
                              if($ekstensi != "pdf"){
                                ?>
                                <img src="<?php echo base_url()?>assets/images/kk/<?php echo $berkas->kk?>" width="100%">

                                <hr />
                                
                              <?php }else{ ?>
                                <object data="<?php echo base_url()?>/assets/images/kk/<?php echo $berkas->kk?>" type="application/pdf" width="100%" height="300">
                                  <p><a href="<?php echo base_url()?>/assets/images/kk/<?php echo $berkas->kk?>">Download Here</a></p>
                                </object>
                                <?php
                              }
                              echo "<a href='#' id='hapus_kk' class='btn btn-danger' data-dismiss='modal'>Hapus</a>";
                            }

                            ?>
                        </div>
                     </div>
                </div>
              </div>
            </div>
            <script>
              $("#hapus_ktp").on("click",function(){
                  $.ajax({
                    url : "<?php echo  base_url();?>simpeg/BerkasPendukung/delete_ktp",
                    method : "POST",
                    data : "id=<?php echo $id_pegawai ?>",
                    //async : false,
                    //dataType : 'json',
                    success: function(data){
                      
                      if(data == "1"){
                        refresh_table();
                      }else{
                        $(".alert").html("DATA GAGAL DI HAPUS");
                      }
                      $('.modal-backdrop').remove();
                    }
                });
              });
              $("#save_ktp").on("click",function(){
                var myForm = new FormData(document.getElementById("form_ktp"));
                $.ajax({
                    url : "<?php echo  base_url();?>simpeg/BerkasPendukung/save_ktp",
                    method : "POST",
                    data : myForm,
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
              $("#hapus_kk").on("click",function(){
                  $.ajax({
                    url : "<?php echo  base_url();?>simpeg/BerkasPendukung/delete_kk",
                    method : "POST",
                    data : "id=<?php echo $id_pegawai ?>",
                    //async : false,
                    //dataType : 'json',
                    success: function(data){
                      
                      if(data == "1"){
                        refresh_table();
                      }else{
                        $(".alert").html("DATA GAGAL DI HAPUS");
                      }
                      $('.modal-backdrop').remove();
                    }
                });
              });
              $("#save_kk").on("click",function(){
                var myForm = new FormData(document.getElementById("form_kk"));
                $.ajax({
                    url : "<?php echo  base_url();?>simpeg/BerkasPendukung/save_kk",
                    method : "POST",
                    data : myForm,
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
            </script>
        </td></tr>
        </tbody>
      </table>