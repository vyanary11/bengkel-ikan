<?php 
	$sql=mysqli_query($conn, "SELECT * FROM barang left join user on user.kd_user=barang.kd_user left join kecamatan on user.kecamatan=kecamatan.kodeKecamatan WHERE kd_barang='$_GET[id]'");
	$data=mysqli_fetch_assoc($sql);
	$sql1=mysqli_query($conn, "SELECT SUM(rating), count(kd_review) FROM review where kd_barang='$_GET[id]'");
	$dttotal=mysqli_fetch_array($sql1);
	if ($dttotal[1]==0) {
      $total=0;
    }else{
      $total=$dttotal[0]/$dttotal[1];
    }
	$total1=ceil($total);
	$sql_review=mysqli_query($conn, "SELECT * FROM review left join user on user.kd_user=review.kd_user WHERE kd_barang='$_GET[id]'");
?>
<div class="row mt-5 mb-3">
	<div class="col-lg-12">
		<nav aria-badge="breadcrumb" role="navigation">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>/jual-beli">Jual Beli</a></li>
		    <li class="breadcrumb-item" ><a href="<?php echo $base_url; ?>/jual-beli/<?php echo $_GET['kategori'] ?>"><?php echo ucwords(str_replace("-", " ", $_GET['kategori'])); ?></a></li>
		    <li class="breadcrumb-item active" aria-current="page">
		    	<?php echo ucwords($data[nama_barang]); ?>
		    </li>
		  </ol>
		</nav>
	</div>
</div>
<div class="row mb-5">
	<div class="col-lg-3 py-3 pl-3 border border-right-0 bg-white">
		<img src="<?php echo $base_url ?>/assets/images/barang/<?php echo $data[gambar_barang]; ?>" class="img-fluid">
	</div>
	<div class="col-lg-6 py-3 pr-3 border border-right-0 border-left-0 bg-white col-md-6 my-lg-0 my-sm-3">
		<h2 class="font-weight-bold"><?php echo ucwords($data[nama_barang]); ?></h2>
		<p class="text-muted">
			<?php 
				$jml=$total1;
				for ($i=0; $i < $jml; $i++) { 
					?>
					<i class="fa fa-star text-warning">&nbsp;</i>
					<?php
				}
				for ($i=0; $i < 5-$jml; $i++) { 
					?>
					<i class="fa fa-star-o" style="color: #ddd">&nbsp;</i>
					<?php
				}
			?>
		<?php echo mysqli_num_rows($sql_review); ?> Review | <a href="#review">Tulis Review</a>
		</p>
		<h3 class="text-primary">Rp. <?php echo number_format($data[harga]); ?><font class="text-dark">/<?php echo ucwords($data[satuan])?></font></h3>
		<hr>
		<h4 class="font-weight-bold">Deskripsi Barang : </h4>
		<p><?php echo $data[deskripsi]; ?> <strong>HANYA SEBAGAI DEMO</strong></p>
		<a href="<?php echo $base_url ?>/bin/cart.php?id=<?php echo $_GET[id] ?>" class="btn btn-primary"><span class="fa fa-shopping-cart"></span> Beli</a>
	</div>
	<div class="col-lg-3 col-md-6 d-md-block d-sm-none my-lg-0 my-sm-3 border py-3 pr-3 bg-white">
		<h3>Seller</h3>
		<div class="media">
			<div class="rounded-circle mr-3 " style="overflow: hidden;width: 80px;height: 80px">
				<img class="w-100 h-100" src="<?php echo $base_url ?>/assets/images/user/<?php echo $data[fp] ?>" alt="Generic placeholder image">
			</div>
			<div class="media-body">
			    <h5 class="mt-0"><?php echo $data[nama_lengkap]; ?></h5>
			    <p class="text-muted"><span class="fa fa-map-marker"></span> <?php echo $data[namaKecamatan]; ?></p>
			</div>
		</div>
	</div>
	<div class="col-lg-12 my-5">
		<nav class="nav nav-tabs border-bottom-0" id="myTab" role="tablist">
		  <a class="nav-item nav-link border bg-primary text-white " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Review (<?php echo mysqli_num_rows($sql_review); ?>)</a>
		</nav>
		<div class="tab-content border mx-2 p-3 bg-white" id="nav-tabContent">
		  	<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-badgeledby="nav-home-tab">
		  		<?php  
		  			while($data_review=mysqli_fetch_assoc($sql_review)){
		  		?>
			  	<div class="media">
			  		<div class="rounded-circle mr-5" style="overflow: hidden;width: 100px;height: 100px">
						<img class="w-100 h-100" src="<?php echo $base_url ?>/assets/images/user/<?php echo $data_review[fp] ?>" alt="Generic placeholder image">
					</div>
					<div class="media-body">
				    	<h5 class="mt-0"><?php echo $data_review[nama_lengkap]; ?></h5>
				    	<p class="text-muted"><?php echo date("d F Y H:i", strtotime($data_review[tgl_review])); ?></p>
				    	<p>
				    	<?php 
							$jml=$data_review[rating];
							for ($i=0; $i < $jml; $i++) { 
								?>
								<i class="fa fa-star text-warning">&nbsp;</i>
								<?php
							}
							for ($i=0; $i < 5-$jml; $i++) { 
								?>
								<i class="fa fa-star-o" style="color: #ddd">&nbsp;</i>
								<?php
							}
						?>
						</p>
				    	<?php echo $data_review[detail_review]; ?>
				  	</div>
				</div>
				<hr>
				<?php } ?>
		  	</div>
			<form method="post" action="<?php echo $base_url ?>/bin/review.php?id=<?php echo $_GET[id] ?>">
				<h2>Tulis Review</h2>
				<div id="review" class="form-group row" >
					<div class="col-md-12">
				        <input type="number" hidden class="rating form-control" name="rating" min=0 max=5 step=1 data-size="md" data-stars="5">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-12">
						<badge for="Detail Review">Detail Review *</badge>
						<textarea name="review" class="form-control"></textarea>
					</div>
				</div>
				<button name="kirim" type="submit" class="btn btn-primary">Kirim Review</button>
			</form>
		</div>
	</div>
</div>