<div class="page-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="card">
							<div class="card-header">
								<?php 
								echo $this->session->userdata('uang'); 
								$this->session->set_userdata('uang','');
									  ?>
								<h5>Masukan</h5>&nbsp;
								
							</div>
							<div class="card-block">
								<div class="dt-responsive table-responsive">
									<table id="order-table" class="table table-striped table-bordered nowrap">
									<thead>
										<tr>
											<th>No</th>
											<th>NIM</th>
											<th>Nama Mahasiswa</th>
											<th>Masukan</th>
										</tr>
									</thead>
									<tbody>
									<?php $no = 1;
									
									foreach($masukan->result() as $a){?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td><?php echo $a->nim ?></td>
											<td><?php echo $a->nama ?></td>
											<td>
												<?php echo $a->saran ?>
											</td>
											
										</tr>
									<?php } ?>
									</tbody>
									<tfoot>
										<tr>
											<th>No</th>
											<th>NIM</th>
											<th>Nama Mahasiswa</th>
											<th>Masukan</th>
										</tr>
									</tfoot>
								  </table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
