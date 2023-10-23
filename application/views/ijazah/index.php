<div class="page-body">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>DAFTAR MAHASISWA</h5>
				</div>
				<div class="card-block">
					<a href="#" id="add"  class="btn btn-primary waves-effect" data-toggle='modal' data-target='#ijazah' onclick="" class="btn btn-success">Setting Ijazah</a>
					<div class="dt-responsive table-responsive">
						<table id="order-table" class="table table-striped table-bordered nowrap">
						<thead>
							<tr>
								<th>No</th>
								<th>NIM</th>
								<th>Nama Lengkap</th>
								<th>Email</th>
								<th>status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<?php $no = 1;
						foreach($daftar_mhs as $a){?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $a->nim ?></td>
								<td><?php echo $a->nama ?></td>
								<td><?php echo $a->email ?></td>
								<td><?php if($a->status == 1){
									echo 'Aktif';
									}else if($a->status == 2){
										echo 'Cuti';
									}else if($a->status == 3){
										echo 'Keluar';
									}else if($a->status == 4){
										echo 'Lulus';
									}else if($a->status == 5){
										echo 'Meninggal';
									}else if($a->status == 6){
										echo 'DO';
									}?></td>
								<td><a href="<?php echo base_url()?>ijazah/cetak/<?php echo $a->nim?>" class="btn btn-success">Cetak Ijazah</a></td>
							</tr>
						<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th>No</th>
								<th>NIM</th>
								<th>Nama Lengkap</th>
								<th>Email</th>
								<th>Status</th>
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
<div class="modal fade" id="ijazah" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Tambah Riwayat Ilmiah</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="<?php echo base_url() ?>ijazah/simpan_setting" id="formKaryaIlmiah" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Izin</label>
                        <div class="col-sm-6">
                          <input type="text" name="izin" id="izin" class="form-control" value="<?php echo (!empty($setting->izin))?$setting->izin:""; ?>">
                        </div>
                      </div>
					  <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Status</label>
                        <div class="col-sm-6">
                          <input type="text" name="status" id="status" class="form-control" value="<?php echo (!empty($setting->status))?$setting->status:""; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Ketua Prodi</label>
                        <div class="col-sm-6">
                          <input type="text" name="ketua_prodi" id="status" class="form-control" value="<?php echo (!empty($setting->ketua_prodi))?$setting->ketua_prodi:""; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Kepala Sekolah</label>
                        <div class="col-sm-6">
                          <input type="text" name="ketua_sekolah" id="status" class="form-control" value="<?php echo (!empty($setting->ketua_sekolah))?$setting->ketua_sekolah:""; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="jenjang">Tanggal Ijazah</label>
                        <div class="col-sm-6">
                          <input type="date" name="tanggal_ijazah" id="status" class="form-control" value="<?php echo (!empty($setting->tanggal_ijazah))?$setting->tanggal_ijazah:""; ?>">
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