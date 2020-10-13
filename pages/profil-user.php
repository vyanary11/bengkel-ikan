<?php	 
	$sql=mysqli_query($conn, "SELECT * FROM user left join kabupaten on user.kabupaten=kabupaten.kodeKabKota left join propinsi on user.provinsi=propinsi.kodePropinsi left join kecamatan on user.kecamatan=kecamatan.kodeKecamatan left join kelurahan on user.desa=kelurahan.kodeKelurahan WHERE kd_user='$_GET[kd_user]' and level_user!='admin'");
	$data=mysqli_fetch_assoc($sql);
?>
<div class="row mt-5 mb-3">
	<div class="col-lg-12">
		<nav aria-label="breadcrumb" role="navigation">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
		    <li class="breadcrumb-item"><a href="#">User</a></li>
		    <li class="breadcrumb-item active" aria-current="page">
		    	<?php 
		    		if($data[kd_user]==$_SESSION[loginuser]){ 
		    			echo ucwords(str_replace("-", " ",$_GET[action]));
		    		}else{ 
		    			if($_GET[action]=="akun"){ 
		    				echo "Tentang Saya"; 
		    			}else{ 
		    				echo ucwords(str_replace("-", " ",$_GET[action])); 
		    			} 
		    		} 
		    	?>
		    </li>
		    <?php if($_GET[action]=="detail-pesanan"){ ?>
		    <li class="breadcrumb-item active" aria-current="page"><?php echo $_GET[id]; ?></li>
		    <?php } ?>
		  </ol>
		</nav>
	</div>
