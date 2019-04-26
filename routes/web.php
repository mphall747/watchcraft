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

// Contains routes that are only available to logged in users
Route::group(['middleware' => ['auth']], function () 
{
    // Calls instore() in ReportsController.php
    Route::get('/tickets/instore', 'ReportsController@instore');

    // Calls send() in ReportsController.php
    Route::get('/tickets/send', 'ReportsController@send');

    // Calls workshop() in ReportsController.php
    Route::get('/tickets/workshop', 'ReportsController@workshop');

    // Calls return() in ReportsController.php
    Route::get('/tickets/return', 'ReportsController@return');

    // Calls complete() in ReportsController.ph
    Route::get('/tickets/complete', 'ReportsController@complete');

    // Calls paid() in ReportsController.php
    Route::get('/tickets/paid', 'ReportsController@paid');

    // Calls all() in ReportsController.php
    Route::get('/tickets/all', 'ReportsController@all');

    // Calls customers() in ReportsController.php
    Route::get('/customers', 'ReportsController@customers');

    // Calls inventories() in ReportsController.php with {id} as $id
    Route::get('/inventories/id/{id}', 'ReportsController@inventories');

    // Calls parts() in ReportsController.php
    Route::get('/inventories/parts', 'ReportsController@parts');

    // Calls suppliers() in ReportsController.php
    Route::get('/inventories/suppliers', 'ReportsController@suppliers');



    // Calls add() in TicketsController.php
    Route::get('/tickets/add', 'TicketsController@add');

    // Calls insert() in TicketsController.php
    Route::post('/tickets/insert', 'TicketsController@insert');

    // Calls details() in TicketsController.php with {id} as $id
    Route::get('/tickets/id/{id}', 'TicketsController@details');

    // Calls edit() in TicketsController.php with {id} as $id
    Route::get('/tickets/edit/{id}', 'TicketsController@edit');

    // Calls update() in TicketsController.php with {id} as $id
    Route::post('/tickets/update/{id}', 'TicketsController@update');

    // Calls receive() in TicketsController.php with {id} as $id
    Route::get('/tickets/receive/{id}', 'TicketsController@receive');

    // Calls complete() in TicketsController.php with {id} as $id
    Route::post('/tickets/complete/{id}', 'TicketsController@complete');

    // Calls return() in TicketsController.php with {id} as $id
    Route::get('/tickets/return/{id}', 'TicketsController@return');

    // Calls pay() in TicketsController.php with {id} as $id
    Route::post('/tickets/pay/{id}', 'TicketsController@pay');


    
    // Returns view customers/add.blade.php
    Route::get('/customers/add', function () {
        return view('customers/add');
    });

    // Calls insert() in CustomersController.php
    Route::post('/customers/insert', 'CustomersController@insert');

    // Calls details() in CustomersContoller.php with {id} as $id
    Route::get('/customers/id/{id}', 'CustomersController@details');

    // Calls edit() in CustomersContoller.php with {id} as $id
    Route::get('/customers/edit/{id}', 'CustomersController@edit');

    // Calls update() in CustomersContoller.php with {id} as $id
    Route::post('/customers/update/{id}', 'CustomersController@update');

    //Calls delete() in CustomersConroller.php with {id} as $id
    Route::get('/customers/delete/{id}', 'CustomersController@delete');



    // Returns view inventories/suppliers/add.blade.php
    Route::get('/inventories/suppliers/add', function () {
        return view('inventories/suppliers/add');
    });

    // Calls supplierInsert() in InventoriesController.php
    Route::post('/inventories/suppliers/insert', 'InventoriesController@supplierInsert');

    // Calls supplierEdit() in InventoriesController.php with {id} as $id
    Route::get('/inventories/suppliers/edit/{id}', 'InventoriesController@supplierEdit');

    // Calls supplierUpdate() in InventoriesController.php with {id} as $id
    Route::post('/inventories/suppliers/update/{id}', 'InventoriesController@supplierUpdate');

    // Calls partAdd() in InventoriesController.php
    Route::get('/inventories/parts/add', 'InventoriesController@partAdd');

    // Calls partInsert() in InventoriesController.php
    Route::post('/inventories/parts/insert', 'InventoriesController@partInsert');

    // Calls partEdit() in InventoriesController.php with {id} as $id
    Route::get('/inventories/parts/edit/{id}', 'InventoriesController@partEdit');

    // Calls partUpdate() in InventoriesController.php with {id} as $id
    Route::post('/inventories/parts/update/{id}', 'InventoriesController@partUpdate');

    // Calls inventoryAdd1() in InventoriesController.php
    Route::get('/inventories/add/1', 'InventoriesController@inventoryAdd1');

    // Calls inventoryAdd2() in InventoriesController.php
    Route::post('/inventories/add/2', 'InventoriesController@inventoryAdd2');

    // Calls inventoryInsert() in InventoriesController.php
    Route::post('/inventories/insert/', 'InventoriesController@inventoryInsert');

    // Calls edit() in InventoriesController.php with {id} as $id
    Route::get('/inventories/edit/{branch}/{part}', 'InventoriesController@edit');

    // Calls update() in InventoriesController.php with {id} as $id
    Route::post('/inventories/update/{branch}/{part}', 'InventoriesController@update');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
