<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
@include('adminlte::layouts.partials.htmlheaderfront')

<body class="index">
@include('adminlte::layouts.partials.header')
	<div class="container">
		<div class="sect-search">
			<div class="wrapper">
				<h1>Temukan properti idaman Anda</h1>
				<p>pada lebih dari 1000 daftar properti yang kami miliki</p>
				<div class="box-search">
					
				{{ Form::open(['method'=>'GET','url'=>'cari','role'=>'search']) }}
		       		{{csrf_field()}}
		       			{{ Form::select('status', [
						   'dijual' => 'Dijual',
						   'disewa' => 'Disewa',
						   'dijual;disewa' => 'Dijual/Disewa'],
						   null, 
						   ['class' => 'form-control', 'id' => 'status'] 
						) }}
						<select class="form-control" id="dropdownjenis" name="jenispropperty">
						@foreach($tampiljenis as $tampiljenis)
							<option value="{{$tampiljenis->id}}">{{$tampiljenis->nama_jenis}}</option>
					    @endforeach
					    </select>
						{{ Form::text('alamat', '', array('class' => 'form-control', 'id' => 'name', 'placeholder' => 'Contoh: Sawojajar')) }}

						{{ Form::submit('Cari', array('class' => 'button btn-primary','id' => 'add')) }}
						{{ Form::hidden('ket', '', array('class' => 'form-control', 'id' => 'ket')) }}
						{{ Form::hidden('filter', 'normal', array('class' => 'form-control', 'id' => 'ket')) }}
						{{ Form::hidden('view', '', array('class' => 'form-control', 'id' => 'view')) }}


		            <div class="advance-search" id="advance">
		            	{{ Form::label('harga', 'Kisaran Harga') }}
		            	
			            <div class="price-slider">

			                <div class="col-sm-12">
				            	<div id="slider-snap"></div>

								<input type="hidden" name="harga-min" class="example-val" id="slider-snap-value-lower">
								<input type="hidden" name="harga-max" class="example-val" id="slider-snap-value-upper">
								<br>
    								<span class="harga">Rp.</span> <span class="harga" id="value-lower"></span> 
    								<span class="harga"> - Rp.</span> <span class="harga" id="value-upper"></span>
							</div>

			            </div>

					    <button id="reset-filter" type="button" aria-expanded="false" onclick="resetfilter()" class="custom reset"><span>Reset filter</span></button>
		            </div>


			    {{ Form::close() }}
			    <button id="filter" type="button" aria-expanded="false" onclick="openfilter()" class="custom"><span>Tampilkan filter</span> <i class="fa fa-angle-left pull-right" ></i></button>
				</div>
			</div>
		</div>
		<div class="wrapper">
			<div class="sect-carousel">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
						<li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
					</ol>
					<div class="carousel-inner">
						<div class="item active">
							<img src="{{ asset('/img/slider-banner-1.jpg') }}" alt="First slide">
						</div>
						<div class="item">
							<img src="{{ asset('/img/slider-banner-2.jpg') }}" alt="Second slide">
						</div>
						<div class="item">
							<img src="{{ asset('/img/slider-banner-3.jpg') }}" alt="Third slide">
						</div>
					</div>
				</div>
			</div>
			<div class="sect-property">
				<h2>Properti Paling Banyak Dilihat</h2>
				<hr class="custom">
				<ul class="property">
                	@foreach($tampilproperty as $tampilproperty)


					<li class="list-property">
						<?php

							$tgl1=date('Y-m-j');
							$tgl2 = date("Y-m-j", strtotime($tampilproperty->property_tanggal));
							$diff = abs(strtotime($tgl1) - strtotime($tgl2));
							//$diff="";
							$years = floor($diff / (365*60*60*24));
							$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
							$days = floor(($diff - ($years * 365*60*60*24) - ($months*30*60*60*24))/ (60*60*24));
							if ($years==0 && $months==0 && $days<=7) {
								# code...
							?>
							<div class="keterangan">LISTING BARU</div>
							<?php
							} else {
								# code...
							}
							
							if ($tampilproperty->property_image=='') {
								# code...
								$img = 'default-img.png';
							} else {
								# code...
								$img = $tampilproperty->property_image;
							}
						?>
						
						<!--<div class="keterangan">Property Baru</div>-->

						<a href="{{ url('detail',$tampilproperty->property_id) }}" style="background-image: url({{ asset('/img/property') }}/{{$img}})" class="box-image">
						</a>
						<?php 
						$propstatus = $tampilproperty->property_status;
						$harga = 0;
						$hargakoma = '';
						$hargakoma1 = '';
						$text = "";
						$textharga='';
						$harga1 = $tampilproperty->property_harga;
						
						
						if ($tampilproperty->property_status=="disewa") {
							# code...
							$harga1 = $tampilproperty->property_harga_sewa;
							$text = "<span>/ thn</span>";
						}

						$harga = explode(",",number_format($harga1, 0));
						$count = strlen($harga1);
						if ($count <= 9) {
							# code...
							$ket = "Jt";
						} elseif ($count >9 ) {
							# code...
							$ket = "M";
							$hargakoma = ",".substr($harga[1],0,2);
						}
						
						

						
						if ($tampilproperty->property_status=="dijual;disewa") {
							# code...
							$propstatus = "dijual/disewa";
							$harga2 = $tampilproperty->property_harga_sewa;
							$harga21 = explode(",",number_format($harga2, 0));
						
							$count = strlen($harga2);
							if ($count <= 9) {
								# code...
								$ket2 = "Jt";
							} elseif ($count >9 ) {
								# code...
								$ket2 = "M";
								$hargakoma1 = ",".substr($harga21[1],0,2);
							}
							$textharga = "<div class='harga custom'><span class='custom'>Disewakan</span><br>Rp. ".$harga21[0].$hargakoma1." ".$ket2."<span>/ thn</span></div>";

						}
						$title = $tampilproperty->nama_jenis." ".$propstatus." di ".$tampilproperty->nama_kawasan;
						$count = strlen($title); 
						$text1='';
						if ($count>48) {
							$text1 = "...";
						}
						$pot1=substr($title,0,48);
						echo $textharga;
						?>
						<div class="harga">Rp. {{$harga[0]}}{{$hargakoma}} {{$ket}} <?php echo $text;?></div>
						<div class="content-property">

							<a href="{{ url('detail',$tampilproperty->property_id) }}"><div class="title"><?php echo $pot1."".$text1;?></div></a>
							<div class="dot {{$tampilproperty->property_status}}"></div><span class="status">{{$tampilproperty->nama_jenis}} {{$propstatus}}</span><span class="view"><span class="icon-view"></span> {{$tampilproperty->property_view}}</span>
									<div class="clear"></div>
							<span class="icon-marker"></span><span class="status">{{$tampilproperty->property_kawasan}}, {{$tampilproperty->nama_kabupaten}}</span>
							<a href="http://maps.google.com/maps?q={{$tampilproperty->property_map}}" class="map" target="_blank">lihat peta</a>
							<?php 
							$property_ruang = explode(";",$tampilproperty->property_ruang_lain);
							$kmmandi = explode(";",$tampilproperty->property_kamar_mandi);

							$jenis = $tampilproperty->nama_jenis;
							
							if ($jenis == 'Tanah' || $jenis == 'Kavling')  {
								# code...
							?>
							<div class="detail">
								<p>Luas Tanah: <span>{{$tampilproperty->property_luas_tanah}} m<sup>2</sup></span></p>
								<p>Harga / Meter: <span>Rp. {{number_format($tampilproperty->property_harga_meter, 0)}}</span></p>
							</div>
							<?php
							} else {
								# code...
							?>
							<div class="detail">
								<p>Luas Bangunan: <span>{{$tampilproperty->property_luas_bangunan}} m<sup>2</sup></span></p>
								<p>Luas Tanah: <span>{{$tampilproperty->property_luas_tanah}} m<sup>2</sup></span></p>
								<p class="custom">Jumlah Lantai: <span>{{$tampilproperty->property_tingkat}} lantai</span></p>	
								<?php 
								if ($jenis == 'Ruko') {
								?>
									<p>Dimensi LB:<span> {{$tampilproperty->property_dimensi_luas_bangunan}} m<sup>2</sup></span></p>
								<?php
								}
								?>
								<ul class="list-detail">
									<li><span class="icon-bed"></span> <label>{{$tampilproperty->property_kamar_tidur}} Km. Tidur</label></li>
									<li><span class="icon-shower"></span> <label>{{$kmmandi[0]}} Km. Mandi</label></li>
									<?php 
									if ($property_ruang[6]!="") {
										# code...
									?>
									<li><span class="icon-carport"></span> <label>Garasi</label></li>
									<?php
									}
									if ($property_ruang[7]!="") {
										# code...
									?>
									<li><span class="icon-car"></span> <label>Carport</label></li>
									<?php
									}
									?>
								</ul>
							</div>
							<?php
							}
							?>
							
							
						</div>
						
					</li>
				    @endforeach
				</ul>
			</div>
			<div class="sect-kpr">
				<div class="content-kpr">
					<p>Jalankan simulasi Kredit Kepemilikan Rumah (KPR) untuk solusi terbaik dalam mewujudkan rumah impian Anda.</p>
					<a href="{{ url('simulasikpr') }}" class="button">Simulasi KPR</a><br>
					<span>*Syarat dan ketentuan berlaku</span>
				</div>
			</div>
			<div class="sect-property">
			<?php 

			$bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
			?>
				<h2>Properti Terbaru Bulan <?php echo $bulan[date("n")];?></h2>
				<hr class="custom">
				<ul class="property">
					@foreach($tampilpropertybulan as $tampilpropertybulan)


					<li class="list-property">
						
						<?php
							$tgl1=date('Y-m-j');
							$tgl2 = date("Y-m-j", strtotime($tampilproperty->property_tanggal));
							$diff = abs(strtotime($tgl1) - strtotime($tgl2));
							//$diff="";
							$years = floor($diff / (365*60*60*24));
							$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
							$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

							if ($days<=7) {
								# code...
							?>
							<div class="keterangan">LISTING BARU</div>
							<?php
							} else {
								# code...
							}
							if ($tampilpropertybulan->property_image=='') {
								# code...
								$img = 'default-img.png';
							} else {
								# code...
								$img = $tampilpropertybulan->property_image;
							}
							
							
						?>

						<a href="{{ url('detail',$tampilpropertybulan->property_id) }}" style="background-image: url({{ asset('/img/property') }}/{{$img}})" class="box-image">
						</a>
						<?php 
						$propstatus = $tampilpropertybulan->property_status;
						$harga = 0;
						$harga1 = 0;
						$hargakoma = '';
						$hargakoma1 = '';
						$text = "";
						$harga1 = $tampilpropertybulan->property_harga;

						$count = strlen($harga1);

						if ($tampilpropertybulan->property_status=="disewa") {
							# code...
							$harga1 = $tampilpropertybulan->property_harga_sewa;
							$text = "<span>/ thn</span>";
						}
						
						$harga = explode(",",number_format($harga1, 0));

						if ($count <= 9) {
							# code...
							$ket = "Jt";
						} elseif ($count >9 ) {
							# code...
							$ket = "M";
							$hargakoma = ",".substr($harga[1],0,2);
						}
						
						

						if ($tampilpropertybulan->property_status=="disewa") {
							# code...
							$text = "<span>/ thn</span>";
						}
						$textharga='';
						if ($tampilpropertybulan->property_status=="dijual;disewa") {
							# code...
							$propstatus = "dijual/disewa";
							$harga2 = $tampilpropertybulan->property_harga_sewa;
							$harga21 = explode(",",number_format($harga2, 0));
						
							$count = strlen($harga2);
							if ($count <= 9) {
								# code...
								$ket2 = "Jt";
							} elseif ($count >9 ) {
								# code...
								$ket2 = "M";
								$hargakoma1 = ",".substr($harga[1],0,2);
							}
							$textharga = "<div class='harga custom'><span class='custom'>Disewakan</span><br>Rp. ".$harga21[0].$hargakoma1." ".$ket2."<span>/ thn</span></div>";

						}
						$title = $tampilpropertybulan->nama_jenis." ".$propstatus." di ".$tampilpropertybulan->nama_kawasan;
						$count = strlen($title); 
						$text1='';
						if ($count>48) {
							$text1 = "...";
						}
						$pot1=substr($title,0,48);
						echo $textharga;
						?>
						<div class="harga">Rp. {{$harga[0]}}{{$hargakoma}} {{$ket}} <?php echo $text;?></div>
						<div class="content-property">

							<a href="{{ url('detail',$tampilpropertybulan->property_id) }}"><div class="title"><?php echo $pot1."".$text1;?></div></a>
							<div class="dot {{$tampilpropertybulan->property_status}}"></div><span class="status">{{$tampilpropertybulan->nama_jenis}} {{$propstatus}}</span><span class="view"><span class="icon-view"></span> {{$tampilpropertybulan->property_view}}</span>
									<div class="clear"></div>
							<span class="icon-marker"></span><span class="status">{{$tampilpropertybulan->property_kawasan}}, {{$tampilpropertybulan->nama_kabupaten}}</span>
							<a href="http://maps.google.com/maps?q={{$tampilpropertybulan->property_map}}" class="map" target="_blank">lihat peta</a>
							<?php 
							$property_ruang = explode(";",$tampilpropertybulan->property_ruang_lain);
							$kmmandi = explode(";",$tampilpropertybulan->property_kamar_mandi);

							$jenis = $tampilpropertybulan->nama_jenis;
							
							if ($jenis == 'Tanah' || $jenis == 'Kavling') {
								# code...
							?>
							<div class="detail">
								<p>Luas Tanah: <span>{{$tampilpropertybulan->property_luas_tanah}} m<sup>2</sup></span></p>
								<p>Harga / Meter: <span>Rp. {{number_format($tampilpropertybulan->property_harga_meter, 0)}}</span></p>
							</div>
							<?php
							} else {
								# code...
							?>
							<div class="detail">
								<p>Luas Bangunan: <span>{{$tampilpropertybulan->property_luas_bangunan}} m<sup>2</sup></span></p>
								<p>Luas Tanah: <span>{{$tampilpropertybulan->property_luas_tanah}} m<sup>2</sup></span></p>
								<p class="custom">Jumlah Lantai: <span>{{$tampilpropertybulan->property_tingkat}} lantai</span></p>		
								<?php 
								if ($jenis == 'Ruko') {
								?>
									<p>Dimensi LB:<span> {{$tampilpropertybulan->property_dimensi_luas_bangunan}} m<sup>2</sup></span></p>
								<?php
								}
								?>
								<ul class="list-detail">
									<li><span class="icon-bed"></span> <label>{{$tampilpropertybulan->property_kamar_tidur}} Km. Tidur</label></li>
									<li><span class="icon-shower"></span> <label>{{$kmmandi[0]}} Km. Mandi</label></li>
									<?php 
									if ($property_ruang[6]!="") {
										# code...
									?>
									<li><span class="icon-carport"></span> <label>Garasi</label></li>
									<?php
									}
									if ($property_ruang[7]!="") {
										# code...
									?>
									<li><span class="icon-car"></span> <label>Carport</label></li>
									<?php
									}
									?>
								</ul>
							</div>
							<?php
							}
							?>
							
							
						</div>
						
					</li>
				    @endforeach
				</ul>
			</div><!-- End Sect Property -->
			<div class="sect-property">
				<h2>Properti Paling Populer Tahun 2017</h2>
				<hr class="custom">
				<div class="box-content">
					<div class="box-content-left">
						<a href="{{ url('/jenis_property/dijual/apartemen') }}">
							<div class="opacity"></div>
							<div class="property-cat apartemen box-1">
								<label>Apartemen</label>
							</div>
						</a>
					</div>
					<div class="box-content-right">
						<a href="{{ url('/jenis_property/dijual/tanah') }}" class="box-2">
							<div class="opacity"></div>
							<div class="property-cat tanah box-2">
								<label>Tanah</label>
							</div>
						</a>
						<a href="{{ url('/jenis_property/dijual/gudang') }}" class="box-2 last">
							<div class="opacity"></div>
							<div class="property-cat villa box-2 last">
								<label>Gudang</label>
							</div>
						</a>
						<div class="clear"></div>
						<a href="{{ url('/jenis_property/dijual/rumah') }}" class="box-3">
							<div class="opacity"></div>
							<div class="property-cat home box-3">
								<label>Rumah</label>
							</div>
						</a>
						
					</div>
				</div>
			</div><!-- End Sect Property -->

			<div class="sect-subscribe">
				<div class="content-subscribe">
					<h2>Dapatkan Kabar Terbaru Dari Kami</h2>
					<hr class="custom">

					{!! Form::open(array('class' => 'subscribe', 'route' => 'subscribe')) !!}
			       		{{csrf_field()}}
			       			<input class="form-control" name="email" id="email" type="email" placeholder="Masukkan alamat email anda" required>

							{{ Form::submit('Kirim', array('class' => 'button btn-primary','id' => 'kirim')) }}

				    {{ Form::close() }}
				</div>
			</div>

		</div><!-- End Wrapper -->
	</div>

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

<script src="{{ asset('/js/custom.js') }}"></script>

<script src="{{ asset('/js/nouislider.min.js') }}"></script>
<script src="{{ asset('/js/wNumb.js') }}"></script>

<script>
	function resetfilter() {
		$("#name").val('');
		$("#status").val('dijual');
		$("#dropdownjenis").val('1');
		
        
	}
	
  /* Nouslider */
	var snapSlider = document.getElementById('slider-snap');

	noUiSlider.create(snapSlider, {
		start: [ 0, 2000000000 ],
		step: 1000000,
		connect: true,
		range: {
			'min': 0,
			'max': 10000000000
		},
		format: wNumb({
			decimals: 3,
			thousand: '.',
		})
	});

	var snapValues = [
		document.getElementById('slider-snap-value-lower'),
		document.getElementById('slider-snap-value-upper')
	];

	var snapValuesSpan = [
		document.getElementById('value-lower'),
		document.getElementById('value-upper')
	];

	snapSlider.noUiSlider.on('update', function( values, handle ) {
		snapValues[handle].value = values[handle];
		snapValuesSpan[handle].innerHTML  = values[handle];
	});

</script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
</body>
</html>
