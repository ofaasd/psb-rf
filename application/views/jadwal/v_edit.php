<div class="page-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>EDIT JADWAL MATAKULIAH</h5>
                            </div>
                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    <table class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th width="5">Rombel</th>
                                            <th width="20px">Dosen</th>
                                            <th>Hari</th>
                                            <th width="10px">Sesi</th>
                                            <th width="10px">Ruang</th>
                                            <th width="10px">Kelas</th>
                                            <th width="20px">Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $d): ?>
                                         <tr>
                                             <td><?php echo $d->rombel ?></td>
                                             <td><?php echo $d->dosen ?></td>
                                             <td><?php echo $d->hari ?></td>
                                             <td><?php echo $d->sesi ?></td>
                                             <td><?php echo $d->ruang ?></td>
                                             <td><?php echo $d->kelas == 1? 'Reguler':'Karyawan'; ?></td>
                                             <td><?php echo $d->status == 1? 'Buka':'Tutup'; ?></td>
                                             <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $d->id; ?>">Edit</button>
                                              <!-- Modal -->
                                              <div class="modal fade" id="myModal<?php echo $d->id; ?>" role="dialog">
                                                <div class="modal-dialog">
                                                
                                                  <!-- Modal content-->
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                      Rombel :
                                                      <select id="rombel" class="form-control" style="width: 180px;">
                                                          <option value="<?php echo $d->rombel ?>" selected><?php echo $d->rombel ?></option>
                                                          <?php foreach ($rombel as $r): 
                                                            ?>
                                                           <option value="<?php echo $r->rombel ?>"><?php echo $r->rombel ?></option>   
                                                          <?php endforeach ?>
                                                      </select><br>
                                                      Dosen :
                                                      <select id="dosen" class="form-control" style="width: 280px;">
                                                          <option value="<?php echo $d->id_dosen ?>" selected><?php echo $d->dosen ?></option>
                                                          <?php foreach($dosen_1 as $dosen){?>
                                                            <option value="<?php echo $dosen->id; ?>"><?php echo $dosen->nama_pegawai; ?></option>
                                                        <?php } ?>
                                                      </select><br>
                                                      Hari:
                                                      <select id="hari" class="form-control" style="width: 180px;">
                                                          <option value="<?php echo $d->hari ?>" selected><?php echo $d->hari ?></option>
                                                          <?php foreach($hari_1 as $hari){?>
                                                            <option value="<?php echo $hari->nama_hari; ?>"><?php echo $hari->nama_hari; ?></option>
                                                        <?php } ?>
                                                      </select><br>
                                                      Sesi :
                                                      <select id="sesi" class="form-control" style="width: 180px;">
                                                          <option value="<?php echo $d->sesi ?>" selected><?php echo $d->sesi ?></option>
                                                          <?php foreach($sesi_1 as $sesi){?>
                                                            <option value="<?php echo $sesi->nama_sesi; ?>"><?php echo $sesi->nama_sesi; ?></option>
                                                        <?php } ?>
                                                      </select><br>
                                                      Ruang :
                                                      <select id="ruang" class="form-control" style="width: 280px;">
                                                          <option value="<?php echo $d->ruang ?>" selected><?php echo $d->ruang ?></option>
                                                          <?php foreach($ruang_1 as $ruang){?>
                                        <option value="<?php echo $ruang->nama_ruang; ?>"><?php echo $ruang->nama_ruang; ?></option>
                                    <?php } ?>
                                                      </select><br>
                                                      Status : 
                                                      <select id="status" class="form-control" style="width: 280px;">
                                                          <option value="<?php echo $d->status ?>" selected><?php echo $d->status == 1? 'Buka':'Tutup'; ?></option>
                                                          <option value="1">Buka</option>
                                                          <option value="0">Tutup</option>
                                                      </select><br>
                                                      <button class="btn btn-primary" onclick="saveJadwal(<?php echo $d->ids_jadwal ?>);">simpan</button>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                  </div>
                                                  
                                                </div>
                                              </div></td>
                                         </tr>   
                                        <?php endforeach ?>
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                                    
<script>
    function saveJadwal(id){
        var rombel = $('#rombel').val();
        var dosen = $('#dosen').val();
        var hari = $('#hari').val();
        var sesi = $('#sesi').val();
        var ruang = $('#ruang').val();
        var status = $('#status').val();

        $.ajax({
            url: "<?php echo base_url('master/jadwal/editSave/'); ?>",
            method: 'POST',
            data: {
                id: id,
                rombel: rombel,
                dosen: dosen,
                hari: hari,
                sesi: sesi,
                ruang: ruang,
                status: status
            },
            success: function(data){
                if (data == 1) {
                    alert('Sukses edit jadwal.');
                    location.reload();
                }else{
                    alert('Gagal edit jadwal');
                    location.reload();
                }
            }
        });
    }
</script>
