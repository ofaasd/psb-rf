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
                    <a href="<?php echo base_url()?>pegawai/tambah_pegawai" class="btn btn-success btn-round">TAMBAH PEGAWAI</a><hr>
                    <h5>DAFTAR PEGAWAI</h5>
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
                                    <td><?php echo  $a->nama_lengkap?></td>
                                    <td><?php echo  $a->nama_jenis ?></td>
                                    <td><?php echo  $a->jabatan_fungsional_sekarang ?> </td>
                                    <!-- <td><?php echo  $a->alamat ?></td>
                                    <td><?php echo  $a->email1 ?> <br /> <?php echo  $a->email2?></td>
                                    <td><?php echo  $a->notelp ?> <br/> <?php echo  $a->nohp ?></td> -->
                                    <td><a href="<?php echo base_url()?>pegawai/reset_pass_pegawai/<?php echo $a->npp ?>" onclick="return confirm('Yakin Reset Password Pegawai?')" class="btn btn-success">Reset Password</a> <a href="<?php echo base_url()?>pegawai/delete_pegawai/<?php echo $a->npp ?>" onclick="return confirm('Yakin Delete Data Pegawai?')" class="btn btn-danger">Delete</a></td>
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