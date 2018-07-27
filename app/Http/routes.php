<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home.index');
});


Route::get('/pass', function(){
	$data = App\User::all();
	foreach($data as $row){
		App\User::find($row->id)->update([
			'password' => bcrypt($row->nim)
		]);
	}
	return 1;
});

//Login User
Route::get('/login', 'Auth\AuthController@getLogin')->name('login');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout')->name('logout');

//Login Admin
Route::get('/admin/login', 'Auth\AdminAuthController@getLogin')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminAuthController@postLogin');
Route::get('/admin/logout', 'Auth\AdminAuthController@getLogout')->name('admin.logout');


// Route::get('/edit', function () {
//     return view('admin.edit-mahasiswa');
// });

// Admin
Route::resource('/admin', 'AdminController');
Route::get('/admin-mahasiswa', 'AdminController@mahasiswaIndex')->name('admin.mahasiswa');
Route::get('/admin-mahasiswa/create', 'AdminController@mahasiswaCreate')->name('admin.mahasiswa-create');
Route::get('/admin-mahasiswa/{id}/edit', 'AdminController@mahasiswaEdit')->name('admin.mahasiswa-edit');
Route::post('/admin-mahasiswa', 'AdminController@mahasiswaStore')->name('admin.mahasiswa-store');
Route::put('/admin-mahasiswa/{id}', 'AdminController@mahasiswaUpdate')->name('admin.mahasiswa-update');
Route::delete('/admin-mahasiswa/{id}', 'AdminController@mahasiswaDestroy')->name('admin.mahasiswa-delete');
Route::get('/admin-sd-pengumuman', 'AdminController@sdPengumumanIndex')->name('admin.sd-pengumuman');
Route::get('/admin-sd-pengumuman/create', 'AdminController@sdPengumumanCreate')->name('admin.sd-pengumuman-create');
Route::get('/admin-sd-pengumuman/{id}/edit', 'AdminController@sdPengumumanEdit')->name('admin.sd-pengumuman-edit');
Route::post('/admin-sd-pengumuman/store', 'AdminController@sdPengumumanStore')->name('admin.sd-pengumuman-store');
Route::put('/admin-sd-pengumuman/{id}', 'AdminController@sdPengumumanUpdate')->name('admin.sd-pengumuman-update');
Route::delete('/admin-sd-pengumuman/{id}', 'AdminController@sdPengumumanDestroy')->name('admin.sd-pengumuman-destroy');
Route::get('/admin-mahasiswa-angkatan', 'AdminController@angkatanIndex')->name('admin.angkatan-index');
Route::post('/admin-mahasiswa-angkatan', 'AdminController@angkatanStore')->name('admin.angkatan-store');
Route::put('/admin-mahasiswa-angkatan/{id}', 'AdminController@angkatanUpdate')->name('admin.angkatan-update');
Route::delete('/admin-mahasiswa-angkatan/{id}', 'AdminController@angkatanDestroy')->name('admin.angkatan-destroy');
Route::get('/admin-golongan-darah', 'AdminController@golonganDarahIndex')->name('admin.golongan-darah-index');
Route::get('/admin-jenis-kelamin', 'AdminController@jenisKelaminIndex')->name('admin.jenis-kelamin-index');
Route::post('/admin-jenis-kelamin', 'AdminController@jenisKelaminStore')->name('admin.jenis-kelamin-store');
Route::put('/admin-jenis-kelamin/{id}', 'AdminController@jenisKelaminUpdate')->name('admin.jenis-kelamin-update');
Route::delete('/admin-jenis-kelamin/{id}', 'AdminController@jenisKelaminDestroy')->name('admin.jenis-kelamin-destroy');
Route::get('/admin-program-studi', 'AdminController@programStudiIndex')->name('admin.program-studi-index');
Route::post('/admin-program-studi', 'AdminController@programStudiStore')->name('admin.program-studi-store');
Route::put('/admin-program-studi/{id}', 'AdminController@programStudiUpdate')->name('admin.program-studi-update');
Route::delete('/admin-program-studi/{id}', 'AdminController@programStudiDestroy')->name('admin.program-studi-destroy');
Route::get('/admin-mahasiswa/export-excel', 'AdminController@excel');
Route::resource('/log', 'LogController');
Route::resource('/prestasi', 'PrestasiController');
Route::resource('/organisasi', 'OrganisasiController');
// End Admin

// Admin Auth
// Route::get('/login/admin', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
// Route::post('/admin/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
// Route::post('/admin/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');
Route::get('/admin-password/reset', 'AdminController@gantiPasswordIndex')->name('admin.password-reset-form');
Route::post('/admin-password/reset', 'AdminController@gantiPassword')->name('admin.password-reset');
Route::get('/coba', 'AdminController@buatPassword');

// Student Day
Route::resource('sd', 'StudentDayController');
Route::get('/sd-pengumuman', 'StudentDayController@pengumumanIndex')->name('sd-pengumuman.index');
Route::get('/sd-pengumuman/{id}', 'StudentDayController@pengumumanShow')->name('sd-pengumuman.show');
// End Student Day

// Student Day Mahasiswa
Route::get('/user/logout', 'Auth\LoginController@logoutUser')->name('user.logout');
Route::resource('/beranda-sd', 'DashboardSdController');
Route::get('/beranda-sd-biodata', 'DashboardSdController@biodata')->name('beranda-sd.biodata');
Route::get('/beranda-sd-cetak-berkas', 'DashboardSdController@cetakBerkas')->name('beranda-sd.cetak-berkas');
Route::get('/beranda-sd-name-tag-pdf', 'DashboardSdController@nameTag')->name('beranda-sd.name-tag');
Route::get('/beranda-sd-biodata-pdf', 'DashboardSdController@biodataPdf')->name('beranda-sd.biodata-pdf');
Route::get('/beranda-sd-evaluasi-pdf', 'DashboardSdController@evaluasiPdf')->name('beranda-sd.evaluasi-pdf');
Route::get('/ganti-password', 'PasswordController@gantiPasswordForm');
Route::post('/ganti-password', 'PasswordController@gantiPassword');
// End Student Day Mahasiswa

Route::get('/bkm', function () {
    return view('bkm.index');
});

Route::get('/granat', function () {
    return view('granat.index');
});

Route::get('/gallery', function () {
    return view('gallery.index');
});


// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/test', function(){
    return view('sd.identitas');
});