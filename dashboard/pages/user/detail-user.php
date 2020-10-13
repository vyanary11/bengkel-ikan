<?php 
	$sql=mysqli_query($conn, "SELECT * FROM user left join kabupaten on user.kabupaten=kabupaten.kodeKabKota left join propinsi on user.provinsi=propinsi.kodePropinsi left join kecamatan on user.kecamatan=kecamatan.kodeKecamatan left join kelurahan on user.desa=kelurahan.kodeKelurahan where kd_user='$_GET[id]'");
	$data=mysqli_fetch_assoc($sql);
?>
<div class="row mb-3" >
	<div class="col-lg-4">
		<div class="card">
			<img src="<?php echo $base_url ?>/assets/images/user/<?php echo $data[fp] ?>" class="card-img-top img-fluid">
			<div class="card-body text-center">
				<h2 class="h2"><?php echo ucwords($data[nama_lengkap]); ?></h2>
				<i class="text-muted">Level User : <?php echo $data[level_user]; ?></i>
			</div>
		</div>
	</div>
<div class="col-lg-8">
	<div class="card">
		<div class="card-body">
			<h3 class="h3 mb-2">Data Diri</h3>
			<table cellpadding="10">
				<tr>
					<td>Nama Lengkap</td>
					<td>:</td>
					<td><?php echo ucwords($data[nama_lengkap]); ?></td>
				</tr>
				<tr>
					<td>Tanggal Lahir</td>
					<td>:</td>
					<td><?php echo date("d F Y", strtotime($data[tanggal_lahir])); ?></td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td>:</td>
					<td><?php echo $data[jenis_kelamin]; ?></td>
				</tr>
				<tr>
					<td>Bio</td>
					<td>:</td>
					<td><?php echo $data[bio]; ?></td>
				</tr>
				<tr>
					<td>Member Sejak</td>
					<td>:</td>
					<td><?php echo date("d F Y", strtotime($data[tgl_daftar])); ?></td>
				</tr>
			</table>
			<h3 class="h3 mt-4 mb-2">Data Kontak</h3>
			<table cellpadding="10">
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><?php echo $data[email]; ?></td>
				</tr>
				<tr>
					<td>Nomor Telepon</td>
					<td>:</td>
					<td><?php echo $data[no_telp]; ?></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td>
						<?php 
				    		echo 
					    		$data[alamat]." Desa ".$data[namaKelurahan]."</br> ".$data[namaKecamatan].", ".$data[namaKabKota].", ".$data[namaPropinsi]; 
			    		?>
				    			
				    </td>
				</tr>
			</table>
		</div>
	</div>
</div>