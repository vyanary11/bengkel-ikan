<?php
if (!$_SESSION[loginuser]) {
	?>
       <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/masuk">  
    <?php
} 	
if ($_GET[action]=="edit-thread") {
	$sql_thread=mysqli_query($conn, "SELECT * FROM threads where kd_thread='$_GET[id]'");
	$data_threads=mysqli_fetch_assoc($sql_thread);

?>
<form  method="post" class=" mt-5 mb-5" action="<?php echo $base_url ?>/bin/edit-thread.php?id=<?php echo $_GET[id]; ?>" enctype="multipart/form-data">
<?php }else{ ?>
<form  method="post" class=" mt-5 mb-5" action="<?php echo $base_url ?>/bin/tulis-thread.php" enctype="multipart/form-data">
<?php } ?>
	<div class="row mb-3">
		<div class="col-lg-12">
	    <nav aria-label="breadcrumb" role="navigation">
	      <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
	        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>/forum">Forum</a></li>
	        <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords(str_replace("-", " ", $_GET[action])); ?></li>
	      </ol>
	    </nav>
	  </div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="row ">
				<div class="col-lg-12">
					<h2><?php echo ucwords(str_replace("-", " ", $_GET[action])); if ($_GET[action]!="edit-thread") { echo " Baru"; } ?></h2>
					<hr>
				</div>
				<div class="col-lg-9">
					<div class="form-group">
						<label for="judul" class="font-weight-bold">Judul *</label>
						<input type="text" value="<?php echo $data_threads[judul] ?>" id="judul" placeholder="Masukkan Judul Thread" name="judul" class="form-control">
					</div>
				</div>
				<div class="col-lg-2">
					<div class="form-group">
						<label for="judul">&nbsp;</label>
						<?php if($_GET[action]=="edit-thread"){ ?>
							<button type="submit" name="simpan" class="btn btn-primary form-control">Simpan Thread</button>
						<?php }else{ ?>
							<button type="submit" name="tambah" class="btn btn-primary form-control">Publish Thread</button>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-9">
					<div class="form-group">
						<label class="font-weight-bold">Detail *</label>
						<textarea class="form-control" name="isi_thread" id="wysiwyg"><?php echo $data_threads[isi] ?></textarea>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						<label for="kategoriberita" class="font-weight-bold">Kategori *</label>
						<select required data-plugin="select2" id="select2" class="form-control" name="kategori" style="width: 100%">
							<option>--Pilih Kategori Thread--</option>
							<?php 
								$sql_kategori=mysqli_query($conn, "SELECT * FROM kategori WHERE kd_kategori_utama=2");
								while($data_kategori=mysqli_fetch_assoc($sql_kategori)){
									$kat=ucwords($data_kategori[nama_kategori]);
							?>
								<option <?php if($data_threads[kd_kategori]==$data_kategori[kd_kategori]){echo "selected";} ?> value="<?php echo $data_kategori[kd_kategori] ?>"><?php echo $kat ?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="gambar-thread" class="font-weight-bold">Gambar Headline *</label>
		  				<?php if($_GET[action]=="edit-thread"){ ?>
		  					<img class="card-img-top img-thumbnail mb-2" src="<?php echo $base_url; ?>/assets/images/threads/<?php echo $data_threads[gambar_headline] ?>" alt="Card image cap" id="preview_fp">
		  				<?php }else{ ?>
		  					<img class="card-img-top img-thumbnail mb-2" src="<?php echo $base_url; ?>/assets/images/no-image.jpeg" alt="Card image cap" id="preview_fp">
		  				<?php } ?>
					</div>
					<div class="form-group">
						<label class="custom-file">
						  <input type="file" id="file2" name="headline_thread" accept="image/*"  onchange="tampilkanPreview(this,'preview_fp')" class="custom-file-input">
						  <span class="custom-file-control"></span>
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>