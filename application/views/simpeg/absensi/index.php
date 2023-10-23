 
<div class="page-body">
	<div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                	<div class="row">
	                	<div class="col-md-2">
		                	<h2 style="display:block;">Absensi</h2>
		                </div>
		                <div class="col-md-8">
		                	<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambah">Upload Absensi</a>
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
            	<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
			      <div class="modal-dialog" role="document">
			          <div class="modal-content">
			              <div class="modal-header">
			                  <h4 class="modal-title">Upload Absensi</h4>
			                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                      <span aria-hidden="true">&times;</span>
			                  </button>
			              </div>
			              <div class="modal-body">
			                  <form method="POST" action="<?php echo  base_url();?>simpeg/absensi/upload" enctype="multipart/form-data">
			                      <div class="form-group">
			                        <label for="jenjang">Upload File DBF</label>
			                        <input type="file" name="file" id="no_sk" class="form-control" value="">
			                      </div> 
			                      <div class="col-sm-12 col-form-label">
			                        <input type="submit" id="save" class="btn btn-primary" value="Simpan">
			                      </div>
			                  </form>
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