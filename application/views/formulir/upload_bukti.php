                    <style>
                            * {
                              box-sizing: border-box;
                            }

                            body {
                              background-color: #f1f1f1;
                            }

                            #regForm {
                              background-color: #ffffff;
                              margin-left: 10px;
                              font-family: Raleway;
                              padding: 40px;
                              width: 100%;
                              min-width: 300px;
                            }

                            h1 {
                              text-align: center;  
                            }

                            input {
                              padding: 10px;
                              width: 100%;
                              font-size: 17px;
                              font-family: Raleway;
                              border: 1px solid #aaaaaa;
                            }

                            /* Mark input boxes that gets an error on validation: */
                            input.invalid {
                              background-color: #ffdddd;
                            }

                            /* Hide all steps by default: */
                            .tab {
                              display: none;
                            }

                            button {
                              background-color: #4CAF50;
                              color: #ffffff;
                              border: none;
                              padding: 10px 20px;
                              font-size: 17px;
                              font-family: Raleway;
                              cursor: pointer;
                            }

                            button:hover {
                              opacity: 0.8;
                            }

                            #prevBtn {
                              background-color: #bbbbbb;
                            }

                            /* Make circles that indicate the steps of the form: */
                            .step {
                              height: 15px;
                              width: 15px;
                              margin: 0 2px;
                              background-color: #bbbbbb;
                              border: none;  
                              border-radius: 50%;
                              display: inline-block;
                              opacity: 0.5;
                            }

                            .step.active {
                              opacity: 1;
                            }

                            /* Mark the steps that are finished and valid: */
                            .step.finish {
                              background-color: #4CAF50;
                            }
                            </style>

<div class="page-body">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<?php echo $this->session->userdata('status_update'); 
								$this->session->set_userdata('status_update', ''); ?>
					<h5>FORM BUKTI PEMBAYARAN CALON MAHASISWA BARU</h5>
				</div>
				<div class="card-block">
				<h4 class="sub-title">BUKTI PEMBAYARAN CALON MAHASISWA</h4>
				<h5>Info dan Ketentuan Pembayaran</h5>
				<ol start=1>
					<li>Biaya Registrasi Pendaftaran Mahasiswa Baru Sebesar Rp. 200.0000</li>
					<li>
						Uang Pendaftaran dapat di transferkan melalui rekening kami yaitu <br />
						<?php foreach($rekening as $row){
							echo "<b>" . $row->nama_bank . " : " . $row->norek . " (AN. " . $row->atas_nama . ")</b>";
							break;
						}
						?>
					</li>
					<li>Setelah melakukan transfer harap menghubungi Admin PMB (082243333409)</li>
				</ol>
				<hr>
				 <!--<form id="" action="<?php echo base_url()?>formulir/cmhs_tambah_bukti" method="post" enctype="multipart/form-data">
					  <!-- One "tab" for each step in the form: 
						<div class="row">
							<div class="col-sm-6">
								<input type="hidden" name="nopen" value="<?php echo $nopen ?>">
								No Rekening Pengirim :
								<p><input type="text" class="form-control" placeholder="Nomor Rekening" oninput="this.className = ''" name="norek" required=""></p>
								Atas Nama Rekening Pengirim :
								<p><input type="text" class="form-control" placeholder="Atas Nama" oninput="this.className = ''" name="an_rekening" required=""></p>
								Tanggal Transfer :
								<p><input type="date" class="form-control" placeholder="Tanggal Transfer" oninput="this.className = ''" name="tgl_tf" required=""></p>
								Rekening Tujuan :
								<p>
									<select name="id_rekening" class="form-control" oninput="this.className = ''" required="">
										<?php foreach($rekening as $row){
											echo "<option value='" . $row->id . "'>" . $row->nama_bank . " : " . $row->norek . " (AN. " . $row->atas_nama . ")</option>";
										}
										?>
									</select>
								</p>
								Bukti Transfer :
								<p><input type="file" class="form-control" placeholder="Bukti Pembayaran" oninput="this.className = ''" name="bukti" required=""> <small>* Max 1MB </small></p>
								
							</div>
							<div class="col-sm-6">
								
							</div>
							<div class="col-sm-12">
								<input type="submit" value="simpan" class="btn btn-primary">
							</div>
						</div>
					</form>-->
			  </div>
			 </div>
			</div>
		  </div>
		</div>
	</div>
</div>
<script type="text/javascript">
</script>