<?php 
    include "../../../bin/koneksi.php";
?> 
<div class="row mb-5">
  	<div class="col-lg-3">
  		<div class="form-group">
  			<label>Pilih Ikan*</label>
			<select name="ikan1" class="form-control pilih-ikan1" data-plugin="select2" id="select1">
	        	<option value="">--Pilih Ikan--</option>
		      		<?php
		          		$sql_ikan = mysqli_query($conn, "SELECT * FROM ikan WHERE kd_jenis_ikan='$_POST[kdjenisikan]'");
		          		while($data_ikan=mysqli_fetch_array($sql_ikan)){
		          			$sql_budidaya=mysqli_query($conn, "SELECT * FROM budidaya_ikan where kd_ikan='$data_ikan[kd_ikan]'");
		      		?>
		          		<option <?php if(mysqli_num_rows($sql_budidaya)==0){ echo "disabled"; } ?> value="<?php echo $data_ikan['kd_ikan'] ?>"><?php echo ucwords($data_ikan['nama_ikan']) ?> <?php if(mysqli_num_rows($sql_budidaya)==0){ echo "( Belum Terdata )"; } ?></option>
		      		<?php } ?>
	    	</select>
	    </div>
	</div>
</div>
<div class="tempat-budidaya">
	<?php include ("budidaya-empty.php") ?>
</div> 


<!-- JAVA SCRIPT -->
<script src="<?php echo $base_url; ?>/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
  	$(function () {
      	$("#select1").select2();
      	$("#select2").select2();
  	});
</script>
<script type="text/javascript">
	var base_url = "<?php echo $base_url ?>";
   	$(document).ready(function(){
	    $(".pilih-ikan1").change(function(){
	        var strcari = $(".pilih-ikan1").val();
	        if(strcari != ""){
	            setTimeout(function(){
	                $.ajax({
	                    type:"post",
	                    url:base_url+"/pages/user/modul/budidaya.php",
	                    data:"kdikan="+ strcari,
	                    success: function(data){
	                        $(".tempat-budidaya").html(data);
	                    }
	                });
	            });
	        }else{
	            setTimeout(function(){
	                $.ajax({
	                    url:base_url+"/pages/user/modul/budidaya-empty.php",
	                    success: function(data){
	                        $(".tempat-budidaya").html(data);
	                    },
	                });
	            });
	        }
	    });
	});
</script>