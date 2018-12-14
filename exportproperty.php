<?php

	$tgl=date('j-m-Y');
// Database Connection
$nama_host="localhost";
	$user_db="root";
	$pass="";
	$nama_db="inmax";

	$koneksi=mysql_connect($nama_host,$user_db,$pass);

	mysql_select_db($nama_db);
	


	$output = "";
	$sql = mysql_query("SELECT nama_jenis, property_status, nama_kawasan, property_lokasi_detail, property_kawasan,nama_kabupaten,property_harga,property_harga_sewa,property_harga_meter,property_luas_tanah,property_dimensi_luas_tanah,property_luas_bangunan,property_dimensi_luas_bangunan,property_tingkat,property_arah_hadap,property_kamar_tidur,property_kamar_mandi,property_ruang_lain,property_fasilitas_umum,property_detail_furnitur,property_status_listing,property_status_kepemilikan,property_tgl_shgb,property_status_lainnya,property_imb,property_pbb,property_jaminan_bank,property_kantor,property_keterangan_ruangan,nama,owner.id, property_publish,property_agen,property_agen_2 FROM property left join owner on property_owner=owner.id left join jenis_property on property_jenis=jenis_property.id left join kawasan on property_lokasi=id_kawasan left join kabupaten on property_kabupatenkota=id_kabupaten");

	
	$columns_total = mysql_num_fields($sql);





// Get The Field Name
/*
$bb="Tanggal";
$aa="Jumlah Transaksi";
$cc="Omset";
$dd="Kasir";
*/
for ($i = 0; $i < $columns_total; $i++) {
$heading = mysql_field_name($sql, $i);
$output .= '"'.$heading.'",';
}
/*
$output .= '"'.$bb.'",';
$output .= '"'.$dd.'",';
$output .= '"'.$aa.'",';
$output .= '"'.$cc.'",';
*/
$output .="\n";

// Get Records from the table

while ($row = mysql_fetch_array($sql)) {

$idagen = explode(";",$row["32"]);
	$a=mysql_query("SELECT agen_nama from agen where agen_id='$idagen[0]'");
$b=mysql_fetch_array($a);


	$c=mysql_query("SELECT agen_nama from agen where agen_id='$row[33]'");
$d=mysql_fetch_array($c);

$output .='"'.$row["0"].'",';
$output .='"'.$row["1"].'",';
$output .='"'.$row["2"].'",';
$output .='"'.$row["3"].'",';
$output .='"'.$row["4"].'",';
$output .='"'.$row["5"].'",';
$output .='"'.$row["6"].'",';
$output .='"'.$row["7"].'",';
$output .='"'.$row["8"].'",';
$output .='"'.$row["9"].'",';
$output .='"'.$row["10"].'",';
$output .='"'.$row["11"].'",';
$output .='"'.$row["12"].'",';
$output .='"'.$row["13"].'",';
$output .='"'.$row["14"].'",';
$output .='"'.$row["15"].'",';
$output .='"'.$row["16"].'",';
$output .='"'.$row["17"].'",';
$output .='"'.$row["18"].'",';
$output .='"'.$row["19"].'",';
$output .='"'.$row["20"].'",';
$output .='"'.$row["21"].'",';
$output .='"'.$row["22"].'",';
$output .='"'.$row["23"].'",';
$output .='"'.$row["24"].'",';
$output .='"'.$row["25"].'",';
$output .='"'.$row["26"].'",';
$output .='"'.$row["27"].'",';
$output .='"'.$row["28"].'",';
$output .='"'.$row["29"].'",';
$output .='"'.$row["30"].'",';
$output .='"'.$row["31"].'",';
$output .='"'.$b["0"].'",';
$output .='"'.$d["0"].'",';

$output .="\n";
}

// Download the file

$filename = "property_".$tgl.".csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);

echo $output;
exit;

?>