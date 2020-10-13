<div class="card mb-3">
	<div class="card-header">
		<i class="fa fa-plus"></i> Tambah Gizi Ikan
	</div>
	<form method="post" action="<?php echo $base_url ?>/dashboard/bin/gizi/crud.php">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group mb-4">
						<label>Nama Ikan</label>
						<select required data-plugin="select2" style="width: 100%;" class="form-control" name="ikan">
							<option>--Pilih Ikan--</option>
							<?php 
								$sql_ikan=mysqli_query($conn, "SELECT * FROM ikan WHERE kd_jenis_ikan=1");
								while($data_ikan=mysqli_fetch_assoc($sql_ikan)){
									$sql_gizi=mysqli_query($conn, "SELECT * FROM gizi_ikan where kd_ikan='$data_ikan[kd_ikan]'");
									$kat=ucwords($data_ikan[nama_ikan]);
									?>
										<option <?php if(mysqli_num_rows($sql_gizi)==1){ echo "disabled"; } ?> value='<?php echo $data_ikan[kd_ikan] ?>'><?php echo $kat ?> <?php if(mysqli_num_rows($sql_gizi)==1){ echo "( Sudah Terdata )"; } ?></option>	
									<?php	
								}
							?>
						</select>
					</div>
					<div class="form-group">
					   	<label for="kalori">Kadar(%) Kalori</label>
					   	<div class="input-group">
							<input required type="text" name="kalori" class="form-control" id="kalori" value="<?php echo $data['kalori'] ?>" placeholder="Masukkan Kadar Kalori">
							<span class="input-group-addon" id="basic-addon2">(kal)</span>
						</div>
					</div>
					<div class="form-group">
					   	<label for="protein">Kadar(%) Protein</label>
					   	<div class="input-group">
							<input required type="text" name="protein" class="form-control" id="protein" value="<?php echo $data['protein'] ?>" placeholder="Masukkan Kadar protein">
							<span class="input-group-addon" id="basic-addon2">(g)</span>
						</div>
					</div>
					<div class="form-group">
					   	<label for="lemak">Kadar(%) Lemak</label>
					   	<div class="input-group">
							<input required type="text" name="lemak" class="form-control" value="<?php echo $data['lemak'] ?>" id="lemak" placeholder="Masukkan Kadar lemak">
							<span class="input-group-addon" id="basic-addon2">(g)</span>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
					   	<label for="karbohidrat">Kadar(%) Karbohidrat</label>
					   	<div class="input-group">
							<input required type="text" value="<?php echo $data['karbohidrat'] ?>" name="karbohidrat" class="form-control" id="karbohidrat" placeholder="Masukkan Kadar karbohidrat">
							<span class="input-group-addon" id="basic-addon2">(g)</span>
						</div>
					</div>
					<div class="form-group">
					   	<label for="kalsium">Kadar(%) Kalsium</label>
					   	<div class="input-group">
							<input value="<?php echo $data['kalsium'] ?>" required type="text" name="kalsium" class="form-control" id="kalsium" placeholder="Masukkan Kadar kalsium">
							<span class="input-group-addon" id="basic-addon2">(mg)</span>
						</div>
					</div>
					<div class="form-group">
					   	<label for="fosfor">Kadar(%) Fosfor</label>
					   	<div class="input-group">
							<input value="<?php echo $data['fosfor'] ?>" required type="text" name="fosfor" class="form-control" id="fosfor" placeholder="Masukkan Kadar fosfor">
							<span class="input-group-addon" id="basic-addon2">(mg)</span>
						</div>
					</div>
					<div class="form-group">
					   	<label for="besi">Kadar(%) Besi</label>
					   	<div class="input-group">
							<input value="<?php echo $data['besi'] ?>" required type="text" name="besi" class="form-control" id="besi" placeholder="Masukkan Kadar besi">
							<span class="input-group-addon" id="basic-addon2">(g)</span>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
					   	<label for="vit_a">Kadar(%) Vitamin A</label>
					   	<div class="input-group">
							<input value="<?php echo $data['vit_a'] ?>" required type="text" name="vit_a" class="form-control" id="vit_a" placeholder="Masukkan Kadar Vitamin A">
							<span class="input-group-addon" id="basic-addon2">A (SI)</span>
						</div>
					</div>
					<div class="form-group">
					   	<label for="vit_b1">Kadar(%) Vitamin B1</label>
					   	<div class="input-group">
							<input value="<?php echo $data['vit_b1'] ?>" required type="text" name="vit_b1" class="form-control" id="vit_b1" placeholder="Masukkan Kadar Vitamin B1">
							<span class="input-group-addon" id="basic-addon2">B1 (mg)</span>
						</div>
					</div>
					<div class="form-group">
					   	<label for="vit_c">Kadar(%) Vitamin C</label>
					   	<div class="input-group">
							<input required type="text" name="vit_c" class="form-control" value="<?php echo $data['vit_c'] ?>" id="vit_c" placeholder="Masukkan Kadar Vitamin C">
							<span class="input-group-addon" id="basic-addon2">C (mg)</span>
						</div>
					</div>
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