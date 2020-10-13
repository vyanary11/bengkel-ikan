<nav class="nav nav-tabs" id="myTab" role="tablist">
	<li class="nav-item">
	    <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="true">User</a>
	</li>
	<li class="nav-item">
	    <a class="nav-link" id="Seller-tab" data-toggle="tab" href="#Seller" role="tab" aria-controls="Seller" aria-selected="false">Seller</a>
	</li>
	<li class="nav-item">
	    <a class="nav-link" id="Admin-tab" data-toggle="tab" href="#Admin" role="tab" aria-controls="Admin" aria-selected="false">Admin</a>
	</li>
</nav>
<div class="tab-content mb-5 border border-top-0 p-3 bg-white"  id="nav-tabContent">
	<div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="
	user-tab">
	    <div class="table-responsive" style="font-size: 14px">
	      <table class="table table-bordered" data-plugin="datatables" width="100%" cellspacing="0">
	        <thead class="bg-light">
	          <tr>
	            <th>No</th>
	            <th>Nama Lengkap</th>
	            <th>Email</th>
	            <th>Alamat</th>
	            <th>No. Telp</th>
	            <th>Status</th>
	            <th>Action</th>
	          </tr>
	        </thead>
	        <tbody>
	          <?php 
	            $sql_users=mysqli_query($conn, "SELECT * FROM user left join kabupaten on user.kabupaten=kabupaten.kodeKabKota left join propinsi on user.provinsi=propinsi.kodePropinsi left join kecamatan on user.kecamatan=kecamatan.kodeKecamatan left join kelurahan on user.desa=kelurahan.kodeKelurahan WHERE level_user='user' order by kd_user DESC");
	            while($data_users=mysqli_fetch_assoc($sql_users)){
	          ?>
	          <tr>
	            <td class="align-middle"><?php echo ++$no; ?></td>
	            <td class="align-middle"><?php echo ucwords($data_users[nama_lengkap]); ?></td>
	            <td class="align-middle"><?php echo $data_users[email]; ?></td>
	            <td class="align-middle">
	            	<p>
	            		<?php 
					    		echo 
						    		$data_users[alamat]." Desa ".$data_users[namaKelurahan]."</br> ".$data_users[namaKecamatan].", ".$data_users[namaKabKota].", ".$data_users[namaPropinsi]; 
				    		?>
	            	</p>
	            </td>
	            <td class="align-middle"><?php echo $data_users[no_telp] ?></td>
	            <td class="align-middle text-center">
	            	<?php if($data_users[kode_aktivasi]==0){ ?>
	            	<span class="badge badge-success">ACTIVE</span>
	            	<?php }else{ ?>
	            	<span class="badge badge-danger">NOT ACTIVE</span>
	            	<?php } ?>
	            </td>
	            <td class="align-middle text-center">
	              	<a class="btn btn-info" href="<?php echo $base_url ?>/dashboard/user/detail-user/id=<?php echo $data_users[kd_user] ?>" role="button"><span class="fa fa-eye ptooltip" data-toggle="tooltip" data-placement="top" title="Detail"></span></a>
	              	<a class="btn btn-danger" data-toggle="modal"  href="#hapusmodal<?php echo ++$counter1 ?>" role="button"><span class="fa fa-trash ptooltip" data-toggle="tooltip" data-placement="top" title="Hapus"></span></a>
	            </td>
	            <div class="modal fade" id="hapusmodal<?php echo $counter1 ?>" tabindex="-1" role="dialog" aria-labelledby="hapusmodallabel" aria-hidden="true">
	                <div class="modal-dialog" role="document">
	                  <div class="modal-content">
	                    <div class="modal-header">
	                      <h5 class="modal-title" id="hapusmodallabel">Yakin Ingin Menghapus ?</h5>
	                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">×</span>
	                      </button>
	                    </div>
	                    <div class="modal-body">Pilih ya untuk menghapus data user <strong><?php echo $data_users[email]; ?></strong></div>
	                    <div class="modal-footer">
	                      <a class="btn btn-danger" href="<?php echo $base_url; ?>/dashboard/bin/user/crud.php?id=<?php echo $data_users[kd_user] ?>">Ya</a>
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
	</div>
	<div class="tab-pane fade" id="Seller" role="tabpanel" aria-labelledby="Seller-tab">
	    <div class="table-responsive" style="font-size: 14px">
	      <table class="table table-bordered" data-plugin="datatables" width="100%" cellspacing="0">
	        <thead class="bg-light">
	          <tr>
	            <th>No</th>
	            <th>Nama Lengkap</th>
	            <th>Email</th>
	            <th>Alamat</th>
	            <th>No. Telp</th>
	            <th>Status</th>
	            <th>Action</th>
	          </tr>
	        </thead>
	        <tbody>
	          <?php 
	            $sql_seller=mysqli_query($conn, "SELECT * FROM user left join kabupaten on user.kabupaten=kabupaten.kodeKabKota left join propinsi on user.provinsi=propinsi.kodePropinsi left join kecamatan on user.kecamatan=kecamatan.kodeKecamatan left join kelurahan on user.desa=kelurahan.kodeKelurahan WHERE level_user='seller' order by kd_user DESC");
	            while($data_seller=mysqli_fetch_assoc($sql_seller)){
	          ?>
	          <tr>
	            <td class="align-middle"><?php echo ++$no1; ?></td>
	            <td class="align-middle"><?php echo ucwords($data_seller[nama_lengkap]); ?></td>
	            <td class="align-middle"><?php echo $data_seller[email]; ?></td>
	            <td class="align-middle">
	            	<p>
	            		<?php 
					    		echo 
						    		$data_seller[alamat]." Desa ".$data_seller[namaKelurahan]."</br> ".$data_seller[namaKecamatan].", ".$data_seller[namaKabKota].", ".$data_seller[namaPropinsi]; 
				    		?>
	            	</p>
	            </td>
	            <td class="align-middle"><?php echo $data_seller[no_telp] ?></td>
	             <td class="align-middle text-center">
	            	<?php if($data_seller[kode_aktivasi]==0){ ?>
	            	<span class="badge badge-success">ACTIVE</span>
	            	<?php }else{ ?>
	            	<span class="badge badge-danger">NOT ACTIVE</span>
	            	<?php } ?>
	            </td>
	            <td class="align-middle text-center">
	              	<a class="btn btn-info" href="<?php echo $base_url ?>/dashboard/user/detail-user/id=<?php echo $data_seller[kd_user] ?>" role="button"><span class="fa fa-eye ptooltip" data-toggle="tooltip" data-placement="top" title="Detail"></span></a>
	              	<a class="btn btn-danger" data-toggle="modal"  href="#hapussellermodal<?php echo ++$counter2 ?>" role="button"><span class="fa fa-trash ptooltip" data-toggle="tooltip" data-placement="top" title="Hapus"></span></a>
	            </td>
	            <div class="modal fade" id="hapussellermodal<?php echo $counter2 ?>" tabindex="-1" role="dialog" aria-labelledby="hapusmodallabel" aria-hidden="true">
	                <div class="modal-dialog" role="document">
	                  <div class="modal-content">
	                    <div class="modal-header">
	                      <h5 class="modal-title" id="hapusmodallabel">Yakin Ingin Menghapus ?</h5>
	                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">×</span>
	                      </button>
	                    </div>
	                    <div class="modal-body">Pilih ya untuk menghapus data seller <strong><?php echo $data_seller[email]; ?></strong></div>
	                    <div class="modal-footer">
	                      <a class="btn btn-danger" href="<?php echo $base_url; ?>/dashboard/bin/user/crud.php?id=<?php echo $data_seller[kd_user] ?>">Ya</a>
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
	</div>
	<div class="tab-pane fade" id="Admin" role="tabpanel" aria-labelledby="Admin-tab">
		<a href="<?php echo $base_url ?>/dashboard/user/tambah-admin" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah Admin</a>
	    <div class="table-responsive" style="font-size: 14px">
	      <table class="table table-bordered" data-plugin="datatables" width="100%" cellspacing="0">
	        <thead class="bg-light">
	          <tr>
	            <th>No</th>
	            <th>Nama Lengkap</th>
	            <th>Email</th>
	            <th>Alamat</th>
	            <th>No. Telp</th>
	            <th>Status</th>
	            <th>Action</th>
	          </tr>
	        </thead>
	        <tbody>
	          <?php 
	            $sql_admin=mysqli_query($conn, "SELECT * FROM user left join kabupaten on user.kabupaten=kabupaten.kodeKabKota left join propinsi on user.provinsi=propinsi.kodePropinsi left join kecamatan on user.kecamatan=kecamatan.kodeKecamatan left join kelurahan on user.desa=kelurahan.kodeKelurahan WHERE level_user='admin' and kd_user!='$_SESSION[loginadmin]' and email!='admin@bengkelikan.com' order by kd_user DESC");
	            while($data_admin=mysqli_fetch_assoc($sql_admin)){
	          ?>
	          <tr>
	            <td class="align-middle"><?php echo ++$no2; ?></td>
	            <td class="align-middle"><?php echo ucwords($data_admin[nama_lengkap]); ?></td>
	            <td class="align-middle"><?php echo $data_admin[email]; ?></td>
	            <td class="align-middle">
	            	<p>
	            		<?php 
					    		echo 
						    		$data_admin[alamat]." Desa ".$data_admin[namaKelurahan]."</br> ".$data_admin[namaKecamatan].", ".$data_admin[namaKabKota].", ".$data_admin[namaPropinsi]; 
				    		?>
	            	</p>
	            </td>
	            <td class="align-middle"><?php echo $data_admin[no_telp] ?></td>
	            <td class="align-middle text-center">
	            	<?php if($data_admin[kode_aktivasi]==0){ ?>
	            	<span class="badge badge-success">ACTIVE</span>
	            	<?php }else{ ?>
	            	<span class="badge badge-danger">NOT ACTIVE</span>
	            	<?php } ?>
	            </td>
	            <td class="align-middle text-center">
	              	<a class="btn btn-info" href="<?php echo $base_url ?>/dashboard/user/detail-user/id=<?php echo $data_admin[kd_user] ?>" role="button"><span class="fa fa-eye ptooltip" data-toggle="tooltip" data-placement="top" title="Detail"></span></a>
	              	<a class="btn btn-danger" data-toggle="modal"  href="#hapusadminmodal<?php echo ++$counter3 ?>" role="button"><span class="fa fa-trash ptooltip" data-toggle="tooltip" data-placement="top" title="Hapus"></span></a>
	            </td>
	            <div class="modal fade" id="hapusadminmodal<?php echo $counter3 ?>" tabindex="-1" role="dialog" aria-labelledby="hapusmodallabel" aria-hidden="true">
	                <div class="modal-dialog" role="document">
	                  <div class="modal-content">
	                    <div class="modal-header">
	                      <h5 class="modal-title" id="hapusmodallabel">Yakin Ingin Menghapus ?</h5>
	                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">×</span>
	                      </button>
	                    </div>
	                    <div class="modal-body">Pilih ya untuk menghapus data admin <strong><?php echo $data_admin[email]; ?></strong></div>
	                    <div class="modal-footer">
	                      <a class="btn btn-danger" href="<?php echo $base_url; ?>/dashboard/bin/user/crud.php?id=<?php echo $data_admin[kd_user] ?>">Ya</a>
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
	</div>
</div>