<div class="card">
    <div class="card-header">
        <?php 
          $jenjang = array("SLTA","D-I", "D-II", "D-III", "D-IV", "S1","S2","S3");
          echo $this->session->userdata('status_delete'); 
              $this->session->set_userdata('status_delete','');
              ?>
        <h5>RIWAYAT JABATAN STRUKTURAL</h5>
        <div class="alert alert-primary" id="alert">
                          
        </div>
    </div>
    <div class="card-block" id="tbl_pegawai" style="overflow-x: scroll;">
      <a href="#" id="add" class="btn btn-primary waves-effect"  data-toggle="modal" data-target="#tambah">Tambah</a><br /><br />
      <table class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>No.</th>
            <th>Unit Kerja</th>
            <th>Jabatan Struktural</th>
            <th>No SK</th>
            <th>Tanggal SK</th>
            <th>TMT SK</th>
            <th>Dokumen SK</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          
          foreach($riwayat as $row){
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $row->unit_kerja . "</td>";
            echo "<td>" . $row->bagian . " (" . $row->jabatan . ")</td>";
            echo "<td>" . $row->no_sk_struktural . "</td>";
            echo "<td>" . $row->tanggal_sk_struktural . "</td>";
            echo "<td>" . $row->tmt_sk_struktural . "</td>";
			echo "<td>";
			echo (empty($row->dokumen))?"<a href='#' id='lihat_dokumen' data-toggle='modal' data-target='#modal-dokumen" . $row->id  . "' class='btn btn-danger'>Belum Ada</a>":"<a href='#' id='lihat_dokumen' class='btn btn-success' data-toggle='modal' data-target='#modal-dokumen" . $row->id  . "'>Lhat Dokumen</a>";
			echo "</td>";
            echo "<td>";
            echo ($row->status==1)?"<a href='#' class='btn btn-success'>Aktif</a>":"<a href='#' class='btn btn-danger'>Tidak Aktif</a>";
            echo "</td>";
            
            echo "<td><a href='#' id='edit' onclick='get_form_edit(" . $row->id . ")'><i class=\"fa fa-pencil\"></i></a> &nbsp;&nbsp;&nbsp;<a href='#' id='delete' onclick='delete_pendidikan(" . $row->id . ")'><i class=\"fa fa-trash\"></i></a>";
            $i++;

          ?>
          <div class="modal fade" id="modal-dokumen<?php echo $row->id ?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Dokumen SK</h4>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					  <?php if (!empty($row->dokumen)){
						  $ekstensi = substr($row->dokumen, -3);
						if($ekstensi != "pdf"){
						?>
						<img src="<?php echo base_url()?>assets/images/struktural/<?php echo $row->dokumen?>" width="100%">
						<hr />
					  <?php }else{
						?>
						<object data="<?php echo base_url()?>/assets/images/struktural/<?php echo $row->dokumen?>" type="application/pdf" width="100%" height="300">
						  <p><a href="<?php echo base_url()?>/assets/images/struktural/<?php echo $row->dokumen?>">Download Here</a></p>
						</object>
						<?php
					  } }?>
					  <h3>
						Upload Dokumen
					  </h3>
					  <form method="POST" action="javascript:void(0)" id="form-dokumen<?php echo $row->id ?>" enctype="multipart/form-data">
						<div class="form-group">
						  <label for="jenjang">FIle Dokumen SK</label>
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
							  url : "<?php echo  base_url();?>simpeg/RiwayatJabatanStruktural/updatedokumen",
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
		</td></tr>
          <?php
          }
          ?>
        </tbody>
      </table>
     
      
    </div>
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Tambah Riwayat Jabatan Struktural</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="javascript:void(0)" enctype="multipart/form-data">
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Unit Kerja</label>
                              <div class="col-sm-6">
                                <select class="form-control" name="unit_kerja" id="unit_kerja">
                                    <option value="0">-- Unit Kerja --</option>
                                    <?php

                                        foreach($unit_kerja as $row){
                                            echo "<option value='" . $row->id . "' ";
                                            echo ">" . $row->unit_kerja . "</option>";
                                        }
                                    ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Bagian</label>
                              <div class="col-sm-6" id="pl_bagian">
                                <select class="form-control" name="bagian" id="bagian">
                                    <option value="0">-- Bagian --</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Jenis Jabatan</label>
                              <div class="col-sm-6" id="pl_jenis_jabatan">
                                <select class="form-control" name="jenis_jabatan" id="jenis_jabatan">
                                    <option value="0">-- Jenis Jabatan --</option>
                                    
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Jabatan</label>
                              <div class="col-sm-6" id="pl_jabatan">
                                <select class="form-control" name="jabatan_struktural" id="jabatan">
                                    <option value="0">-- Jabatan Struktural --</option>
                                    
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">No. SK</label>
                              <div class="col-sm-6">
                                <input type="text" name="no_sk" id="no_sk" class="form-control">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Tanggal SK</label>
                              <div class="col-sm-6">
                                <input type="date" name="tanggal_sk" id="tgl_sk" class="form-control" >
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">TMT SK</label>
                              <div class="col-sm-6">
                                <input type="date" name="tempat" id="tmt_sk" class="form-control" >
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="jenjang">Status</label>
                              <div class="col-sm-6">
                                <select name="status" class="form-control" id="status">
                                  <option value="1">Aktif</option>
                                  <option value="0">Tidak Aktif</option>
                                </select>
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
<div id="form-edit">

