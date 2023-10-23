<form method="POST" onsubmit="javascript:void(0)" id="form_edit<?php echo  $row->id ?>" enctype="multipart/form-data">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="jenjang">Jenjang</label>
                      <div class="col-sm-2">
                        <select class="form-control" name="jenjang" id="jenjang_edit<?php echo $row->id?>">
                          <?php
                          foreach($jenjang as $value){
                            echo "<option value='" . $value . "'";
                            if($row->jenjang == $value)
                              echo "selected";
                            echo ">" . $value ."</option>";
                            }
                          ?>
                        </select>
                      </div>
                      <div class="col-sm-8">
                        <button type="button" class="close" id="close_edit<?php echo $row->id ?>" onclick="tutup_edit()">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    </div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for="jenjang profesi">Jenjang Profesi</label>
						<div class="col-sm-5">
							<input type="text" name="jenjang_profesi" class="form-control" id="jenjang_profesi" placeholder="Jenjang Profesi" value="<?php echo $row->jenjang_profesi ?>" >
						</div>
					</div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="jenjang">Jurusan</label> <br/>
                      <div class="col-sm-10">
                        <select name="jurusan" id="jurusan_edit<?php echo $row->id?>" class="js-example-basic-edit<?php echo $row->id?> col-sm-12" placeholder="--Nama Jurusan--">
                            <?php
                                //echo "<option value='0'></option>";
                                foreach($master_prodi as $value){
                                    echo "<option value=" . $value->id . "   ";
                                    if($row->jurusan == $value->id){
                                      echo "selected";
                                    }
                                    echo ">" . $value->nama_jurusan . "</option>";
                                }
                                echo "<option value='999999' >Lainnya</option>";
                            ?> 
                        </select>
                      </div>
                      <div class="col-sm-12">
                        <div class="jurusan_edit<?php echo $row->id?>-text">
                            <input type='hidden' class='form-control mt-3' placeholder='Nama Jurusan' name='jurusan_lain'id="jurusan_lain_edit<?php echo $row->id?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="jenjang">Sekolah</label> <br />
                      <div class="col-sm-10">
                        <select name="universitas" id="universitas_edit<?php echo $row->id?>" class="js-example-basic-edit<?php echo $row->id?> col-sm-12" placeholder="--Nama Universitas--">
                            <?php
                                //echo "<option value='0'></option>";
                                foreach($master_universitas as $value){
                                    echo "<option value=" . $value->id . "   ";
                                    if($row->universitas == $value->id){
                                      echo "selected";
                                    }
                                    echo ">" . $value->nama_universitas . "</option>";
                                }
                                echo "<option value='999999' >Lainnya</option>";
                            ?> 
                        </select>
                      </div>
                      <div class="col-sm-12">
                        <div class="universitas_edit<?php echo $row->id?>-text">
                            <input type='hidden' class='form-control mt-3' placeholder='Nama Universitas' name='universitas_lain' id="universitas_lain_edit<?php echo $row->id?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="jenjang">Tempat</label> <br />
                      <div class="col-sm-5">
                        <select name="tempat" id="tempat_edit<?php echo $row->id?>" class="js-example-basic-edit<?php echo $row->id?> col-sm-12" placeholder="--Nama Kota/Kabupaten--">
                            <?php
                                //echo "<option value='0'></option>";
                                foreach($master_kota as $value){
                                    echo "<option value=" . $value->id . "   ";
                                    if($row->tempat == $value->id){
                                      echo "selected";
                                    }
                                    echo ">" . $value->nama_kota . "</option>";
                                }
                            ?> 
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="jenjang">No. Ijazah</label>
                      <div class="col-sm-5">
                        <input type="text" name="no_ijazah" id="no_ijazah_edit<?php echo $row->id?>" class="form-control" value="<?php echo  $row->no_ijazah ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="jenjang">Tanggal</label>
                      <div class="col-sm-5">
                        <input type="date" name="tanggal" id="tanggal_edit<?php echo $row->id?>" class="form-control" value="<?php echo  $row->tanggal_ijazah ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="jenjang">Tahun</label>
                      <div class="col-sm-5">
                        <input type="number" name="tahun" id="tahun_edit<?php echo $row->id?>" class="form-control" value="<?php echo  $row->tahun ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="jenjang">File Ijazah</label>
                      <div class="col-sm-5">
                        <input type="file" name="ijazah" id="ijazah_update<?php echo $row->id ?>" class="form-control"> 
                        
                      </div>
                      <div class="col-sm-1">
                          <?php 
                            if(!empty($row->ijazah)){
                             if(substr($row->ijazah, -3) == "pdf"){
                                echo "<a href='" . base_url() . "assets/images/ijazah/".$row->ijazah . "' target='_blank' title='Laporan Kemajuan'><i class=\"fa fa-file-pdf-o\"></i> Lihat File</a>";
                              }else{
                                echo "<a href='" . base_url() . "assets/images/ijazah/".$row->ijazah . "' target='_blank' title='Laporan Kemajuan'><i class=\"fa fa-file-image-o\" ></i></i>  Lihat File</a>";
                              }
                            }
                          ?>
                        </div>
                    </div>
                    <div class="col-sm-12 col-form-label">
                        <input type="submit" id="edit_submit<?php echo $row->id?>" class="btn btn-primary" value="Simpan" >
                         <input type="button" id="tutup_edit<?php echo $row->id ?>" class="btn" value="Tutup"  onclick="tutup_edit()">
                    </div>
                </form>
                <script>
          function tutup_edit(){
            $("#form-edit").html("");
          }
          $("#lihat_ijazah<?php echo $row->id ?>").on("click",function(){
            $("#modal-ijazah<?php echo $row->id ?>").show();
          });
          $(".js-example-basic-edit<?php echo $row->id?>").select2({
            //dropdownParent: $("#edit<?php echo  $row->id ?>")
          });
          $("#universitas_edit<?php echo $row->id?>").on("change",function(){
              universitas("universitas_edit<?php echo $row->id?>");
          });
          $("#jurusan_edit<?php echo $row->id?>").on("change",function(){
              universitas("jurusan_edit<?php echo $row->id?>");
          });

          $("#form_edit<?php echo $row->id?>").submit(function(e){
            var myForm = new FormData(document.getElementById("form_edit<?php echo $row->id?>"));
            myForm.append("id",<?php echo $row->id ?>);
            e.preventDefault();
            $.ajax({
                url : "<?php echo  base_url();?>simpeg/manage/update_pendidikan",
                method : "POST",
                //data : "jenjang="+$("#jenjang_edit<?php echo $row->id ?>").val()+"&jurusan="+$("#jurusan_edit<?php echo $row->id?>").val()+"&jurusan_lain="+$("#jurusan_lain_edit<?php echo $row->id?>").val()+"&universitas_lain="+$("#universitas_lain_edit<?php echo $row->id?>").val()+"&universitas="+$("#universitas_edit<?php echo $row->id?>").val()+"&tempat="+$("#tempat_edit<?php echo $row->id?>").val()+"&no_ijazah="+$("#no_ijazah_edit<?php echo $row->id?>").val()+"&tanggal_ijazah="+$("#tanggal_edit<?php echo $row->id?>").val()+"&tahun="+$("#tahun_edit<?php echo $row->id?>").val()+"&id=<?php echo $row->id ?>",
                data : myForm,
                processData: false,
                contentType: false,
                //async : false,
                //dataType : 'json',
                success: function(data){
                  
                  if(data == "1"){
                    refresh_table();
                    $("#form-edit").html("");
                  }else{
                    $(".alert").html("DATA GAGAL DI TAMBAHKAN");
                  }
                  $('.modal-backdrop').remove();
                  //alert($("#form_edit<?php echo $row->id?>").serialize());
                }
            });
          });
        </script>