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
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// Top page
Route::get('/', 'HelloController@index');

Route::get('/organization/verifier', 'OrganizationController@index');
Route::get('/organization/issuer', 'OrganizationController@index')->name('organization.issuer');

Route::get('/verification/{organization_id}', 'VerificationController@index')->where('organization_id', '[0-9]+');
Route::post('/verification/verify', 'VerificationController@verify');

Route::group(['middleware' => ['auth', 'can:system-only']], function () {
    Route::get('/issuer/new', 'IssuerController@new');
    Route::post('/issuer/new', 'IssuerController@store');
});
Route::group(['middleware' => ['auth', 'can:issuer-role']], function () {
    Route::get('/issuer/{organization_id}', 'IssuerController@index')->where('organization_id', '[0-9]+');
    Route::post('/issuer', 'IssuerController@validIssue');
    Route::post('/issuer/valid', 'IssuerController@storeValidIssue');
    Route::post('/issuer/invalid', 'IssuerController@storeInvalidIssue');
});