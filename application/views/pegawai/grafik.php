<div class="col-md-12">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th rowspan="3" valign="center"><center>Pendidikan</center></th>
				<th align="center" colspan="20"><center>Golongan</center></th>
			</tr>
			<tr>
				<?php 
				foreach($jabatan_fungsional as $value){
					echo "<th colspan=5>" . $value . "</th>";
				}
				?>
			</tr>
			<tr>
				<?php 
				foreach($jabatan_fungsional as $value){
					foreach($posisi as $row){
						echo "<th>" . $row->kode . "</th>";
					}
				}
				?>
			</tr>
		</thead>
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
        labels: [0, 1, 2, 3, 4, 5, 6, 7],
        datasets: [{
            label: "My First dataset",
            backgroundColor: [
                'rgba(95, 190, 170, 0.99)',
                'rgba(95, 190, 170, 0.99)',
                'rgba(95, 190, 170, 0.99)',
                'rgba(95, 190, 170, 0.99)',
                'rgba(95, 190, 170, 0.99)',
                'rgba(95, 190, 170, 0.99)',
                'rgba(95, 190, 170, 0.99)'
            ],
            hoverBackgroundColor: [
                'rgba(26, 188, 156, 0.88)',
                'rgba(26, 188, 156, 0.88)',
                'rgba(26, 188, 156, 0.88)',
                'rgba(26, 188, 156, 0.88)',
                'rgba(26, 188, 156, 0.88)',
                'rgba(26, 188, 156, 0.88)',
                'rgba(26, 188, 156, 0.88)'
            ],
            data: [65, 59, 80, 81, 56, 55, 50],
        }, {
            label: "My second dataset",
            backgroundColor: [
                'rgba(93, 156, 236, 0.93)',
                'rgba(93, 156, 236, 0.93)',
                'rgba(93, 156, 236, 0.93)',
                'rgba(93, 156, 236, 0.93)',
                'rgba(93, 156, 236, 0.93)',
                'rgba(93, 156, 236, 0.93)',
                'rgba(93, 156, 236, 0.93)'
            ],
            hoverBackgroundColor: [
                'rgba(103, 162, 237, 0.82)',
                'rgba(103, 162, 237, 0.82)',
                'rgba(103, 162, 237, 0.82)',
                'rgba(103, 162, 237, 0.82)',
                'rgba(103, 162, 237, 0.82)',
                'rgba(103, 162, 237, 0.82)',
                'rgba(103, 162, 237, 0.82)'
            ],
            data: [60, 69, 85, 91, 58, 50, 45],
        }]
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