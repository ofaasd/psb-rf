 
<div class="page-body">
	<div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                	<div class="row">
	                	<div class="col-md-10">
		                	<h2 style="display:block;">Jabatan Struktural</h2>
		                </div>
		                
		            </div>
                </div>
                <div class="card-block">
                	<div class="row">
	                	<div class="col-md-12">
	                		<div class="card">
							    <div class="card-header">	
							        <h5>Daftar Jabatan Struktural</h5>
							        <div class="alert alert-primary" id="alert">
							        	     
							        </div>
							    </div>
							    <div class="card-block" id="tbl_pegawai">
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
								</div>
							</div>
							<div class="card">
								<div class="card-block" id="form-add">
									<form method="POST" action="javascript:void(0)" id="formJabatan" enctype="multipart/form-data">
										<div class="row">
								         <div class="col-sm-6">
								          <div class="form-group row">
								            <label class="col-sm-4 col-form-label" for="jenjang">Unit Kerja</label>
								            <div class="col-sm-6">
								              <select name="unit_kerja" id="unit_kerja" class="form-control">
								              	<option value=0>---Pilih Unit Kerja</option>
								              	<?php foreach($unit_kerja as $value){
								              		echo "<option value='" . $value->id . "'>" . $value->unit_kerja . "</option>";

								              	}?>
								              </select>
								            </div>
								          </div>
								          <div class="form-group row">
								            <label class="col-sm-4 col-form-label" for="jenjang">Bagian</label>
								            <div class="col-sm-6" id="bagian">
								              <select name="bagian" id="field_bagian" class="form-control">
								              	
								              </select>
								            </div>
								          </div>
								          <div class="form-group row">
								            <label class="col-sm-4 col-form-label" for="jenjang">Jenis Jabatan</label>
								            <div class="col-sm-6" id="jenis_jabatan">
								              <select name="jenis_jabatan" id="field_jenis" class="form-control">
								              	
								              </select>
								            </div>
								          </div>
								          <div class="form-group row">
								            <label class="col-sm-4 col-form-label" for="jenjang">Nama Jabatan</label>
								            <div class="col-sm-6">
								              <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control" value="">
								            </div>
								          </div>
								          <div class="form-group row">
								          	<div class="col-sm-6">
									          <input type="submit" id="save" class="btn btn-primary" value="Simpan" data-dismiss="modal">
									      	</div>
									      </div>
								      	 </div>
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
</div>
<script>
	$(document).ready(function(){
		$(".table").DataTable();
	});
	$("#unit_kerja").change(function(){
		var id = $(this).val();
		$.ajax({
			method:"POST",
			url : "<?php echo base_url();?>simpeg/jabatan/getBagian",
			data : "id="+id,
			success: function(data){
	          $("#bagian").html(data);
	        }
		});
		$.ajax({
			method:"POST",
			url : "<?php echo base_url();?>simpeg/jabatan/getJenis",
			data : "id="+id,
			success: function(data){
	          $("#jenis_jabatan").html(data);
	        }
		});
	});
	$("#save").on("click",function(){
    var formJabatan = new FormData(document.getElementById("formJabatan"));
    $.ajax({
        url : "<?php echo base_url();?>simpeg/jabatan/insert",
        method : "POST",
        data : formJabatan,
        processData: false,
        contentType: false,
        success: function(data){
          
          if(data == "1"){
            refresh_table();
          }else{
            $(".alert").html("DATA GAGAL DI TAMBAHKAN");
          }
          $('.modal-backdrop').remove();
          
        }
    });
  });
  function refresh_table(){
      $.ajax({
        url : "<?php echo base_url();?>simpeg/jabatan/refresh",
        type : "GET",
        //async : false,
        //dataType : 'json',
        success: function(data){
          $("#tbl_pegawai").html(data);
          
        }
    });        
  }
</script>