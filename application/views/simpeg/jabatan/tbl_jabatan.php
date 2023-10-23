<a href="#form-add" class="btn btn-primary" onclick="add_form()">+ Jabatan Struktural</a><br /><br />
							      <table class="table table-striped table-bordered nowrap">
							        <thead>
							          <tr>
							            <th>No.</th>
							            <th>Unit Kerja</th>
							            <th>Bagian</th>
							            <th>Jenis Jabatan</th>
							            <th>Nama jabatan</th>
							            
							            <th>Action</th>
							          </tr>
							        </thead>
							        <tbody>
							        	<?php
							        	$i = 1;
							        	foreach($jabatan as $row){
							        	?>
								        	<tr>
								        	  <td><?php echo  $i ?></td>
								        	  <td><?php echo  $row->unit_kerja ?></td>
								        	  <td><?php echo  $row->nama_bagian ?></td>
								        	  <td><?php echo  $row->nama_jenis ?></td>
								        	  <td><?php echo  $row->nama_jabatan ?></td>
								        	  <td><?php echo  $row->id ?></td>
								        	</tr>
							        	<?php
							        	$i++;
							        	}
							        	?>
							        </tbody>
								   </table>
								   <script>
								   	$(".table").DataTable();
								   </script>