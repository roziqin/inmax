<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
@include('adminlte::layouts.partials.htmlheaderfront')
	
<body>
@include('adminlte::layouts.partials.header')
	<div class="container">
		<div class="wrapper">
			<div class="box-sect-content">
				<div class="sect-content-left">
					<h2>Tentang Kami</h2>
					<h4 class="custom"><a href="#tentang-inmax">Tentang INMAX Property</a></h4>
					<h4 class="custom"><a href="#tentang-tim">Tim Kami</a></h4>
				</div>
				<div class="sect-content-right">
					<h4 id="tentang-inmax">Tentang INMAX Property</h4>
					<p>
						INMAX Property dibuka dengan Soft Opening pada tanggal 4 Mei 2010, yang sekaligus menandai mulai beroperasinya kantor real estate ini.
					</p>
					<p>
						INMAX Property didirikan dengan sebuah visi untuk menjadi agen properti yang hadir untuk benar-benar melayani kebutuhan masyarakat di bidang informasi properti, dan memastikan standard layanan dan kejujuran yang tinggi bagi agen-agennya.
					</p>
					<p>
						Karena itu INMAX Property membawa misi untuk menjadi agen properti yang profesional, yang sanggup untuk membantu proses transaksi properti secara efisien dan transparan, serta berorientasi pada ide win-win solution.
						INMAX didirikan oleh agen-agen properti profesional yang telah berpengalaman dalam bidangnya. Pada tanggal 28 Juni 2011, INMAX resmi bergabung dalam Asosiasi Real Estate Broker Indonesia (AREBI).
					</p>
					<p>
						Supaya bisa memberikan pelayanan yang lebih baik lagi kepada masyarakat, INMAX membuka kantor cabangnya yang ke-2 di Malang, pada tanggal 9 Oktober 2013, yang bernama INMAX Harmony (dipimpin oleh Arie Siswanto). Kantor yang pertama sekarang bernama INMAX Premiere.
					</p>
					<hr class="custom-1">
					<h4 id="tentang-tim">Tim Kami</h4>
					<ul class="team">
						<li class="list-team">
							<img src="{{ asset('/img/danny-user.jpg') }}" class="user">
							<div class="content-team">
								<h4 class="name">Danny Tj.</h4>
								<h4 class="position">Co-Founder, Director</h4>
								<p>
									Berpengalaman selama lebih dari 4 tahun sebagai agen properti di salah satu agen properti nasional, sebelum memutuskan untuk mendirikan INMAX Property.
								</p>
								<p>
									Danny adalah seorang agen properti yang mengantongi Sertifikat Broker resmi yang diterbitkan oleh LSP, juga Sertifikat dari AREBI.
Saat ini menjabat sebagai INMAX Property Director.
								</p>
								<p>
									Personal sales blog : <a href="">www.INMAXProperty.blogspot.com</a>
								</p>
							</div>
						</li>
						<li class="list-team">
							<img src="{{ asset('/img/livvy-user.jpg') }}" class="user">
							<div class="content-team">
								<h4 class="name">Livvy (Alivia Prisca)</h4>
								<h4 class="position">Co-Founder, Principal</h4>
								<p>
									Berpengalaman selama hampir 5 tahun sebagai agen properti di salah satu agen properti nasional, sebelum memutuskan untuk mendirikan INMAX Property.
								</p>
								<p>
									Livvy adalah seorang agen properti bersertifikat (AREBI), merupakan rekan pendiri dan sekarang menjabat sebagai komisaris INMAX Property.
								</p>
							</div>
						</li>
						<li class="list-team">
							<img src="{{ asset('/img/endah-user.jpg') }}" class="user">
							<div class="content-team">
								<h4 class="name">Endah S.</h4>
								<h4 class="position">Principal</h4>
								<p>
									Berpengalaman selama 4 tahun sebagai agen properti terbaik di salah satu agen properti nasional, sebelum memutuskan bergabung di INMAX Property.
								</p>
								<p>
									Endah adalah seorang agen properti bersertifikat (AREBI), dan sekarang menjabat sebagai komisaris INMAX Property.
								</p>
							</div>
						</li>
					</ul>
				</div>
			</div>
			
		</div><!-- End Wrapper -->
	</div><!-- End Container -->

@include('adminlte::layouts.partials.footerfront')
<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
<script>
window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
]); ?>
</script>

<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<!-- Bootstrap slider -->
<script src="{{ asset('/plugins/bootstrap-slider/bootstrap-slider.js') }}"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
<script src="{{ asset('/js/custom.js') }}"></script>
</body>
</html>
