<div class="card mb-3">
	<div class="card-header">
		<i class="fa fa-plus"></i> Tambah Admin
	</div>
	<form method="post" action="<?php echo $base_url ?>/dashboard/bin/user/crud.php">
		<div class="card-body">
			<div class="form-group">
	    		<label >Nama Lengkap</label>
	      		<input required type="text" class="form-control" name="nama" placeholder="Nama Lengkap">
		  	</div>
		  	<div class="form-group ">
		  		<label >Nomor Telpon</label>
		    	<input required type="text" class="form-control" name="telp" placeholder="Nomor Telepon">
		  	</div>
		  	<div class="form-group ">
		  		<label >Email</label>
		    	<input required type="email" class="form-control" name="email" placeholder="Email">
		  	</div>
		  	<div class="form-group ">
		  		<label >Password</label>
      			<input required type="password" class="form-control" name="password" placeholder="Password">
		  	</div>
		</div>
		<div class="card-footer">
		    <div class="">
	      		<div class="col-lg-12">
	      			<button type="submit" name="tambah" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah</button>
	      		</div>
	      	</div>
	    </div>
	</form>    
</div>