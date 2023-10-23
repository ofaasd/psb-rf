                        <div class="page-body">
                                        <div class="row">
                                            <!-- task, page, download counter  start -->
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-yellow update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white"><?php echo $jumlah_mhs?></h4>
                                                                <h6 class="text-white m-b-0">Mahasiswa</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="feather icon-user" style="font-size:23pt;"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">	
														<div class="row">
															<div class="col-6 border-right">
																<small>L : <?php echo $jumlah_mhs_laki ?></small>
															</div>
															<div class="col-6">
																<small>P : <?php echo $jumlah_mhs_perempuan ?></small>
															</div>
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white"><?php echo $jumlah_pegawai ?></h4>
                                                                <h6 class="text-white m-b-0">Jumlah Pegawai</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="feather icon-users" style="font-size:23pt;"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">	
														<div class="row">
															<div class="col-6 border-right">
																<small>L : <?php echo $jumlah_pegawai_laki ?></small>
															</div>
															<div class="col-6">
																<small>P : <?php echo $jumlah_pegawai_perempuan ?></small>
															</div>
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-pink update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white"><?php echo $matakuliah ?></h4>
                                                                <h6 class="text-white m-b-0">Mata Kuliah</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-3" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="row">
															<div class="col-6 border-right">
																<small>D3 Farmasi: <?php echo $matakuliah_d3 ?></small>
															</div>
															<div class="col-6">
																<small>S1 Farmasi : <?php echo $matakuliah_s1 ?></small>
															</div>
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-lite-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white"><?php echo $maba ?></h4>
                                                                <h6 class="text-white m-b-0">Mahasiswa Baru</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-4" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="row">
															<div class="col-6 border-right">
																<small>L: <?php echo $maba_laki ?></small>
															</div>
															<div class="col-6">
																<small>P : <?php echo $maba_perempuan ?></small>
															</div>
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- task, page, download counter  end -->

                                            <!--  sale analytics start -->
                                            <div class="col-xl-8 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Statistik PMB</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <canvas id="myChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-12">
                                                <div class="card user-activity-card">
                                                    <div class="card-header">
                                                        <h5>Saran dan Masukan</h5>
                                                    </div>
                                                    <div class="card-block">
														<?php foreach($masukan as $r_masukan){
															$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $r_masukan->email ) ) )
															?>
                                                        <div class="row m-b-25">
                                                            <div class="col-auto p-r-0">
                                                                <div class="u-img">
                                                                    <img src="<?php echo $grav_url?>" alt="user image" class="img-radius cover-img">
                                                                    <img src="<?php echo $grav_url?>" alt="user image" class="img-radius profile-img">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5"><?php echo $r_masukan->nama ?></h6>
                                                                <p class="text-muted m-b-0"><?php echo $r_masukan->saran?></p>
                                                                <p class="text-muted m-b-0"><i class="feather icon-clock m-r-10"></i><?php echo $r_masukan->tanggal?></p>
                                                            </div>
                                                        </div>
														<?php 
														}
														?>
                                                        <div class="text-center">
                                                            <a href="<?php echo base_url() . "master/masukan"; ?>" class="b-b-primary text-primary">Lihat Semua Masukan</a>
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