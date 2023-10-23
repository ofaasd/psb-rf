<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
<h4>User Profile</h4>
<!-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> -->
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.html"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a href="#!">User Profile</a>
</li>
<li class="breadcrumb-item"><a href="#!">User Profile</a>
</li>
</ul>
</div>
</div>
</div>
</div>

<div class="page-body">

<div class="row">
<div class="col-lg-12">
<div class="cover-profile">
<div class="profile-bg-img">
<img class="profile-bg-img img-fluid" src="<?php echo base_url('assets/foto_pegawai/background.jpg')?>" alt="bg-img">
<div class="card-block user-info">
<div class="col-md-12">
<div class="media-left" width=30%>
<a href="#" class="profile-image">
<img class="user-img img-radius" src="<?php echo base_url('assets/foto_pegawai/'.$biodata->foto)?>" alt="user-img">
</a>
</div>
<div class="media-body row">
<div class="col-lg-12">
<div class="user-title">
<h2><?php echo $biodata->nama_lengkap;?></h2>
<span class="text-white"><?php echo $posisi->nama?>
</span>
</div>
</div>
<div>
<div class="pull-right cover-btn">
<button type="button" class="btn btn-primary m-r-10 m-b-5"><i class="icofont icofont-plus"></i> Follow</button>
<button type="button" class="btn btn-primary"><i class="icofont icofont-ui-messaging"></i> Message</button>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-12">

<div class="tab-content">

<div class="tab-pane active" id="personal" role="tabpanel">

<div class="card">
<div class="card-header">
<h5 class="card-header-text">About Me</h5>
<button id="toggle" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
<i class="icofont icofont-edit"></i>
</button>
</div>
<div class="card-block">
<!-- toggle -->
<div class="view-info" style="">
<div class="row">
<div class="col-lg-12">
<div class="general-info">
<div class="row">
<div class="col-lg-12 col-xl-6">
<div class="table-responsive">
<table class="table m-0">
<tbody>
<tr>
<th scope="row">Nama Lengkap</th>
 <td><?php echo $biodata->gelar_depan." "
               .$biodata->nama_lengkap." "
               .$biodata->gelar_belakang;?></td>
</tr>
<tr>
<th scope="row">NPP</th>
<td><?php echo isset($biodata->npp)? $biodata->npp : "-";?></td>
</tr>
<tr>
<th scope="row">NIP PNS</th>
<td><a href="#!"><?php echo isset($biodata->nip_pns)? $biodata->nip_pns : "-";?></a></td>
</tr>
<tr>
<th scope="row">Progdi</th>
<td><?php echo $prodi->jenjang." "
         .$prodi->nama_jurusan?></td>
</tr>
<tr>
<th scope="row">NIDN</th>
<td><?php echo isset($biodata->nidn)? $biodata->nidn : "-";?></td>
</tr>
<tr>
<th scope="row">Status</th>
<td><?php echo $biodata->status_pegawai;?></td>
</tr>
<tr>
<th scope="row">TTL</th>
<td><?php echo $biodata->tempat_lahir.", ".$biodata->tanggal_lahir;?></td>
</tr>
<tr>
<th scope="row">Jenis Kelamin</th>
<td><?php echo isset($biodata->jenis_kelamin)&&($biodata->jenis_kelamin=='P')? 
               "Wanita" : "Pria";?></td>
</tr>
<tr>
<th scope="row">Email</th>
<td><?php echo $biodata->email1." / ".$biodata->email2;?></td>
</tr>
<tr>
<th scope="row">No.HP</th>
<td><?php echo $biodata->notelp." / ".$biodata->nohp;?></td>
</tr>
<tr>
<th scope="row">Blog</th>
<td><a href="#!"><?php echo isset($biodata->blog)? $biodata->blog : "-";?></a></td>
</tr>
<tr>
<th scope="row">Citation</th>
<td><a href="#!"><?php echo isset($biodata->citation)? $biodata->citation : "-";?></a></td>
</tr>
</tbody>
</table>
</div>
</div>

<div class="col-lg-12 col-xl-6">
<div class="table-responsive">
<table class="table">
<tbody>
<tr>
<th scope="row">Agama</th>
<td><a href="#!"><?php echo $biodata->agama; ?></a></td>
</tr>
<tr>
<th scope="row">No.KTP</th>
<td><?php echo $biodata->no_ktp; ?></td>
</tr>
<tr>
<th scope="row">No.KK</th>
<td><?php echo $biodata->no_kk; ?></td>
</tr>
<tr>
<th scope="row">Alamat</th>
<td><?php echo $biodata->alamat; ?></td>
</tr>

