<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAge;

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
Route::get('exception/index', 'ExceptionController@index');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//
Route::get('home', 'HomeController@index');

/*Before Login Pages Starts */
//Client user Login Form & Post
Route::get('login/{name}', function ($name) {
    return view('auth/login', ["name"=>$name]);
})->where(['name' => '[a-z]+']);
Route::post('login/clients', 'ClientsController@login')
->middleware("throttle:3,1");

//Registration
Route::get('clients/register', 'ClientsController@register')
->name('clients.register');
Route::post('clients/registration', 'ClientsController@registration')
->name('clients.registration');
Route::get('/permission-denied', 'AdminsController@permissionDenied')
->name('nopermission');
Route::get('country/state/{id}', 'CountryController@state')
    ->where(['id' => '[0-9]+']);
/*Before Login Pages Ends */

Route::group(['middleware'=>['auth']], function () {
    //Authenticated but not in admin guards
   
    //Admin and client user can list of user
    Route::get('user/userlist', 'UserController@userlist')
                ->name('user.listuser');
    //Admin and Client user can create user
    Route::get('user/register', 'UserController@register')
                ->name('user.register');
    Route::post('registerstore', 'UserController@registerstore')
                ->name('user.registerstore');
    /* Route::get('clients/allclients', 'ClientsController@allclients')
        ->name('allclients'); */
    // Route::resource('book', 'BookController'); pending

    //Admin, Client and User can create, modify, delete book
    Route::group(['middleware'=> ['admin']], function () {
        // Route::middleware([CheckAge::class])->group(function () {
        Route::resource('admin', 'AdminsController');
        Route::resource('clients', 'ClientsController');
        Route::resource('book', 'BookController');
        // Route::resource('users', 'UserController');
        // Route::resource('roles', 'RoleController');
        Route::get('user', 'UserController@index');
    });

    Route::group(['middleware'=> ['clients']], function () {
        Route::get('clientsprofile/{id}', 'ClientsController@profile')->where(['id' => '[0-9]+']);
        Route::get('ownclientbooklist', 'BookController@clientBookList')->name('ownclientbooklist');
        Route::get('ownclientbookcreate', 'BookController@clientBookCreate')->name('ownclientbookcreate');
        Route::post('ownclientbookcreate', 'BookController@clientBookStore')->name('ownclientbookcreate');
        Route::resource('user', 'UserController');
    });

    Route::group(['middleware'=> ['user']], function () {
        Route::get('userprofile/{id}', 'UserController@profile')->where(['id' => '[0-9]+']);
        // Route::get('/home', 'HomeController@index')->name('home');
        //Edit & Delete Pending
        /* Route::get('ownbooklist', 'BookController@userBookList')->name('ownbooklist');
        Route::get('ownbookcreate', 'BookController@userBookCreate')->name('ownbookcreate');
        Route::post('ownbookcreate', 'BookController@userBookStore')->name('ownbookcreate'); */
    });
});
