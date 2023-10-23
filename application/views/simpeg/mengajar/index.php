<div class="card">
    <div class="card-header">
        <?php 
          $jenjang = array("SLTA","D-I", "D-II", "D-III", "D-IV", "S1","S2","S3");
          echo $this->session->userdata('status_delete'); 
              $this->session->set_userdata('status_delete','');
              ?>
        <h5>RIWAYAT MENGAJAR</h5>
        <div class="alert alert-primary" id="alert">
                          
        </div>
    </div>
    <div class="card-block" id="tbl_pegawai" style="overflow-x: scroll;">
      <a href="#" id="add" class="btn btn-primary waves-effect"  data-toggle="modal" data-target="#tambah">Tambah</a><br /><br />
      <table class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Institusi</th>
            <th>Program Studi</th>
            <th>Mata Kuliah</th>
            <th>Tahun</th>
			<th>Rombel</th>
			<th>Kelas</th>
			<th>SKS</th>
			<th>Dokumen Unggah</th>
			<th>SK Mengajar</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach($riwayat as $row){
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $row->institusi . "</td>";
            echo "<td>" . $row->prodi . "</td>";
            echo "<td>" . $row->mata_kuliah . "</td>";
            echo "<td>" . $row->awal . "-" . $row->akhir . " (";
			echo ($row->jenis==1)?"Ganjil":"Genap";
			echo ") </td>";
           
			echo "<td>" . $row->rombel . "</td>";
			echo "<td>";
			echo ($row->kelas==1)?"Reguler":"Karyawan";
			echo "</td>";
			echo "<td>" . $row->sks . "</td>";
			echo "<td>";
			echo (empty($row->dokumen))?"<a href='#' id='lihat_dokumen' data-toggle='modal' data-target='#modal-dokumen" . $row->id  . "' class='btn btn-danger'>Belum Ada</a>":"<a href='#' id='lihat_dokumen' class='btn btn-success' data-toggle='modal' data-target='#modal-dokumen" . $row->id  . "'>Lhat Dokumen</a>";
			echo "</td>";
			echo "<td>";
			echo (empty($row->sk_mengajar))?"<a href='#' id='lihat_dokumen' data-toggle='modal' data-target='#modal-sk" . $row->id  . "' class='btn btn-danger'>Belum Ada</a>":"<a href='#' id='lihat_dokumen' class='btn btn-success' data-toggle='modal' data-target='#modal-sk" . $row->id  . "'>Lhat SK Mengajar</a>";
			echo "</td>";
            echo "<td><a href='#' id='edit'   data-toggle='modal' data-target='#edit" . $row->id . "'><i class=\"fa fa-pencil\"></i></a> &nbsp;&nbsp;&nbsp;<a href='#' id='delete' onclick='delete_pendidikan(" . $row->id . ")'><i class=\"fa fa-trash\"></i></a>";
            $i++;
				
          ?>
		  <div class="modal fade" id="modal-dokumen<?php echo $row->id ?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Dokumen</h4>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					  <?php if (!empty($row->dokumen)){
						  $ekstensi = substr($row->dokumen, -3);
						if($ekstensi != "pdf"){
						?>
						<img src="<?php echo base_url()?>assets/images/mengajar/<?php echo $row->dokumen?>" width="100%">
						<hr />
					  <?php }else{
						?>
						<object data="<?php echo base_url()?>/assets/images/mengajar/<?php echo $row->dokumen?>" type="application/pdf" width="100%" height="300">
						  <p><a href="<?php echo base_url()?>/assets/images/mengajar/<?php echo $row->dokumen?>">Download Here</a></p>
						</object>
						<?php
					  } }?>
					  <h3>
						Upload Dokumen
					  </h3>
					  <form method="POST" action="javascript:void(0)" id="form-dokumen<?php echo $row->id ?>" enctype="multipart/form-data">
						<div class="form-group">
						  <label for="jenjang">FIle Dokumen</label>
						  <input type="file" name="dokumen" class="form-control">
						</div>
						<input type="hidden" name="id" value="<?php echo $row->id ?>">
						<div class="col-sm-12 col-form-label">
						  <input type="submit" id="save_sk<?php echo $row->id ?>" class="btn btn-primary" value="Simpan" data-dismiss="modal">
						  <input type="button" id="cancel1" class="btn" value="Tutup" data-dismiss="modal">
						</div>
					  </form>
					  <script>
						$("#save_sk<?php echo $row->id ?>").on("click",function(){
						  var formDokumen = new FormData(document.getElementById("form-dokumen<?php echo $row->id ?>"));
						  //alert("clicked");

						  $.ajax({
							  url : "<?php echo  base_url();?>simpeg/RiwayatMengajar/updatedokumen",
							  method : "POST",
							  //data : "jenjang="+$("#jenjang").val()+"&jurusan="+$("#jurusan").val()+"&jurusan_lain="+$("#jurusan_lain").val()+"&universitas_lain="+$("#universitas_lain").val()+"&universitas="+$("#universitas").val()+"&tempat="+$("#tempat").val()+"&no_ijazah="+$("#no_ijazah").val()+"&tanggal_ijazah="+$("#tanggal").val()+"&tahun="+$("#tahun").val()+"&id_pegawai=<?php echo $id_pegawai?>",
							  data : formDokumen,
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
					</div>
				  </div>
			  </div>
			</div>
			<div class="modal fade" id="modal-sk<?php echo $row->id ?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Dokumen SK</h4>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					  <?php if (!empty($row->sk_mengajar)){
						  $ekstensi = substr($row->sk_mengajar, -3);
						if($ekstensi != "pdf"){
						?>
						<img src="<?php echo base_url()?>assets/images/sk_mengajar/<?php echo $row->sk_mengajar?>" width="100%">
						<hr />
					  <?php }else{
						?>
						<object data="<?php echo base_url()?>/assets/images/sk_mengajar/<?php echo $row->sk_mengajar?>" type="application/pdf" width="100%" height="300">
						  <p><a href="<?php echo base_url()?>/assets/images/sk_mengajar/<?php echo $row->sk_mengajar?>">Download Here</a></p>
						</object>
						<?php
					  } }?>
					  <h3>
						Upload Dokumen SK 
					  </h3>
					  <form method="POST" action="javascript:void(0)" id="form-sk<?php echo $row->id ?>" enctype="multipart/form-data">
						<div class="form-group">
						  <label for="jenjang">FIle Dokumen SK</label>
						  <input type="file" name="dokumen" class="form-control">
						</div>
						<input type="hidden" name="id" value="<?php echo $row->id ?>">
						<div class="col-sm-12 col-form-label">
						  <input type="submit" id="save_sk_dokumen<?php echo $row->id ?>" class="btn btn-primary" value="Simpan" data-dismiss="modal">
						  <input type="button" id="cancel1" class="btn" value="Tutup" data-dismiss="modal">
						</div>
					  </form>
					  <script>
						$("#save_sk_dokumen<?php echo $row->id ?>").on("click",function(){
						  var formDokumen = new FormData(document.getElementById("form-sk<?php echo $row->id ?>"));
						  //alert("clicked");

						  $.ajax({
							  url : "<?php echo  base_url();?>simpeg/RiwayatMengajar/updatesk",
							  method : "POST",
							  //data : "jenjang="+$("#jenjang").val()+"&jurusan="+$("#jurusan").val()+"&jurusan_lain="+$("#jurusan_lain").val()+"&universitas_lain="+$("#universitas_lain").val()+"&universitas="+$("#universitas").val()+"&tempat="+$("#tempat").val()+"&no_ijazah="+$("#no_ijazah").val()+"&tanggal_ijazah="+$("#tanggal").val()+"&tahun="+$("#tahun").val()+"&id_pegawai=<?php echo $id_pegawai?>",
							  data : formDokumen,
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
					</div>
				  </div>
			  </div>
			</div>
          <div class="modal fade" id="edit<?php echo  $row->id ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Riwayat Mengajar</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" onsubmit="return false" id="form_edit<?php echo  $row->id ?>" enctype="multipart/form-data">
                            
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Nama Institusi</label>
                              <div class="col-sm-6">
                                <input type="text" name="institusi" id="institusi<?php echo $row->id?>" class="form-control" value="<?php echo  $row->institusi; ?>">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Program Studi</label>
                              <div class="col-sm-6">
                                <input type="text" name="prodi" id="prodi<?php echo $row->id?>" class="form-control" value="<?php echo  $row->prodi; ?>">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Mata Kuliah</label>
                              <div class="col-sm-6">
                                <input type="text" name="mata_kuliah" id="mata_kuliah<?php echo $row->id?>" class="form-control" value="<?php echo  $row->mata_kuliah; ?>">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Tahun</label>
                              <div class="col-sm-6">
								<select class="form-control" id="tahun<?php echo $row->id ?>" name="tahun">
									<?php 
										foreach($tahun_ajaran as $value){
											echo "<option value=" . $value->id . " ";
											echo ($row->tahun == $value->id)?"selected":"";
											echo ">" . $value->awal . "-" . $value->akhir . " (";
											echo ($value->jenis==1)?"Ganjil":"Genap";
											echo ") </option>";
										}
									?>
								</select>
                              </div>
                            </div>
							<div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Rombel</label>
                              <div class="col-sm-6">
								<select class="form-control" id="rombel<?php echo $row->id ?>" name="rombel">
									<?php 
										foreach($rombel as $value){
											echo "<option value='" . $value . "'";
											echo ($row->rombel == $value)?"selected":"";
											echo ">" . $value . "</option>";
										}
									?>
								</select>
                              </div>
                            </div>
							<div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Kelas</label>
                              <div class="col-sm-6">
								<select class="form-control" id="kelas<?php echo $row->id ?>" name="kelas">
									<?php 
										foreach($kelas as $key=>$value){
											echo "<option value=" . $key . " ";
											echo ($row->kelas == $key)?"selected":"";
											echo ">" . $value . "</option>";
										}
									?>
								</select>
                              </div>
                            </div>
							<div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">SKS</label>
                              <div class="col-sm-6">
                                <input type="number" name="sks" id="sks<?php echo $row->id?>" class="form-control" value="<?php echo  $row->sks; ?>">
                              </div>
                            </div>
                            <div class="col-sm-12 col-form-label">
                                <input type="submit" id="edit_submit<?php echo $row->id?>" class="btn btn-primary" value="Simpan" data-dismiss="modal">
                            </div>
                        </form>
                    </div>
                 </div>
            </div>
        </div>
        <script>
		$(document).ready(function(){
			$("#edit_submit<?php echo $row->id?>").on("click",function(){
				$.ajax({
					url : "<?php echo base_url();?>simpeg/RiwayatMengajar/update",
					method : "POST",
					data : "institusi="+$("#institusi<?php echo $row->id ?>").val()+
					  "&prodi="+$("#prodi<?php echo $row->id?>").val()+
					  "&mata_kuliah="+$("#mata_kuliah<?php echo $row->id?>").val()+
					  "&tahun="+$("#tahun<?php echo $row->id?>").val()+
					  "&sks="+$("#sks<?php echo $row->id?>").val()+
					  "&rombel="+$("#rombel<?php echo $row->id?>").val()+
					  "&kelas="+$("#kelas<?php echo $row->id?>").val()+
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
					  //alert($("#form_edit<?php echo $row->id?>").serialize());
					}
				});
		    });
		});
          

        </script>
          <?php
          }
			foreach($riwayat_jadwal as $row){
				echo "<tr>";
				echo "<td>" . $i . "</td>";
				echo "<td>STIFERA</td>";
				echo "<td>" . $row->nama_jurusan . "</td>";
				echo "<td>" . $row->kode_mata_kuliah . "-" . $row->nama_mata_kuliah . "</td>";
				echo "<td>" . $row->awal . "-" . $row->akhir . " (";
				echo ($row->jenis==1)?"Ganjil":"Genap";
				echo ") </td>";
				echo "<td>" . $row->rombel . "</td>";
				echo "<td>";
				echo ($row->kelas==1)?"Reguler":"Karyawan";
				echo "</td>";
				echo "<td>" . $row->sks . "</td>";
				echo "<td>-</td>";
				echo "<td>-</td>";
				echo "<td></td>";
				echo "</tr>";
				$i++;
			}
          ?>
		  </td></tr>
        </tbody>
      </table>
     
      
    </div>
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Tambah Riwayat Mengajar</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="javascript:void(0)" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Nama Institusi</label>
                        <div class="col-sm-6">
                          <input type="text" name="institusi" id="institusi" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Program Studi</label>
                        <div class="col-sm-6">
                          <input type="text" name="prodi" id="prodi" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Mata Kuliah</label>
                        <div class="col-sm-6">
                          <input type="text" name="mata_kuliah" id="mata_kuliah" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group row">
						  <label class="col-sm-4 col-form-label" for="jenjang">Tahun</label>
						  <div class="col-sm-6">
							<select class="form-control" id="tahun" name="tahun">
								<?php 
									foreach($tahun_ajaran as $value){
										echo "<option value=" . $value->id . " ";
										echo ">" . $value->awal . "-" . $value->akhir . " (";
										echo ($value->jenis==1)?"Ganjil":"Genap";
										echo ") </option>";
									}
								?>
							</select>
						  </div>
						</div>
						<div class="form-group row">
						  <label class="col-sm-4 col-form-label" for="jenjang">Rombel</label>
						  <div class="col-sm-6">
							<select class="form-control" id="rombel" name="rombel">
								<?php 
									foreach($rombel as $value){
										echo "<option value='" . $value . "'";
										echo ">" . $value . "</option>";
									}
								?>
							</select>
						  </div>
						</div>
						<div class="form-group row">
						  <label class="col-sm-4 col-form-label" for="jenjang">Kelas</label>
						  <div class="col-sm-6">
							<select class="form-control" id="kelas" name="kelas">
								<?php 
									foreach($kelas as $key=>$value){
										echo "<option value=" . $key . " ";
										echo ">" . $value . "</option>";
									}
								?>
							</select>
						  </div>
						</div>
						<div class="form-group row">
						  <label class="col-sm-4 col-form-label" for="jenjang">SKS</label>
						  <div class="col-sm-6">
							<input type="number" name="sks" id="sks" class="form-control" value="">
						  </div>
						</div>
                      <div class="col-sm-12 col-form-label">
                          <input type="submit" id="save" class="btn btn-primary" value="Simpan" data-dismiss="modal">
                      </div>
              </form>
          </div>
       </div>
  </div>
</div>
</div>
<script>
  $("#save").on("click",function(){
    $.ajax({
        url : "<?php echo base_url();?>simpeg/RiwayatMengajar/insert",
        method : "POST",
        data : "institusi="+$("#institusi").val()+
                  "&prodi="+$("#prodi").val()+
                  "&mata_kuliah="+$("#mata_kuliah").val()+
                  "&tahun="+$("#tahun").val()+
                  "&rombel="+$("#rombel").val()+
                  "&kelas="+$("#kelas").val()+
                  "&sks="+$("#sks").val()+
                  "&id_pegawai=<?php echo $id_pegawai?>",
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
  function delete_pendidikan(id){
    var r = confirm("Yakin Ingin Menghapus ?")
    if(r == true){
      $.ajax({
        url : "<?php echo base_url();?>simpeg/RiwayatMengajar/delete",
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
        url : "<?php echo base_url();?>simpeg/RiwayatMengajar/refresh",
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