</div>
<script>
  function get_form_edit(id){
    $.ajax({
      url : "<?php echo base_url();?>simpeg/RiwayatJabatanStruktural/edit_form",
      method : "POST",
      data : "id="+id,
      success: function(data){
        $("#form-edit").html(data);
      }
    });
  }
  $("#unit_kerja").change(function(){
      var id=$(this).val();
      $.ajax({
          url : "<?php echo base_url();?>pegawai/get_bagian/",
          method : "POST",
          data : "id_unit="+id,
          success: function(data){
              $('#pl_bagian').html(data);
          }
      });
  });
  $(document).on("change","#bagian",function(){
      var id=$(this).val();
      var id_unit = $("#unit_kerja").val();
      $.ajax({
          url : "<?php echo base_url();?>pegawai/get_jenis_jabatan/",
          method : "POST",
          data : "id_bagian="+id+"&id_unit="+id_unit,
          success: function(data){
              $('#pl_jenis_jabatan').html(data);
          }
      });
  });
  $(document).on("change","#jenis_jabatan",function(){
      var id=$(this).val();
      var id_bagian = $("#bagian").val();
      $.ajax({
          url : "<?php echo base_url();?>pegawai/get_jabatan_struktural/",
          method : "POST",
          data : "id_jenis_jabatan="+id+"&id_bagian="+id_bagian,
          success: function(data){
              $('#pl_jabatan').html(data);
          }
      });
  });
  $("#save").on("click",function(){
    $.ajax({
        url : "<?php echo base_url();?>simpeg/RiwayatJabatanStruktural/insert",
        method : "POST",
        data : "unit_kerja="+$("#unit_kerja").val()+
              "&id_jabatan_struktural="+$("#jabatan").val()+
              "&no_sk="+$("#no_sk").val()+
              "&tgl_sk="+$("#tgl_sk").val()+
              "&tmt_sk="+$("#tmt_sk").val()+
              "&kum="+$("#kum").val()+
              "&status="+$("#status").val()+
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
          //alert($("#form_edit<?php echo $row->id?>").serialize());
        }
    });
  });
  function delete_pendidikan(id){
    var r = confirm("Yakin Ingin Menghapus ?")
    if(r == true){
      $.ajax({
        url : "<?php echo base_url();?>simpeg/RiwayatJabatanStruktural/delete",
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
          //alert($("#form_edit<?php echo $row->id?>").serialize());
        }
      });
    }
  }
  
  function refresh_table(){
      $.ajax({
        url : "<?php echo base_url();?>simpeg/RiwayatJabatanStruktural/refresh",
        data : "id=<?php echo $id_pegawai?>",
        type : "GET",
        //async : false,
        //dataType : 'json',
        success: function(data){
          $("#tbl_pegawai").html(data);
          //alert($("#form_edit<?php echo $row->id?>").serialize());
        }
    });        
  }
</script>
