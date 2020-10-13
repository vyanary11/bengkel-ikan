<style type="text/css">
	body{
		background-color: #eee;
	}
</style>
<div class="container-fluid">
	<div class="row justify-content-center <?php if(isset($_GET[msg])){ echo "my-5"; }else{ ?> " style="<?php echo "margin-top:120px"; } ?>">
		<div class="col-lg-4">
			<?php if ($_GET[msg]=="berhasildaftar") { ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				</button>
				<h3>Terima Kasih Telah Mendaftar</h3>
				Sebuah email untuk mengaktifkan akun anda telah dikirim ke alamat email Anda. Harap periksa juga folder Spam email Anda.
			</div>
			<?php }elseif ($_GET[msg]=="gagalmasuk") { ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				</button>
				<h3>Gagal Masuk</h3>
				Email dan password anda tidak valid atau anda belum melakukan aktivasi akun !
			</div>
			<?php }elseif ($_GET[msg]=="aktivasiberhasil") { ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				</button>
				<h3>Aktivasi Akun Berhasil</h3>
				Silahkan Login !
			</div>
			<?php } elseif ($_GET[msg]=="resetpasswordberhasil") { ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				</button>
				<h3>Reset Password Berhasil</h3>
				Silahkan Login !
			</div>
			<?php } elseif ($_GET[msg]=="koderesetpasswordterkirim") { ?>
			<div class="alert alert-info alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				</button>
				<h3>Kode Reset Password Terkirim</h3>
				Sebuah email yang berisi petunjuk untuk membuat password baru telah dikirim ke alamat email Anda. Harap periksa juga folder Spam email Anda.
			</div>
			<?php } ?>
			<div class="card">
				<div class="card-body">
					<h2 class="text-center font-weight-bold mb-3">Masuk Dashboard Bengkel Ikan</h2>
					<p class="mb-4 text-center text-muted">Menjadi Seller Bengkel Ikan Klik <a href="<?php echo $base_url; ?>/dashboard/daftar-seller" >di sini</a></p>
					<form method="post" action="<?php echo $base_url; ?>/dashboard/bin/masuk.php">
					  	<div class="form-group row">
					    	<div class="col-sm-12">
					    		<div class="input-group">
		  							<span class="input-group-addon fa fa-envelope"></span>
						      		<input type="text" class="form-control" name="email" placeholder="Email">
						      	</div>
					    	</div>
					  	</div>
					  	<div class="form-group row">
					    	<div class="col-sm-12">
					    		<div class="input-group">
		  							<span class="input-group-addon fa fa-key"></span>
					      			<input type="password" class="form-control" name="password" placeholder="Password">
					      		</div>
					    	</div>
					  	</div>
					  	<div class="form-group row justify-content-end">
					    	<div class="col-sm-5">
					    		<a href="<?php echo $base_url ?>/dashboard/lupa-password">Lupa Password ?</a>
					    	</div>
						</div>
						<div class="form-group row">
					    	<div class="col-sm-12">
					      		<button type="submit" name="masuk" class="form-control btn btn-primary">Masuk</button>
					    	</div>
					  	</div>
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>