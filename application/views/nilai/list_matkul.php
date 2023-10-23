 <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
						<div class="col-md-12">
							<h2></h2>
						</div>
					</div>
				</div>
				<div class="card-block">
					<div class="dt-responsive table-responsive">
					<table class="table table-striped table-bordered nowrap">
						<thead>
							<tr>
								<th>Kode Matakuliah</th>
								<th>Matakuliah</th>
								<th>Hari</th>
								<th>Jam</th>
								<th>Ruangan</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($jadwal as $row){
									echo "<tr>";
									echo "<td>" . $row->kode_mata_kuliah . "</td>";
									echo "<td>" . $row->nama_mata_kuliah . "</td>";
									echo "<td>" . $row->hari . "</td>";
									echo "<td>" . $row->sesi . "</td>";
									echo "<td>" . $row->ruang . "</td>";
									echo "<td><a href='" . base_url() . "/master/nilai/set_nilai/" . $row->id ."' class='btn btn-primary'>Set Nilai</a></td>";
									echo "</tr>";
								}
							?>
						</tbody>
					</table>
				</div>
				</div>
			</div>
		</div>
	</div>