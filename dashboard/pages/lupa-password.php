<?php 
	if ($_SESSION['loginuser']) {
		?>
		<meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/">  
		<?php
	}
?>
<style type="text/css">
	body{
		background-color: #eee;
	}
</style>
<div class="row my-5 justify-content-md-center">
	<div class="col-lg-7">
		<?php if ($_GET[msg]=="emailtidakterdaftar") { ?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
			<h3>Email Tidak Terdaftar !</h3>
			Email anda belum terdaftar di Bengkel Ikan.
		</div>
		<?php } ?>
		<div class="card">
			<div class="card-body">
				<h3 class="text-center font-weight-bold mb-3">Kesulitan mengakses akun Anda?</h3>
				<p class="mb-4 text-center text-muted">Lupa password? Masukkan email akun Anda di bawah ini. Kami akan mengirimkan pesan email beserta tautan untuk reset password Anda.</p>
				<form method="post" action="<?php echo $base_url; ?>/dashboard/bin/lupa_password.php">
				  	<div class="form-group row">
				    	<div class="col-sm-12">
				    		<div class="input-group">
				    			<span class="input-group-addon fa fa-envelope"></span>
				      			<input type="email" class="form-control" name="email" placeholder="Email">
				      		</div>
				    	</div>
				  	</div>
					<div class="form-group row mt-5">
				    	<div class="col-sm-12">
				      		<button type="submit" name="kirim" class="form-control btn btn-primary">Kirim</button>
				    	</div>
				  	</div>
				</form>	
			</div>
		</div>
	</div>
</div>