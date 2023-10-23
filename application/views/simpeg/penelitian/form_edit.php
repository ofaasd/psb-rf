
                  <form method="POST" onsubmit="return false" id="form_edit<?php echo  $row->p_id ?>" enctype="multipart/form-data">
                      
                      <div class="row">
                       <div class="col-sm-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label" for="jenjang">Nomor</label>
                          <div class="col-sm-6">
                            <input type="text" name="nomor" id="nomor" class="form-control" value="<?php echo $row->nomor ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label" for="jenjang">judul</label>
                          <div class="col-sm-6">
                            <input type="text" name="judul" id="judul" class="form-control" value="<?php echo $row->judul ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label" for="jenjang">Fakultas</label>
                          <div class="col-sm-6">
                            <select name="fakultas" id="fakultas" class="form-control">
                              <?php
                              foreach($fakultas as $value){
                                echo "<option value=" . $value->id ." ";
                                if($value->id == $row->id_fakultas){
                                  echo "selected";
                                }
                                echo ">" . $value->nama_fakultas . "</option>";
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label" for="jenjang">Jenis Penelitian</label>
                          <div class="col-sm-6">
                            <input type="text" name="jenis_penelitian" id="jenis_penelitian" class="form-control" value="<?php echo $row->jenis_penelitian ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label" for="jenjang">Tahun</label>
                          <div class="col-sm-6">
                            <input type="text" name="tahun" id="tahun" class="form-control" value="<?php echo $row->tahun ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label" for="jenjang">Sumber Dana</label>
                          <div class="col-sm-6">
                            <input type="text" name="sumber_dana" id="sumber_dana" class="form-control" value="<?php echo $row->sumber_dana ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label" for="jenjang">Dokumen Publikasi</label>
                          <div class="col-sm-8">
                            <input type="file" name="dokumen" id="dokumen" class="form-control" value=""> 
                            <?php 
							if(!empty($row->dokumen)){
                               if(substr($row->dokumen, -3) == "pdf"){
                                  echo "<a href='" . base_url() . "assets/images/penelitian/".$row->dokumen . "' target='_blank' title='dokumen'><i class=\"fa fa-file-pdf-o\"></i></a>";
                                }else{
                                  echo "<a href='" . base_url() . "assets/images/penelitian/".$row->dokumen . "' target='_blank' title='dokumen'><i class=\"fa fa-file-image-o\" ></i></i></a>";
                                }
							}
                            ?>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label" for="jenjang">Proposal</label>
                          <div class="col-sm-8">
                            <input type="file" name="proposal" id="proposal" class="form-control" value="">
                            <?php 
							if(!empty($row->proposal)){
                               if(substr($row->proposal, -3) == "pdf"){
                                  echo "<a href='" . base_url() . "assets/images/penelitian/".$row->proposal . "' target='_blank' title='Proposal'><i class=\"fa fa-file-pdf-o\"></i></a>";
                                }else{
                                  echo "<a href='" . base_url() . "assets/images/penelitian/".$row->proposal . "' target='_blank' title='Proposal'><i class=\"fa fa-file-image-o\" ></i></i></a>";
                                }
							}
                            ?>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label" for="jenjang">Lap. Kemajuan</label>
                          <div class="col-sm-8">
                            <input type="file" name="lap_kemajuan" id="lap_kemajuan" class="form-control" value="">
                            <?php 
                              if(!empty($row->lap_kemajuan)){
                               if(substr($row->lap_kemajuan, -3) == "pdf"){
                                  echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_kemajuan . "' target='_blank' title='Laporan Kemajuan'><i class=\"fa fa-file-pdf-o\"></i></a>";
                                }else{
                                  echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_kemajuan . "' target='_blank' title='Laporan Kemajuan'><i class=\"fa fa-file-image-o\" ></i></i></a>";
                                }
                              }
                            ?>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label" for="jenjang">Lap. Keuangan</label>
                          <div class="col-sm-8">
                            <input type="file" name="lap_keuangan" id="lap_keuangan" class="form-control" value="">
                            <?php 
							if(!empty($row->lap_keuangan)){
                               if(substr($row->lap_keuangan, -3) == "pdf"){
                                  echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_keuangan . "' target='_blank' title='Laporan Keuangan'><i class=\"fa fa-file-pdf-o\"></i></a>";
                                }else{
                                  echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_keuangan . "' target='_blank' title='Laporan Keuangan'><i class=\"fa fa-file-image-o\" ></i></i></a>";
                                }
							}
                            ?>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label" for="jenjang">Lap. Akhir</label>
                          <div class="col-sm-8">
                            <input type="file" name="lap_akhir" id="lap_akhir" class="form-control" value="">
                            <?php 
							if(!empty($row->lap_akhir)){
                               if(substr($row->lap_akhir, -3) == "pdf"){
                                  echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_akhir . "' target='_blank' title='Laporan Akhir'><i class=\"fa fa-file-pdf-o\"></i></a>";
                                }else{
                                  echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_akhir . "' target='_blank' title='Laporan Akhir'><i class=\"fa fa-file-image-o\" ></i></i></a>";
                                }
							}
                            ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label" for="jenjang">Dana</label>
                          <div class="col-sm-6">
                            <input type="text" name="dana" id="dana" class="form-control" value="<?php echo $row->dana ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label" for="jenjang">No. Surat Perjanjian</label>
                          <div class="col-sm-6">
                            <input type="text" name="no_surat" id="no_surat" class="form-control" value="<?php echo $row->no_surat ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label" for="jenjang">Penyelenggara</label>
                          <div class="col-sm-8">
                            <input type="text" name="penyelenggara" id="penyelenggara" class="form-control" value="<?php echo $row->penyelenggara ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label" for="jenjang">Ketua</label>
                          <div class="col-sm-8">
                            <select name="ketua" id="ketua" class="js-example-basic-single col-sm-12" placeholder="--Nama Ketua--">
                                <?php
                                    //echo "<option value='0'></option>";
                                    foreach($pegawai as $value){
                                        echo "<option value=" . $value->npp . "  ";
                                        if($value->npp == $row->ketua){
                                          echo "selected";
                                        }
                                        echo ">" . $value->npp . " - " . $value->nama . "</option>";
                                    }
                                ?> 
                            </select>
                          </div>
                        </div>
                        <div class="form-group row" id="anggota">
                          <!-- <label class="col-sm-12 col-form-label" for="jenjang">Anggota</label> -->
                            <table class="myedittable" width="100%">
                              <thead>
                                <tr>
                                  <td>Jenis Anggota</td>
                                  <td>Nama Anggota</td>
                                  <td><a href="javascript:void(0)" class="text-primary" style="margin-top:8px;" id="add_update_anggota"><i class="fa fa-plus"></i> Anggota</a> </td>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $query = $this->db->query("select * from pegawai_anggota_penelitian where id_penelitian='" . $row->p_id . "'")->result();
                                $i =1;
                                foreach($query as $anggota){
                                ?>
                                <tr>
                                  <td>
                                    <select name="jenis[]" id="jenis_anggota_update<?php echo $i ?>" onclick="getAnggota('#jenis_anggota_update<?php echo $i ?>','#list_anggota_update<?php echo $i ?>');">
                                      <option value=0>Jenis Anggota</option>
                                      <option value=1 <?php echo ($anggota->jenis_anggota == 1)?"selected":"" ?>>Dosen</option>
                                      <option value=2  <?php echo ($anggota->jenis_anggota == 2)?"selected":"" ?>>Mahasiswa</option>
                                    </select>
                                  </td>
                                  <td>
                                    <div id="list_anggota_update<?php echo $i ?>" style="width:150px">
                                      <select name="anggota[]" class="jenis_anggota" style="width:100px">
                                        <?php
                                          if($anggota->jenis_anggota == 1){
                                            foreach($pegawai as $p){
                                              echo "<option value='$p->id' "; 
                                              if($p->id == $anggota->id_anggota) echo "selected";
                                              echo ">" . $p->nama . "</option>";
                                            }
                                          }else{
                                            foreach($mahasiswa as $m){
                                              echo "<option value='$m->id' "; 
                                              if($m->id == $anggota->id_anggota) echo "selected";
                                              echo ">" . $m->nama . "</option>";
                                            }
                                          }
                                        ?>
                                      </select>
                                    </div>
                                  </td>
                                  <td>
                                    <a href="javascript:void(0)" class="delete_row_update" class="text-danger" style="margin-top:8px;" onclick="delete_detail(<?php echo $anggota->id ?>)"><i class="fa fa-trash"></i></i></a>
                                    <input type="hidden" name="id_detail[]" value="<?php echo $anggota->id ?>">
                                  </td>

                                </tr>
                                <?php
                                $i++;
                                }
                                ?>
                              </tbody>
                            </table>
                            <!-- <div class="col-sm-1">        
                              <a href="#" class="text-danger" style="margin-top:8px;"><i class="fa fa-trash"></i></i></a>
                            </div> -->
                          </div>
                        
                      </div>
                      </div>
                      <div class="col-sm-12 col-form-label">
                        <input type="submit" id="edit_submit<?php echo $row->p_id?>" class="btn btn-primary" value="Simpan" >
                        <input type="button" id="tutup_edit<?php echo $row->id ?>" class="btn" value="Tutup"  onclick="tutup_edit()">
                      </div>
                  </form>
<script>
  function tutup_edit(){
    $("#form-edit").html("");
  }
  $("#edit_submit<?php echo $row->p_id?>").on("click",function(){
    var formPenelitian = new FormData(document.getElementById("form_edit<?php echo  $row->p_id ?>"));
    formPenelitian.append("id",<?php echo $row->p_id ?>);
    $.ajax({
        url : "<?php echo base_url();?>simpeg/RiwayatPenelitian/update",
        method : "POST",

        // data : "nomor="+$("#nomor<?php echo $row->p_id ?>").val()+
        //   "&judul="+$("#judul<?php echo $row->p_id?>").val()+
        //   "&mata_kuliah="+$("#mata_kuliah<?php echo $row->p_id?>").val()+
        //   "&fakultas="+$("#fakultas<?php echo $row->p_id?>").val()+
        //   "&jenis_penelitian="+$("#jenis_penelitian<?php echo $row->p_id?>").val()+
        //   "&tahun="+$("#tahun<?php echo $row->p_id?>").val()+
        //   "&sumber_dana="+$("#sumber_dana<?php echo $row->p_id?>").val()+
        //   "&dana="+$("#dana<?php echo $row->p_id?>").val()+
        //   "&no_surat="+$("#no_surat<?php echo $row->p_id?>").val()+
        //   "&penyelenggara="+$("#penyelenggara<?php echo $row->p_id?>").val()+
        //   "&ketua="+$("#ketua<?php echo $row->p_id?>").val()+
        //   "&anggota="+$("#anggota<?php echo $row->p_id?>").val()+
        //   "&id=<?php echo $row->p_id ?>",
        //async : false,
        //dataType : 'json',
        data : formPenelitian,
        processData: false,
        contentType: false,
        success: function(data){
          
          if(data == "1"){
            refresh_table();
          }else{
            $(".alert").html("DATA GAGAL DI TAMBAHKAN");
          }
          $("#form-edit").html("");
          //alert($("#form_edit<?php echo $row->p_id?>").serialize());
        }
    });
  });
  var t = $(".myedittable").DataTable({
    "paging":   false,
    "ordering": false,
    "info":     false

  });
  var counter = 1;
  function delete_detail(id){
    var r = confirm("Anda yakin ingin menghapus ?");
    if(r == true){
      $.ajax({
        url : "<?php echo base_url();?>simpeg/RiwayatPenelitian/delete_detail",
        method : "POST",
        data : "id="+id,
        success : function(data){
          if(data == "1"){
            alert("data berhasil dihapus");
            
                t
                    .row( $(".delete_row_update").parents('tr') )
                    .remove()
                    .draw();
          }else{
            alert("data gagal dihapus");
          }
        },
      });
    }else{
      return false;
    }

  }

  $("#add_update_anggota").on("click", function(){
    t.row.add([
      '<select name="jenis[]" id="jenis_anggota'+counter+'" onclick="getAnggota(\'#jenis_anggota'+counter+'\',\'#list_anggota'+counter+'\');"> \
          <option value=0>Jenis Anggota</option> \
          <option value=1>Dosen</option>\
          <option value=2>Mahasiswa</option>\
        </select>',
      '<div id="list_anggota'+counter+'" style="width:150px">\
          <select name="anggota[]" class="jenis_anggota" style="width:100px">\
            <option value=0>Nama Anggota</option>\
          </select>\
        </div>',
      '<a href="javascript:void(0)" class="delete_row" class="text-danger" style="margin-top:8px;"><i class="fa fa-trash"></i></i></a><input type="hidden" name="id_detail[]" value="0">',
    ]).draw();
    counter++;
  });
  $("#add_anggota").click();
  $('.myedittable tbody').on( 'click', '.delete_row', function () {
              t
                  .row( $(this).parents('tr') )
                  .remove()
                  .draw();
          } );
  $(".js-example-basic-single").select2({
    //dropdownParent: $("#tambah")
  });
  $(".jenis_anggota").select2({
    //dropdownParent: $("#tambah"),
    width: '100px' 
  });
</script>