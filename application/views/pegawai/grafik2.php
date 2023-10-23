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
					echo "<th colspan=2><center>" . $value . "</center></th>";
				}
				?>
			</tr>
			<tr>
				<?php 
                $isi = array();
				foreach($jabatan_fungsional as $value){
					echo "<th>Laki-Laki</th>";
                    echo "<th>Perempuan</th>";
				}
				?>
			</tr>
		</thead>
        <tbody>
            <tr>
                <td><?php echo $unit_result?></td>
            <?php 
                
                $warna = array('rgba(52, 152, 219,1.0)','rgba(46, 204, 113,1.0)','rgba(155, 89, 182,1.0)','rgba(230, 126, 34,1.0)','rgba(231, 76, 60,1.0)');
                $jumlah_grafl = "";
                $jumlah_grafp = "";
                foreach($jabatan_fungsional as $key=>$value){
                    $query = "select count(*) as jumlah from pegawai_biodata b 
                                inner join pegawai_jabatan_fungsional f on f.id_pegawai=b.id_pegawai
                                where jenis_kelamin='L' and jabatan_fungsional_sekarang='$value'";
                    $jumlahl = $this->db->query($query)->row()->jumlah;
                    $jumlah_grafl .= $jumlahl . ",";
                    echo "<td>" . $jumlahl . "</td>";
                     $query = "select count(*) as jumlah from pegawai_biodata b 
                                inner join pegawai_jabatan_fungsional f on f.id_pegawai=b.id_pegawai
                                where jenis_kelamin='P' and jabatan_fungsional_sekarang='$value'";
                    $jumlahp = $this->db->query($query)->row()->jumlah;
                    echo "<td>" . $jumlahp . "</td>";
                    $jumlah_grafp .= $jumlahp . ",";
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
<canvas id="barChart" width="400" height="200"></canvas>
</div>
</div>
</div>

<script>
	$(document).ready(function(){
	var data1 = {
        labels: [<?php echo $jabatan?>],
        datasets: [
        
        {
            label: "Laki-Laki",
            backgroundColor: 'rgba(52, 152, 219,1.0)',
            hoverBackgroundColor: 'rgba(52, 152, 219,1.0)',
            data: [<?php echo $jumlah_grafl?>],
        }, 
        {
            label: "Perempuan",
            backgroundColor: 'rgba(231, 76, 60,1.0)',
            hoverBackgroundColor: 'rgba(231, 76, 60,1.0)',
            data: [<?php echo $jumlah_grafp?>],
        }, 
        
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