<style type="text/css">
	body{
		background-color: #eee;
	}
</style>
<div class="container-fluid">
	<div class="row my-5 justify-content-md-center">
		<div class="col-lg-6">
			<?php if ($_GET[msg]=="emailsudahada") { ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				</button>
				<h3>Email Sudah Ada</h3>
				Email yang anda gunakan sudah digunakan oleh akun lain !
			</div>
			<?php } ?>
			<div class="card">
				<div class="card-body">
					<h2 class="text-center font-weight-bold mb-3">Menjadi Seller Di Bengkel Ikan</h2>
					<p class="mb-4 text-center text-muted">Sudah punya akun Seller Bengkel Ikan ? Masuk <a href="<?php echo $base_url; ?>/dashboard/masuk" >di sini</a></p>
					<form method="post" action="<?php echo $base_url; ?>/dashboard/bin/daftar-seller.php">
						<div class="form-group row">
					    	<div class="col-sm-12">
					    		<div class="input-group">
		  							<span class="input-group-addon fa fa-address-book"></span>
					      			<input required type="text" class="form-control" name="nama" placeholder="Nama Kios">
					      		</div>
					    	</div>
					  	</div>
					  	<div class="form-group row">
					    	<div class="col-sm-12">
					    		<div class="input-group">
					    			<span class="input-group-addon fa fa-phone-square"></span>
					    			<input required type="text" class="form-control" name="telp" placeholder="Nomor Telepon">
					    		</div>
					    	</div>
					  	</div>
					  	<div class="form-group row">
					    	<div class="col-sm-12">
					    		<div class="input-group">
					    			<span class="input-group-addon fa fa-envelope"></span>
					      			<input required type="email" class="form-control" name="email" placeholder="Email">
					      		</div>
					    	</div>
					  	</div>
					  	<div class="form-group row">
					    	<div class="col-sm-12">
					    		<div class="input-group">
					    			<span class="input-group-addon fa fa-key"></span>
					      			<input required type="password" class="form-control" name="password" placeholder="Password">
					      		</div>
					    	</div>
					  	</div>
						<div class="form-group row mt-5">
					    	<div class="col-sm-12">
					      		<button type="submit" name="daftar" class="form-control btn btn-primary">Daftar Akun</button>
					      		<p class="text-muted text-center mt-3">Dengan menekan Daftar Akun, saya mengkonfirmasi telah menyetujui Syarat dan Ketentuan, serta Kebijakan Privasi Bengkel Ikan.</p>
					    	</div>
					  	</div>
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>