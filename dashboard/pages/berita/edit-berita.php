<?php 
	$sql=mysqli_query($conn, "SELECT * FROM berita where kd_berita='$_GET[id]'");
	$data=mysqli_fetch_assoc($sql);
?>
<div class="card mb-3">
  	<div class="card-header">
    	<i class="fa fa-newspaper-o"></i> Edit Berita
    </div>
  	<div class="card-body">
		<form method="post" action="<?php echo $base_url ?>/dashboard/bin/berita/crud.php?id=<?php echo $_GET[id] ?>" enctype="multipart/form-data">
			<div class="row">
				<div class="col-lg-2" style="font-size: 25px;">
					<strong><a href="<?php echo $base_url ?>">Bengkel Ikan</a></strong> - Berita
				</div>
				<div class="col-lg-9">
					<div class="form-group">
						<input type="text" placeholder="Judul Berita" name="judul" value="<?php echo $data[judul] ?>" class="form-control">
					</div>
				</div>
				<div class="col-lg-1">
					<button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-9">
					<div class="form-group">
						<textarea class="form-control" name="isi_berita" id="wysiwyg"><?php echo $data[isi]; ?></textarea>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						<label for="kategoriberita">Kategori</label>
						<select required data-plugin="select2" class="form-control" name="Kategori" style="width: 100%">
							<option>--Pilih Kategori Berita--</option>
							<?php 
								$sql_kategori=mysqli_query($conn, "SELECT * FROM kategori WHERE kd_kategori_utama=1");
								while($data_kategori=mysqli_fetch_assoc($sql_kategori)){
									$kat=ucwords($data_kategori[nama_kategori]);
							?>
									<option <?php if($data[kd_kategori]==$data_kategori[kd_kategori]){ echo "selected"; } ?> value='<?php echo $data_kategori[kd_kategori] ?>'><?php echo $kat ?></option>		
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="gambar-berita">Gambar Headline berita</label>
	      				<img class="card-img-top img-thumbnail mb-2" src="<?php echo $base_url; ?>/assets/images/berita/<?php echo $data[gambar_headline] ?>" alt="Card image cap" id="preview_fp">
					</div>
					<div class="form-group">
						<label class="custom-file">
						  <input type="file" id="file2" name="headline_berita" accept="image/*"  onchange="tampilkanPreview(this,'preview_fp')" class="custom-file-input">
						  <span class="custom-file-control"></span>
						</label>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>