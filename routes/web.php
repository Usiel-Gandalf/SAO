<?php

use Illuminate\Support\Facades\Route;

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
    return view('login');
});

//Auth::routes();

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
//Fin de la ruta de recursos

//Rutas de busqueda 
Route::get('searchRegion', 'RegionController@show')->name('searchRegion');
Route::get('searchMunicipality', 'MunicipalityController@show')->name('searchMunicipality');
Route::get('searchLocality', 'LocalityController@show')->name('searchLocality');
Route::get('searchSchool', 'SchoolController@show')->name('searchSchool');
Route::get('searchScholar', 'ScholarController@show')->name('searchScholar');
Route::get('searchTitular', 'TitularController@show')->name('searchTitular');
Route::get('searchBasic', 'BasicController@show')->name('searchBasic');
//Fin de las rutas de busqueda

//Rutas para ir a los formularios de importacion de archivos excel
Route::get('importEntities', function () {
    return view('user.import.importEntities');
})->name('importEntities');

Route::get('importScholars', function () {
    return view('user.import.importScholars');
})->name('importScholars');

Route::get('importBasic', function () {
    return view('user.import.importBasic');
})->name('importBasic');

Route::get('importMedium', function () {
    return view('user.import.importMedium');
})->name('importMedium');

Route::get('importHiger', function () {
    return view('user.import.importHiger');
})->name('importHiger');

Route::get('basicReport', function () {
    return view('user.universes.basicReport');
})->name('basicReport');
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
Route::get('basicReport', 'BasicController@basicReport')->name('basicReport');
Route::post('basicSearch', 'BasicController@basicSearch')->name('basicSearch');

