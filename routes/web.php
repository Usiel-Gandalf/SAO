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
});



Route::get('/home', 'HomeController@index')->name('home');


//Rutas de recursos
Route::resource('user', 'UserController');
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
Route::get('searchUser', 'UserController@show')->name('searchUser');
Route::get('searchBasic', 'BasicController@show')->name('searchBasic');
Route::get('searchMedium', 'MediumController@show')->name('searchMedium');
Route::get('searchHiger', 'HigerController@show')->name('searchHiger');
//Fin de las rutas de busqueda

//Rutas para ir a los formularios de importacion de archivos excel y los reportes o graficas
Route::get('importEntities', 'RouteController@importEntities')->name('importEntities');
Route::get('importScholars', 'RouteController@importScholars')->name('importScholars');
Route::get('importBasics', 'RouteController@importBasics')->name('importBasics');
Route::get('importMediums', 'RouteController@importMediums')->name('importMediums');
Route::get('importHigers', 'RouteController@importHigers')->name('importHigers');
//Fin de las rutas de formularios

//Rutas de importacion de las entidades, becarios, titulares y archivos excel en general
Route::post('importRegion', 'ImportController@importRegion')->name('importRegion');
Route::post('importMunicipality', 'ImportController@importMunicipality')->name('importMunicipality');
Route::post('importLocality', 'ImportController@importLocality')->name('importLocality');
Route::post('importSchool', 'ImportController@importSchool')->name('importSchool');
Route::post('importScholar', 'ImportController@importScholar')->name('importScholar');
Route::post('importBasic', 'importController@importBasic')->name('importBasic');
Route::post('importMedium', 'importController@importMedium')->name('importMedium');
Route::post('importHiger', 'importController@importHiger')->name('importHiger');
//Fin de las rutas de importacion de archivos excel 

//Rutas para ver informacion de los niveles educativos
Route::get('basicReport', 'RouteController@basicReport')->name('basicReport');
Route::post('basicSearch', 'RouteController@basicSearch')->name('basicSearch');

//Editar pasword y perfiles
Route::get('user/{id}/editPassword', 'UserController@editPassword');
Route::post('user/{id}/updatePassword', 'UserController@updatePassword');

//rutas para ver los bimestres de los diferentes niveles educativos
Route::get('basicBimestersCerm', 'RouteController@basicBimestersCerm')->name('basicBimestersCerm');
Route::get('basicBimestersDelivery', 'RouteController@basicBimestersDelivery')->name('basicBimestersDelivery');
Route::get('mediumBimestersDelivery', 'RouteController@mediumBimestersDelivery')->name('mediumBimestersDelivery');
Route::get('higerBimestersDelivery', 'RouteController@higerBimestersDelivery')->name('higerBimestersDelivery');
