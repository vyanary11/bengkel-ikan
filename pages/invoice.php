<div class="row mt-5 mb-3">
	<div class="col-lg-12">
		<nav aria-badge="breadcrumb" role="navigation">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>/jual-beli">Jual Beli</a></li>
		    <li class="breadcrumb-item"><a href="">Invoice</a></li>
		    <li class="breadcrumb-item active" aria-current="page"><?php echo $_GET[id]; ?></li>
		  </ol>
		</nav>
	</div>
</div>
<?php 
	$qry_order=mysqli_query($conn, "SELECT * FROM orders where kd_user='$_SESSION[loginuser]' and kd_order='$_GET[id]' ORDER by kd_order DESC");
	$data_order=mysqli_fetch_array($qry_order);
	
?>
<div class="row mb-5 py-5 bg-white justify-content-center">
	<div class="col-lg-5 text-center">
		<p>Batas Pembayaran :<br>
			<b> 
				<?php 
					if ($data_order[status_pembayaran]=="n" and $tgl_sekarang>$tgl_order_berakhir) {
						echo "Kadaluarsa";
					}elseif ($data_order[status_pembayaran]=="n" and $tgl_sekarang<$tgl_order_berakhir) {
						echo $tgl_kadaluarsa;
					}else{
						echo "Pembayaran Sukses"."<br>";
					}
				?>
			</b>
		</p>
		<p class="mt-4">
			Jumlah yang harus dibayar:<br>
			<h3 class="font-weight-bold">Rp. <?php echo str_replace(" ", "", str_replace(",", ".", number_format($tdepan))).".<mark>".str_replace(" ", "", $tbelakang)."</mark>" ?> </h3>
		</p>
		<div class="row text-center">
			<div class="col-lg-12 ">
				<div class="triangle demo-arrow-up text-center" style="border-bottom: 15px solid #2c3e50;position: relative;float: none;left:0 ;top:5px;margin: 0 auto;"></div>
				<div style="background-color: #2c3e50" class="p-3 text-white">
					Transfer tepat hingga 3 digit terakhir agar tidak menghambat proses vertifikasi
				</div>
			</div>
		</div>

		<p class="mt-5">
			Nomor Invoice:
			<h1 class="font-weight-bold text-primary"><?php echo $_GET[id] ?></h1>
		</p>
		<p class="mt-4 text-justify">
			Silahkan Transfer ke rekening bengkelikan a/n Vyan Ary Pratama:
		</p>
		<div class="row">
			<div class="col-lg-6 p-3 col-12 border">
				<img src="<?php echo $base_url ?>/assets/images/bca.gif" align="left" alt="Card image cap"><br><br>
				<p class="text-justify">Bank BCA, Jember</p>
	      		<p class="text-justify font-weight-bold">023 333 3333</p>
			</div>
			<div class="col-lg-6 p-3 col-12 border">
				<img src="<?php echo $base_url ?>/assets/images/mandiri.gif" align="left" alt="Card image cap"><br><br>
				<p class="text-justify">Bank Mandiri, Jember</p>
	      		<p class="text-justify font-weight-bold">023 333 3333</p>
			</div>
			<div class="w-100"></div>
			<div class="col-lg-6 p-3 col-12 border">
				<img src="<?php echo $base_url ?>/assets/images/bni.gif" align="left" alt="Card image cap"><br><br>
				<p class="text-justify">Bank BNI, Banyuwangi</p>
	      		<p class="text-justify font-weight-bold">023 333 3333</p>
			</div>
			<div class="col-lg-6 p-3 col-12 border">
				<img src="<?php echo $base_url ?>/assets/images/bri.gif" align="left" alt="Card image cap"><br><br>
				<p class="text-justify">Bank BRI, Jember</p>
	      		<p class="text-justify font-weight-bold">023 333 3333</p>
			</div>
		</div>
		<a href="<?php echo $base_url ?>/jual-beli" class="mt-5 btn btn-secondary"><span class="fa fa-home"></span> Lanjutkan Belanja</a>
		<a href="<?php echo $base_url ?>/pages/cetak/cetak_invoice.php?id=<?php echo $_GET[id] ?>" class="mt-5 btn btn-primary"><span class="fa fa-print"></span> Cetak Invoice</a>
	</div>
</div>