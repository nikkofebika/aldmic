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
// Route::get('/login', function () {
// 	return view('welcome');
// });
Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);

// Route::get('console', function(){
// 	return redirect('console/login');
// });
// Route::get('/console/login', [App\Http\Controllers\Console\AuthController::class, 'showLoginForm'])->name('console.login');
// Route::post('/console/login_admin', [App\Http\Controllers\Console\AuthController::class, 'login']);
Auth::routes();

Route::group(['prefix' => 'dashboard', 'middleware' => 'IsAdmin'], function () {
	Route::get('/', [App\Http\Controllers\Dashboard\DashboardController::class, 'index']);
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::group(['prefix' => 'console', 'as' => 'console.', 'middleware' => ['IsAdmin','auth:admin']], function () {
// 	Route::post('logout', [App\Http\Controllers\Console\AuthController::class, 'logout']);
// 	Route::get('dashboard', [App\Http\Controllers\Console\DashboardController::class, 'index']);

// 	Route::get('users/list', [App\Http\Controllers\Console\UserController::class, 'getUsers'])->name('users.list');
// 	Route::post('users/ajax_active_user', [App\Http\Controllers\Console\UserController::class, 'ajax_active_user']);

// 	Route::get('articles/list', [App\Http\Controllers\Console\ArticleController::class, 'getArticles'])->name('articles.list');
// 	Route::post('articles/ajax_approve_article', [App\Http\Controllers\Console\ArticleController::class, 'ajax_approve_article']);

// 	Route::get('article-categories', [App\Http\Controllers\Console\ArticleCategoryController::class, 'index']);
// 	Route::post('article-categories/ajax_cek_category', [App\Http\Controllers\Console\ArticleCategoryController::class, 'ajax_cek_category']);
// 	Route::post('article-categories/ajax_active_category', [App\Http\Controllers\Console\ArticleCategoryController::class, 'ajax_active_category']);
// 	Route::get('article-categories/{id}', [App\Http\Controllers\Console\ArticleCategoryController::class, 'show']);
// 	Route::post('article-categories', [App\Http\Controllers\Console\ArticleCategoryController::class, 'store']);
// 	Route::put('article-categories/{id}', [App\Http\Controllers\Console\ArticleCategoryController::class, 'update']);
// 	Route::delete('article-categories/destroy/{id}', [App\Http\Controllers\Console\ArticleCategoryController::class, 'destroy']);

// 	Route::get('facilities/list', [App\Http\Controllers\Console\FacilityController::class, 'getFacilities'])->name('facilities.list');
// 	Route::post('facilities/ajax_active_facility', [App\Http\Controllers\Console\FacilityController::class, 'ajax_active_facility']);

// 	Route::get('rooms/list', [App\Http\Controllers\Console\RoomController::class, 'getRooms'])->name('rooms.list');
// 	Route::post('rooms/ajax_approve_room', [App\Http\Controllers\Console\RoomController::class, 'ajax_approve_room']);
	
// 	Route::get('rooms/booking_schedules', [App\Http\Controllers\Console\RoomController::class, 'booking_schedules']);
// 	Route::get('rooms/ajax_load_schedules/{scheduleId?}', [App\Http\Controllers\Console\RoomController::class, 'ajax_load_schedules']);
// 	Route::post('rooms/ajax_move_schedule', [App\Http\Controllers\Console\RoomController::class, 'ajax_move_schedule']);
// 	Route::get('rooms/ajax_get_today_schedules/{roomId}/{date}/{scheduleId?}', [App\Http\Controllers\Console\RoomController::class, 'ajax_get_today_schedules']);
// 	Route::post('rooms/ajax_create_booking_schedules', [App\Http\Controllers\Console\RoomController::class, 'ajax_create_booking_schedules']);
// 	Route::any('rooms/create_booking_schedules', [App\Http\Controllers\Console\RoomController::class, 'create_booking_schedules']);
// 	Route::post('rooms/ajax_edit_booking_schedules/{id}', [App\Http\Controllers\Console\RoomController::class, 'ajax_edit_booking_schedules']);
// 	Route::post('rooms/ajax_delete_booking_schedules', [App\Http\Controllers\Console\RoomController::class, 'ajax_delete_booking_schedules']);
// 	Route::any('rooms/edit_booking_schedules/{id}', [App\Http\Controllers\Console\RoomController::class, 'edit_booking_schedules']);
// 	Route::get('rooms/booking_schedule_list', [App\Http\Controllers\Console\RoomController::class, 'booking_schedule_list'])->name('rooms.booking_schedule_list');

// 	Route::resources([
// 		'users' => App\Http\Controllers\Console\UserController::class,
// 		'articles' => App\Http\Controllers\Console\ArticleController::class,
// 		'facilities' => App\Http\Controllers\Console\FacilityController::class,
// 		'rooms' => App\Http\Controllers\Console\RoomController::class,
// 	]);
// });