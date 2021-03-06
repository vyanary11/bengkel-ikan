<div class="card mb-3">
	<div class="card-header">
		<i class="fa fa-plus"></i> Tambah Kategori
	</div>
	<form method="post" action="<?php echo $base_url ?>/dashboard/bin/kategori/crud.php">
		<div class="card-body">
			<div class="form-group">
			   	<label for="kategori-utama">Kategori Utama</label>
	      		<select id="kategori-utama" name="kategori_utama" class="form-control kategori-utama" required>
	        		<option>-- Pilih Kategori Utama --</option>
	        		<?php 
	        			$sql_kategori_utama=mysqli_query($conn, "SELECT * FROM kategori_utama");
	        			while($data_kategori_utama=mysqli_fetch_assoc($sql_kategori_utama)){
					?>
						<option value="<?php echo $data_kategori_utama['kd_kategori_utama'] ?>">
							<?php echo ucwords($data_kategori_utama['nama_kategori_utama']) ?>
						</option>
					<?php 
	        			}
	        		?>
	      		</select>
			</div>
			<div class="form-group">
			   	<label for="nama-kategori">Nama Kategori</label>
				<input required type="text" name="nama_kategori" class="form-control" id="nama-kategori" placeholder="Masukkan Nama Kategori">
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