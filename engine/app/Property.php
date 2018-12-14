<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    protected $table = 'property';
    protected $primaryKey = 'property_id';
   	protected $fillable = ['property_id', 'property_status', 'property_jenis', 'property_owner', 'property_agen', 'property_lokasi_provinsi', 'property_lokasi_kabupaten', 'property_lokasi_kecamatan', 'property_lokasi_kelurahan', 'property_alamat', 'property_harga', 'property_tanggal', 'property_image', 'property_luas_tanah', 'property_luas_bangunan', 'property_dimensi_luas_tanah', 'property_dimensi_luas_bangunan', 'property_tingkat', 'property_arah_hadap', 'property_kamar_tidur', 'property_kamar_mandi', 'property_keterangan_ruangan', 'property_ruang_lain', 'property_fasilitas_umum', 'property_detail_furnitur', 'property_status_listing', 'property_status_kepemilikan', 'property_tgl_shgb', 'property_status_lainnya', 'property_imb', 'property_pbb', 'property_bank'];
   	public $timestamps = false;
}

