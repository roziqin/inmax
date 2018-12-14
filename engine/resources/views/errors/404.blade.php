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
                <div class="sect-content-center">
                    <h1>Mohon maaf, halaman yang Anda cari tidak ditemukan.</h1>
                    <h4>Mohon periksa kembali apakah alamat URL yang telah anda masukkan sudah benar.</h4>
                    <a href="{{url('')}}" class="button">Kembali ke Home</a>
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
