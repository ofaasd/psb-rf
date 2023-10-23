<?php
	$array = array("Home","Profile","Riwayat Pendidikan","Riwayat Jabatan Fungsional","Riwayat Jabatan Struktural","Riwayat Organisasi","Riwayat Mengajar","Riwayat Pekerjaan","Riwayat Penelitian","Riwayat Pengabdian","Riwayat Karya Ilmiah","Berkas Pendukung");
	//$array2 = array("Home","Riwayat Berkas","Riwayat Karya Ilmiah","Riwayat Penelitian","Riwayat Seminar","Pengalaman Pekerjaan","Riwayat Pendidikan","Riwayat Penghargaan",""Riwayat Keluarga","Riwayat Medical","Riwayat Jab Struktur"al","Riwayat Jab Fungsional","Riwayat Gol. Lokal","Riwayat Gol. Kopertis","Riwayat Hukuman Disiplin","Riwayat DP3","Riwayat Kompetensi","Riwayat KUM");
?>
<div class="card">
	<div class="card-header">
		<p><b>Riwayat-riwayat</b></p>
	</div>	
	<div class="card-block tree-view">
		<div id="basicTree" class="jstree jstree-1 jstree-default" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="j1_6" aria-busy="false">
			<ul >
				
					<li data-jstree='{"opened":true}'>Manajemen Data Pegawai
						<?php
						
						
							echo "<ul>";
							foreach($array as $submenu){
								echo "<li data-jstree='{\"type\":\"file\"}' onclick='tree(\"" . preg_replace('/\s+/', '', $submenu) ."\")'>" . $submenu . "</li>";
							}
							echo "</ul>";
						

						?>

					</li>
				
			</ul>
		</div>
	</div>
</div>
<script>
	function tree(url){
		if(url == "Home"){
			document.location.href = "<?php echo  base_url()?>simpeg/manage";
		}else if(url == "Profile"){
			document.location.href = "<?php echo  base_url()?>simpeg/manage/profil/<?php echo $_SESSION['npp']?>";
		}else{
	        $.ajax({
	            url : "<?php echo  base_url()?>simpeg/"+url,
	            method : "GET",
	            success: function(data){
	                $(".target_ajax").html(data);
	                //$("#myInput").val("<?php echo  $this->uri->segment('4')?>");
	            }
	        });
        }
    };
</script>