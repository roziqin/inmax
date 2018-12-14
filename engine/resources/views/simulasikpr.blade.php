<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
@include('adminlte::layouts.partials.htmlheaderfront')
	
<body>
@include('adminlte::layouts.partials.header')
	<div class="container">
		<div class="box-header kpr">
			<div class="wrapper">
				<h1>Simulasi KPR</h1>
				<p>Jalankan simulasi Kredit Kepemilikan Rumah<br>(KPR) untuk solusi terbaik dalam mewujudkan<br>rumah impian Anda.</p>
				<span>*Syarat dan ketentuan berlaku</span>
			</div>
		</div>
		<div class="wrapper">
			<div class="box-sect-kpr">
				<div class="box-sect-kpr-left">
					<h2>Jalankan Simulasi KPR</h2>
					<div class="kpr">
		       			<div class="form-group">
							<div class="form-left">
								{{ Form::label('amount', 'Harga Property') }}
							</div>
							<div class="form-right">
                <div class="input-group">
                  <span class="input-group-addon">Rp. </span>
                  {{ Form::text('harga', '', array('class' => 'form-control', 'id' => 'harga', 'placeholder' => 'Masukan harga poperty')) }}
                  <input type="hidden" id="harga1" /></td>
                </div>
							</div>
						</div>
		       			<div class="form-group">
							<div class="form-left">
								{{ Form::label('pinjaman', 'Pinjaman') }}
							</div>
							<div class="form-right">
								<div class="input-group">
									<span class="input-group-addon">Rp. </span>
									{{ Form::text('pinjaman', '', array('class' => 'form-control', 'id' => 'pinjaman', 'placeholder' => 'Masukan jumlah pinjaman')) }}
									<input type="hidden" id="pinjaman_hidden" /></td>
								</div>

								<span style="display:none; background-color:red; color:white; padding-left:5px; padding-right:5px;" id="alert">Maksimal 80% dari Harga Property</span></td>
							</div>
						</div>
		       			<div class="form-group">
							<div class="form-left">
								{{ Form::label('uang_muka', 'Uang Muka') }}
							</div>
							<div class="form-right">
									<span id="uang_muka" class="uang-muka"></span>
							</div>
						</div>
		       			<div class="form-group">
							<div class="form-left">
								{{ Form::label('bunga', 'Bunga') }}
							</div>
							<div class="form-right">
								<div class="input-group">
									{{ Form::text('bunga', '', array('class' => 'form-control', 'id' => 'bunga', 'placeholder' => 'Masukan jumlah bunga')) }}
									<span class="input-group-addon"> % </span>
								</div>
							</div>
						</div>
		       			<div class="form-group">
							<div class="form-left">
								{{ Form::label('lama_pinjaman', 'Lama Pinjaman') }}
							</div>
							<div class="form-right">
								<div class="input-group">
									{{ Form::text('lama_pinjaman', '', array('class' => 'form-control', 'id' => 'lama_pinjaman', 'placeholder' => 'Masukan lama Pinjaman')) }}
									<span class="input-group-addon"> Th </span>
								</div>
							</div>
						</div>

						{{ Form::submit('Hitung Simulasi', array('class' => 'button btn-primary pull-right','id' => 'hitung')) }}


			    	</div>
			    	<hr>
			    	<h4>Perkiraan Cicilan/bln</h4>
			    	<span id="result"></span>
 
				</div>
				<div class="box-sect-kpr-right">
					<img src="{{ asset('/img/logo-inmax-putih-baru.png') }}">
					<h2>Temukan properti idaman anda</h2>
					<h1>Sekarang Juga</h1>
					<a href="" class="button">Cari Sekarang</a>
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


<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('/js/jquery.formatCurrency-1.4.0.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('/js/custom.js') }}"></script>
<script>


  $(function () {
  	jQuery(document).ready(function(){

    function validasiPersen(){
    
        var hargapropertine = jQuery("#amount1").val();
        var pinjamane = jQuery("#pinjaman").val();
        var persenan = 0.8*hargapropertine;
    
        if(pinjamane>persenan){
            alert = jQuery("#alert");
            jQuery("#pinjaman").css("background-color","red");
            jQuery("#hitung").css("display","none");
            alert.css("display","block");
        }else{
            alert.css("display","none");
            jQuery("#pinjaman").css("background-color","white");
            jQuery("#hitung").css("display","block");
        }
    }
    
    function PMT(i, n, p) {
        return i * p * Math.pow((1 + i), n) / (1 - Math.pow((1 + i), n));
    }

    function HitungUangMuka(){
        var hp = jQuery("#harga1").val();
        var p = jQuery("#pinjaman_hidden").val();
        var hasil = hp-p;
        //var num1 = 'Rp. ' + hasil.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        jQuery("#uang_muka").text(hasil);
        jQuery("#uang_muka").formatCurrency();
    }
    
    jQuery("#harga").focusout(function(){
        var hargaproperti = jQuery(this).val();
        jQuery("#harga1").val(hargaproperti);
        jQuery(this).formatCurrency();
    });

    jQuery("#harga").focus(function(){
        jQuery(this).val('');
        jQuery("#pinjaman").text('');
    });
    
    jQuery("#pinjaman").focus(function(){
        jQuery(this).val('');   
        jQuery("#uang_muka").text('');
    });

    jQuery("#pinjaman").focusout(function(){
        var pinjaman = jQuery(this).val();
        //var num1 = 'Rp. ' + pinjaman.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        jQuery("#pinjaman_hidden").val(pinjaman);
        jQuery(this).formatCurrency();
    });
    
    jQuery("#pinjaman").keyup(function(){
        validasiPersen();
    });
    
    jQuery("#bunga").focus(function(){
        jQuery(this).val('');
        HitungUangMuka();
    });
    
    jQuery("#lama_pinjaman").focus(function(){
        jQuery(this).val('');
        HitungUangMuka();
    });
    
    jQuery("#hitung").click(function(){

        HitungUangMuka();
    
        var p = jQuery("#pinjaman_hidden").val();
        var i = jQuery("#bunga").val()/1200;
        var n = jQuery("#lama_pinjaman").val()*12;
        var angsuran = PMT(i, n, -p);
        
        jQuery("#result").text(angsuran.toFixed(0)+' /Bulan');
        jQuery("#result").formatCurrency();
    });
    

});
  	
  	/*
    $( "#slider-range" ).slider({
      orientation: "vertical",
      range: "min",
      min: 0,
      max: 100,
      value: 60,
      slide: function( event, ui ) {
      	//var num1 = 'Rp. ' + ui.values.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        //$( "#amount" ).val( num1 );
        //$( "#amount1" ).val( ui.values);
        $( "#amount" ).val( ui.value );
        $( "#amount1" ).val( ui.value );
      }
    });
    $( "#amount" ).val( $( "#slider-vertical" ).slider( "value" ) );
    $( "#amount1" ).val( $( "#slider-vertical" ).slider( "value" ) );
    */
    //$( "#amount" ).val( "Rp. " + $( "#slider-range" ).slider( "values" ) );

    //$( "#amount1" ).val( $( "#slider-range" ).slider( "values" ) );

  });
</script>
</body>
</html>
