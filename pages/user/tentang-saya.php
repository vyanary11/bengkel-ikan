<?php 
	if ($_GET[msg]=="gagalpasssalah") {
		?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
			<h3><span class="fa fa-times-circle"></span> Maaf, Password yang anda masukkan salah</h3>
			Pastikan password yang anda masukkan benar
		</div>
		<?php
	}elseif ($_GET[msg]=="berhasilubahfoto") {
		?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
			<h3><span class="fa fa-check-circle"></span> Berhasil Mengganti Foto</h3>
		</div>
		<?php
	}elseif ($_GET[msg]=="berhasilubahprofil") {
		?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
			<h3><span class="fa fa-check-circle"></span> Anda Berhasil Mengubah data diri / profil anda</h3>
		</div>
		<?php
	}elseif ($_GET[msg]=="berhasilubahpass") {
		?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
			<h3><span class="fa fa-check-circle"></span> Anda Berhasil Mengubah Password Anda</h3>
			Simpan baik - baik password anda.
		</div>
		<?php
	}elseif ($_GET[msg]=="gagalpasstidaksama") {
		?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
			<h3><span class="fa fa-exclamation-circle"></span> Maaf, ulangi password baru anda tidak sama</h3>
			Pastikan anda memasukkannya dengan benar
		</div>
		<?php
	}
?>
<h3>Tentang Saya
<?php if($data[kd_user]==$_SESSION[loginuser] ){ ?> 
	<a data-toggle="modal" href="#ubahpass" class="float-right ml-2"> Ubah Password</a><span class="float-right">|</span><a data-toggle="modal" href="#ubahprofil" class="float-right mr-2">Edit Profil</a>
<?php } ?>
</h3>
<div class="card rounded-0 px-5 py-3">
	<?php if($data[kd_user]!=$_SESSION[loginuser] ){ }?>

	<table cellpadding="10">
		<thead>
			<tr>
				<td class="text-muted">Nama</td>
				<td>:</td>
				<td><?php echo $data[nama_lengkap]; ?></td>
			</tr>
			<tr>
				<td class="text-muted">Email</td>
				<td>:</td>
				<td><?php echo $data[email]; ?></td>
			</tr>
			<tr>
				<td class="text-muted">Member Sejak</td>
				<td>:</td>
				<td><?php echo date("d F Y", strtotime($data['tgl_daftar'])) ?></td>
			</tr>
			<tr>
				<td class="text-muted">Tanggal Lahir</td>
				<td>:</td>
				<td><?php echo date("d F Y", strtotime($data['tanggal_lahir'])) ?></td>
			</tr>
			<tr>
				<td class="text-muted">Jenis Kelamin</td>
				<td>:</td>
				<td><?php echo $data[jenis_kelamin]; ?></td>
			</tr>
			<tr>
				<td class="text-muted">No.Telepon</td>
				<td>:</td>
				<td><?php echo $data[no_telp]; ?></td>
			</tr>
			<tr>
				<td class="text-muted">Alamat</td>
				<td>:</td>
				<td><?php echo $data[alamat]." - ".$data[namaKelurahan].", ".$data[namaKecamatan].", ".$data[namaKabKota].", ".$data[namaPropinsi]; ?></td>
			</tr>
		</thead>
	</table>
</div>