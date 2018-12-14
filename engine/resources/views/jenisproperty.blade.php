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
			<div class="box-sect-content result jenisproperty">
			    <span class="filter-btn"><i class="fa fa-filter" aria-hidden="true"></i></span>
				<div class="box-left">
					<h3>Filter pencarian Anda</h3>
					<hr>

					{{ Form::open(['method'=>'GET','url'=>'cari','role'=>'search']) }}
		       			{{csrf_field()}}
						{{ Form::hidden('filter', 'advance', array('class' => 'form-control', 'id' => 'ket')) }}
						{{ Form::hidden('view', '', array('class' => 'form-control', 'id' => 'view')) }}
			       			<div class="col-lg-12">
								<h4>Jenis Properti</h4>
			       			</div>
			       			<div class="col-lg-6">
				       			{{ Form::select('status', [
								   'dijual' => 'Dijual',
								   'disewa' => 'Disewa',
								   'dijual;disewa' => 'Dijual/Disewa'],
								   null, 
								   ['class' => 'form-control custom']
								) }}
							</div>
							<div class="col-lg-6">
								<select class="form-control custom-1" id="dropdownjenis" name="jenispropperty">
								@foreach($tampiljenisall as $tampiljenisall	)
									<option value="{{$tampiljenisall->id}}">{{$tampiljenisall->nama_jenis}}</option>
							    @endforeach
							    </select>
						    </div>
			       			<div class="col-lg-12">
								<h4>Lokasi Properti</h4>
			       			</div>
							<div class="col-lg-6">
								<select class="form-control custom" id="dropdownkabupaten" name="kabupaten">
					       			<option value="0">Pilih Kabupaten/Kota</option>
									@foreach($tampilkabupaten as $tampilkabupaten)
										<option value="{{$tampilkabupaten->id_kabupaten}}">{{$tampilkabupaten->nama_kabupaten}}</option>
								    @endforeach
							    </select>
							</div>
							<div class="col-lg-6">
								<select class="form-control custom-1" id="dropdownlokasi" name="lokasi">
					       			<option value="0">Pilih Lokasi</option>
									@foreach($tampilkawasan as $tampilkawasan)
										<option value="{{$tampilkawasan->property_kawasan }}">{{$tampilkawasan->property_kawasan }}</option>
								    @endforeach
							    </select>
						    </div>
			       			<div class="col-lg-12">
								<h4>Kata Kunci Detil Lokasi</h4>
			       			</div>
			       			<div class="col-lg-12">
								{{ Form::text('alamat', '', array('class' => 'form-control custom', 'id' => 'name', 'placeholder' => 'Contoh: dieng, sukun, ijen')) }}
							</div>
			       			<div class="col-lg-12">
								{{ Form::label('harga', 'Kisaran Harga') }}
							</div>
			       			<div class="col-lg-12">
				            	
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
							</div>
							<div class="other-input">
								<div class="col-lg-12">
									<h4>Ruangan Lain</h4>
				       			</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="checkbox" class="check-custom" name="ruangtamu" value="ruangtamu"> R. Tamu
					                </label>
								</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="checkbox" class="check-custom" name="ruangkeluarga" value="ruangkeluarga"> R. Keluarga
					                </label>
								</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="checkbox" class="check-custom" name="musholla" value="musholla"> Musholla
					                </label>
								</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="checkbox" class="check-custom" name="gudang" value="gudang"> Gudang
					                </label>
								</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="checkbox" class="check-custom" name="dapurbasah" value="dapurbasah"> Dapur Basah
					                </label>
								</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="checkbox" class="check-custom" name="pantry" value="pantry"> Pantry
					                </label>
								</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="checkbox" class="check-custom" name="garasi" value="garasi"> Garasi
					                </label>
								</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="checkbox" class="check-custom" name="carport" value="carport"> Carport
					                </label>
								</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="checkbox" class="check-custom" name="halamandepan" value="halamandepan"> Halaman Depan
					                </label>
								</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="checkbox" class="check-custom" name="halamanbelakang" value="halamanbelakang"> Halaman Belakang
					                </label>
								</div>
							</div>
    						<div class="clear"></div>
    						{{ Form::submit('Terapkan Filter', array('class' => 'button btn-primary','id' => 'add')) }}
							<div class="other-input">
								<?php /* ?>
								<div class="col-lg-12">
									<h4 class="custom">Fasilitas Umum</h4>
								</div>
								<?php */ ?>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="hidden" class="check-custom" name="listrik" value="listrik">
					                </label>
								</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="hidden" class="check-custom" name="internet" value="internet">
					                </label>
								</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="hidden" class="check-custom" name="telepon" value="telepon">
					                </label>
								</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="hidden" class="check-custom" name="tv" value="tv">
					                </label>
								</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="hidden" class="check-custom" name="pdam" value="pdam">
					                </label>
				                </div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="hidden" class="check-custom" name="sumur" value="sumur">
					                </label>
								</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="hidden" class="check-custom" name="ac" value="ac">
					                </label>
								</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="hidden" class="check-custom" name="heater" value="heater">
					                </label>
								</div>
								<div class="col-lg-6">
									<label class="check-input">
					                	<input type="hidden" class="check-custom" name="furnitur" value="furnitur">
					                </label>
								</div>
							</div>



				    {{ Form::close() }}

				    <div class="box-kpr">
				    	<h2>Simulasi KPR</h2>
				    	<p>Simulasi Kredit Kepemilikan Rumah (KPR) untuk solusi terbaik dalam mewujudkan rumah impian Anda.</p>
				    	<a href="{{ url('simulasikpr') }}" class="button">Simulasi KPR</a>
				    	<span>*Syarat dan ketentuan berlaku</span>
				    </div>
				</div>
				<?php 
					$ket = '';
					$count = 0;
					$aa = Request::fullUrl(); 
					if (Request::segment(2)=='dijual'||Request::segment(2)=='disewa') {
						# code...
						$ket = Request::segment(2);
					} else {
						# code...
						$ket = '';
					}
					
				?>
				@foreach($tampilproperty as $tampilpropertys)
                	<?php 
                		$count = $tampilproperty->count();
                	?>
			    @endforeach
			    
			    <?php
			    $count=0;
			    ?>
				@foreach($counttampilproperty as $counttampilproperty)
                	<?php
                	$count++;
                		//$count1 = $counttampilproperty->count();
                	?>
			    @endforeach
			    
			    @foreach($tampiljenis as $tampiljenis)
                	<?php 
                		$jenis = $tampiljenis->nama_jenis;
                	?>
            	@endforeach
            	<?php
            	$data[][]= array();
            	$z = 0;
            	?>
            	@foreach($tampilagen as $tampilagen)
            	<?php
	            	$data[$z][0] = $tampilagen->agen_id;
	            	$data[$z][1] = $tampilagen->agen_nama;
	            	$data[$z][2] = $tampilagen->agen_hp;
	            	$data[$z][3] = $tampilagen->agen_email;
	            	$data[$z][4] = $tampilagen->agen_bbm;
	            	$data[$z][5] = $tampilagen->agen_keterangan;
	            	$z++;
            	?>

            	@endforeach
            	

				<div class="box-right">
				    
					<h3>Menampilkan list {{$jenis}} {{$ket}}</h3>
					<span class="count">(<?php echo $count; ?> hasil pencarian)</span> 
					<ul class="listing-view">
						<li class="list-view">Urutkan Berdasarkan: </li>
						<li class="list-view"><a href="{{url('jenis_property/')}}/{{Request::segment(2)}}/{{Request::segment(3)}}" class="<?php if(Request::segment(4)=='') { echo 'active';}?>">Rekomendasi</a></li>
						<li class="list-view"><a href="{{url('jenis_property/')}}/{{Request::segment(2)}}/{{Request::segment(3)}}/terbaru" class="<?php if(Request::segment(4)=='terbaru') { echo 'active';}?>">Terbaru</a></li>
						<li class="list-view"><a href="{{url('jenis_property/')}}/{{Request::segment(2)}}/{{Request::segment(3)}}/populer" class="<?php if(Request::segment(4)=='populer') { echo 'active';}?>">Terpopuler</a></li>
						<li class="list-view tree"><a href="#"  class="<?php if(Request::segment(4)=='hargarendah'||Request::segment(4)=='hargatinggi') { echo 'active';}?>">Harga <i class="fa fa-angle-left pull-right"></i></a>
							<ul class="sub-listing-view">
								<li class="sub-list-view"><a href="{{url('jenis_property/')}}/{{Request::segment(2)}}/{{Request::segment(3)}}/hargatinggi">Tinggi ke Rendah</a></li>
								<li class="sub-list-view"><a href="{{url('jenis_property/')}}/{{Request::segment(2)}}/{{Request::segment(3)}}/hargarendah">Rendah ke Tinggi</a></li>
							</ul>
						</li>
					</ul>
					<div class="content-result-property">
						<ul class="result-property">

	                	@foreach($tampilproperty as $tampilpropertys)
							<li class="list-property">
								<?php 
									$harga = 0;
									$harga1 = 0;
									$hargakoma = '';
									$hargakoma1 = '';
									$harga1 = $tampilpropertys->property_harga;
									$text = "";
									
									
									$textharga='';
									$ketdot = $tampilpropertys->property_status;
									if ($tampilpropertys->property_status=="dijual;disewa") {
										# code...
										$ketdot = "dijual-disewa";
										# code...
										$harga2 = $tampilpropertys->property_harga_sewa;
										$harga21 = explode(",",number_format($harga2, 0));
									
										$count = strlen($harga2);
										if ($count <= 9) {
											# code...
											$ket2 = "Jt";
										} elseif ($count >9 ) {
											# code...
											$ket2 = "M";
											$hargakoma = ",".substr($harga21[1],0,2);
										}

										if (Request::segment(2)=='dijual') {
											# code...
											$stat = "dijual";	
										} elseif (Request::segment(2)=='disewa') {
											# code...
											$stat = "disewa";
											$text = "<span>/ thn</span>";
											$harga1 = $tampilpropertys->property_harga_sewa;	
										} else {
											$stat = "dijual/disewa";	
											$textharga = "<div class='harga custom'>Rp. ".$harga21[0].$hargakoma." ".$ket2."<span>/ thn</span></div>";
										}
									} else {
										$stat = $tampilpropertys->property_status;
									}

									
									
									if ($tampilpropertys->property_status=="disewa") {
										# code...
										$harga1 = $tampilpropertys->property_harga_sewa;
										$text = "<span>/ thn</span>";
									}
									if ($tampilpropertys->property_image=='') {
										# code...
										$img = 'default-img.png';
									} else {
										# code...
										$img = $tampilpropertys->property_image;
									}

									$count = strlen($harga1);

									$harga = explode(",",number_format($harga1, 0));
									$harga11 = number_format($harga1, 0);
									if ($count <= 6) {
										# code...
										$ket = "Rb";
									} elseif ($count <= 9) {
										# code...
										$ket = "Jt";
									} elseif ($count >9 ) {
										# code...
										$ket = "M";
										$hargakoma1 = ",".substr($harga[1],0,2);
									}


									$tgl1=date('Y-m-j');
									$tgl2 = date("Y-m-j", strtotime($tampilpropertys->property_tanggal));
									$diff = abs(strtotime($tgl1) - strtotime($tgl2));
									//$diff="";
									$years = floor($diff / (365*60*60*24));
									$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
									$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

									
									$title = $tampilpropertys->nama_jenis." ".$stat." di ".$tampilpropertys->nama_kawasan;
									$count = strlen($title); 
									$text1='';
									if ($count>80) {
										$text1 = "...";
									}
									$pot1=substr($title,0,80);
								?>
								<?php if ($tampilpropertys->property_image!='') {

									if ($years==0 && $months==0 && $days<=7) {
										# code...
									?>
									<div class="new-property">Listing Baru</div>
									<?php
									} else {
										# code...
									}
									?>
								<div class="box-image" style="background-image: url({{ asset('/img/property') }}/{{$img}})">
									<a href="{{ url('detail',$tampilpropertys->property_id) }}">
									</a>
									<?php echo $textharga;?>
									<div class="harga">Rp {{$harga[0]}}{{$hargakoma1}} {{$ket}} <?php echo $text; ?></div>
								</div>
								<div class="content-property">

									<a href="{{ url('detail',$tampilpropertys->property_id) }}"><div class="title"><?php echo $pot1."".$text1;?></div></a>
									<div class="dot {{$ketdot}}"></div><span class="status">{{$tampilpropertys->nama_jenis}} {{$stat}}</span>  <span class="view"><span class="icon-view"></span> {{$tampilpropertys->property_view}}</span>

									<br>
									<span class="icon-marker"></span><span class="status">{{$tampilpropertys->property_kawasan}}, {{$tampilpropertys->nama_kabupaten}}</span>
									<a href="http://maps.google.com/maps?q={{$tampilpropertys->property_map}}" class="map" target="_blank">lihat peta</a>
									<?php 
									$property_ruang = explode(";",$tampilpropertys->property_ruang_lain);

									$jenis = $tampilpropertys->nama_jenis;
									
									if ($jenis == 'Tanah' || $jenis == 'Kavling' ) {
										# code...
									?>
									<div class="detail">
										<p>Luas Tanah: <span>{{$tampilpropertys->property_luas_tanah}} m<sup>2</sup></span></p>
										<p>Harga / Meter: <span>Rp. {{number_format($tampilpropertys->property_harga_meter, 0)}}</span></p>
									</div>
									<?php
									} else {
										# code...
									?>
									<div class="detail">
										<div class="col-lg-6">
											<p>Luas Bangunan:<span> {{$tampilpropertys->property_luas_bangunan}} m<sup>2</sup></span></p>
										</div>
										<div class="col-lg-6">
											<p>Luas Tanah:<span> {{$tampilpropertys->property_luas_tanah}} m<sup>2</sup></span></p>
										</div>
										<div class="clear"></div>
										<div class="col-lg-6">
											<p class="custom">Jumlah Lantai: <span>{{$tampilpropertys->property_tingkat}} lantai</span></p>
										</div>
										<?php 
										if ($jenis == 'Ruko') {
										?>
											<div class="col-lg-6">
												<p>Dimensi LB:<span> {{$tampilpropertys->property_dimensi_luas_bangunan}} m<sup>2</sup></span></p>
											</div>

										<?php
										}
										?>
										<div class="clear"></div>
										<ul class="list-detail">
											<li><span class="icon-bed"></span> <label>{{$tampilpropertys->property_kamar_tidur}} Km. Tidur</label></li>
											<li><span class="icon-shower"></span> <label>{{$tampilpropertys->property_kamar_mandi}} Km. Mandi</label></li>
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
								<?php } else {?>
								<div class="content-property list">
									<a href="{{ url('detail',$tampilpropertys->property_id) }}" class="link-title"><div class="title"><?php echo $pot1."".$text1;?></div></a>
									<?php
									if ($years==0 && $months==0 && $days<=7) {
										# code...
									?>
									<div class="new-property">Listing Baru</div>
									<div class="clear"></div>
									<?php
									} else {
										# code...
									}
									?>
									<?php echo $textharga;?>
									<div class="harga custom-1">Rp {{$harga11}} <?php echo $text; ?></div>
									<div class="clear"></div>
									<span class="icon-marker"></span><span class="status">{{$tampilpropertys->property_kawasan}}, {{$tampilpropertys->nama_kabupaten}}</span>
									<a href="http://maps.google.com/maps?q={{$tampilpropertys->property_map}}" class="map" target="_blank">lihat peta</a>
									<div class="dot {{$ketdot}}"></div><span class="status">{{$tampilpropertys->nama_jenis}} {{$stat}}</span>  <span class="view"><span class="icon-view"></span> {{$tampilpropertys->property_view}}</span>
									<?php
									$idagen = explode(";",$tampilpropertys->property_agen);
									$size = sizeof($idagen);
									?>
									<div class="clear" style="margin-bottom: 8px;"></div>
									<?php 
									$x = 0;
									while($x < $z) {
										for ($i=0; $i < $size; $i++) { 
											# code...
											if ($data[$x][0]==$idagen[$i]) {

											?>
											<div class="box-agen">
												<ul class="list-agen">
													<li class="box-name">
														<img src="{{ asset('/img/icon-user.png') }}">
														<div class="box-1">
															<h4><?php echo $data[$x][1];?></h4>
															<span><?php echo $data[$x][5];?></span>
														</div>
													</li>
													<li class="box-phone">
														<span class="icon-phone"></span>
														<div class="box-1">
															<?php echo $data[$x][2];?>
														</div>
													</li>
													<li class="box-bbm">
														<div><span class="icon-mail"></span><?php echo $data[$x][3];?></div>
														<div><span class="icon-bbm"></span><?php echo $data[$x][4];?></div>
													</li>
												</ul>
											</div>
											<?php
											}
										}
										$x++;
									}
									$x = 0;
									while($x < $z) {
									
										# code...
										if ($data[$x][0]==$tampilpropertys->property_agen_2) {

										?>
										<div class="box-agen">
											<ul class="list-agen">
												<li class="box-name">
													<img src="{{ asset('/img/icon-user.png') }}">
													<div class="box-1">
														<h4><?php echo $data[$x][1];?></h4>
														<span><?php echo $data[$x][5];?></span>
													</div>
												</li>
												<li class="box-phone">
													<span class="icon-phone"></span>
													<div class="box-1">
														<?php echo $data[$x][2];?>
													</div>
												</li>
												<li class="box-bbm">
													<div><span class="icon-mail"></span><?php echo $data[$x][3];?></div>
													<div><span class="icon-bbm"></span><?php echo $data[$x][4];?></div>
												</li>
											</ul>
										</div>
										<?php
										}
										
										$x++;
									}

									?>

								</div>
								<?php } ?>
							</li>
					    @endforeach
						</ul>

					</div>
					<div class="pagination">
						
						{{ $tampilproperty->links() }}
					</div>
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

<script src="{{ asset('/js/custom.js') }}"></script>

<script src="{{ asset('/js/nouislider.min.js') }}"></script>
<script src="{{ asset('/js/wNumb.js') }}"></script>

<script>

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

<script src="{{ asset('/js/custom-admin.js') }}"></script>

</body>
</html>
