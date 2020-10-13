<div class="row mt-5 mb-3">
	<div class="col-lg-12">
		<nav aria-badge="breadcrumb" role="navigation">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>/jual-beli">Jual Beli</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
		  </ol>
		</nav>
	</div>
</div>
<div class="row mb-5 bg-white py-4 px-0">
	<?php 
		$qrycart=mysqli_query($conn, "SELECT * FROM cart left join barang on cart.kd_barang=barang.kd_barang where cart.kd_user='$_SESSION[loginuser]'");
		if (mysqli_num_rows($qrycart)==0) {
	?>
	<div class="col-lg-12">
		<h2>Keranjang Belanja Saya</h2>
		<div class="card">
		  	<div class="card-body text-center">
			    <h5>Keranjang anda kosong, silakan berbelanja.</h5>
		    	<a href="<?php echo $base_url; ?>" class="btn btn-secondary">Lanjutkan Belanja</a>
		  	</div>
		</div>
	</div>
	<?php	
		}else{
	?>
	<div class="col-lg-12">
		<h2>Keranjang Belanja Saya</h2>
		<p class="text-muted"><?php echo mysqli_num_rows($qrycart); ?> PRODUK</p>
	</div>
	<div class="col-lg-9 col-6">
		<table class="table table-responsive">
		  <thead class="bg-primary text-white">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col" colspan="2">PRODUK</th>
		      <th scope="col" width="160px">HARGA PRODUK</th>
		      <th scope="col" width="100px" class="text-center">KUANTITAS</th>
		      <th scope="col" width="160px" class="text-center">TOTAL HARGA</th>
		      <th scope="col" width="80px"></th>
		    </tr>
		  </thead>
		  <tbody class="bg-light">
		  	<?php while($datacart=mysqli_fetch_assoc($qrycart)){ ?>
		  	<?php 
		  		$total=$datacart[harga]*$datacart[qty];
		  		$subtotal+=$total;
		  	?>
		    <tr >
		      <th scope="row"><?php echo ++$no; ?></th>
		      <td width="100px"><img src="<?php echo $base_url ?>/assets/images/barang/<?php echo $datacart[gambar_barang] ?>" class="img-thumbnail"></td>
		      <td><?php echo $datacart[nama_barang] ?></td>
		      <td class="font-weight-bold text-right">Rp. <?php echo number_format($datacart[harga])." / ".$datacart[satuan]; ?></td>
		      <td class="text-center" width="180px">
		      	<form method="POST" action="<?php echo $base_url ?>/bin/cart.php?id=<?php echo $datacart[kd_cart] ?>">
                <div class="input-group">
	                <span class="input-group-btn">
	                    <button type="button" class="btn btn-danger" onclick="<?php echo "no".$no; ?>minus()">
	                      <span class="fa fa-minus"></span>
	                    </button>
	                </span>
                	<input type="number" required id="quantity<?php echo $no ?>" class="form-control text-center" value="<?php echo $datacart[qty]?>" name="qty">
                	<input type="submit" name="enter" class="d-none">
	                <span class="input-group-btn">
	                    <button type="button"  class="btn btn-success" onclick="<?php echo "no".$no; ?>plus()">
	                        <span class="fa fa-plus"></span>
	                    </button>
	                </span>
	            </div>
	            <script type="text/javascript">
					var count<?php echo $no; ?> = <?php echo $datacart[qty]?>;
				    var countE<?php echo $no; ?> = document.getElementById("quantity<?php echo $no ?>");

				    function <?php echo "no".$no; ?>plus(){
				        count<?php echo $no; ?>++;
				        countE<?php echo $no; ?>.value = count<?php echo $no; ?>;
				        window.location = "<?php echo $base_url ?>/bin/cart.php?qty="+countE<?php echo $no; ?>.value+"&id=<?php echo $datacart[kd_cart] ?>";
				    }
				    function <?php echo "no".$no; ?>minus(){
				      if (count<?php echo $no; ?> > 1) {
				        count<?php echo $no; ?>--;
				        countE<?php echo $no; ?>.value = count<?php echo $no; ?>;
				        window.location = "<?php echo $base_url ?>/bin/cart.php?qty="+countE<?php echo $no; ?>.value+"&id=<?php echo $datacart[kd_cart] ?>";
				      }  
				    }
				</script>
				</form>
			  </td>
		      <td class="font-weight-bold text-right">Rp. <?php echo number_format($total); ?></td>
		      <td class="text-right">
		      	<a class="text-muted" data-toggle="modal"  href="#hapusmodal<?php echo ++$no1 ?>" role="button"><span class="fa fa-close ptooltip" data-toggle="tooltip" data-placement="top" title="Hapus"></span></a>
		      </td>
		      <div class="modal fade" id="hapusmodal<?php echo $no1 ?>" tabindex="-1" role="dialog" aria-labelledby="hapusmodallabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="hapusmodallabel">Yakin Ingin Menghapus ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">Pilih ya untuk menghapus isi cart  dengan nama barang <strong><?php echo ucwords($datacart[nama_barang]); ?></strong></div>
                  <div class="modal-footer">
                    <a class="btn btn-danger" href="<?php echo $base_url ?>/bin/hapus_cart.php?id=<?php echo $datacart[kd_cart] ?>">Ya</a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                  </div>
                </div>
              </div>
            </div>
		    </tr>
		    <?php } ?>
		  </tbody>
		</table>
	</div>
	<div class="col-lg-3 col-6">
		<table class="table table-responsive">
		  <thead class="bg-primary text-white">
		    <tr>
		      <th scope="col" colspan="2">SUB TOTAL</th>
		    </tr>
		  </thead>
		  <tbody class="bg-light">
		  	<tr>
		  		<td colspan="2">
		  			<p class="text-muted">Jasa Pengiriman : Go-Send</p>
		  			<p class="text-muted" style="font-size: 9px;">*Sub total belum termasuk biaya pengiriman Go-Send</p>
		  		</td>
		  	</tr>
		    <tr >
		      <td>Sub Total : </td>
		      <td class="font-weight-bold text-right">Rp. <?php echo number_format($subtotal); ?></td>
		    </tr>
		  </tbody>
		</table>
		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo $base_url; ?>" class="btn btn-secondary">Lanjutkan Belanja</a>
			</div>
			<div class="col-lg-6 text-lg-right mt-lg-0 mt-md-2 mt-2">
				<a href="<?php echo $base_url; ?>/jual-beli/checkout" class="btn btn-success">Checkout</a>
			</div>
		</div>
	</div>
	<?php } ?>
</div>