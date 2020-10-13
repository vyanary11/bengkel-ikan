<?php 
	if ($_SESSION['loginuser']) {
		?>
		<meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/">  
		<?php
	}
?>
<div class="row mt-5 mb-3">
	<div class="col-lg-12">
		<nav aria-label="breadcrumb" role="navigation">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
		    <li class="breadcrumb-item"><a href="#">Akun</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Masuk</li>
		  </ol>
		</nav>
	</div>
</div>
<div class="row mb-5 justify-content-md-center">
	<div class="col-lg-6">
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
				<h2 class="text-center font-weight-bold mb-3">Masuk Bengkel Ikan</h2>
				<p class="mb-4 text-center text-muted">Belum punya akun Bengkel Ikan? Daftar <a href="<?php echo $base_url; ?>/daftar" >di sini</a></p>
				<form method="post" action="<?php echo $base_url; ?>/bin/masuk.php">
				  	<div class="form-group row">
				    	<div class="col-sm-12">
				    		<div class="input-group">
	  							<span class="input-group-addon fa fa-envelope"></span>
					      		<input type="email" class="form-control" name="email" placeholder="Email">
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
				    	<div class="col-sm-4">
				    		<a href="<?php echo $base_url; ?>/lupa-password">Lupa Password ?</a>
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