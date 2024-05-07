<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BlogController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\MailController;
use App\Http\Controllers\Frontend\OnePageController;

// use App\Http\Controllers\Frontend\BlogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Front end

    Route::get('/', [HomeController::class, 'index']);
    Route::post('index/ajax', [HomeController::class, 'ajaxProduct']);
//cart, checkout-sendmail

    Route::prefix('/cart')->name('cart')->group( function() {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/ajax', [CartController::class, 'ajax']);
        Route::get('/checkout', [MailController::class, 'index']);
        // Route::get('/test', [App\Http\Controllers\MailController::class, 'index']);
        Route::get('/checkout/test', [MailController::class, 'sendMail']);
    });

//shop product
    Route::prefix('/shop')->name('shop')->group(function() {
        Route::get('/', [ProductController::class, 'index'])->name('.index');
        Route::get('/product-detail/{id}', [ProductController::class, 'indexProductDetail']);
    });
    //check not login for form login
    Route::group(['middleware' => 'memberNotLogin'], function () {

        Route::get('/member/login', [MemberController::class, 'indexLogin'])->name('member.indexLogin');
        Route::post('/member/login', [MemberController::class, 'login'])->name('member.login');
        Route::get('/member/register', [MemberController::class, 'register'])->name('member.register');
        Route::post('/member/register', [MemberController::class, 'postRegister'])->name('member.postRegister');

   });
    //check login
    Route::group(['middleware' => 'member'] , function() {
        //product
        Route::prefix('/member/account')->name('account.')->group(function(){
            Route::get('/', [AccountController::class, 'index'])->name('index');
            Route::post('/update', [AccountController::class, 'updateAccount'])->name('update');
            Route::get('/my-product', [AccountController::class, 'showMyProduct'])->name('myproduct');
            Route::get('/add-product', [AccountController::class, 'addProduct'])->name('addProduct');
            Route::post('/add-product', [AccountController::class, 'postProduct'])->name('postProduct');
            Route::get('/edit-product/{id}', [AccountController::class, 'editProduct'])->name('editProduct');
            Route::post('/update-product', [AccountController::class, 'updateProduct'])->name('updateProduct');
            Route::get('/delete-product/{id}', [AccountController::class, 'deleteProduct'])->name('deleteProduct');
        });
        //member

        Route::get('/member/profile', [MemberController::class, 'profile'])->name('profile');
        Route::get('/member/log-out', [MemberController::class, 'logout']);
    });


    Route::prefix('blog-list')->name('blog-list.')->group(function(){
        Route::get('/', [App\Http\Controllers\Frontend\BlogController::class, 'index'])->name('index');
        Route::get('/blog-detail/{id}', [App\Http\Controllers\Frontend\BlogController::class, 'show'])->name('show');
        Route::post('blog-detail/rate/ajax', [App\Http\Controllers\Frontend\BlogController::class, 'rate']);
        Route::post('blog-detail/cmt/ajax', [App\Http\Controllers\Frontend\BlogController::class, 'comment']);
    });

//search
    Route::get('/search', [OnePageController::class, 'index']);
    Route::get('/search-advandce', [OnePageController::class, 'searchAdvandce']);
    Route::get('/search-price/ajax', [OnePageController::class, 'searchPrice']);

//Auth
Auth::routes();

Route::get('/home',[App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Admin
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['admin'],
], function() {

    Route::prefix('/dashboard')->name('dashboard.')->group(function(){
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::get('/page-profile', [DashboardController::class, 'getProfile'])->name('getProfile');
        Route::post('/update', [DashboardController::class, 'update'])->name('updateProfile');

        Route::prefix('/country')->name('country.')->group(function(){
            Route::get('/', [CountryController::class, 'index'])->name('index');

            Route::get('/add', [CountryController::class, 'getCountry'])->name('getCountry');
            Route::post('/add', [CountryController::class, 'postAdd'])->name('postAdd');

            Route::get('/delete/{id}', [CountryController::class, 'deleteCountry'])->name('deleteCountry');
        });

        Route::prefix('blog')->name('blog.')->group(function(){
            Route::get('/', [BlogController::class, 'index'])->name('index');
            Route::get('/add', [BlogController::class, 'getBlog'])->name('getBlog');
            Route::post('/add', [BlogController::class, 'postBlog'])->name('postBlog');
            Route::get('/edit/{id}', [BlogController::class, 'editBlog'])->name('editBlog');
            Route::post('/update', [BlogController::class, 'updateBlog'])->name('updateBlog');

            Route::get('/delete/{id}', [BlogController::class, 'delete'])->name('delete');
        });

        Route::get('/list-user', [DashboardController::class, 'getListUser'])->name('getListUser');

        Route::get('/form-basic', [DashboardController::class, 'getForm'])->name('getForm');

        Route::get('/table-basic', [DashboardController::class, 'getTable'])->name('getTable');

        Route::get('/icon-material', [DashboardController::class, 'getIcon'])->name('getIcon');

        Route::get('/blank', [DashboardController::class, 'getBlank'])->name('getBlank');

        Route::get('/error-404', [DashboardController::class, 'getError'])->name('getError');
    });
    Route::post('/log-out', [App\Http\Controllers\Admin\UserController::class, 'logout']);
});




