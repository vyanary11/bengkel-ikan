<?php
$emailuser=$data_user[email];
$namauser=$data_user[nama];
if ($data_user[level_user]=="seller") {
  $url_pass_baru='<a href="'.$base_url.'/dashboard/lupa-password/reset-password/kd_user='.$data_user[kd_user].'/kode_reset_password='.$data_user[kode_reset_password].'" class="btn btn-primary">Buat Password Baru</a>';
}else{
   $url_pass_baru='<a href="'.$base_url.'/lupa-password/reset-password/kd_user='.$data_user[kd_user].'/kode_reset_password='.$data_user[kode_reset_password].'" class="btn btn-primary">Buat Password Baru</a>';
}
$msg = '
<!DOCTYPE html>
<html>
<head>
  <title>Selamat datang di Bengkel Ikan</title>
  <style type="text/css">
    .media {display: -ms-flexbox;display: flex;-ms-flex-align: start;    align-items: flex-start;}.media-body {-ms-flex: 1;flex: 1;}.mt-0{margin-top:0!important}.mb-1{margin-bottom:0.25rem!important}.text-white{color:#fff!important}html{box-sizing:border-box;font-family:sans-serif;line-height:1.15;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;-ms-overflow-style:scrollbar;-webkit-tap-highlight-color:transparent}body{margin:0;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;font-size:1rem;font-weight:400;line-height:1.5;color:#212529;background-color:#fff}hr{box-sizing:content-box;height:0;overflow:visible}h1,h2,h3,h4,h5,h6{margin-top:0;margin-bottom:.5rem}p{margin-top:0;margin-bottom:1rem}ol,ul,dl{margin-top:0;margin-bottom:1rem}ol ol,ul ul,ol ul,ul ol{margin-bottom:0}b,strong{font-weight:bolder}img{vertical-align:middle;border-style:none}table{border-collapse:collapse}th{text-align:left}h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6{margin-bottom:.5rem;font-family:inherit;font-weight:500;line-height:1.1;color:inherit}h1,.h1{font-size:2.5rem}h2,.h2{font-size:2rem}h3,.h3{font-size:1.75rem}h4,.h4{font-size:1.5rem}h5,.h5{font-size:1.25rem}h6,.h6{font-size:1rem}hr{margin-top:1rem;margin-bottom:1rem;border:0;border-top:1px solid rgba(0,0,0,.1)}mark,.mark{padding:.2em;background-color:#fcf8e3}.list-unstyled{padding-left:0;list-style:none}.list-inline{padding-left:0;list-style:none}.list-inline-item{display:inline-block}.list-inline-item:not(:last-child){margin-right:5px}.img-fluid{max-width:100%;height:auto}.container{margin-right:auto;margin-left:auto;padding-right:15px;padding-left:15px;width:100%}@media (min-width:576px){.container{max-width:540px}}@media (min-width:768px){.container{max-width:720px}}@media (min-width:992px){.container{max-width:960px}}@media (min-width:1200px){.container{max-width:1140px}}.row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}.col-1,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-10,.col-11,.col-12{position:relative;width:100%;min-height:1px;padding-right:15px;padding-left:15px}.col-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}.col-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}.col-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}.col-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}.col-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}.col-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}.col-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}.table{width:100%;max-width:100%;margin-bottom:1rem;background-color:transparent}.table th,.table td{padding:.75rem;vertical-align:top;border-top:1px solid #e9ecef}.table thead th{vertical-align:bottom;border-bottom:2px solid #e9ecef}.table tbody + tbody{border-top:2px solid #e9ecef}.table .table{background-color:#fff}.table-sm th,.table-sm td{padding:.3rem}.table-striped tbody tr:nth-of-type(odd){background-color:rgba(0,0,0,.05)}.table-hover tbody tr:hover{background-color:rgba(0,0,0,.075)}@media (max-width:991px){.table-responsive{display:block;width:100%;overflow-x:auto;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive.table-bordered{border:0}}.btn{display:inline-block;font-weight:400;text-align:center;white-space:nowrap;vertical-align:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;border:1px solid transparent;padding:.5rem .75rem;font-size:1rem;line-height:1.25;border-radius:.25rem;transition:all 0.15s ease-in-out}.btn:focus,.btn:hover{text-decoration:none}.btn:focus,.btn.focus{outline:0;box-shadow:0 0 0 3px rgba(0,123,255,.25)}.btn-primary{color:#fff;background-color:#007bff;border-color:#007bff}.btn-primary:hover{color:#fff;background-color:#0069d9;border-color:#0062cc}.btn-primary:focus,.btn-primary.focus{box-shadow:0 0 0 3px rgba(0,123,255,.5)}.btn-primary.disabled,.btn-primary:disabled{background-color:#007bff;border-color:#007bff}.btn-primary:active,.btn-primary.active,.show>.btn-primary.dropdown-toggle{background-color:#0069d9;background-image:none;border-color:#0062cc}.card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem}.card-body{-ms-flex:1 1 auto;flex:1 1 auto;padding:1.25rem}.card-title{margin-bottom:.75rem}.card-text:last-child{margin-bottom:0}.card-header{padding:.75rem 1.25rem;margin-bottom:0;background-color:rgba(0,0,0,.03);border-bottom:1px solid rgba(0,0,0,.125)}.card-header:first-child{border-radius:calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0}.bg-primary{background-color:#007bff!important}a.bg-primary:focus,a.bg-primary:hover{background-color:#0062cc!important}.bg-secondary{background-color:#868e96!important}a.bg-secondary:focus,a.bg-secondary:hover{background-color:#6c757d!important}.bg-light{background-color:#f8f9fa!important}a.bg-light:focus,a.bg-light:hover{background-color:#dae0e5!important}.bg-transparent{background-color:transparent!important}.border{border:1px solid #e9ecef!important}.border-top-0{border-top:0!important}.border-right-0{border-right:0!important}.border-bottom-0{border-bottom:0!important}.border-left-0{border-left:0!important}.border-secondary{border-color:#868e96!important}.border-light{border-color:#f8f9fa!important}.justify-content-center{-ms-flex-pack:center!important;justify-content:center!important}.w-25{width:25%!important}.w-50{width:50%!important}.m-3{margin:1rem!important}.mt-3{margin-top:1rem!important}.mr-3{margin-right:1rem!important}.mb-3{margin-bottom:1rem!important}.ml-3{margin-left:1rem!important}.mx-3{margin-right:1rem!important;margin-left:1rem!important}.my-3{margin-top:1rem!important;margin-bottom:1rem!important}.m-4{margin:1.5rem!important}.mt-4{margin-top:1.5rem!important}.mr-4{margin-right:1.5rem!important}.mb-4{margin-bottom:1.5rem!important}.ml-4{margin-left:1.5rem!important}.mx-4{margin-right:1.5rem!important;margin-left:1.5rem!important}.my-4{margin-top:1.5rem!important;margin-bottom:1.5rem!important}.m-5{margin:3rem!important}.mt-5{margin-top:3rem!important}.mr-5{margin-right:3rem!important}.mb-5{margin-bottom:3rem!important}.ml-5{margin-left:3rem!important}.mx-5{margin-right:3rem!important;margin-left:3rem!important}.my-5{margin-top:3rem!important;margin-bottom:3rem!important}.p-3{padding:1rem!important}.pt-3{padding-top:1rem!important}.pr-3{padding-right:1rem!important}.pb-3{padding-bottom:1rem!important}.pl-3{padding-left:1rem!important}.px-3{padding-right:1rem!important;padding-left:1rem!important}.py-3{padding-top:1rem!important;padding-bottom:1rem!important}.p-4{padding:1.5rem!important}.pt-4{padding-top:1.5rem!important}.pr-4{padding-right:1.5rem!important}.pb-4{padding-bottom:1.5rem!important}.pl-4{padding-left:1.5rem!important}.px-4{padding-right:1.5rem!important;padding-left:1.5rem!important}.py-4{padding-top:1.5rem!important;padding-bottom:1.5rem!important}.p-5{padding:3rem!important}.pt-5{padding-top:3rem!important}.pr-5{padding-right:3rem!important}.pb-5{padding-bottom:3rem!important}.pl-5{padding-left:3rem!important}.px-5{padding-right:3rem!important;padding-left:3rem!important}.py-5{padding-top:3rem!important;padding-bottom:3rem!important}.text-justify{text-align:justify!important}.text-left{text-align:left!important}.text-right{text-align:right!important}.text-center{text-align:center!important}.font-weight-bold{font-weight:700}.text-secondary{color:#868e96!important}a.text-secondary:focus,a.text-secondary:hover{color:#6c757d!important}.text-muted{color:#868e96!important}a{text-decoration:none}
  </style>
</head>
<body>
	<div class="container">
    <div class="row my-5">
      <div class="col-6" style="margin:0 auto;">
        <img src="'.$base_url.'/assets/images/brand.png" class="img-fluid w-50 mb-4">
        <div class="card border-bottom-0">
          <div class="card-header bg-primary text-white text-center" style="width:100%;">
              <h4 class="card-title">Buat Password Baru di Bengkel Ikan</h4>
          </div>
        </div>
        <div class="card border-top-0">
          <div class="card-body">
            <p class="card-text">Lupa password Anda? Jangan khawatir. Untuk membuat password baru, cukup klik tombol di bawah ini:</p>
             <div class="row justify-content-center">
               <div class="col-4">'.$url_pass_baru.'</div>
             </div>
             <p class="card-text mt-3 ">Anda mendapatkan email ini karena permintaan seorang pengguna di Bengkel Ikan. Hal ini merupakan prosedur yang kami terapkan untuk mengubah password. Jika Anda merasa tidak pernah melakukan permintaan pengubahan password, abaikan email ini dan password Anda tetap aman.</p>
             <p class="card-text mt-5">Salam sukses, <br> Tim Bengkel Ikan</p>
             <p class="card-text mt-3"><i>Copyright</i> &copy; 2017 BengkeIkan.com</p>
          </div>
        </div>
      </div>
    </div>
	</div>
</body>
</html>
';

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Asia/Jakarta');

if ($data_user[level_user]=="seller") {
  require '../../plugins/phpmailer/PHPMailerAutoload.php';
}else{
  require '../plugins/phpmailer/PHPMailerAutoload.php';
}

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "officialbengkelikan@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "bengkelikan11";

//Set who the message is to be sent from
$mail->setFrom('noreply-officialbengkelikan@gmail.com', 'Bengkel Ikan');

//Set an alternative reply-to address
$mail->addReplyTo('noreply-officialbengkelikan@gmail.com', 'Bengkel Ikan');

//Set who the message is to be sent to
$mail->addAddress($emailuser, $nama);

//Set the subject line
$mail->Subject = 'Lupa Password Anda di Bengkel Ikan ?';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($msg);

//Replace the plain text body with one created manually
//$mail->AltBody = 'scdsddsdsd';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  if ($data_user[level_user]=="seller") {
    ?>
      <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/dashboard/masuk/msg=koderesetpasswordterkirim">  
  <?php  
  }else{
  ?>
      <meta http-equiv="refresh" content="0; url=<?php echo $base_url; ?>/masuk/msg=koderesetpasswordterkirim">  
  <?php 
  }
}
?>