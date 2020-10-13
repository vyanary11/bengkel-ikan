<div class="card mb-3">
	<div class="card-header">
		<i class="fa fa-plus"></i> Tambah ikan
	</div>
	<form method="post" action="<?php echo $base_url ?>/dashboard/bin/ikan/crud.php" enctype="multipart/form-data">
		<div class="card-body">
			<div class="form-group">
			   	<label for="jenis-ikan">Jenis Ikan </label>
	      		<select id="jenis-ikan" name="jenis_ikan" class="form-control ikan-" required>
	        		<option>-- Pilih Jenis Ikan --</option>
	        		<?php 
	        			$sql_jenis_ikan=mysqli_query($conn, "SELECT * FROM jenis_ikan");
	        			while($data_jenis_ikan=mysqli_fetch_assoc($sql_jenis_ikan)){
					?>
						<option value="<?php echo $data_jenis_ikan['kd_jenis_ikan'] ?>">
							<?php echo ucwords($data_jenis_ikan['jenis_ikan']) ?>
						</option>
					<?php 
	        			}
	        		?>
	      		</select>
			</div>
			<div class="form-group">
			   	<label for="nama-ikan">Nama Ikan</label>
				<input required type="text" name="nama_ikan" class="form-control" id="nama-ikan" placeholder="Masukkan Nama Ikan">
			</div>
			<div class="row">
	      		<div class="col-lg-3">
	      			<label for="gambar-ikan">Gambar Ikan</label>
	      			<img class="card-img-top img-fluid mb-2" src="<?php echo $base_url; ?>/assets/images/no-image.jpeg" alt="Card image cap" id="preview_fp">
	      		</div>
	      	</div>
	      	<div class="row mb-3">
	      		<div class="col-lg-3">
	      			<label class="custom-file">
					  <input type="file" required id="file2" name="gambar_ikan" accept="image/*"  onchange="tampilkanPreview(this,'preview_fp')" class="custom-file-input">
					  <span class="custom-file-control"></span>
					</label>
	      		</div>
	      	</div>
		</div>
		<div class="card-footer">
		    <div class="row">
	      		<div class="col-lg-12">
	      			<button type="submit" name="tambah" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah</button>
	      		</div>
	      	</div>
	    </div>
	</form>
</div>