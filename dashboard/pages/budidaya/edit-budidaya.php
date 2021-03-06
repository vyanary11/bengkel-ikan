<?php 
	$sql=mysqli_query($conn, "SELECT * FROM budidaya_ikan where kd_budidaya='$_GET[id]'");
	$data=mysqli_fetch_assoc($sql);
?>
<div class="card mb-3">
  	<div class="card-header">
    	<i class="fa fa-edit"></i> Edit Budidaya
    </div>
    <form method="post" action="<?php echo $base_url ?>/dashboard/bin/budidaya/crud.php?id=<?php echo $_GET[id] ?>" enctype="multipart/form-data">
  		<div class="card-body">
			<div class="row">
				<div class="col-lg-12">
					<div class="form-group">
						<label>Nama Ikan</label>
						<select required data-plugin="select2" style="width: 100%;" class="form-control" name="ikan">
							<option>--Pilih Ikan--</option>
							<?php 
								$sql_ikan=mysqli_query($conn, "SELECT * FROM ikan");
								while($data_ikan=mysqli_fetch_assoc($sql_ikan)){
									$sql_budidaya=mysqli_query($conn, "SELECT * FROM budidaya_ikan where kd_ikan='$data_ikan[kd_ikan]'");
									$kat=ucwords($data_ikan[nama_ikan]);
								?>
									<option <?php if(mysqli_num_rows($sql_budidaya)==1){ echo "disabled"; } ?> <?php if($data[kd_ikan]==$data_ikan[kd_ikan]){ echo "selected"; } ?> value='<?php echo $data_ikan[kd_ikan] ?>'><?php echo $kat ?> <?php if(mysqli_num_rows($sql_budidaya)==1){ echo "( Sudah Terdata )"; } ?></option>	
								<?php
								}
							?>
						</select>
					</div>
				</div>
				<div class="col-lg-6 mt-4">
					<div class="form-group">
						<label>Deskripsi</label>
						<textarea class="form-control" name="deskripsi" id="wysiwyg"><?php echo $data['deskripsi'];  ?></textarea>
					</div>
				</div>
				<div class="col-lg-6 mt-4">
					<div class="form-group">
						<label>Cara Budidaya</label>
						<textarea class="form-control" name="budidaya" id="wysiwyg1"><?php echo $data['budidaya'];  ?></textarea>
					</div>
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