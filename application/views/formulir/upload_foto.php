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
					<h5>UPLOAD FOTO CALON MAHASISWA BARU</h5>
				</div>
				<div class="card-block">
					<div class="row">
					  <div class="col-sm-6">
						<form method="POST" action="<?php echo base_url()?>formulir/cmhs_upload_foto" enctype="multipart/form-data">
						  <input type="hidden" name="nopen" value="<?php echo $nopen ?>">
						  Upload Foto :
						  <p><input type='file' name="foto" onchange="readURL(this);" />
							Maksimal 1 MB dengan background merah.</p>
							<?php
								if(!empty($pmb_peserta->foto_peserta)){
							?>
									<img id="blah" src="<?php echo base_url() ?>assets/foto_pmb_peserta/<?php echo $pmb_peserta->foto_peserta ?>" alt="your image" style="width:225px;height:280px;" />
							<?php
								}
							?>
							<br><br><br>
							<input type="submit" class="btn btn-primary">
						  </form>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>