<?php 
	$sql=mysqli_query($conn, "SELECT * FROM ikan where kd_ikan='$_GET[id]'");
	$data=mysqli_fetch_assoc($sql);
?>
<div class="card mb-3">
	<div class="card-header">
		<i class="fa fa-edit"></i> Edit Ikan 
	</div>
	<form method="post" action="<?php echo $base_url ?>/dashboard/bin/ikan/crud.php?id=<?php echo $_GET[id] ?>" enctype="multipart/form-data">
		<div class="card-body">
			<div class="form-group">
			   	<label for="jenis-ikan">Jenis Ikan</label>
	      		<select id="jenis-ikan" name="jenis_ikan" class="form-control jenis-ikan">
	        		<option>-- Pilih Jenis Ikan --</option>
	        		<?php 
	        		echo  $_GET[id];
	        			$sql_jenis_ikan=mysqli_query($conn, "SELECT * FROM jenis_ikan");
	        			while($data_jenis_ikan=mysqli_fetch_assoc($sql_jenis_ikan)){
					?>
						<option <?php if($data[kd_jenis_ikan]==$data_jenis_ikan[kd_jenis_ikan]){ echo "selected"; } ?>  value="<?php echo $data_jenis_ikan['kd_jenis_ikan'] ?>">
							<?php echo ucwords($data_jenis_ikan['jenis_ikan']) ?>
						</option>
					<?php 
	        			}
	        		?>
	      		</select>
			</div>
			<div class="form-group">
			   	<label for="nama-ikan">Nama ikan</label>
				<input required type="text" name="nama_ikan" class="form-control" id="nama-ikan" value="<?php echo $data['nama_ikan'] ?>" placeholder="Masukkan Nama ikan">
			</div>
			<div class="row">
	      		<div class="col-lg-3">
	      			<label for="gambar-ikan">Gambar Ikan</label>
	      			<img class="card-img-top img-fluid mb-2" src="<?php if($data[gambar_ikan]==""){ echo $base_url; ?>/assets/images/no-image.jpeg <?php }else{ echo $base_url; ?>/assets/images/ikan/<?php echo $data[gambar_ikan]; } ?> " alt="Card image cap" id="preview_fp">
	      		</div>
	      	</div>
	      	<div class="row mb-3">
	      		<div class="col-lg-3">
	      			<label class="custom-file">
					  <input type="file" id="file2" name="gambar_ikan" accept="image/*"  onchange="tampilkanPreview(this,'preview_fp')" class="custom-file-input">
					  <span class="custom-file-control"></span>
					</label>
	      		</div>
	      	</div>
		</div>
		<div class="card-footer">
		    <div class="row">
	      		<div class="col-lg-12">
	      			<button type="submit" name="ubah" class="btn btn-primary"><span class="fa fa-save"></span> Simpan Perubahan</button>	
	      		</div>
	      	</div>
		</div>
	</form>
</div>