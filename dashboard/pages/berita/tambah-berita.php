<div class="card mb-3">
  	<div class="card-header">
    	<i class="fa fa-newspaper-o"></i> Buat Berita Baru
    </div>
  	<div class="card-body">
		<form method="post" action="<?php echo $base_url ?>/dashboard/bin/berita/crud.php" enctype="multipart/form-data">
			<div class="row">
				<div class="col-lg-2" style="font-size: 25px;">
					<strong><a href="<?php echo $base_url ?>">Bengkel Ikan</a></strong> - Berita
				</div>
				<div class="col-lg-9">
					<div class="form-group">
						<input type="text" placeholder="Masukkan Judul Berita" name="judul" class="form-control">
					</div>
				</div>
				<div class="col-lg-1">
					<button type="submit" name="tambah" class="btn btn-primary">Publish</button>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-9">
					<div class="form-group">
						<textarea class="form-control" name="isi_berita" id="wysiwyg"></textarea>
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
									echo "<option value='$data_kategori[kd_kategori]'>$kat</option>";		
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="gambar-ikan">Gambar Headline berita</label>
	      				<img class="card-img-top img-thumbnail mb-2" src="<?php echo $base_url; ?>/assets/images/no-image.jpeg" alt="Card image cap" id="preview_fp">
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