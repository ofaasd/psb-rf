<?php 
  $jenjang = array("SLTA","D-I", "D-II", "D-III", "D-IV", "S1","S2","S3");
  echo $this->session->userdata('status_delete'); 
      $this->session->set_userdata('status_delete','');
      ?>
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