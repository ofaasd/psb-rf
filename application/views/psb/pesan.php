<div class="page-body">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4>Daftar Santri PSB</h4>
				</div>
				<div class="card-body">

				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		
		if(localStorage.getItem('msg')){
			$(".card-body").prepend("<div class='alert bg-primary text-light'>"+ localStorage.getItem('msg') +"</div>")
			localStorage.removeItem("msg");

		}
	})
</script>
