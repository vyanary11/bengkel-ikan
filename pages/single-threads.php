<?php 
    $sql_threads=mysqli_query($conn, "SELECT * FROM threads left join user on user.kd_user=threads.kd_user WHERE kd_thread=$_GET[id]");
    $data_threads=mysqli_fetch_assoc($sql_threads);
    mysqli_query($conn, "UPDATE threads SET jumlah_view=$data_threads[jumlah_view]+1 WHERE kd_thread='$_GET[id]'");

?> 

<div class="row mt-5 mb-3">
	<div class="col-lg-12">
		<nav aria-label="breadcrumb" role="navigation">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>/forum">Forum</a></li>
		    <li class="breadcrumb-item" ><a href="<?php echo $base_url; ?>/forum/<?php echo $_GET['kategori'] ?>"><?php echo str_replace("-", " ", $_GET['kategori']); ?></a></li>
		    <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords($data_threads [judul]); ?></li>
		  </ol>
		</nav>
	</div>
</div>
<div class="row mb-3">
	<div class="col-lg-3">
		<div class="input-group">
			<a href="<?php echo $base_url ?>/forum/reply-thread/<?php echo $_GET[url]."-".$_GET[id] ?>" class="btn btn-primary"><span class="fa fa-pencil"></span> Tulis Reply</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
		  	<div class="card-header bg-primary text-white">
		    	<span class="fa fa-check-square-o"></span> <?php echo Tgl($data_threads [tgl_post]); ?>
		    	<font class="float-right">#1</font>
		  	</div>
		  	<div class="card-header">
		  		<div class="row" style="margin-left: -20px;">
		  			<div class="col-lg-2">
				    	<div class="media">
						  	<img class="img-thumbnail" src="<?php echo $base_url ?>/assets/images/user/<?php echo $data_threads [fp]; ?>" alt="Generic placeholder image">
						</div>
					</div>
					<div class="col-lg-10">
						<p class="text-primary font-weight-bold"><a href="<?php echo $base_url ?>/user/akun/<?php echo $data_threads[kd_user] ?>"><?php echo ucwords($data_threads [nama_lengkap]); ?></a></p>
					    <p class="text-muted">Member Sejak : <?php echo date("d F Y", strtotime($data_threads[tgl_daftar])); ?>, Thread : <?php echo mysqli_num_rows(mysqli_query($conn,"SELECT * FROM threads where kd_user='$data_threads[kd_user]'")); ?></p>
					</div>
				</div>
		  	</div>
		  	<div class="card-header bg-white font-weight-bold">
		    	<?php 
          		echo ucwords($data_threads[judul]); ?>
		  	</div>
		  	<div class="card-body" style="overflow-x: hidden;">
		    	<div class="text-center">
		    		<img src="<?php echo $base_url ?>/assets/images/threads/<?php echo $data_threads [gambar_headline]; ?>" alt="Generic placeholder image" class="img-fluid">
		    	</div>
		    	<p class="card-text my-5"><?php echo $data_threads [isi]; ?></p>
		  	</div>
		</div>
	</div>
</div>
<div class="row my-3">
	<?php 
		$sql_reply=mysqli_query($conn, "SELECT * FROM balasan_thread left join user on user.kd_user=balasan_thread.kd_user WHERE kd_thread='$_GET[id]'");
		$no=2;
		while($data_threads_reply = mysqli_fetch_assoc($sql_reply)){
	?>
	<div class="col-lg-12 mb-3">
		<div class="card">
		  	<div class="card-header bg-primary text-white">
		    	<span class="fa fa-check-square-o"></span> <?php echo Tgl($data_threads_reply[tgl_balasan]); ?>
		    	<font class="float-right">#<?php echo $no++; ?></font>
		  	</div>
		  	<div class="card-body">
		  		<div class="row" style="margin-left: -20px;margin-top: -5px;">
		  			<div class="col-lg-2">
		  				<div class="media">
						  	<img class="align-self-start img-thumbnail" src="<?php echo $base_url ?>/assets/images/user/<?php echo $data_threads_reply[fp] ?>" alt="Generic placeholder image">
						</div>
						<div class="media mt-3">
							<div class="media-body">
						    	<p class="text-primary font-weight-bold"><p class="text-primary font-weight-bold"><a href="<?php echo $base_url ?>/user/akun/<?php echo $data_threads_reply[kd_user] ?>"><?php echo ucwords($data_threads_reply [nama_lengkap]); ?></a></p></p>
						    	<p>Member Sejak: <br> <?php echo date("d F Y", strtotime($data_threads_reply[tgl_daftar])); ?></p>
						    	<p>Threads: <br> <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM threads where kd_user = '$data_threads_reply[kd_user]'")) ?></p>
						  	</div>
						</div>
		  			</div>
		  			<div class="col-lg-1 m-0 p-0">
		  				<hr style="height:100%;width: 1px; margin-top: -5px;" color="gray"/>
		  			</div> 	
		  			<div class="col-lg-9 ml-0 p-0" style="overflow-x: hidden;">
		    			<p class="card-text my-3"><?php echo $data_threads_reply[isi] ?></p>
		  			</div>
		  		</div>
		  	</div>
		</div>
	</div>
	<?php } ?>
</div>
<?php if ($_SESSION[loginuser]) { ?>
<form  method="post" class=" mt-5 mb-3" action="<?php echo $base_url ?>/bin/reply_thread.php?id=<?php echo $_GET[id] ?>" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-12">
			<h4 class="text-center">Reply Thread </h4>
			<hr>
			<div class="form-group">
				<textarea class="form-control" name="isi_reply" id="wysiwyg"></textarea>
			</div>
			<div class="form-group">
				<label for="judul">&nbsp;</label>
				<button type="submit" name="tambah" class="btn btn-primary float-lg-right">Publish Reply</button>
			</div>
		</div>
	</div>
</form>
<?php } ?>