 
<div class="page-body">
	<div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                	<h2>Dashboard</h2>
                </div>
                <div class="card-block">
                	<div class="row">
	                	<div class="col-md-9">
	                		<div class="card">
	                			<div class="card-header">
	                				<p><b>Quick Links</b></p>
	                			</div>
	                			<div class="card-block">
	                				<div class="row">
		                				<div class="card col-md-2" style="padding:10px;">
		                					<center><i class="fa fa-home fa-3x" style="color:#3498DB; margin:10px;"></i></center>
		                					<center><a href="#">Home</a></center>
		                				</div>
		                				<div class="card col-md-2" style="padding:10px;">
		                					<center><i class="fa fa-search fa-3x" style="color:#F1C40F; margin:10px;"></i></center>
		                					<center><a href="#">Pencarian Pegawai</a></center>
		                				</div>
		                				<div class="card col-md-2" style="padding:10px;">
		                					<center><i class="fa fa-file-text fa-3x" style="color:#2ECC71; margin:10px;"></i></center>
		                					<center><a href="#">Nominatif Pegawai</a></center>
		                				</div>
		                				<div class="card col-md-2" style="padding:10px;">
		                					<center><i class="fa fa-pie-chart fa-3x" style="color:#1ABC9C; margin:10px;"></i></center>
		                					<center><a href="#">Statistik Pegawai</a></center>
		                				</div>
		                				<div class="card col-md-2" style="padding:10px;">
		                					<center><i class="fa fa-wpforms fa-3x" style="color:#E74C3C; margin:10px;"></i></center>
		                					<center><a href="#">Data Belum Lengkap</a></center>
		                				</div>
		                				<div class="card col-md-2" style="padding:10px;">
		                					<center><i class="fa fa-print fa-3x" style="color:#34495E; margin:10px;"></i></center>
		                					<center><a href="#">Cetak Data</a></center>
		                				</div>
		                				<div class="card col-md-2" style="padding:10px;">
		                					<center><i class="fa fa-users fa-3x" style="color:#1CC9A7; margin:10px;"></i></center>
		                					<center><a href="#">User Manager</a></center>
		                				</div>
		                			</div>
	                			</div>
	                		</div>
	                	</div>
	                	<div class="col-md-3">
	                		<div class="card">
		                		<div class="card-header">
	                				<p><b>Main Menu</b></p>
	                			</div>
		                		<div class="card-block tree-view">
									<div id="basicTree" class="jstree jstree-1 jstree-default" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="j1_6" aria-busy="false">
										<ul >
											<?php
												$array = array("Asdasd","vbbbb");
												foreach($menu_tree as $value){
												// echo "<li >" . $value->nama_menu . "</li>"; 
												?>
												<li data-jstree='{"opened":true}'><?php echo  $value->nama_menu ?>
													<?php
													$kueri = $this->db->query("select * from menu_tree where parent = " . $value->id)->result();
													if(!empty($kueri)){
														echo "<ul>";
														foreach($kueri as $submenu){
															echo "<li data-jstree='{\"type\":\"file\"}'>" . $submenu->nama_menu . "</li>";
														}
														echo "</ul>";
													}

													?>

												</li>
											<?php
												}
											?>
										</ul>
									</div>
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
	$('#treeview').on('ready.jstree', function() {
	    $("#treeview").jstree("open_all");          
	});
	</script>