<tr>
<th scope="row">Nama Pasangan</th>
<td><?php echo isset($biodata->nama_pasangan)? $biodata->nama_pasangan : "-";?></td>
</tr>
<tr>
<th scope="row">Tanggal Lahir Pasangan</th>
<td><?php echo isset($biodata->tgl_lahir_pasangan)? $biodata->tgl_lahir_pasangan : "-";?></td>
</tr>
<tr>
<th scope="row">Jumlah Anak</th>
<td><a href="#!"><?php echo isset($biodata->jumlah_anak)? $biodata->jumlah_anak : "-";?></a></td>
</tr>
<tr>
<th scope="row">Pekerjaan Pasangan</th>
<td><a href="#!"><?php echo isset($biodata->pekerjaan_pasangan)? $biodata->pekerjaan_pasangan : "-";?></a></td>
</tr>
<tr>
<th scope="row">KTP</th>
<td><a href="#!"><?php echo isset($biodata->ktp)? $biodata->ktp : "-";?></a></td>
</tr>
<tr>
<th scope="row">No. BPJS Kesehatan</th>
<td><a href="#!"><?php echo isset($biodata->no_bpjs_kesehatan)? $biodata->no_bpjs_kesehatan : "-";?></a></td>
</tr>
<tr>
<th scope="row">No. BPJS Ketenagakerjaan</th>
<td><a href="#!"><?php echo isset($biodata->no_bpjs_ketenagakerjaan)? $biodata->no_bpjs_ketenagakerjaan : "-";?></a></td>
</tr>
</tbody>
</table>
</div>
</div>

</div>

</div>

</div>

</div>

</div>

<!-- toggle -->
<div class="edit-info" style=""> 
<div class="row">
<div class="col-lg-12">
<div class="general-info">
<div class="row">
<div class="col-lg-6">
<table class="table">
<tbody>
<tr>
<td>
<div class="input-group">
<span class="input-group-addon"><i class="icofont icofont-user"></i></span>
<input type="text" class="form-control" placeholder="Full Name">
</div>
</td>
</tr>
<tr>
<td>
<div class="form-radio">
<div class="group-add-on">
<div class="radio radiofill radio-inline">
<label>
<input type="radio" name="radio" checked=""><i class="helper"></i> Male
</label>
</div>
<div class="radio radiofill radio-inline">
<label>
<input type="radio" name="radio"><i class="helper"></i> Female
</label>
</div>
</div>
</div>
</td>
</tr>
<tr>
<td>
<input id="dropper-default" class="form-control" type="text" placeholder="Select Your Birth Date">
</td>
</tr>
<tr>
<td>
<select id="hello-single" class="form-control">
<option value="">---- Marital Status ----</option>
<option value="married">Married</option>
 <option value="unmarried">Unmarried</option>
</select>
</td>
</tr>
<tr>
<td>
<div class="input-group">
<span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
<input type="text" class="form-control" placeholder="Address">
</div>
</td>
</tr>
</tbody>
</table>
</div>

<div class="col-lg-6">
<table class="table">
<tbody>
<tr>
<td>
<div class="input-group">
<span class="input-group-addon"><i class="icofont icofont-mobile-phone"></i></span>
<input type="text" class="form-control" placeholder="Mobile Number">
</div>
</td>
</tr>
<tr>
<td>
<div class="input-group">
<span class="input-group-addon"><i class="icofont icofont-social-twitter"></i></span>
<input type="text" class="form-control" placeholder="Twitter Id">
</div>
</td>
 </tr>

<tr>
<td>
<div class="input-group">
<span class="input-group-addon"><i class="icofont icofont-social-skype"></i></span>
<input type="email" class="form-control" placeholder="Skype Id">
</div>
</td>
</tr>
<tr>
<td>
<div class="input-group">
<span class="input-group-addon"><i class="icofont icofont-earth"></i></span>
<input type="text" class="form-control" placeholder="website">
</div>
</td>
</tr>
</tbody>
</table>
</div>

</div>

<div class="text-center">
<a href="#!" class="btn btn-primary waves-effect waves-light m-r-20">Save</a>
<button id="toggle" class="btn btn-default waves-effect">Cancel</button>
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
</div>
 </div>
 <script>
 $(function(){
  $('div.edit-info').hide();// hide it initially
  $('button#toggle').on('click', function(){
     $('div.view-info, div.edit-info').toggle();
  });
});
 </script>
 