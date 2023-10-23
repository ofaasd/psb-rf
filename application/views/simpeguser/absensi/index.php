 
<div class="page-body">
	<div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                	<div class="row">
	                	<div class="col-md-2">
		                	<h2 style="display:block;">Absensi</h2>
		                </div>
		                
		            </div>
                </div>
                <div class="card-block">
                	<div class="row">
	                	<div class="col-md-12">
	                		<div class="card">
							    <div class="card-header">	
							        <h5>Data Absensi</h5>
							        <div class="alert alert-primary" id="alert">
							        	     
							        </div>
							    </div>
							    <div class="card-block" id="tbl_pegawai">
							      <table class="table table-striped table-bordered nowrap">
							        <thead>
							          <tr>
							            <th>No.</th>
							            <th>No Kartu</th>
							            <th>No ID</th>
							            <th>Nama</th>
							            <th>Tanggal</th>
							            <th>Masuk</th>
							            <th>Keluar</th>
							          </tr>
							        </thead>
							        <tbody>
							        	<?php
							        	$kueri = $this->db->query("select * from absensi")->result();
							        	$i = 1;
							        	foreach($kueri as $row){
							        	?>
								        	<tr>
								        	  <td><?php echo  $i ?></td>
								        	  <td><?php echo  $row->FCCARDNO ?></td>
								        	  <td><?php echo  $row->FCIDNO ?></td>
								        	  <td><?php echo  $row->FCNAME ?></td>
								        	  <td><?php echo  $row->FDDATE ?></td>
								        	  <td><?php echo  $row->FCFIRSTIN ?></td>
								        	  <td><?php echo  $row->FCLASTOUT ?></td>
								        	</tr>
							        	<?php
							        	$i++;
							        	}
							        	?>
							        </tbody>
								   </table>
								</div>
							</div>
	                	</div>
               		</div>
            	</div>
       		</div>
    	</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$(".table").DataTable();
	});
</script>