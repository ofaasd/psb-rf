

                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <?php 
                                                        echo $this->session->userdata('jadwal'); 
                                                        $this->session->set_userdata('jadwal','');
                                                              ?>
                                                        <!-- <a href="<?php echo base_url()?>master/matakuliah/add" class="btn btn-success btn-round"><font style="color: white;">TAMBAH MATA KULIAH</font></a><hr> -->
                                                        <h5>MASTER Hari</h5>
                                                        <?=$this->session->flashdata('master_hari');?>
                                                        <div class="modal fade" id="tambahhari" tabindex="-1" role="dialog">
                                                                    <div class="modal-dialog modal-sm" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Tambah Hari</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                            <form class='form-horizontal form-label-left' action='<?=base_url('master/hari/simpan_hari')?>' method='post'>
                                                                                  
                                                                            <input type="hidden" class="form-control" name="id" id="id">
                                                                                  <div class="card-block">
                                                                                    <label class="control-label col-md-6 col-sm-6">Hari : </label>
                                                                                      <div class="col-md-12 col-sm-12">
                                                                                      <input type="text" class="form-control" name="hari" id="hari">
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
                                                        
                                                        <hr>
                                                        <button onclick="$('#tambahhari').modal('show');" class="btn btn-success btn-round"><font style="color: white;">Tambah Hari</font></button>
                                                        
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th width="5">No</th>
                                                                    <th>Hari</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($hari as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a->nama_hari ?></td>
                                                                    <td><button onclick="if (confirm('Anda yakin?')) window.location.href='<?=base_url('master/hari/hapus_hari/'.$a->id)?>';"><font color=red><i class="fa fa-trash"><b>Hapus</b></i></font></button></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th width="5">No</th>
                                                                    <th>Hari</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </tfoot>
                                                          </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
