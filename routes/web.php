<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePass;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Models\Multipic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\User;
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

//Route::get('/', function () {
//    return view('home');
//});

Route::get('/', function () {
    $brands =DB::table('brands')->get();
    $abouts =DB::table('home_abouts')->first();
    $images =Multipic::all();
    return view('home',compact('brands','abouts','images'));
});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
//        $users = User::all();// using elequent
       $users = DB::table('users')->get();// using the query builder
        return view('dashboard',compact('users'));})->name('dashboard');
});


//
//Route::middleware(['auth:sanctum', config('jetstream.auth_session'),
//    'verified'])->get('/dashboard', function () {
//    return view('admin.index');
//    })->name('dashboard');







Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/pdelete/category/{id}', [CategoryController::class, 'Pdelete']);

//
/// For Brand Route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);
////// Admin ALL Route
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');
////// Home About All Route
Route::get('/home/About', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/About', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/About', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']);
Route::post('/update/homeabout/{id}', [AboutController::class, 'UpdateAbout']);
Route::get('/about/delete/{id}', [AboutController::class, 'DeleteAbout']);

Route::get('/portfolio', [AboutController::class, 'portfolio'])->name('portfolio');

//////// Multi Image Route
Route::get('/multi/image', [BrandController::class, 'Multpic'])->name('multi.image');
Route::post('/multi/add', [BrandController::class, 'StoreImg'])->name('store.image');
//////// Admin Contact Page Route
Route::get('/admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');
Route::post('/admin/store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');
Route::get('/admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');
//
////
////
//
///// Home Contact Page Route
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    // $users = User::all();
    // $users = DB::table('users')->get();

    return view('admin.index');
})->name('dashboard');
Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');

//
/// Chanage Password and user Profile Route
Route::get('/user/password', [ChangePass::class, 'CPassword'])->name('change.password');
Route::post('/password/update', [ChangePass::class, 'UpdatePassword'])->name('password.update');

// User Profile
Route::get('/user/profile', [ChangePass::class, 'PUpdate'])->name('profile.update');
Route::post('/user/profile/update', [ChangePass::class, 'UpdateProfile'])->name('update.user.profile');
//Route::get('/user/profile', [ChangePass::class, 'PUpdate'])->name('profile.show');
