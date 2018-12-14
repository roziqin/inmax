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
					<h2>Referral Service</h2>
					<h4 class="custom"><a href="#cari-properti">Mencari Properti</a></h4>
					<h4 class="custom"><a href="#jual-sewa">Menjual/Menyewakan Properti</a></h4>
				</div>
				<div class="sect-content-right">
					<h4>Referral Service</h4>
					<p class="custom">
						Sebagai kantor properti yang berpusat di Malang, INMAX lebih memfokuskan pada pemasaran properti yang terletak di Malang dan sekitarnya.
					</p>
					<p class="custom">
						Namun, kami juga bisa membantu apabila Anda membutuhkan jasa pemasaran di kota lain. INMAX secara proaktif selalu menjalin hubungan dengan agen-agen properti di luar kota Malang.
					</p>
					<hr class="custom-1">

					<h4 class="custom-1" id="cari-properti">Jika Anda sedang mencari properti di kota lain</h4>
					<ul>
						<li>Agen INMAX akan membantu Anda untuk mencarikan informasi properti di kota tujuan, sesuai dengan kebutuhan Anda.</li>
						<li>Agen INMAX akan menghubungkan Anda dengan agen properti di kota tujuan, sehingga Anda sudah dapat memperoleh banyak informasi, bahkan pada saat Anda masih di kota Malang, atau kota tempat tinggal Anda.</li>
						<li>Agen INMAX akan memastikan supaya Anda memperoleh bantuan profesional dari seorang agen properti setempat di kota tujuan investasi Anda.</li>
						<li>Agen INMAX akan membantu proses permohonan KPR jika Anda memerlukan bantuan pendanaan dari Bank. Beberapa Bank memiliki jaringan nasional yang memungkinkan pengajuan KPR antarkota.</li>
						<li>Seluruh layanan di atas dapat Anda peroleh TANPA BIAYA APAPUN (bebas komisi).</li>
					</ul>

					<hr class="custom-1">

					<h4 class="custom-1" id="jual-sewa">Jika Anda hendak menjual atau menyewakan properti di kota lain</h4>
					<ul>
						<li>Agen INMAX akan menghubungi kantor rekanan yang terdekat dengan properti Anda, dan mengusahakan agen properti terbaik yang bisa membantu Anda.</li>
						<li>Agen INMAX akan mengirimkan informasi properti Anda ke agen propeti yang ditunjuk, sehingga Anda bahkan tidak perlu pergi ke kota yang bersangkutan untuk menjual properti Anda.</li>
						<li>Agen INMAX akan memantau perkembangan pemasaran properti Anda, dan menyampaikan laporan pemasaran dari agen properti yang melaksanakan pemasaran properti Anda.</li>
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
