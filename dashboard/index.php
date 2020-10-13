<?php 
  include "./bin/koneksi.php";
  $pages=$_GET[page];
  $action=$_GET[action];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Jasa pembuatan aplikasi dan website banyuwangi">
    <meta name="author" content="">
    <meta name="keywords" content="pratama technocraft, jasa pembuatan aplikasi, jasa pembuatan website, banyuwangi, sunrise of java, website murah, aplikasi murah, software house">
    <link rel="icon" href="<?php echo $base_url; ?>/assets/images/logo.png" >
    
    <title><?php if(isset($pages)){ echo ucwords(str_replace("-"," ", $pages))." | Bengkel Ikan"; }else{  echo "Dashboard".$data_user[level_user]." | Bengkel Ikan"; } ?></title>

    <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/assets/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/assets/css/animate.css">
    <!-- Page level plugin CSS-->
    <link href="<?php echo $base_url; ?>/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->

     <link href="<?php echo $base_url; ?>/plugins/select2/select2.min.css" rel="stylesheet">

    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo $base_url; ?>/assets/css/sb-admin.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <style type="text/css">
      body{
        font-family: 'Josefin Sans', sans-serif;
      }
      .btn{
        margin-bottom: 10px;
      }
      .table-responsive{
        overflow-y: hidden;
      }
    </style>
  </head>
  <body <?php if ($_SESSION[loginadmin]) { ?> class="fixed-nav sticky-footer bg-dark" id="page-top" <?php } ?>>
<?php 
	if ($_SESSION[loginadmin]) {
		include "./pages/home.php";
	}else{
    if ($pages=="daftar-seller") {
      include "./pages/daftar-seller.php";
    }elseif ($pages=="lupa-password"){
      if ($action=="reset-password") {
        include "pages/reset-password.php";
      }else{ 
        include "pages/lupa-password.php";
      }
    }else{
      include "./pages/masuk.php";
    }
	}
?>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="<?php echo $base_url; ?>/plugins/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/js/vendor/popper.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/js/vendor/holder.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/js/vendor/wow.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="<?php echo $base_url; ?>/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo $base_url; ?>/plugins/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo $base_url; ?>/assets/js/vendor/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="<?php echo $base_url; ?>/assets/js/vendor/sb-admin-datatables.min.js"></script>
    <script src="<?php echo $base_url; ?>/plugins/select2/select2.full.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1//js/froala_editor.pkgd.min.js"></script>
    <script type="text/javascript" src="<?php echo $base_url ?>/assets/js/custom.min.js"></script>
    
    <script type="text/javascript">
      var url = "<?php echo $base_url."/dashboard" ?>";
      $(function () {
        $('.ptooltip').tooltip();
        $('[data-plugin="datatables"]').DataTable();
        $('[data-plugin="select2"]').select2();
        $('#wysiwyg').froalaEditor({
        // Set the file upload URL.
          imageUploadURL: url+'/upload_image.php',
   
          imageUploadParams: {
            id: 'my_editor'
          },
          heightMin: 200
        });
        $('#wysiwyg1').froalaEditor({
        // Set the file upload URL.
          imageUploadURL: url+'/upload_image.php',
   
          imageUploadParams: {
            id: 'my_editor'
          },
          heightMin: 200
        })
      });
    </script>
    <script type="text/javascript">
      var base_url = "<?php echo $base_url ?>";
      $(document).ready(function(){ 
        $("#loading").hide();
        <?php if($data_user[kabupaten]==""){ ?>
          $(".pilih-kabupaten-dashboard").hide();
          $(".label-kab").hide();
        <?php } ?>
        <?php if($data_user[kecamatan]==""){ ?>
          $(".pilih-kecamatan-dashboard").hide();
          $(".label-kec").hide();
        <?php } ?>
        <?php if($data_user[desa]==""){ ?>
          $(".pilih-kelurahan-dashboard").hide();
          $(".label-kel").hide();
        <?php } ?>
        $(".pilih-propinsi-dashboard").change(function(){  
          $("#loading").show(); 
          $.ajax({
            type: "POST", 
            url: base_url+"/dashboard/pages/user/modul/kabupaten.php", 
            data: {provinsi : $(".pilih-propinsi-dashboard").val()}, 
            dataType: "json",
            beforeSend: function(e) {
              if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
              }
            },
            success: function(response){ 
              setTimeout(function(){
                $('[data-plugin="select3"]').select2();
                $("#loading").hide(); 
                $(".label-kab").show();
                $(".pilih-kabupaten-dashboard").html(response.data_kota).show();
              }, 3000);
            },
            error: function (xhr, ajaxOptions, thrownError) { 
              alert(thrownError); 
            }
          });
        });

        $(".pilih-kabupaten-dashboard").change(function(){  
          $("#loading").show(); 
          $.ajax({
            type: "POST", 
            url: base_url+"/dashboard/pages/user/modul/kecamatan.php", 
            data: {kabupaten : $(".pilih-kabupaten-dashboard").val()}, 
            dataType: "json",
            beforeSend: function(e) {
              if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
              }
            },
            success: function(response){ 
              setTimeout(function(){
                $('[data-plugin="select4"]').select2();
                $("#loading").hide(); 
                $(".label-kec").show();
                $(".pilih-kecamatan-dashboard").html(response.data_kec).show();
              }, 3000);
            },
            error: function (xhr, ajaxOptions, thrownError) { 
              alert(thrownError); 
            }
          });
        });

        $(".pilih-kecamatan-dashboard").change(function(){  
          $("#loading").show(); 
          $.ajax({
            type: "POST", 
            url: base_url+"/dashboard/pages/user/modul/kelurahan.php", 
            data: {kecamatan : $(".pilih-kecamatan-dashboard").val()}, 
            dataType: "json",
            beforeSend: function(e) {
              if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
              }
            },
            success: function(response){ 
              setTimeout(function(){
                $('[data-plugin="select5"]').select2();
                $("#loading").hide(); 
                $(".label-kel").show();
                $(".pilih-kelurahan-dashboard").html(response.data_desa).show();
              }, 3000);
            },
            error: function (xhr, ajaxOptions, thrownError) { 
              alert(thrownError); 
            }
          });
        });
      });
    </script>
  </body>
</html>