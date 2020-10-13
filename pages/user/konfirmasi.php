<?php 
	$msg=ucwords(str_replace("-", " ", $_GET[msg]));
	if (isset($_GET[msg])) {
	  if (preg_match('/berhasil/', $_GET[msg])) {
	    ?>
	      <div class="alert alert-success alert-dismissible fade show" role="alert">
	        <strong><span class="fa fa-check-circle"></span> Berhasil</strong> <?php echo ucwords(str_replace("Berhasil", "", $msg)); ?>.
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	    <?php
	  }else{
	    ?>
	      <div class="alert alert-danger alert-dismissible fade show" role="alert">
	        <strong><span class="fa fa-times-circle"></span> Gagal</strong> <?php echo ucwords(str_replace("Gagal", "", $msg)); ?>.
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	    <?php
	  }
	}
?>
<h3 class="mt-3">Konfirmasi Pembayaran</h3>
<div class="card mt-4">
	<div class="card-body">
		<form action="<?php echo $base_url ?>/bin/konfirmasi.php" method="post" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="col-form-label col-lg-4" for="kode_order">Kode Order / No Invoice*</label>
				<div class="col-lg-8">
					<div class="input-group">
						<span class="input-group-addon">#</span>
						<input type="text" required class="form-control" name="kode_order" id="kode_order" placeholder="Kode Order / No Invoice ">
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-form-label col-lg-4" for="nama">Bank*</label>
				<div class="col-lg-8">
					<select class="select2 form-control" name="bank" required id="select2" style="width: 100%">
						<option value="">--Pilih Bank--</option>
						<option value="madiri">Mandiri</option>
						<option value="bni">BNI</option>
						<option value="bca">BCA</option>
						<option value="bri">BRI</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-form-label col-lg-4" for="nama">Atas Nama*</label>
				<div class="col-lg-8">
					<input type="text" required class="form-control" name="nama" id="nama" placeholder="Atas Nama">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-form-label col-lg-4" for="jumlah">Jumlah Transfer*</label>
				<div class="col-lg-8">
					<div class="input-group">
						<span class="input-group-addon">Rp. </span>
						<input type="number" required class="form-control text-right" name="jumlah" id="jumlah" placeholder="Jumlah Transfer">
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-form-label col-lg-4" for="tgl_transfer">Tanggal Transfer*</label>
				<div class="col-lg-8">
					<input type="datetime-local" required class="form-control" name="tgl_transfer" id="tgl_transfer" placeholder="Tanggal Transfer">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-form-label col-lg-4" for="kode_order">Bukti Pembayaran*</label>
				<div class="col-lg-8">
					<div class="row">
			      		<div class="col-lg-4">
			      			<img class="img-thumbnail img-fluid mb-5" src="<?php echo $base_url; ?>/assets/images/no-image.jpeg" alt="Card image cap" id="preview_fp">
			      		</div>
			      	</div>
			      	<div class="row" style="margin-top: -40px">
			      		<div class="col-lg-6">
			      			<label class="custom-file">
							  <input type="file" id="file2" required name="filebukti" accept="image/*"  onchange="tampilkanPreview(this,'preview_fp')" class="custom-file-input">
							  <span class="custom-file-control"></span>
							</label>
			      		</div>
			      	</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-4">
					<button type="submit" name="kirim" class="btn btn-primary mt-3 form-control">Kirim</button>
				</div>
			</div>
		</form>
	</div>
</div>
