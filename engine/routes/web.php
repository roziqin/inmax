<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'FrontendController@index');
/*Route::group(['middleware'] => ['web'], function()
{
	Route::resource('home','HomeController');
});*/
Route::resource('home','HomeController');
Route::resource('agen','AgenController');
Route::get('addagen','AgenController@addagen');
Route::get('editagen/{id}', 'AgenController@edit');
Route::resource('owner','OwnerController');
Route::get('addowner','OwnerController@addowner');
Route::get('editowner/{id}','OwnerController@edit');

Route::resource('property','PropertyController');
Route::resource('category','CategoryController');
Route::get('tes', 'HomeController@tes');
Route::get('addtes', 'HomeController@addtes');
Route::get('addproperty', 'HomeController@addproperty');
Route::get('edit/{id}', 'CategoryController@edit');
Route::post('update/{id}', 'CategoryController@update');

Route::resource('user','useradminController');
Route::get('adduser','useradminController@adduser');
Route::get('edituser/{id}','useradminController@edit');

Route::resource('jenisproperty','JenispropertyController');
Route::get('editjenis/{id}','JenispropertyController@edit');

Route::resource('kawasan','KawasanController');
Route::get('editkawasan/{id}','KawasanController@edit');

Route::resource('kabupatenkota','KabupatenController');
Route::get('editkabupatenkota/{id}','KabupatenController@edit');
/* Frontend */
//Route::get('detail/{id}', 'AgenController@edit');
Route::get('index', 'FrontendController@index');
Route::get('detail/{id}', 'FrontendController@detail');
Route::get('tentangkami', 'FrontendController@tentangkami');
Route::get('referral', 'FrontendController@referral');
Route::get('joinus', 'FrontendController@joinus');
Route::get('simulasikpr', 'FrontendController@simulasikpr');

Route::get('result', 'ResultController@index');
Route::get('jenis_property/{name}', 'ResultController@jenis_property');
Route::get('jenis_property/{ket}/{name}', 'ResultController@jenis_property_ket');
Route::get('jenis_property/{ket}/{name}/{sort}', 'ResultController@jenis_property_ket_lain');
Route::get('result/kabupaten/{id}', 'ResultController@kabupaten');
Route::get('result/kecamatan/{id}', 'ResultController@kecamatan');
Route::get('result/kelurahan/{id}', 'ResultController@kelurahan');
Route::get('cari', 'ResultController@search');
Route::get('cari/kabupaten/{id}', 'ResultController@kabupaten');
Route::get('cari/kecamatan/{id}', 'ResultController@kecamatan');
Route::get('cari/kelurahan/{id}', 'ResultController@kelurahan');

Route::get('jenis_property/dijual/cari/kabupaten/{id}', 'ResultController@kabupaten');
Route::get('jenis_property/dijual/cari/kecamatan/{id}', 'ResultController@kecamatan');
Route::get('jenis_property/dijual/cari/kelurahan/{id}', 'ResultController@kelurahan');

Route::get('jenis_property/disewa/cari/kabupaten/{id}', 'ResultController@kabupaten');
Route::get('jenis_property/disewa/cari/kecamatan/{id}', 'ResultController@kecamatan');
Route::get('jenis_property/disewa/cari/kelurahan/{id}', 'ResultController@kelurahan');
//Route::get('{url}/{id}', 'ResultController@kecamatan_jenis');
//Route::get('{url}/{id}', 'ResultController@kelurahan_jenis');

Route::get('addproperty/kabupaten/{id}', 'HomeController@kabupaten');
Route::get('addproperty/kecamatan/{id}', 'HomeController@kecamatan');
Route::get('addproperty/kelurahan/{id}', 'HomeController@kelurahan');

Route::get('editproperty/{id}','PropertyController@edit');
Route::get('cekproperty/{id}','PropertyController@cek');


Route::get('editproperty/kabupaten/{ids}', 'PropertyController@kabupaten');
Route::get('editproperty/kecamatan/{ids}', 'PropertyController@kecamatan');
Route::get('editproperty/kelurahan/{ids}', 'PropertyController@kelurahan');


Route::resource('subscribe','subscribeController');
Route::post('subscribe',['as'=>'subscribe','uses'=>'subscribeController@subscribe']);
Route::get('subscribesukses', 'subscribeController@sukses');



Route::get('cari/ktp/{id}', 'OwnerController@cekktp');
Route::get('cari/lokasi/{id}', 'PropertyController@ceklokasi');

Route::get('cari/ktpedit/{id}', 'OwnerController@cekktp');
Route::get('cari/lokasiedit/{id}', 'PropertyController@ceklokasi');


Route::resource('tambahproperty','TambahpropertyController');

