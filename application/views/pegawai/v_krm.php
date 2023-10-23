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
					<table class="table table-stripped">
						<tr>
							<td>Kode Matakuliah</td>
							<td>Matakuliah</td>
							<td>Hari</td>
							<td>Jam</td>
							<td>Ruangan</td>
						</tr>
						<?php
							foreach($jadwal as $row){
								echo "<tr>";
								echo "<td>" . $row->kode_mata_kuliah . "</td>";
								echo "<td>" . $row->nama_mata_kuliah . "</td>";
								echo "<td>" . $row->hari . "</td>";
								echo "<td>" . $row->sesi . "</td>";
								echo "<td>" . $row->ruang . "</td>";
								echo "</tr>";
							}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>