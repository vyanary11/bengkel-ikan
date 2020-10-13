<?php 
	$sql=mysqli_query($conn, "SELECT * FROM user left join kabupaten on user.kabupaten=kabupaten.kodeKabKota left join propinsi on user.provinsi=propinsi.kodePropinsi left join kecamatan on user.kecamatan=kecamatan.kodeKecamatan left join kelurahan on user.desa=kelurahan.kodeKelurahan WHERE kd_user='$_SESSION[loginuser]' and level_user!='admin'");
	$data=mysqli_fetch_assoc($sql);
?>
<div class="row mt-5 mb-3">
	<div class="col-lg-12">
		<nav aria-badge="breadcrumb" role="navigation">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>/jual-beli">Jual Beli</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
		  </ol>
		</nav>
	</div>
</div>
<form method="post" action="<?php echo $base_url; ?>/bin/checkout.php">
<div class="row mb-5">
	<div class="col-lg-8">
		<div class="card">
			<div class="card-header text-white bg-primary">
				<h2>Isi Alamat Pengiriman</h2>
			</div>
			<div class="card-body">
        		<div class="form-group row">
        			<label for="namalengkap" class="col-lg-4 col-form-label">Nama Lengkap</label>
        			<div class="col-lg-8">
        				<input type="text" name="nama" required class="form-control" value="<?php echo $data[nama_lengkap] ?>" id="namalengkap" placeholder="Nama Lengkap">
        			</div>
        		</div>
        		<div class="form-group row">
				    <label for="kabupaten" class="col-lg-4 col-form-label">Kabupaten / Kota</label>
				    <div class="col-lg-8">
				    	<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="Jember">
					    <p class="text-muted">Hanya untuk wilayah Jember</p>
				    </div>
				</div>
				<div class="form-group row">
				    <label for="kecamatan" class="col-lg-4 col-form-label">Kecamatan</label>
				    <div class="col-lg-8">
					    <select data-plugin="select2" required id="select2" name="kecamatan" class="form-control pilih-kecamatan-dicheckout" style="width: 100%;">
					        <option value="">---&nbsp;&nbsp;&nbsp;  Pilih Kecamatan  &nbsp;&nbsp;&nbsp;---</option>
					        <?php
					            $sql_kecamatan = mysqli_query($conn, "SELECT * from kecamatan where kodeKabKota=244");
					            while($data_kecamatan=mysqli_fetch_array($sql_kecamatan)){
					        ?>
					            <option value="<?php echo $data_kecamatan['kodeKecamatan'] ?>"><?php echo $data_kecamatan['namaKecamatan'] ?></option>
					        <?php } ?>
					    </select>
					</div>
				</div>
				<div class="tempat-kelurahan">
				    <?php include("./pages/checkout/modul/kelurahan-empty.php"); ?>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-4" for="alamat">Alamat Lengkap</label>
					<div class="col-lg-8">
						<textarea class="form-control" required rows="5" name="alamat" id="alamat" placeholder="Alamat Lengkap"></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-4" for="no_telp">Nomor Handphone</label>
					<div class="col-lg-8">
						<div class="input-group">
							<span class="input-group-addon">+62</span>
							<input type="number" required class="form-control" value="<?php echo $data[no_telp] ?>" rows="5" name="no_telp" id="no_telp" placeholder="Nomor Handphone">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 mt-lg-0 mt-3">
		<?php 
			$qrycart=mysqli_query($conn, "SELECT * FROM cart left join barang on cart.kd_barang=barang.kd_barang where cart.kd_user='$_SESSION[loginuser]'");
			$qrycart1=mysqli_query($conn, "SELECT sum(qty) as items FROM cart  where cart.kd_user='$_SESSION[loginuser]'");
			$datacart1=mysqli_fetch_assoc($qrycart1);
		?>
		<div class="card">
			<div class="card-header text-white bg-primary">
				<h5>Rincian Pesanan <i class="text-light">( <?php echo $datacart1[items]  ?> Items )</i></h5>
			</div>
			<div class="card-body p-0">
				<table class="table table-responsive" style="font-size: 10px">
					<thead class="bg-light">
						<tr>
							<th scope="col" width="180px">PRODUK</th>
							<th scope="col" class="text-center">KUANTITAS</th>
							<th scope="col" width="100px" class="text-right">HARGA</th>
						</tr>
					</thead>
					<tbody>
						<?php while($datacart=mysqli_fetch_assoc($qrycart)){ ?>
						<?php 
							$harga=$datacart[harga]*$datacart[qty];
							$total+=$harga;
						?>
						<tr>
							<td scope="row"><?php echo $datacart[nama_barang]; ?></td>
							<td class="text-center"><?php echo $datacart[qty]; ?></td>
							<td class="text-right"><?php echo number_format($harga); ?></td>
						</tr>
						<?php } ?>
					</tbody>
					<tfoot class="bg-light">
						<tr style="font-size: 16px">
							<td colspan="3" class="font-weight-bold">
								TOTAL <font class="float-right text-primary">Rp. <?php echo number_format($total); ?></font>
								<p class="text-muted" style="font-size: 8px">(termasuk PPN, jika ada*)</p>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="card-footer">
				<button type="submit" name="konfirmasi_pesanan" class="btn btn-primary"><span class="fa fa-money"></span> KONFIRMASI PESANAN</button>
			</div>
		</div>
	</div>
</div>
</form>
