<div class="card mb-3">
	<div class="card-header">
		<i class="fa fa-plus"></i> Tambah Jenis Ikan
	</div>
	<form method="post" action="<?php echo $base_url ?>/dashboard/bin/jenis-ikan/crud.php">
		<div class="card-body">
			<div class="form-group">
			   	<label for="nama-jenis-ikan">Jenis Ikan</label>
				<input required type="text" name="jenis_ikan" class="form-control" id="nama-jenis-ikan" placeholder="Masukkan Nama jenis-ikan">
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