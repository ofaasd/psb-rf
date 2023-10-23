<div class="card">
    <div class="card-header">
        <?php 
          
          echo $this->session->userdata('status_delete'); 
              $this->session->set_userdata('status_delete','');
              ?>
        <h5>Riwayat Pendidikan</h5>
        <div class="alert alert-primary" id="alert">
                          
        </div>
    </div>
    <div class="card-block" id="tbl_pegawai" style="">
      <a href="#" id="add" class="btn btn-primary waves-effect"  data-toggle="modal" data-target="#tambah">Tambah</a><br /><br />
      <table class="table" >
        <thead>
          <tr class='d-flex'>
            <!-- <th>No.</th> -->
            <!-- <th>Jenjang</th> -->
            <th class='col-2'>Jurusan</th>
            <th class='col-2'>Sekolah</th>
            <th class='col-2'>No. Ijazah</th>
            <th class='col-2'>Tanggal</th>
            <th class='col-1'>File</th>
            <th class='col-1'>Tahun</th>
            <th class='col-2'></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach($riwayat as $row){
            echo "<tr class='d-flex'>";
            //echo "<td>" . $i . "</td>";
            // echo "<td>" . $row->jenjang . "</td>";
            echo "<td class='col-2' style='word-wrap: break-word;display:table;white-space: normal;'>". $row->jenjang . " " . $row->nama_prodi . "</td>";
            echo "<td class='col-2' style='word-wrap: break-word;display:table;white-space: normal;'>" . $row->nama_universitas . "</td>";
            echo "<td class='col-2'>" . $row->no_ijazah . "</td>";
            echo "<td class='col-2'>" . $row->tanggal_ijazah . "</td>";
            echo "<td class='col-1'>";
            if(!empty($row->ijazah)){
             if(substr($row->ijazah, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/ijazah/".$row->ijazah . "' target='_blank' title='Laporan Kemajuan'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/ijazah/".$row->ijazah . "' target='_blank' title='Laporan Kemajuan'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "</td>";
            echo "<td  class='col-1'>" . $row->tahun . "</td>";
            echo "<td  class='col-1'><a href='#' id='edit_btn" . $row->id ."' onclick='get_form_edit(" . $row->id . ")'><i class=\"fa fa-pencil\"></i></a> &nbsp;&nbsp;&nbsp;<a href='#' id='delete' onclick='delete_pendidikan(" . $row->id . ")'><i class=\"fa fa-trash\"></i></a>";
           
            $i++;
            //echo "</tr>";
          ?>
          <div class="modal fade" id="modal-ijazah<?php echo  $row->id ?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ijazah</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
                      <h3>
                        Upload Ijazah
                      </h3>
                      <form method="POST" action="javascript:void(0)" id="form-ijazah<?php echo  $row->id ?>" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id" value="<?php echo $row->id?>">
                        <div class="col-sm-12 col-form-label">
                          <input type="submit" id="save_ijazah<?php echo $row->id ?>" class="btn btn-primary" value="Simpan" data-dismiss="modal">
                          <input type="button" id="cancel<?php echo $row->id ?>" class="btn" value="Tutup" data-dismiss="modal">
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
        </td>
      </tr>
          <!-- <tr>
            <td colspan=10>
          <?php
            $data['row'] = $row;
            //$this->load->view('simpeg/manage/_form_ijazah',$data);
          ?>
            </td>
          </tr> -->
        
          <?php
          }
          ?>
        
        </tbody>
      </table>
     
      
    </div>
    <div class="modal fade" id="tambah" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Tambah Riwayat Pendidikan</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="javascript:void(0)" id="form-tambah" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="jenjang">Jenjang</label>
                        <div class="col-sm-3">
                          <select class="form-control" name="jenjang" id="jenjang">
                            <?php
                            foreach($jenjang as $value){
                              echo "<option value='" . $value . "'>" . $value ."</option>";
                              }
                            ?>
                          </select>
                        </div>
                      </div>
					  <div class="form-group row">
						<label class="col-sm-3 col-form-label" for="jenjang profesi">Jenjang Profesi</label>
						<div class="col-sm-9">
							<input type="text" name="jenjang_profesi" class="form-control" id="jenjang_profesi" placeholder="Jenjang Profesi">
						</div>
					  </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="jenjang">Jurusan</label>
                        <div class="col-sm-5">
                          <select name="jurusan" id="jurusan1" class="js-example-basic-single col-sm-12" placeholder="--Nama Jurusan--">
                              <?php
                                  //echo "<option value='0'></option>";
                                  foreach($master_prodi as $value){
                                      echo "<option value=" . $value->id . "  >" . $value->nama_jurusan . "</option>";
                                  }
                                  echo "<option value='999999' >Lainnya</option>";
                              ?> 
                          </select>
                        </div>
                        <div class="col-sm-4">
                          <div class="jurusan1-text">
                              <input type='hidden' class='form-control' placeholder='Nama Jurusan' name='jurusan_lain'>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="jenjang">Sekolah</label>
                        <div class="col-sm-5">
                          <select name="universitas" id="univ1" class="js-example-basic-single col-sm-12" placeholder="--Nama Universitas--">
                              <?php
                                  //echo "<option value='0'></option>";
                                  foreach($master_universitas as $value){
                                      echo "<option value=" . $value->id . "  >" . $value->nama_universitas . "</option>";
                                  }
                                  echo "<option value='999999' >Lainnya</option>";
                              ?> 
                          </select>
                        </div>
                        <div class="col-sm-4">
                          <div class="univ1-text">
                              <input type='hidden' class='form-control' placeholder='Nama Universitas' name='universitas_lain'>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="jenjang">Tempat</label> <br />
                        <div class="col-sm-5">
                          <select name="tempat" id="tempat" class="js-example-basic-single col-sm-12" placeholder="--Nama Kota/Kabupaten--">
                              <?php
                                  //echo "<option value='0'></option>";
                                  foreach($master_kota as $value){
                                      echo "<option value=" . $value->id . "   ";
                                      echo ">" . $value->nama_kota . "</option>";
                                  }
                              ?> 
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="jenjang">No. Ijazah</label>
                        <div class="col-sm-9">
                          <input type="text" name="no_ijazah" id="no_ijazah" class="form-control">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="jenjang">Tanggal</label>
                        <div class="col-sm-9">
                          <input type="date" name="tanggal_ijazah" id="tanggal" class="form-control">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="jenjang">Tahun</label>
                        <div class="col-sm-9">
                          <input type="number" name="tahun" id="tahun" class="form-control">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="jenjang">FIle Ijazah</label>
                        <div class="col-sm-9">
                          <input type="file" name="ijazah" id="ijazah" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-12 col-form-label">
                          <input type="submit" id="save" class="btn btn-primary" value="Simpan" data-dismiss="modal">
                           <input type="button" class="tutup" class="btn" value="Tutup" data-dismiss="modal">
                      </div>
                  </form>
              </div>
           </div>
      </div>
  </div>
  <div class="col-sm-12" id="form-edit">

  </div>
</div>
<script src="<?php echo base_url()?>assets/js/select2.full.min.js"></script>
<script src="<?php echo base_url()?>assets/pages/advance-elements/select2-custom.js"></script>
<script>
  function get_form_edit(id){
    $.ajax({
        url : "<?php echo base_url();?>simpeg/manage/edit_form_pendidikan",
        method : "POST",
        data : "id="+id,
        success: function(data){
          $("#form-edit").html(data);
        }
    });
  }
  
  $(document).ready(function(){
    $(".mytabel").DataTable();
	  $(".js-example-basic-single").select2({
		dropdownParent: $("#tambah")
	  });
	  $("#univ1").on("change",function(){
      universitas("univ1");
	  });
	  $("#jurusan1").on("change",function(){
		  universitas("jurusan1");
	  });
  });
  
  
  
  

  function universitas(univ){
        if($("#" + univ).val() == 999999){
            //alert("lainnya");
            $("." + univ + "-text input").attr({type:"text"});
        }else{  
            $("." + univ + "-text input").attr({type:"hidden"});
        }
        //alert("asdasd");
    }
  
  $("#save").on("click",function(){
    var myForm = new FormData(document.getElementById("form-tambah"));
    myForm.append("id_pegawai",<?php echo $id_pegawai?>);
    $.ajax({
        url : "<?php echo  base_url();?>simpeg/manage/add_pendidikan",
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
  function delete_pendidikan(id){
    var r = confirm("Yakin Ingin Menghapus ?")
    if(r == true){
      $.ajax({
        url : "<?php echo  base_url();?>simpeg/manage/delete_pendidikan",
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
        url : "<?php echo  base_url();?>simpeg/manage/refreshtable",
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