</div>
<?php 
	if (mysqli_num_rows($sql)<1) {
?>
<div class="row mb-5">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body text-center">
			    <h5>Maaf, User tidak terdaftar</h5>
		  	</div>
		</div>
	</div>
</div>
<?php
	}else{
?>
<div class="row mb-5">
	<div class="col-lg-3">
		<div class="card">
			<div class="row">
				<div class="col-lg-12">
					<div class="fp-setting">
					  	<img class="card-img-top img-fluid" src="<?php echo $base_url; ?>/assets/images/user/<?php echo $data[fp]; ?>" alt="Card image cap">
					  	<?php if($data[kd_user]==$_SESSION[loginuser]){ ?>
					  	<div class="fp-setting-blur" data-toggle="modal" data-target="#gantifoto">Ganti Foto</div>
					  	<?php } ?>
				  	</div>
				</div>
			</div>
		  	<div class="card-body">
		    	<h4 class="card-title" style="min-height: 0px;"><?php echo ucwords($data[nama_lengkap]); ?></h4>
		    	<p class="card-text">Tipe Akun : <?php echo $data[level_user]; ?></p>
		    	<p class="card-text text-muted font-italic">"<?php if($data[bio]==""){ echo "Agan ini masih malu-malu nyeritain tentang dirinya."; }else{ echo $data[bio]; } ?>"</p>
		  	</div>
		  	<ul class="list-group list-group-flush">
		  		<?php if($data[kd_user]==$_SESSION[loginuser] ){ ?>
			    	<a href="<?php echo $base_url ?>/user/akun/<?php echo $data[kd_user] ?>" class="list-group-item list-group-item-action <?php if($action=="akun"){ echo "active"; } ?>"><span class="fa fa-smile-o"></span> Panel Akun</a>
			    	<a href="<?php echo $base_url ?>/user/pesanan/<?php echo $data[kd_user] ?>" class="list-group-item list-group-item-action <?php if($action=="pesanan" or $action=="detail-pesanan"){ echo "active"; } ?>"><span class="fa fa-archive"></span> Pesanan Saya <span class="badge badge-success float-right"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders WHERE kd_user='$_GET[kd_user]'")); ?></span></a>
			    	<a href="<?php echo $base_url ?>/user/threads/<?php echo $data[kd_user] ?>" class="list-group-item list-group-item-action <?php if($action=="threads"){ echo "active"; } ?>"><span class="fa fa-pencil-square-o"></span> Threads Saya <span class="badge badge-success float-right"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM threads WHERE kd_user='$_GET[kd_user]'")); ?></span></a>
			    	<a href="<?php echo $base_url ?>/user/tentang-saya/<?php echo $data[kd_user] ?>" class="list-group-item list-group-item-action <?php if($action=="tentang-saya"){ echo "active"; } ?>"><span class="fa fa-user"></span> Tentang Saya</a>
			    	<a href="<?php echo $base_url ?>/user/konfirmasi/<?php echo $data[kd_user] ?>" class="list-group-item list-group-item-action <?php if($action=="konfirmasi"){ echo "active"; } ?>"><span class="fa fa-check-square-o"></span> Konfirmasi Pembayaran</a>
			    	<a href="<?php echo $base_url ?>/dashboard/daftar-seller" class="list-group-item list-group-item-action"><span class="fa fa-odnoklassniki"></span> Menjadi Seller</a>
			    <?php }else{ ?>
			    	<a href="<?php echo $base_url ?>/user/tentang-saya/<?php echo $data[kd_user] ?>" class="list-group-item list-group-item-action <?php if($action=="tentang-saya" or $action=="akun"){ echo "active"; } ?>"><span class="fa fa-user"></span> Tentang Saya</a>
			    	<?php if ($data[level_user]=="seller") { ?>
			    		<a href="<?php echo $base_url ?>/user/catalog/<?php echo $data[kd_user] ?>" class="list-group-item list-group-item-action <?php if($action=="catalog"){ echo "active"; } ?>"><span class="fa fa-shopping-basket"></span> Jual Beli / Catalog<span class="badge badge-success float-right"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM barang WHERE kd_user='$_GET[kd_user]'")); ?></span></a>
			    	<?php } else { ?>
			    		<a href="<?php echo $base_url ?>/user/threads/<?php echo $data[kd_user] ?>" class="list-group-item list-group-item-action <?php if($action=="threads"){ echo "active"; } ?>"><span class="fa fa-pencil-square-o"></span> Theards<span class="badge badge-success float-right"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM threads WHERE kd_user='$_GET[kd_user]'")); ?></span></a>
			    	<?php } ?>
			    <?php } ?>
		  	</ul>
		</div>
	</div>	
	<div class="col-lg-9 bg-white p-4 border border-gray">
		<?php
			if($data[kd_user]!=$_SESSION[loginuser] and $data[level_user]=="user"){
				if ($action=="tentang-saya") {
	            	include "pages/user/tentang-saya.php";
	          	}elseif ($action=="threads") {
	            	include "pages/user/threads.php";
	          	}else{
	          		include "pages/user/tentang-saya.php";
	          	}
	        }elseif($data[kd_user]!=$_SESSION[loginuser] and $data[level_user]=="seller"){
	        	if ($action=="tentang-saya") {
	            	include "pages/user/tentang-saya.php";
	          	}elseif ($action=="catalog") {
	            	include "pages/user/catalog.php";
	          	}else{
	          		include "pages/user/tentang-saya.php";
	          	}
	        }else{
	        	if ($action=="pesanan") {
	          		include "pages/user/list-pesanan.php";
	    	    }elseif ($action=="detail-pesanan") {
	            	include "pages/user/detail-pesanan.php";
	          	}elseif ($action=="tentang-saya") {
	            	include "pages/user/tentang-saya.php";
	          	}elseif ($action=="threads") {
	            	include "pages/user/threads.php";
	          	}elseif ($action=="konfirmasi") {
	            	include "pages/user/konfirmasi.php";
	          	}else{ ?>
					<h3>Panel Akun
					<?php if($data[kd_user]==$_SESSION[loginuser] ){ ?>
						<a data-toggle="modal" href="#ubahpass" class="float-right ml-2"> Ubah Password</a><span class="float-right">|</span><a data-toggle="modal" href="#ubahprofil" class="float-right mr-2">Edit Profil</a>
					<?php } ?>
					</h3>
					<div class="card">
					  	<div class="card-body">
						    <h5>Tentang Saya</h5>
					    	<p class="card-text">
					    		<?php 
						    		echo 
							    		$data[nama_lengkap].
							    		"<br>".$data[email].
							    		"<br>".$data[alamat]." - ".$data[namaKelurahan].", ".$data[namaKecamatan].", ".$data[namaKabKota].", ".$data[namaPropinsi].
							    		"<br>".$data[no_telp]; 
					    		?>
					    	</p>
					  	</div>
					</div>
					<h3 class="mt-5 mb-3">Pesanan Saya</h3>
					<?php 
					  $sql_pesanan=mysqli_query($conn, "SELECT kd_order, tgl_order,status_pembayaran FROM orders WHERE kd_user='$_SESSION[loginuser]' order by tgl_order DESC LIMIT 3");
					if (mysqli_num_rows($sql_pesanan)==0) {
					?>
					<div class="row mb-5 justify-content-center">
					  <div class="col-lg-8 text-center alert alert-danger">
					    Pesanan Anda Kosong </br>Ingin Belanja sesuatu<a href="<?php echo $base_url ?>/jual-beli" class="alert-link"> Klik disini.</a>
					  </div>
					</div>
					<?php }else{ ?>
					<div id="accordion" role="tablist">
					  <?php while ($data_pesanan=mysqli_fetch_assoc($sql_pesanan)) { ?>
					  <?php ++$counter; ?>
					  <div class="card mb-3">
					    <div class="card-header bg-light" role="tab" id="heading<?php echo $counter ?>">
					      <div class="row align-items-center">
					        <div class="col-1">
					          <h5 class="mb-0">
					            <a data-toggle="collapse" href="#collapse<?php echo $counter ?>" aria-expanded="true" aria-controls="collapse<?php echo $counter ?>"><span class="fa fa-bars"></span></a>
					          </h5>
					        </div>
					        <div class="col-8">
					          Pesanan <a href="" class="card-link">#<?php echo $data_pesanan[kd_order]; ?></a></br>
					          Di pesan pada : <?php echo date("d/m/Y", strtotime($data_pesanan[tgl_order])); ?>
					        </div>
					        <div class="col-3">
					          <a href="<?php echo $base_url ?>/user/detail-pesanan=<?php echo $data_pesanan[kd_order] ?>/<?php echo $_GET[kd_user] ?>" class="card-link">DETAIL PESANAN</a>
					        </div>
					      </div>
					    </div>
					    <div id="collapse<?php echo $counter ?>" class="collapse <?php if($counter==1){echo"show";} ?>" role="tabpanel" aria-labelledby="heading<?php echo $counter ?>" data-parent="#accordion">
					      <div class="card-body">
					        <?php 
					          $sql_barang_pesanan=mysqli_query($conn, "SELECT * FROM detail_order left join barang on barang.kd_barang=detail_order.kd_barang WHERE kd_order='$data_pesanan[kd_order]' ");
					          while($data_barang_pesanan=mysqli_fetch_assoc($sql_barang_pesanan)){
					        ?>
					        <div class="media">
					          <img class="mr-3 img-fluid img-thumbnail w-25" src="<?php echo $base_url ?>/assets/images/barang/<?php echo $data_barang_pesanan[gambar_barang] ?>" alt="Generic placeholder image">
					          <div class="media-body">
					            <a href="" class="btn-link"><h5 class="mt-0"><?php echo ucwords($data_barang_pesanan[nama_barang]); ?></h5></a>
					            <h5>
					            <?php
					              $tgl_sekarang=time();
					              $tgl_order_berakhir=strtotime('+12 hours', strtotime($data_pesanan[tgl_order]));  
					              if ($data_pesanan[status_pembayaran]=="n" and $tgl_sekarang>$tgl_order_berakhir) {
					                echo "<span class='badge badge-danger'>Dibatalkan</span>";
					              }elseif ($data_pesanan[status_pembayaran]=="n" and $tgl_sekarang<$tgl_order_berakhir) {
					                echo "<span class='badge badge-warning'>Menunggu Konfirmasi</span>";
					              }else{
					                if ($data_barang_pesanan[status]=="p") {
					                  echo "<span class='badge badge-info p-2'>Sedang diproses</span>";
					                }elseif ($data_barang_pesanan[status]=="d") {
					                  echo "<span class='badge badge-primary p-2'>Telah dikirim</span>";
					                }elseif ($data_barang_pesanan[status]=="t") {
					                  echo "<span class='badge badge-success p-2'>Telah diterima</span>";
					                }elseif ($data_barang_pesanan[status]=="b") {
					                  echo "<span class='badge badge-danger p-2'>Dibatalkan</span>";
					                }elseif($data_barang_pesanan[status]=="pt") {
					                  echo "<span class='badge badge-warning p-2'>Perlu Tindakan Seller</span>";
					                }
					              }
					            ?>
					            </h5>
					          </div>
					        </div>
					        <?php } ?>
					      </div>
					    </div>
					  </div>
					  <?php } ?>
					</div>
					<?php } ?>
	          	<?php }
	  		}
	  	?>
	</div>
</div>
<!-- modal -->
<div class="modal fade" id="gantifoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganti Foto Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo $base_url ?>/bin/user/edit_profil.php?kd_user=<?php echo $_SESSION[loginuser]; ?>" enctype="multipart/form-data" method="post">
      <div class="modal-body">
      	<div class="row justify-content-center">
      		<div class="col-lg-3">
      			<img class="card-img-top img-fluid mb-5" src="<?php echo $base_url; ?>/assets/images/user/<?php echo $data[fp]; ?>" alt="Card image cap" id="preview_fp">
      		</div>
      	</div>
      	<div class="row justify-content-center mb-3">
      		<div class="col-lg-6">
      			<label class="custom-file">
				  <input type="file" id="file2" required name="filefoto" accept="image/*"  onchange="tampilkanPreview(this,'preview_fp')" class="custom-file-input">
				  <span class="custom-file-control"></span>
				</label>
      		</div>
      	</div>
      	<label>Konfirmasi Perubahan</label>
		<input name="password1" type="password" class="form-control" placeholder="Masukkan password" style="width:60%" required>
      </div>
      <div class="modal-footer">
      	<button type="submit" name="simpan_foto" class="btn btn-primary">Simpan Perubahan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="ubahprofil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo $base_url ?>/bin/user/edit_profil.php?kd_user=<?php echo $_SESSION[loginuser]; ?>" enctype="multipart/form-data" method="post">
      <div class="modal-body">
      	<div class="row">
      		<div class="col-lg-12">
      			<div class="form-group">
				    <label for="nama">Nama Lengkap</label>
				    <input type="text" class="form-control" name="nama" id="nama" required placeholder="Masukkan Nama Lengkap" value="<?php echo $data[nama_lengkap] ?>">
				</div>
				<div class="form-group">
				    <label for="tgl-lahir">Tanggal Lahir</label>
				    <input type="date" class="form-control" name="tgl_lahir" id="tgl-lahir" value="<?php echo $data[tanggal_lahir];?>">
				</div>
				<div class="form-group">
					<label>Jenis Kelamin</label>
					<select name="jenis_kelamin" type="text" class="form-control">
                        <?php if($data['jenis_kelamin']=="Laki-Laki"){ ?>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        <?php }elseif($data['jenis_kelamin']=="Perempuan"){ ?>
                            <option value="Perempuan">Perempuan</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                        <?php }else{ ?>
                        	<option value="">--Pilih Jenis Kelamin--</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        <?php } ?>
                    </select>
				</div>
				<div class="form-group">
	                <label>Provinsi</label>
	                <select name="provinsi" data-plugin="select2" class="form-control pilih-propinsi-user" style="width: 100%">
	                    <option value="">--Pilih Provinsi--</option>
	                    <?php
	                        $sql_proponsi = mysqli_query($conn, "SELECT * FROM propinsi");
	                        while($data_propinsi=mysqli_fetch_array($sql_proponsi)){
	                    ?>
	                        <option <?php if($data['provinsi']==$data_propinsi['kodePropinsi']){ ?> selected=selected <?php } ?> value="<?php echo $data_propinsi['kodePropinsi'] ?>"><?php echo $data_propinsi['namaPropinsi'] ?></option>
	                    <?php } ?>
	                </select>
	            </div>
             	<div class="form-group">
	                <label class="label-kab">Kabupaten / Kota</label>
	                <select name="kabupaten" data-plugin="select<?php if($data[kabupaten]==""){echo 3;}else{echo 2;} ?>" class="form-control pilih-kabupaten-user" style="width: 100%;">
	                    <option value="">- Pilih Kabupaten -</option>
	                    <?php if($data['kabupaten']!=""){ 
	                      $sql_kabupaten = mysqli_query($conn, "SELECT * from kabupaten where kodeKabKota='$data[kabupaten]'");
	                      while($data_kabupaten=mysqli_fetch_array($sql_kabupaten)){
	                    ?>
	                      <option <?php if($data['kabupaten']==$data_kabupaten['kodeKabKota']){ ?> selected=selected <?php } ?> value="<?php echo $data_kabupaten['kodeKabKota'] ?>"><?php echo $data_kabupaten['namaKabKota'] ?></option>
	                    <?php } } ?>
	                </select>
	            </div>
              	<div class="form-group">
	                <label class="label-kec">Kecamatan</label>
	                <select name="kecamatan" data-plugin="select<?php if($data[kecamatan]==""){echo 4;}else{echo 2;} ?>" class="form-control pilih-kecamatan-user" style="width: 100%;">
	                    <option value="">- Pilih Kecamatan -</option>
	                    <?php if($data['kecamatan']!=""){ 
	                      $sql_kecamatan = mysqli_query($conn, "SELECT * from kecamatan where kodeKecamatan='$data[kecamatan]'");
	                      while($data_kecamatan=mysqli_fetch_array($sql_kecamatan)){
	                    ?>
	                      <option <?php if($data['kecamatan']==$data_kecamatan['kodeKecamatan']){ ?> selected=selected <?php } ?> value="<?php echo $data_kecamatan['kodeKecamatan'] ?>"><?php echo $data_kecamatan['namaKecamatan'] ?></option>
	                    <?php } } ?>
	                </select>
              	</div>
              	<div class="form-group">
	                <label class="label-kel">Desa / Kelurahan</label>
	                <select name="desa" data-plugin="select<?php if($data[desa]==""){echo 5;}else{echo 2;} ?>" class="form-control pilih-kelurahan-user" style="width: 100%;">
	                  <option value="">- Pilih Desa / Kelurahan -</option>
	                    <?php if($data['desa']!=""){
	                        $sql_kelurahan = mysqli_query($conn, "SELECT * from kelurahan where kodeKelurahan='$data[desa]'");
	                        while($data_kelurahan=mysqli_fetch_array($sql_kelurahan)){
	                    ?>
	                        <option <?php if($data['desa']==$data_kelurahan['kodeKelurahan']){ ?> selected=selected <?php } ?> value="<?php echo $data_kelurahan['kodeKelurahan'] ?>"><?php echo $data_kelurahan['namaKelurahan'] ?></option>
	                    <?php } } ?>
	                </select>
              	</div>
              	<div id="loading" style="margin-top: 15px;">
                	<img src="<?php echo $base_url ?>/assets/images/loading.gif" width="18"> <small>Loading...</small>
              	</div>
                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <textarea name="alamat" required class="form-control" rows="3" placeholder="Alamat Lengkap"><?php echo $data['alamat'] ?></textarea>
                </div>
                <div class="form-group">
				    <label for="no_telp">No Telpon</label>
				    <input type="text" class="form-control" name="no_telp" id="no_telp" required value="<?php echo $data[no_telp] ?>" placeholder="Masukkan No. Telpon">
				</div>
				<div class="form-group">
                    <label>Bio</label>
                    <textarea name="bio" required class="form-control" rows="3" placeholder="Masukkan Bio / Tentang Anda"><?php echo $data['bio'] ?></textarea>
                </div>
      		</div>
      	</div>
      	<div class="row mt-3">
      		<div class="col-lg-12">
      			<div class="form-group">
				  	<label>Konfirmasi Perubahan</label>
					<input name="password1" type="password" class="form-control" placeholder="Masukkan password" required>
				</div>
      		</div>
      	</div>
    </div>

      <div class="modal-footer">
      	<button type="submit" name="simpan_info" class="btn btn-primary">Simpan Perubahan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="ubahpass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo $base_url ?>/bin/user/edit_profil.php?kd_user=<?php echo $_SESSION[loginuser]; ?>" enctype="multipart/form-data" method="post">
      <div class="modal-body">
      	<div class="row">
      		<div class="col-lg-12">
      			<div class="form-group">
				    <label for="passbaru">Password Baru</label>
				    <input type="password" class="form-control" name="passbaru" id="passbaru" required placeholder="Masukkan Password Baru">
				  </div>
				  <div class="form-group">
				    <label for="ulangipassbaru">Ulangi Password Baru</label>
				    <input type="password" class="form-control" name="passbaru1" id="ulangipassbaru" required placeholder="Ulangi Password Baru">
				  </div>
				  <div class="form-group">
				  	<label>Konfirmasi Perubahan</label>
					<input name="password1" type="password" class="form-control" placeholder="Masukkan password lama" required>
				  </div>
      		</div>
      	</div>
      </div>
      <div class="modal-footer">
      	<button type="submit" name="simpan_pass" class="btn btn-primary">Simpan Perubahan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>