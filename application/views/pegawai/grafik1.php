<div class="col-md-12">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th rowspan="3" valign="center"><center>Unit</center></th>
				<th align="center" colspan="20"><center>Golongan</center></th>
			</tr>
			<tr>
				<?php 
                $jabatan = "";
				foreach($jabatan_fungsional as $value){
                    $jabatan .= "'" . $value . "',";
					echo "<th colspan=5>" . $value . "</th>";
				}
				?>
			</tr>
			<tr>
				<?php 
                $isi = array();
				foreach($jabatan_fungsional as $value){
					foreach($posisi as $row){
                        $isi[$row->kode] = "";
						echo "<th>" . $row->kode . "</th>";
					}
				}
				?>
			</tr>
		</thead>
        <tbody>
            <tr>
                <td><?php echo $unit_result?></td>
            <?php 
                
                $warna = array('rgba(52, 152, 219,1.0)','rgba(46, 204, 113,1.0)','rgba(155, 89, 182,1.0)','rgba(230, 126, 34,1.0)','rgba(231, 76, 60,1.0)');
                foreach($jabatan_fungsional as $key=>$value){
                    
                    foreach($posisi as $row){

                        //echo "<th>" . $row->kode . "</th>";
                        $kueri = "select count(*) as jumlah from pegawai_biodata b 
                                    inner join pegawai_jabatan_fungsional f on f.id_pegawai=b.id_pegawai 
                                    inner join pegawai_posisi p on p.kode=b.kd_posisi_pegawai
                                    where status_pegawai='aktif' and f.status=1 and jabatan_fungsional_sekarang='$value' and kd_posisi_pegawai='$row->kode'";
                        $jumlah = $this->db->query($kueri)->row()->jumlah;
                        echo "<td>" . $jumlah . "</td>";
                        $isi[$row->kode] .= $jumlah . ",";
                    }
                }
            ?>
            </tr>
        </tbody>    
	</table>
</div>	
<div class="col-md-12 col-lg-12">
<div class="card">
<div class="card-header">
<h5></h5>
<span></span>
</div>
<div class="card-block">
<canvas id="barChart" width="400" height="400"></canvas>
</div>
</div>
</div>

<script>
	$(document).ready(function(){
	var data1 = {
        labels: [<?php echo $jabatan?>],
        datasets: [
        <?php
        $i = 0;
        foreach($posisi as $row){
        ?>
        {
            label: "<?php echo $row->kode?>",
            backgroundColor: '<?php echo $warna[$i]?>',
            hoverBackgroundColor: '<?php echo $warna[$i]?>',
            data: [<?php echo $isi[$row->kode]?>],
        }, 
        <?php
        $i++;
        }
        ?>
        ]
    };

    var bar = document.getElementById("barChart").getContext('2d');
    var myBarChart = new Chart(bar, {
        type: 'bar',
        data: data1,
        options: {
            barValueSpacing: 20
        }
    });	
	});
	
</script>