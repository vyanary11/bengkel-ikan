<?php 
	if ($_SESSION['loginuser']) {
		?>
		<meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/">  
		<?php
	}
	$sqlcek=mysqli_query($conn, "SELECT * FROM user WHERE kd_user='$_GET[kd_user]' and kode_reset_password='$_GET[kode_reset_password]'");
?>
<div class="row mt-5 mb-3">
	<div class="col-lg-12">
		<nav aria-label="breadcrumb" role="navigation">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
		    <li class="breadcrumb-item"><a href="#">Akun</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
		  </ol>
		</nav>
	</div>
</div>
<div class="row mb-5 justify-content-md-center">
	<?php if (mysqli_num_rows($sqlcek)<1) { ?>
	<div class="col-lg-10">
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
			<h3>Kode reset password tidak benar atau sudah kadaluwarsa</h3>
			Silakan periksa email Anda lagi dan ikuti petunjuk di dalamnya.
		</div>
	</div>
	<?php }else{ ?>
	<div class="col-lg-5">
		<div class="card">
			<div class="card-body">
				<h3 class="text-center font-weight-bold mb-3">Masukkan Password Baru</h3>
				<form method="post" action="<?php echo $base_url; ?>/bin/reset_password.php?kd_user=<?php echo $_GET['kd_user']; ?>&kode_reset_password=<?php echo $_GET['kode_reset_password']; ?>">
				  	<div class="form-group row">
				    	<div class="col-sm-12">
				    		<div class="input-group">
				    			<span class="input-group-addon fa fa-key"></span>
				      			<input type="password" class="form-control" name="password_baru" placeholder="Masukkan Password Baru">
				      		</div>
				    	</div>
				  	</div>
					<div class="form-group row mt-5">
				    	<div class="col-sm-12">
				      		<button type="submit" name="ganti" class="form-control btn btn-primary">Ganti Password</button>
				    	</div>
				  	</div>
				</form>	
			</div>
		</div>
	</div>	
	<?php } ?>
</div>