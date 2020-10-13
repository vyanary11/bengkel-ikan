<?php
	if (!$_SESSION[loginuser]) {
		?>
           <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/masuk">  
        <?php
	} 	
	$sql=mysqli_query($conn, "SELECT * FROM threads left join kategori on kategori.kd_kategori=threads.kd_kategori WHERE kd_thread='$_GET[id]'");
	$data=mysqli_fetch_assoc($sql);
?>
<form  method="post" class=" mt-5 mb-3" action="<?php echo $base_url ?>/bin/reply_thread.php?id=<?php echo $_GET[id] ?>" enctype="multipart/form-data">
	<div class="row mb-3">
		<div class="col-lg-12">
		    <nav aria-label="breadcrumb" role="navigation">
		      <ol class="breadcrumb">
		        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
		        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>/forum">Forum</a></li>
		        <li class="breadcrumb-item" ><a href="<?php echo $base_url; ?>/forum/<?php echo $data['nama_kategori'] ?>"><?php echo ucwords($data['nama_kategori']) ?></a></li>
			    <li class="breadcrumb-item" ><a href="<?php echo $base_url; ?>/forum/<?php echo $data['nama_kategori'] ?>/<?php echo $_GET[url]."-".$_GET[id] ?>.html"><?php echo ucwords($data['judul']) ?></a></li>
		        <li class="breadcrumb-item active" aria-current="page">Reply Thread</li>
		      </ol>
		    </nav>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12">
					<h2>Reply Thread </h2>
					<hr>
					<div class="form-group">
						<label class="font-weight-bold">Isi *</label>
						<textarea class="form-control" name="isi_reply" id="wysiwyg"></textarea>
					</div>
					<div class="form-group">
						<label for="judul">&nbsp;</label>
						<button type="submit" name="tambah" class="btn btn-primary float-lg-right">Publish Reply</button>
					</div>
				</div>
			</div>	
		</div>
	</div>
</form>