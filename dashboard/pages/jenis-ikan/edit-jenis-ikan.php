<?php 
	$sql=mysqli_query($conn, "SELECT * FROM jenis_ikan where kd_jenis_ikan='$_GET[id]'");
	$data=mysqli_fetch_assoc($sql);
?>
<div class="card mb-3">
	<div class="card-header">
		<i class="fa fa-edit"></i> Edit Jenis Ikan 
	</div>
	<form method="post" action="<?php echo $base_url ?>/dashboard/bin/jenis-ikan/crud.php?id=<?php echo $_GET[id]; ?>">
		<div class="card-body">
			<div class="form-group">
			   	<label for="jenis_ikan">Jenis Ikan</label>
				<input required type="text" name="jenis_ikan" class="form-control" id="jenis_ikan" value="<?php echo $data['jenis_ikan'] ?>" placeholder="Masukkan Jenis Ikan">
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