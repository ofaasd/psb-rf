                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <?php 

                                                        // $kur_item=array();
                                                        // foreach($kurikulum_item as $data){
                                                        //   $kur_item[]=$data['id_mata_kuliah'];
                                                        // }

                                                        // echo print_r($kur_item);

                                                        echo $this->session->userdata('matakuliah'); 
                                                        $this->session->set_userdata('matakuliah','');
                                                              ?>
                                                        <!-- <a href="<?php echo base_url()?>master/matakuliah/add" class="btn btn-success btn-round"><font style="color: white;">TAMBAH MATA KULIAH</font></a><hr> -->
                                                        <h5>Daftar Matakuliah  
                                                        <?=$kurikulum[0]->nama_jurusan." - ".$kurikulum[0]->kode_kurikulum?></h5>
                                                        
                                                        <hr>
                                                        <a href="<?php echo base_url()?>master/kurikulum" class="btn btn-success btn-round"><font style="color: white;">KEMBALI KE KURIKULUM</font></a>
                                                        <a href="<?=base_url('master/kurikulum/kelola_matkul/').$kurikulum[0]->kur_id?>" class="btn btn-info btn-round"><font style="color: white;">TAMBAH MATA KULIAH</font></a>
                                                    </div>
                                                    <div class="card-block">
                                                    <?php echo $this->session->userdata('updatematkul'); 
                                                          $this->session->set_userdata('updatematkul','');
                                                    ?>

                                                    <?php
                                                    echo $this->session->userdata('hapusmatkul'); 
                                                    $this->session->set_userdata('hapusmatkul','');
                                                     
                                                    ?>

                                                    <div class="modal fade" id="editmatkul" tabindex="-1" role="dialog">
                                                                    <div class="modal-dialog modal-sm" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Edit SKS & SMT</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                            <form class='form-horizontal form-label-left' action='<?=base_url('master/kurikulum/update_matkul')?>' method='post'>
                                                                                  
                                                                            <input type="hidden" class="form-control" name="kurid" id="kurid" value="<?=$kurikulum[0]->kur_id?>">
                                                                            <input type="hidden" class="form-control" name="id" id="id">
                                                                                  <div class="card-block">
                                                                                    <label class="control-label col-md-6 col-sm-6">SKS : </label>
                                                                                      <div class="col-md-12 col-sm-12">
                                                                                      <input type="number" class="form-control" name="sks" id="sks">
                                                                                      </div>
                                                                                    <br>
                                                                                    <label class="control-label col-md-6 col-sm-6">Semester : </label>
                                                                                      <div class="col-md-12 col-sm-12">
                                                                                      <input type="number" class="form-control" name="smt" id="smt">
                                                                                      </div>
                                                                                      <br>
                                                                                    <label class="control-label col-md-6 col-sm-6">Tipe : </label>
                                                                                      <div class="col-md-12 col-sm-12">
                                                                                      <select class="form-control" name="tipe" id="tipe">
                                                                                        <option value="teori">Teori</option>
                                                                                        <option value="praktek">Praktek</option>
                                                                                      </select>
                                                                                      </div>  
                                                                                       <br>
                                                                                    <label class="control-label col-md-6 col-sm-6">Status : </label>
                                                                                      <div class="col-md-12 col-sm-12">
                                                                                      <select class="form-control" name="status" id="status">
                                                                                        <option value="aktif">Aktif</option>
                                                                                        <option value="non-aktif">Non-aktif</option>
                                                                                      </select>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="card-block">
                                                                                        <div class="col-md-12 col-sm-12 ">
                                                                                        <center>
                                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                                        </center>
                                                                                        </div>
                                                                                  </div>

                                                                            </form>
    
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                       
                                                        <div class="dt-responsive table-responsive">
                                                            <!-- <form action=<?=base_url('master/kurikulum/simpan_matkul_kurikulum')?> method=post> -->
                                                            <!-- <input type="hidden" name="id_kurikulum" value="<?=$kurikulum[0]->kur_id?>"> -->
                                                            <table class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th width="5">No</th>
                                                                    <th width="20px">Kode</th>
                                                                    <th>Nama Mata Kuliah</th>
                                                                    <th>SKS</th>
                                                                    <th>SMT</th>
                                                                    <th>Tipe</th>
                                                                    <th>Status</th>
                                                                    <th>Aksi</th>
                                                                    <!-- <th width="10px"><input type=checkbox id=pilihsemua> Pilih Semua</th> -->
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            if(!empty($list_matkul)){
                                                            foreach($list_matkul as $a){
                                                              $statMatkul=$this->Kurikulum_Model->getStatMatkul($kurikulum[0]->kur_id,$a['id']);
                                                              // echo print_r($statMatkul);
                                                              ?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a['kode_mata_kuliah'] ?></td>
                                                                    <td><?php echo $a['nama_mata_kuliah']." / ".$a['nama_mata_kuliah_eng']; ?></td>
                                                                    <td><?php echo $statMatkul->sks;?></td>
                                                                    <td><?php echo $statMatkul->semester;?></td>
                                                                    <td><?php echo $statMatkul->tipe;?></td>
                                                                    <td><?php echo ($statMatkul->status=='aktif')? "<span class='badge badge-success'>Aktif</span>":"<span class='badge badge-danger'>Non-Aktif</span>";?></td>
                                                                    <td><button data-id="<?=$a['id']?>" data-sks="<?=$statMatkul->sks?>" data-smt="<?=$statMatkul->semester?>" data-tipe="<?=$statMatkul->tipe?>" data-status="<?=$statMatkul->status?>" onclick="$('#id').val($(this).data('id')); $('#sks').val($(this).data('sks')); $('#smt').val($(this).data('smt')); $('#tipe').val($(this).data('tipe')); $('#status').val($(this).data('status')); $('#editmatkul').modal('show');"><font color=green><i class="fa fa-edit"><b>Edit</b></i></font></button>
                                                                    <!-- <a href=""><font color=green><i class="fa fa-edit"><b>Edit</b></i></font></a> |  -->
                                                                    <button onclick="if (confirm('Anda yakin?')) window.location.href='<?=base_url('master/kurikulum/hapus_matkul/'.$kurikulum[0]->kur_id.'/'.$a['id'])?>';"><font color=red><i class="fa fa-trash"><b>Hapus</b></i></font></button></td>
                                                                    
                                                                </tr>
                                                            <?php }
                                                            }else{
                                                              echo "<tr><td colspan=6><center>Belum ada matakuliah pada kurikulum ini. Klik <a href=".base_url('master/kurikulum/kelola_matkul/').$kurikulum[0]->kur_id.">disini</a></center></td></tr>";
                                                            } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                <th width="5">No</th>
                                                                    <th width="20px">Kode</th>
                                                                    <th>Nama Mata Kuliah</th>
                                                                    <th>SKS</th>
                                                                    <th>SMT</th>
                                                                    <th>Tipe</th>
                                                                    <th>Status</th>
                                                                    <th>Aksi</th>
                                                                    <!-- <th width="5"></th>
                                                                    <th width="20px"></th>
                                                                    <th></th> -->
                                                                    <!-- <th width="10px"><input type="submit" class="btn btn-primary" value="Simpan"></th> -->
                                                                    
                                                                </tr>
                                                            </tfoot>
                                                          </table>
                                                          <!-- </form> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        
            
                                        </div>
                                    </div>
                                    
<script>

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
