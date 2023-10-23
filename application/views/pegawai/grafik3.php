<div class="col-md-12" style="overflow-x:scroll">
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
					echo "<th colspan=5 style='font-size:8pt;'><center>" . $value . "</center></th>";
				}
				?>
			</tr>
			<tr>
				<?php 
                $isi = array();
                $jumlah_graf = array();
				foreach($jabatan_fungsional as $value){
				    foreach($agama as $value){
                        $jumlah_graf[$value] = "";
                        echo "<th style='font-size:7pt;' width=1>" . $value . "</th>";
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
                    foreach($agama as $religion){

                        $query = "select count(*) as jumlah from pegawai_biodata b 
                                inner join pegawai_jabatan_fungsional f on f.id_pegawai=b.id_pegawai
                                where agama='$religion' and jabatan_fungsional_sekarang='$value'";

                        $jumlah = $this->db->query($query)->row()->jumlah;
                        $jumlah_graf[$religion] .= $jumlah . ",";
                        echo "<td style='font-size:7pt;'>" . $jumlah . "</td>";
                         
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
<canvas id="barChart" width="400" height="200"></canvas>
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
            foreach($agama as $value){
        ?>
            {
                label: "<?php echo  $value?>",
                backgroundColor: '<?php echo  $warna[$i]?>',
                hoverBackgroundColor: '<?php echo  $warna[$i]?>',
                data: [<?php echo $jumlah_graf[$value]?>],
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