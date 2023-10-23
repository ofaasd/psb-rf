                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Statistik Penerimaan Mahasiswa Baru</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <div style="width: 800px;margin: 0px auto;">
                                                          <canvas id="myChart"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
<script type="text/javascript">
  var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["2020", "2021", "2022", "2023", "2024", "2025"],
        datasets: [{
          label: '',
          data: [
          <?php 
          $jumlah_2020 = $this->db->query("SELECT count(angkatan) as angkatan FROM pmb_peserta WHERE angkatan = 2020")->row();
          echo $jumlah_2020->angkatan;
          ?>, 
          <?php 
          $jumlah_2021 = $this->db->query("SELECT count(angkatan) as angkatan FROM pmb_peserta WHERE angkatan = 2021")->row();
          echo $jumlah_2021->angkatan;
          ?>, 
          <?php 
          $jumlah_2022 = $this->db->query("SELECT count(angkatan) as angkatan FROM pmb_peserta WHERE angkatan = 2022")->row();
          echo $jumlah_2022->angkatan;
          ?>, 
          <?php 
          $jumlah_2023 = $this->db->query("SELECT count(angkatan) as angkatan FROM pmb_peserta WHERE angkatan = 2023")->row();
          echo $jumlah_2023->angkatan;
          ?>, 
          <?php 
          $jumlah_2024 = $this->db->query("SELECT count(angkatan) as angkatan FROM pmb_peserta WHERE angkatan = 2024")->row();
          echo $jumlah_2024->angkatan;
          ?>, 
          <?php 
          $jumlah_2025 = $this->db->query("SELECT count(angkatan) as angkatan FROM pmb_peserta WHERE angkatan = 2025")->row();
          echo $jumlah_2025->angkatan;
          ?>
          ],
          backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(75, 192, 192, 0.2)'
          ],
          borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });
</script>