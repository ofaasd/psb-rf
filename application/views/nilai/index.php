<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <?php 
                          echo $this->session->userdata('status_delete'); 
                          $this->session->set_userdata('status_delete','');
                          echo $this->session->userdata('notif'); 
                          $this->session->set_userdata('notif','');
                          ?>
                    <!-- <a href="<?php echo base_url()?>pegawai/tambah_pegawai" class="btn btn-success btn-round">TAMBAH PEGAWAI</a><hr> -->
                    <h5>DAFTAR DOSEN</h5>
                    <a href="<?php echo base_url('master/nilai/validasi_all'); ?>" onclick="return confirm('Apakah yakin untuk melakukan Validasi?');" class="btn btn-success">Validasi Semua Matakuliah</a> <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Buka Validasi</a>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                      <div class="modal-dialog">
                      
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Buka Validasi</h4>
                          </div>
                          <div class="modal-body">
                            <p>Pilih Jangkauan : </p>
                            <select id="jangkauan" class="form-control" onchange="cariData()">
                                <option selected="" disabled="">-- Pilih Jangkauan --</option>
                                <option value="1">Jadwal</option>
                                <option value="2">Matakuliah</option>
                                <option value="3">Semua</option>
                            </select>
                            <div id='tampil'>
                                
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
						<table id="order-table" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP - NIDN</th>
                                    <th>Nama Pegawai</th>
                                    <th>Status Homebase</th>
                                    <th>Jabatan Fungsional</th>
                                    <!-- <th>Alamat</th>
                                    <th>Email</th>
                                    <th>No. Telp / Hp</th> -->
                                    <th></th>
                                </tr> 
                            </thead>
                            <tbody>
                            <?php $no = 1;
                            foreach($query->result() as $a){?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $a->npp ?> - <?php echo  $a->nidn ?></td>
                                    <td><?php echo  $a->gelar_depan.' '.strtoupper($a->nama_lengkap).' '.$a->gelar_belakang; ?></td>
                                    <td><?php echo  $a->nama_jenis ?></td>
                                    <td><?php echo  $a->jabatan_fungsional_sekarang ?> </td>
                                    <!-- <td><?php echo  $a->alamat ?></td>
                                    <td><?php echo  $a->email1 ?> <br /> <?php echo  $a->email2?></td>
                                    <td><?php echo  $a->notelp ?> <br/> <?php echo  $a->nohp ?></td> -->
                                    <td><a href="<?php echo base_url()?>master/nilai/list_matkul/<?php echo $a->pid ?>" class="btn btn-success">Input Nilai</a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>NIP - NIDN</th>
                                    <th>Nama Pegawai</th>
                                    <th>Status Homebase</th>
                                    <th>Jabatan Fungsional</th>
                                    <!-- <th>Alamat</th>
                                    <th>Email</th>
                                    <th>No. Telp / Hp</th> -->
                                    <th></th>
                                </tr>
                            </tfoot>
                          </table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    function cariData(){
        var j = $("#jangkauan").val();
        $.ajax({
            url : "<?php echo base_url();?>master/nilai/tampilJangkauan",
            method: "POST",
            data:{
                  jangkauan: jangkauan
              },
            async: false, 
            success: function(data){
                $('#tampil').html(data);
            }
        });
    }
</script>