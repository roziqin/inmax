<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
@include('adminlte::layouts.partials.htmlheaderfront')
	<noscript>
		<style>
			.es-carousel ul{
				display:block;
			}
		</style>
	</noscript>
	<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
		<div class="rg-image-wrapper">

				<div class="rg-image-nav">
					<a href="#" class="rg-image-nav-prev"></a>
					<a href="#" class="rg-image-nav-next"></a>
				</div>

			<div class="rg-image"></div>
			<div class="rg-loading"></div>
			
		</div>
	</script>
<body>
@include('adminlte::layouts.partials.header')
	<div class="container">
		<div class="wrapper">
			@foreach($tampilproperty as $tampilproperty)
			<div class="box-sect-detail detail-content">
				<div class="sect-detail-property" id="detail-property">
					<div class="box-detail-property custom">
						<div class="slider-detail">
							<div id="rg-gallery" class="rg-gallery">
								<div class="rg-thumbs">
									<!-- Elastislide Carousel Thumbnail Viewer -->
									<div class="es-carousel-wrapper">
										<!--
										<div class="es-nav">
											<span class="es-nav-prev"></span>
											<span class="es-nav-next"></span>
										</div>
										-->
										<div class="es-carousel">
										<?php
										if ($tampilproperty->property_image=='') {
											# code...
											$img = 'default-img.png';
										} else {
											# code...
											$img = $tampilproperty->property_image;
										}
										?>
											<ul>
												<li><a href="#"><img src="{{ asset('/img/property') }}/{{$img}}" data-large="{{ asset('/img/property') }}/{{$img}}" alt="image01" /></a></li>
												<?php
												$x = 0;
												$gallery = explode(";",$tampilproperty->property_gallery);
												
												while($x < count($gallery)) {
													if ($gallery[$x]=='') {
														# code...
													} else {
														# code...
														?>
														<li><a href="#"><img src="{{ asset('/img/property') }}/{{$gallery[$x]}}" data-large="{{ asset('/img/property') }}/{{$gallery[$x]}}" alt="image01" /></a></li>
														<?php
													}
													
												    $x++;
												} 
												?>
											</ul>
										</div>
									</div>
									<!-- End Elastislide Carousel Thumbnail Viewer -->
								</div><!-- rg-thumbs -->
							</div><!-- rg-gallery -->
						</div>
					</div>
					<div class="box-detail-property">
						<div class="left">
						<?php
						$txt = "";
						$harga1 = 0;
						$harga2 = 0;
						$status ='';
						$hargasewa = '';
						$hargameter = '';
						if ($tampilproperty->property_status == "dijual;disewa") {
							$status = "Dijual/Disewa";
							$harga1 = $tampilproperty->property_harga;
							$harga2 = $tampilproperty->property_harga_sewa;

							$hargasewa = "Disewakan Rp. ".number_format($harga2, 0)."/Thn";
						} else if ($tampilproperty->property_status == "dijual") {
							$status = "Dijual";
							$harga1 = $tampilproperty->property_harga;
						} else if ($tampilproperty->property_status == "disewa") {
							$status = "Disewa";
							$harga1 = $tampilproperty->property_harga_sewa;
							$txt = "<span> / thn </span>";
						}

						if ($tampilproperty->nama_jenis=='Tanah' || $tampilproperty->nama_jenis=='kavling') {

							$hargameter = "Rp. ".number_format($tampilproperty->property_harga_meter, 0)."/m<sup>2</sup>";
						}
						?>

							<div class="title-property">{{$tampilproperty->nama_jenis}} {{$status}} di {{$tampilproperty->nama_kawasan}}</div>

							<div class="circle {{$tampilproperty->property_status}}"></div><span class="status">{{$tampilproperty->nama_jenis}} {{$status}}</span><span class="view"><span class="icon-view"></span> {{$tampilproperty->property_view}}</span>
							<span class="address"><span class="icon-marker"></span> {{$tampilproperty->property_kawasan}}, {{$tampilproperty->nama_kabupaten}} <a href="http://maps.google.com/maps?q={{$tampilproperty->property_map}}" target="_blank">lihat peta</a></span>
						</div>
						<div class="right">
							<?php

							$harga = number_format($harga1, 0);

							$kmmandi = explode(";",$tampilproperty->property_kamar_mandi);
							$arah = explode(";",$tampilproperty->property_arah_hadap);

							if (sizeof($arah)==2) {
								# code...
								$arahhadap = $arah[0]." - ".$arah[1];
							} else {
								$arahhadap = $arah[0];

							}
							?>
							<div class="price">Rp. {{$harga}}<?php echo $txt; ?></div>
							<!--<a href="">Terapkan Simulasi KPR</a>-->
							<span>Keterangan Lain:</span>
							<div class="ket-lain">
								{{$hargasewa}}
								<?php echo $hargameter; ?><br>
								{{$tampilproperty->property_keterangan_ruangan}}
							</div>
						</div>
						<div class="clear"></div>
						<hr class="custom-1">
						<label>Spesifikasi</label>
						<ul class="property-detail">
							<li class="list-property-detail">L. Tanah: <span>{{$tampilproperty->property_luas_tanah}} /m<sup>2</sup></span></li>
							<li class="list-property-detail">Dimensi LT: <span>{{$tampilproperty->property_dimensi_luas_tanah}}  /m<sup>2</sup></span></li>
							<li class="list-property-detail">L. Bangunan: <span>{{$tampilproperty->property_luas_bangunan}} /m<sup>2</sup></span></li>
							<li class="list-property-detail">Dimensi LB: <span>{{$tampilproperty->property_dimensi_luas_bangunan}} /m<sup>2</sup></span></li>
							<li class="list-property-detail">Tingkat: <span>{{$tampilproperty->property_tingkat}}</span></li>
							<li class="list-property-detail">Arah Hadap: <span>{{$arahhadap}}</span></li>
						</ul>
						<hr class="custom-1">
						<label>Ruangan Utama</label>
						<ul class="property-detail">
							<li class="list-property-detail">Kamar Tidur: <span>{{$tampilproperty->property_kamar_tidur}}</span></li>
							<li class="list-property-detail">Kamar Mandi: <span>{{$kmmandi[0]}}</span></li>
							<li class="list-property-detail">Kamar Mandi Dalam: <span>{{$kmmandi[1]}}</span></li>
						</ul>
						<hr class="custom-1">
						<label>Ruangan Lain</label>
						<?php
						
						$property_ruang = explode(";",$tampilproperty->property_ruang_lain);
						$property_fasilitas = explode(";",$tampilproperty->property_fasilitas_umum);

						?>
						<ul class="property-detail">
							<?php if ($property_ruang[0]!="") { ?>
								<li class="list-property-detail"><span>Ruang Tamu</span></li>
							<?php } ?>
							<?php if ($property_ruang[1]!="") { ?>
								<li class="list-property-detail"><span>Ruang Keluarga</span></li>
							<?php } ?>
							<?php if ($property_ruang[2]!="") { ?>
								<li class="list-property-detail"><span>Musholla</span></li>
							<?php } ?>
							<?php if ($property_ruang[3]!="") { ?>
								<li class="list-property-detail"><span>Gudang</span></li>
							<?php } ?>
							<?php if ($property_ruang[4]!="") { ?>
								<li class="list-property-detail"><span>Dapur Basah</span></li>
							<?php } ?>
							<?php if ($property_ruang[5]!="") { ?>
								<li class="list-property-detail"><span>Pantry</span></li>
							<?php } ?>
							<?php if ($property_ruang[6]!="") { ?>
								<li class="list-property-detail"><span>Garasi</span></li>
							<?php } ?>
							<?php if ($property_ruang[7]!="") { ?>
								<li class="list-property-detail"><span>Carport</span></li>
							<?php } ?>
							<?php if ($property_ruang[8]!="") { ?>
								<li class="list-property-detail"><span>Halaman Depan</span></li>
							<?php } ?>
							<?php if ($property_ruang[9]!="") { ?>
								<li class="list-property-detail"><span>Halaman Belakang</span></li>
							<?php } ?>
							<?php if ($property_ruang[10]!="") { ?>
								<li class="list-property-detail"><span>Kolam Renang</span></li>
							<?php } ?>
							<?php if ($property_ruang[11]!="") { ?>
								<li class="list-property-detail"><span>Km Tidur Pembantu</span></li>
							<?php } ?>
							<?php if ($property_ruang[12]!="") { ?>
								<li class="list-property-detail"><span>Km Mandi Pembantu</span></li>
							<?php } ?>

						</ul>
						<hr class="custom-1">
						<label>Fasilitas Umum</label>
						<ul class="property-detail">
							<?php
							$listrik = explode("-",$property_fasilitas[0]);
							$tlp = explode("-",$property_fasilitas[2]);
							$ac = explode("-",$property_fasilitas[7]);
							?>
							<?php if ($listrik[0]!="") { ?>
								<li class="list-property-detail"><span>Listrik: <?php echo $listrik[1];?> VA</span></li>
							<?php } ?>
							<?php if ($property_fasilitas[1]!="") { ?>
								<li class="list-property-detail"><span>Internet</span></li>
							<?php } ?>
							<?php if ($tlp[0]!="") { ?>
								<li class="list-property-detail"><span>Telepon Rumah: <?php echo $tlp[1];?> Unit</span></li>
							<?php } ?>
							<?php if ($property_fasilitas[3]!="") { ?>
								<li class="list-property-detail"><span>TV Berlangganan</span></li>
							<?php } ?>
							<?php if ($property_fasilitas[4]!="") { ?>
								<li class="list-property-detail"><span>PDAM</span></li>
							<?php } ?>
							<?php if ($property_fasilitas[5]!="") { ?>
								<li class="list-property-detail"><span>Air Sumur</span></li>
							<?php } ?>
							<?php if ($property_fasilitas[6]!="") { ?>
								<li class="list-property-detail"><span>Air Pengelolaan Perumahan</span></li>
							<?php } ?>
							<?php if ($ac[0]!="") { ?>
								<li class="list-property-detail"><span>AC: <?php echo $ac[1];?> Unit</span></li>
							<?php } ?>
							<?php if ($property_fasilitas[8]!="") { ?>
								<li class="list-property-detail"><span>Water Heater</span></li>
							<?php } ?>
							<?php if ($property_fasilitas[9]!="") { ?>
								<li class="list-property-detail"><span>Furniture</span></li>
							<?php } ?>
							<?php if ($tampilproperty->property_detail_furnitur!="") { ?>
								<li class="list-property-detail"><span>Detail: {{$tampilproperty->property_detail_furnitur}}</span></li>
							<?php } ?>
							
						</ul>
						<hr class="custom-1">
						<label>Status</label>
						<ul class="property-detail">
							<?php
							$tgl = '';
							if ($tampilproperty->property_tgl_shgb != '') {
								# code...
								$d = explode("/",$tampilproperty->property_tgl_shgb);
								$tgl = $d[0]."-".$d[1]."-".$d[2];
							} else {
								# code...
							}
							
							
							?>
							<?php /* if ($tampilproperty->property_status_listing=="exclusive") { ?>
								<li class="list-property-detail"><span>Status Listing Exclusive</span></li>
							<?php } ?>
							<?php if ($tampilproperty->property_status_listing=="open") { ?>
								<li class="list-property-detail"><span>Status Listing Open</span></li>
							<?php } */?>
							<?php if ($tampilproperty->property_status_kepemilikan=="shm") { ?>
								<li class="list-property-detail"><span>Status Kepemilikan SHM</span></li>
							<?php } ?>
							<?php if ($tampilproperty->property_status_kepemilikan=="shgb") { ?>
								<li class="list-property-detail"><span>Status Kepemilikan SHGB : {{$tgl}}</span></li>
							<?php } ?>
							<?php if ($tampilproperty->property_status_kepemilikan=="ppjb") { ?>
								<li class="list-property-detail"><span>Status Kepemilikan PPJB</span></li>
							<?php } ?>
							<?php if ($tampilproperty->property_status_kepemilikan=="petok") { ?>
								<li class="list-property-detail"><span>Status KepemilikanPetok D</span></li>
							<?php } ?>
							<?php if ($tampilproperty->property_status_kepemilikan=="lainnya") { ?>
								<li class="list-property-detail"><span>Status KepemilikanLainnya</span></li>
							<?php } ?>
							<?php if ($tampilproperty->property_imb=="1") { ?>
								<li class="list-property-detail"><span>IMB</span></li>
							<?php } ?>
							<?php if ($tampilproperty->property_pbb=="1") { ?>
								<li class="list-property-detail"><span>PBB</span></li>
							<?php } ?>
							<?php if ($tampilproperty->property_jaminan_bank=="1") { ?>
								<li class="list-property-detail"><span>Dijamin Bank</span></li>
							<?php } ?>
							
						</ul>
					</div>
					
				</div>
				<div class="sect-agen" id="sect-agen">
					<div class="detail-agen">
						<div class="top-detail-agen">
							Hubungi Agen
						</div>
						<?php
						$idagen = explode(";",$tampilproperty->property_agen);
						$size = sizeof($idagen);

						?>
						@foreach($tampilagen as $tampilagen)
						<?php 
						for ($i=0; $i < $size; $i++) { 
							# code...
							if ($tampilagen->agen_id==$idagen[$i]) {
								if ($tampilagen->agen_avatar!='') {
									$avatar = $tampilagen->agen_avatar;
								} else {
									$avatar = "avatar-default.png";
								}
							?>
							<div class="content-agen">
								<img src="{{ asset('/img/avatar') }}/{{$avatar}}" class="image-user">
								<div class="group">
									<span class="name">{{$tampilagen->agen_nama}}</span>
									<br>
									<span class="inmax">{{$tampilagen->agen_keterangan}}</span>
								</div>
								<div class="clear"></div>
								<div class="group-kontak">
									<h4>Daftar Kontak Agen</h4>
									<ul>
										<li id="phone"><span class="icon-phone"></span><a href="tel:<?php echo $tampilagen->agen_hp; ?>">{{$tampilagen->agen_hp}}</a></li>
										<li id="email"><span class="icon-mail"></span>{{$tampilagen->agen_email}}</li>
										<li id="bbm"><span class="icon-bbm"></span>{{$tampilagen->agen_bbm}}</li>
									</ul>
								</div>
								<?php
								$tgl1=date('Y-m-j');
								$tgl2 = date("Y-m-j", strtotime($tampilagen->agen_anggota));
								$diff = abs(strtotime($tgl1) - strtotime($tgl2));
								//$diff="";
								$years = floor($diff / (365*60*60*24));
								$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

								
								?>
								<span class="status">Anggota sejak <?php echo $months; ?> bulan lalu</span>
								<!--<a href="" class="button">Telepon Agen</a>-->
								<a href="mailto:{{$tampilagen->agen_email}}" class="button">Email Agen</a>
							</div>
						<?php
							}
						}
						?>
					    @endforeach

						@foreach($tampilagen_2 as $tampilagen_2)
						<?php
						if ($tampilagen_2->agen_id==$tampilproperty->property_agen_2) {
							if ($tampilagen_2->agen_avatar!='') {
								$avatar = $tampilagen_2->agen_avatar;
							} else {
								$avatar = "avatar-default.png";
							}
							?>
							<div class="content-agen">
								<img src="{{ asset('/img/avatar') }}/{{$avatar}}" class="image-user">
								<div class="group">
									<span class="name">{{$tampilagen_2->agen_nama}}</span>
									<br>
									<span class="inmax">{{$tampilagen_2->agen_keterangan}}</span>
								</div>
								<div class="clear"></div>
								<div class="group-kontak">
									<h4>Daftar Kontak Agen</h4>
									<ul>
										<li id="phone"><span class="icon-phone"></span><a href="tel:<?php echo $tampilagen_2->agen_hp; ?>">{{$tampilagen_2->agen_hp}}</a></li>
										<li id="email"><span class="icon-mail"></span>{{$tampilagen_2->agen_email}}</li>
										<li id="bbm"><span class="icon-bbm"></span>{{$tampilagen_2->agen_bbm}}</li>
									</ul>
								</div>
								<?php
								$tgl1=date('Y-m-j');
								$tgl2 = date("Y-m-j", strtotime($tampilagen_2->agen_anggota));
								$diff = abs(strtotime($tgl1) - strtotime($tgl2));
								//$diff="";
								$years = floor($diff / (365*60*60*24));
								$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

								
								?>
								<span class="status">Anggota sejak <?php echo $months; ?> bulan lalu</span>
								<!--<a href="" class="button">Telepon Agen</a>-->
								<a href="mailto:{{$tampilagen->agen_email}}" class="button">Email Agen</a>
							</div>
							<?php
						}

						?>
					    @endforeach

					</div>
				</div>
			</div>
			<div class="box-sect-detail">
				<div class="clear"></div>
				<div class="sect-property related">
					<h2>Hasil Pencarian yang Sejenis</h2>
					<hr class="custom">
					<ul class="property">
						@foreach($relatedproperty as $relatedproperty)
							<li class="list-property">
								<?php 
									$harga = 0;
									$harga1 = 0;
									$harga1 = $relatedproperty->property_harga;
									$text = "";
									$hargakoma = '';
									$hargakoma1 = '';
									
									
									$textharga='';
									$ketdot = $relatedproperty->property_status;
									if ($relatedproperty->property_status=="dijual;disewa") {
										# code...
										$ketdot = "dijual-disewa";
										# code...
										$harga2 = $relatedproperty->property_harga_sewa;
										$harga21 = explode(",",number_format($harga2, 0));
									
										$count = strlen($harga2);
										if ($count <= 9) {
											# code...
											$ket2 = "Jt";
										} elseif ($count >9 ) {
											# code...
											$ket2 = "M";
											$hargakoma = ",".substr($harga21[1],0,1);
										}

										if (Request::segment(2)=='dijual') {
											# code...
											$stat = "dijual";	
										} elseif (Request::segment(2)=='disewa') {
											# code...
											$stat = "disewa";
											$text = "<span>/ thn</span>";
											$harga1 = $relatedproperty->property_harga_sewa;	
										} else {
											$stat = "dijual/disewa";	
											$textharga = "<div class='harga custom'>Rp. ".$harga21[0].$hargakoma." ".$ket2."<span>/ thn</span></div>";
										}
									} else {
										$stat = $relatedproperty->property_status;
									}

									
									
									if ($relatedproperty->property_status=="disewa") {
										# code...
										$harga1 = $relatedproperty->property_harga_sewa;
										$text = "<span>/ thn</span>";
									}
									if ($relatedproperty->property_image=='') {
										# code...
										$img = 'default-img.png';
									} else {
										# code...
										$img = $relatedproperty->property_image;
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
										$hargakoma1 = ",".substr($harga[1],0,1);
									}


									$tgl1=date('Y-m-j');
									$tgl2 = date("Y-m-j", strtotime($relatedproperty->property_tanggal));
									$diff = abs(strtotime($tgl1) - strtotime($tgl2));
									//$diff="";
									$years = floor($diff / (365*60*60*24));
									$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
									$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

									
									$title = $relatedproperty->nama_jenis." ".$stat." di ".$relatedproperty->nama_kawasan;
									$count = strlen($title); 
									$text1='';
									if ($count>80) {
										$text1 = "...";
									}
									$pot1=substr($title,0,80);
									?>
									<?php

									if ($years==0 && $months==0 && $days<=7) {
										# code...
									?>
									<div class="keterangan">Listing Baru</div>
									<?php
									} else {
										# code...
									}
									?>
								<div class="box-image">
									<a href="{{ url('detail',$relatedproperty->property_id) }}"><img src="{{ asset('/img/property') }}/{{$img}}" class="image-property"></a>
									<?php echo $textharga;?>
									<div class="harga custom-1">Rp {{$harga[0]}}{{$hargakoma1}} <?php echo $text; ?></div>
								</div>
								<div class="content-property">

									<a href="{{ url('detail',$relatedproperty->property_id) }}"><div class="title"><?php echo $pot1."".$text1;?></div></a>
									<div class="dot {{$relatedproperty->property_status}}"></div><span class="status">{{$relatedproperty->nama_jenis}} {{$relatedproperty->property_status}}</span><span class="view"><span class="icon-view"></span> {{$relatedproperty->property_view}}</span>

									<br>
									<span class="icon-marker"></span><span class="status">{{$tampilproperty->property_kawasan}}, {{$tampilproperty->nama_kabupaten}}</span>
									<a href="" class="map">lihat peta</a>
									<?php 
									$property_ruang = explode(";",$relatedproperty->property_ruang_lain);

									$jenis = $relatedproperty->nama_jenis;
									
									if ($jenis == 'Tanah' || $jenis == 'kavling') {
										# code...
									?>
									<div class="detail">
										<p>Luas Tanah: <span>{{$relatedproperty->property_luas_tanah}} m<sup>2</sup></span></p>
										<p>Harga / Meter: <span>Rp. {{number_format($relatedproperty->property_harga, 0)}}</span></p>
									</div>
									<?php
									} else {
										# code...
									?>
									<div class="detail">
										<div class="col-lg-12">
											<p>Luas Bangunan:<span> {{$relatedproperty->property_luas_bangunan}} m<sup>2</sup></span></p>
										</div>
										<div class="col-lg-12">
											<p>Luas Tanah:<span> {{$relatedproperty->property_luas_tanah}} m<sup>2</sup></span></p>
										</div>
										<div class="clear"></div>
										<p class="custom">Jumlah Lantai: <span>{{$relatedproperty->property_tingkat}} lantai</span></p>
										<ul class="list-detail">
											<li><span class="icon-bed"></span> <label>{{$relatedproperty->property_kamar_tidur}} Km. Tidur</label></li>
											<li><span class="icon-shower"></span> <label>{{$relatedproperty->property_kamar_mandi}} Km. Mandi</label></li>
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
			</div>
			@endforeach
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
	$.fn.scrollBottom = function() { 
	  return $(document).height() - this.scrollTop() - this.height(); 
	};
    $(window).scroll(function() {

        var d = $("#sect-agen").height();
        var c = $("#detail-property").height();
        var e = $(this).scrollTop();
        var f = c - d + 150;
        
        if(e < 150) {
        	$("#sect-agen").removeClass('fixed');
        	$("#sect-agen").removeClass('stop');

        }
        if (e > 150) {
        	$("#sect-agen").addClass('fixed');
        	$("#sect-agen").removeClass('stop');
        }
        if(e > f) {
        	$("#sect-agen").removeClass('fixed');
        	$("#sect-agen").addClass('stop');
        }
        if(e < f) {
        	$("#sect-agen").addClass('fixed');
        	$("#sect-agen").removeClass('stop');
        }
        if(e < 150) {
        	$("#sect-agen").removeClass('fixed');
        	$("#sect-agen").removeClass('stop');

        }
 

    });
</script>

<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<!-- Bootstrap slider -->
<script src="{{ asset('/plugins/bootstrap-slider/bootstrap-slider.js') }}"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
<!-- slider gallery -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('/js/slider/jquery.tmpl.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/slider/jquery.elastislide.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/slider/gallery.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/custom.js') }}"></script>
</body>
</html>
