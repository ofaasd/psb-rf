<div class="page-body">
    <div class="row">
        <div class="col-sm-9 target_ajax">
            <div class="card">
                <div class="card-header">
                    <?php echo  $this->session->userdata('status_delete'); 
                          $this->session->set_userdata('status_delete','');
                          ?>
                    <a href="<?php echo  base_url()?>simpeg/manage/tambah_pegawai" class="btn btn-success btn-round">TAMBAH PEGAWAI</a><hr>
                    <h5>DAFTAR PEGAWAI</h5>
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
						<table id="order-table" class="table table-sm compact">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>npp - NIDN</th>
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
                                    <td><?php echo  $no++ ?></td>
                                    <td><?php echo  $a->npp ?> - <?php echo  $a->nidn ?></td>
                                    <td><?php echo  $a->nama_lengkap?></td>
                                    <td><?php echo  $a->nama_jenis ?></td>
                                    <td><?php echo  $a->jabatan_fungsional_sekarang ?> </td>
                                    <!-- <td><?php echo  $a->alamat ?></td>
                                    <td><?php echo  $a->email1 ?> <br /> <?php echo  $a->email2?></td>
                                    <td><?php echo  $a->notelp ?> <br/> <?php echo  $a->nohp ?></td> -->
                                    <td><a href="<?php echo  base_url()?>simpeg/manage/profil/<?php echo  $a->npp?>" class="btn btn-success"><i class="fa fa-pencil" ></i></a>&ensp;<a href="<?php echo  base_url()?>simpeg/manage/nonaktif/<?php echo  $a->npp?>" onclick="return confirm('Yakin Delete Data Calon Mahasiswa?')" class="btn btn-danger"><i class="fa fa-ban" ></i></a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>npp - NIDN</th>
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
        <div class="col-sm-3">
            <?php echo  $riwayat_tree ?>
        </div>
	</div>
</div>