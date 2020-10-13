<?php 
	$sql=mysqli_query($conn, "SELECT * FROM barang where kd_barang='$_GET[id]'");
	$data=mysqli_fetch_assoc($sql);
?>
<div class="card mb-3">
  	<div class="card-header">
    	<i class="fa fa-shopping-basket"></i> Edit Barang
    </div>
  	<div class="card-body">
		<form method="post" action="<?php echo $base_url ?>/dashboard/bin/barang/crud.php?id=<?php echo $_GET[id] ?>" enctype="multipart/form-data">
			<div class="row">
				<div class="col-lg-2" style="font-size:22px;">
					Nama Barang : 
				</div>
				<div class="col-lg-9">
					<div class="form-group">
						<input type="text" value="<?php echo $data[nama_barang] ?>" placeholder="Masukkan Nama Barang" name="nama_barang" class="form-control">
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
						<label>Deskripsi</label>
						<textarea class="form-control" name="deskripsi"  id="wysiwyg"><?php echo $data[deskripsi] ?></textarea>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						<label for="kategoriBarang">Kategori Barang</label>
						<select required data-plugin="select2" class="form-control" name="kategori" style="width: 100%">
							<option>--Pilih Kategori Barang--</option>
							<?php 
								$sql_kategori=mysqli_query($conn, "SELECT * FROM kategori WHERE kd_kategori_utama=3");
								while($data_kategori=mysqli_fetch_assoc($sql_kategori)){
									$kat=ucwords($data_kategori[nama_kategori]);
							?>
									<option <?php if($data[kd_kategori]==$data_kategori[kd_kategori]){echo "selected";} ?> value='<?php echo $data_kategori[kd_kategori] ?>'><?php echo $kat ?></option>"
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="hargaBarang">Harga Barang</label>
						<div class="input-group">
						  <span class="input-group-addon">Rp.</span>
						  <input type="text" value="<?php echo $data[harga] ?>" class="form-control text-right" name="harga" placeholder="Masukkan Harga Barang">
						  <span class="input-group-addon">.00</span>
						</div>
					</div>
					<div class="form-group">
						<label for="satuanBarang">Satuan Barang</label>
						<input type="text" placeholder="Masukkan Satuan. Contoh: Kg, Unit, Bungkus dll" name="satuan" value="<?php echo $data[satuan] ?>" class="form-control">
					</div>
					<div class="form-group">
						<label for="gambar-ikan">Gambar Barang</label>
	      				<img class="card-img-top img-thumbnail mb-2" src="<?php echo $base_url; ?>/assets/images/barang/<?php echo $data[gambar_barang] ?>" alt="Card image cap" id="preview_fp">
					</div>
					<div class="form-group">
						<label class="custom-file">
						  <input type="file" id="file2" name="gambar_barang" accept="image/*"  onchange="tampilkanPreview(this,'preview_fp')" class="custom-file-input">
						  <span class="custom-file-control"></span>
						</label>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>