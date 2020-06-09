<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('employees', 'EmployeeController');
    Route::resource('companies', 'CompanyController');
});
