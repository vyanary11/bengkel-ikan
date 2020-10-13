<?php
    $query = mysqli_query($conn, "SELECT berita.tgl_post, berita.judul, berita.isi, berita.gambar_headline, berita.jumlah_view, user.nama_lengkap, berita.kd_kategori FROM berita left join user on user.kd_user=berita.kd_user WHERE berita.kd_berita='$_GET[id]'");
    $row=mysqli_fetch_array($query);
    mysqli_query($conn, "UPDATE berita SET jumlah_view=$row[jumlah_view]+1 WHERE kd_berita='$_GET[id]'");
?>
<div class="row mt-5 mb-3">
	<div class="col-lg-12">
		<nav aria-label="breadcrumb" role="navigation">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
		    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>/berita">Berita</a></li>
		    <li class="breadcrumb-item" ><a href="<?php echo $base_url; ?>/berita/<?php echo $_GET['kategori'] ?>"><?php echo str_replace("-", " ", $_GET['kategori']); ?></a></li>
		    <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords($row[judul]); ?></li>
		  </ol>
		</nav>
	</div>
</div>
<div class="card bg-white">
	<div class="card-body">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="h1"><?php echo ucwords($row["judul"]) ?></h1>
				<p class="text-muted">Oleh : <?php echo ucwords($row["nama_lengkap"]) ?> | <?php echo Tgl($row[tgl_post])?></p>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-12">
				<img class="card-img-top img-fluid" src="<?php echo $base_url; ?>/assets/images/berita/<?php echo $row ['gambar_headline'] ?>">
			</div>
			<div class="col-lg-12 mt-3 " style="overflow-x: hidden;">
				<p class="text-justify "><?php  echo $row [isi] ?></p>
			</div>
		</div>	
	</div>
</div>
<div class="card mt-3 mb-5">
	<div class="card-body">
		<div class="row m-3">
			<div class="col-lg-12">
				<div id="disqus_thread"></div>
			</div>
		</div>
	</div>
</div>
<h2>Artikel Terkait</h2>
<div class="row mb-5 mt-3">
	<?php 
		$sql_search_berita=mysqli_query($conn, "SELECT * FROM berita left join user on user.kd_user=berita.kd_user left join kategori on berita.kd_kategori=kategori.kd_kategori WHERE berita.kd_kategori='$row[kd_kategori]' and berita.kd_berita!='$_GET[id]' order by RAND() LIMIT 4");
		while($data_search_berita=mysqli_fetch_array($sql_search_berita)){ 
	?>
	<?php $nama_kategori=str_replace(" ","-",$data_search_berita[nama_kategori]); ?>
	<div class="col-lg-3 wow fadeInUp" data-wow-delay="<?php echo $delay+=0.5 ?>s">
		<div class="card mb-3">
			<div class="card-img-top gambar" style="background-image:url(<?php echo $base_url; ?>/assets/images/berita/<?php echo str_replace(" ", "%20", $data_search_berita[gambar_headline]) ?>);">
						&nbsp;
				</div>
			<div class="card-body">
				<h6 class="card-title text-center"><?php echo ucwords($data_search_berita[judul]) ?></h6>
				<a href="<?php echo $base_url.'/berita/'.$nama_kategori.'/'.$data_search_berita[judul_url].'-'.$data_search_berita[kd_berita].'.html' ?>" class="btn btn-primary"><span class="fa fa-eye"></span> Baca Selengkapnya</a>	
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<?php 
	$url=$base_url."/".$_GET[page]."/".$_GET[kategori]."/".$_GET[url]."-".$_GET[id].".html";
	$url1="/".$_GET[kategori]."/".$_GET[url]."-".$_GET[id].".html";
?>
<script>

    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

    var disqus_config = function () {
      this.page.url = "<?php echo $url; ?>";  // Replace PAGE_URL with your page's canonical URL variable
      this.page.identifier = "<?php echo $url1; ?>"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    (function() { // DON'T EDIT BELOW THIS LINE
      var d = document, s = d.createElement('script');
      s.src = 'https://bengkelikan.disqus.com/embed.js';
      s.setAttribute('data-timestamp', +new Date());
      (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>