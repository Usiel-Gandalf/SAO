<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

Route::get('/', function () {
        return view('auth.login');
})->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');

//Rutas de recursos
Route::resource('admin', 'AdminController');
Route::resource('boss', 'BossController');
Route::resource('region', 'RegionController');
Route::resource('municipality', 'MunicipalityController');
Route::resource('locality', 'LocalityController');
Route::resource('school', 'SchoolController');
Route::resource('scholar', 'ScholarController');
Route::resource('titular', 'TitularController');
Route::resource('basicEducation', 'BasicController');
Route::resource('mediumEducation', 'MediumController');
Route::resource('higerEducation', 'HigerController');
//Fin de la ruta de recursos

//Rutas de busqueda 
Route::get('searchRegion', 'RegionController@show')->name('searchRegion');
Route::get('searchMunicipality', 'MunicipalityController@show')->name('searchMunicipality');
Route::get('searchLocality', 'LocalityController@show')->name('searchLocality');
Route::get('searchSchool', 'SchoolController@show')->name('searchSchool');
Route::get('searchScholar', 'ScholarController@show')->name('searchScholar');
Route::get('searchTitular', 'TitularController@show')->name('searchTitular');
Route::get('searchAdmin', 'AdminController@show')->name('searchAdmin');
Route::get('searchBoss', 'BossController@show')->name('searchBoss');
Route::get('searchBasic', 'BasicController@show')->name('searchBasic');
Route::get('searchMedium', 'MediumController@show')->name('searchMedium');
Route::get('searchHiger', 'HigerController@show')->name('searchHiger');
//Fin de las rutas de busqueda

//Rutas para ir a los formularios de importacion de archivos excel y los reportes o graficas
Route::get('importRegions', 'RouteController@importRegions')->name('importRegions');
Route::get('importMunicipalities', 'RouteController@importMunicipalities')->name('importMunicipalities');
Route::get('importLocalities', 'RouteController@importLocalities')->name('importLocalities');
Route::get('importSchools', 'RouteController@importSchools')->name('importSchools');
Route::get('importScholars', 'RouteController@importScholars')->name('importScholars');
Route::get('importBasics', 'RouteController@importBasics')->name('importBasics');
Route::get('importMediums', 'RouteController@importMediums')->name('importMediums');
Route::get('importReissue', 'RouteController@importReissue')->name('importReissue');
Route::get('importHigers', 'RouteController@importHigers')->name('importHigers');
//Fin de las rutas de formularios

//Rutas de importacion de las entidades, becarios, titulares y archivos excel en general
Route::post('importRegion', 'ImportController@importRegion')->name('importRegion');
Route::post('importMunicipality', 'ImportController@importMunicipality')->name('importMunicipality');
Route::post('importLocality', 'ImportController@importLocality')->name('importLocality');
Route::post('importSchool', 'ImportController@importSchool')->name('importSchool');
Route::post('importScholar', 'ImportController@importScholar')->name('importScholar');
Route::post('importTitular', 'ImportController@importTitular')->name('importTitular');
Route::post('importBasic', 'importController@importBasic')->name('importBasic');
Route::post('updateBasic', 'importController@updateBasic')->name('updateBasic');
Route::post('importMedium', 'importController@importMedium')->name('importMedium');
Route::post('updateMedium', 'importController@updateMedium')->name('updateMedium');
Route::post('importReissue', 'importController@importReissue')->name('importReissue');
Route::post('updateReissue', 'importController@updateReissue')->name('updateReissue');
Route::post('importHiger', 'importController@importHiger')->name('importHiger');
Route::post('updateHiger', 'importController@updateHiger')->name('updateHiger');
//Fin de las rutas de importacion de archivos excel 

//Rutas para ver informacion de los niveles educativos
Route::get('basicReport', 'RouteController@basicReport')->name('basicReport');
Route::post('basicSearch', 'RouteController@basicSearch')->name('basicSearch');

//Editar pasword y perfiles de administradores y jefes juar por parte de los administradores
Route::get('admin/{id}/editPasswordAdmin', 'AdminController@editPasswordAdmin');
Route::post('admin/{id}/updatePasswordAdmin', 'AdminController@updatePasswordAdmin');
Route::get('boss/{id}/editPasswordBoss', 'BossController@editPasswordBoss');
Route::post('boss/{id}/updatePasswordBoss', 'BossController@updatePasswordBoss');

//rutas para ver los bimestres de los diferentes niveles educativos
Route::get('basicBimestersCerm', 'RouteController@basicBimestersCerm')->name('basicBimestersCerm');
Route::get('basicBimestersDelivery', 'RouteController@basicBimestersDelivery')->name('basicBimestersDelivery');
Route::get('mediumBimestersDelivery', 'RouteController@mediumBimestersDelivery')->name('mediumBimestersDelivery');
Route::get('higerBimestersDelivery', 'RouteController@higerBimestersDelivery')->name('higerBimestersDelivery');

//Rutas para el control de los perfiles como administrador
Route::get('adminProfile', 'AdminprofileController@adminProfile')->name('adminProfile');
Route::get('editAdminProfile', 'AdminprofileController@editAdminProfile')->name('editAdminProfile');
Route::post('editAdminProfile/{id}/updateAdminProfile', 'AdminprofileController@updateAdminProfile');

Route::get('editAdminPassword', 'AdminprofileController@editAdminPassword')->name('editAdminPassword');
Route::post('editAdminPassword/{id}/updateAdminPassword', 'AdminprofileController@updateAdminPassword');

Route::get('editAdminEmail', 'AdminprofileController@editAdminEmail')->name('editAdminEmail');
Route::post('editAdminEmail/{id}/updateAdminEmail', 'AdminprofileController@updateAdminEmail');

// Rutas para el control de los perfiles como jefes juar
Route::get('bossProfile', 'BossprofileController@bossProfile')->name('bossProfile');
Route::get('editBossProfile', 'BossprofileController@editBossProfile')->name('editBossProfile');
Route::post('editBossProfile/{id}/updateBossProfile', 'BossprofileController@updateBossProfile');
Route::get('editBossPassword', 'BossprofileController@editBossPassword')->name('editBossPassword');
Route::post('editBossPassword/{id}/updateBossPassword', 'BossprofileController@updateBossPassword');
Route::get('editBossEmail', 'BossprofileController@editBossEmail')->name('editBossEmail');
Route::post('editBossEmail/{id}/updateBossEmail', 'BossprofileController@updateBossEmail');

//ruta de reportes por entidades 
Route::get('reportRegion/{id}/reportRegion/{type}', 'RegionController@reportRegion');
Route::get('reportMunicipality/{id}/reportMunicipality/{type}', 'MunicipalityController@reportMunicipality');
Route::get('reportLocality/{id}/reportLocality/{type}', 'LocalityController@reportLocality');
Route::get('reportSchool/{id}/reportSchool/{type}', 'SchoolController@reportSchool');
Route::get('basicPdf', 'BasicController@basicPdf');
Route::get('mediumPdf', 'MediumController@mediumPdf');
Route::get('higerPdf', 'HigerController@higerPdf');