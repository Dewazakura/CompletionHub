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

// Top page
Route::get('/', 'HelloController@index');

Route::get('/organization/verifier', 'OrganizationController@index');
Route::get('/organization/issuer', 'OrganizationController@index')
        ->name('organization.issuer');

Route::get('/verification/{organization_id}', 'VerificationController@index')
        ->where('organization_id', '[0-9]+');

Route::get('/issuer/new', 'IssuerController@new');
Route::get('/issuer/{organization_id}', 'IssuerController@issu')
        ->where('organization_id', '[0-9]+');