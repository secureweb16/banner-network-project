<?php

use Illuminate\Support\Facades\Route;
use Admin as Admin;
use Advertiser as Advertiser;


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

Route::get('/', function () { return view('auth.login'); });
Route::get('register', function () { return view('auth.register'); });

Route::post('register', 'UserController@register')->name('register');
Route::get('verify-email/{token}', 'UserController@verify_email')->name('verify-email');


Route::get('/dashboard', 'HomeController@index')->middleware(['auth']);
Route::get('/logout', 'HomeController@logout')->name('logout');


// Route::get('/pdf/{uuid}/download', 'HomeController@download')->name('pdf.download');


// Route::post('/reset', [User\UserController::class, 'passwordUpdate'])->name('reset');
// Route::post('/reset', 'User\UserController@passwordUpdate')->name('reset');
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
	Route::get('/dashboard', 'Admin\AdminController@index');

	Route::get('/change-password', 'Admin\AdminController@ChangePasswordView');
	Route::post('/update-password', 'Admin\AdminController@updatePassword')->name('update-password');

	Route::get('/trash-companies', 'Admin\CompanyController@trashComapines')->name('view-trash-company');
	Route::post('/restore-company/{id}', 'Admin\CompanyController@restoreComapines')->name('restore-company');

	Route::get('/trash-appraisals', 'Admin\AppraisalController@trashAppraisals')->name('view-trash-appraisals');
	Route::post('/restore-appraisals/{id}', 'Admin\AppraisalController@restoreAppraisals')->name('restore-appraisals');

	Route::get('/trash-jewelry', 'Admin\JewelryTypeController@trashJewelry')->name('view-trash-jewelry');
	Route::post('/restore-jewelry/{id}', 'Admin\JewelryTypeController@restoreJewelry')->name('restore-jewelry');

	Route::get('/trash-users', 'Admin\UserController@trashUsers')->name('view-trash-users');
	Route::post('/restore-users/{id}', 'Admin\UserController@restoreUsers')->name('restore-users');

	
	Route::resources([
		'companies' => Admin\CompanyController::class,
		'appraisals' => Admin\AppraisalController::class,
		'jewelry-type' => Admin\JewelryTypeController::class,
		'users' => Admin\UserController::class,
	]);
});
*/
/*
|--------------------------------------------------------------------------
| Advertiser Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('publisher')->name('publisher.')->middleware('isPublisher')->group(function () {

	Route::get('/dashboard', 'Publisher\PublisherController@index')->name('index');
});

Route::prefix('advertiser')->name('advertiser.')->middleware('isAdvertiser')->group(function () {

	// Route::get('/dashboard',function(){
	// 	echo "Dfhfd";
	// });
	// Appraisal 

	Route::get('/dashboard', 'Advertiser\AdvertiserController@index')->name('index');
});
