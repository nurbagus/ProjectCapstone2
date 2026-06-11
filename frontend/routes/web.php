<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ProcurementController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\BhpController;
use App\Http\Controllers\MaintenanceController;

use App\Http\Controllers\DashboardController;

Route::get(
    '/dashboard',
    [DashboardController::class,'index']
)->middleware('check.login');


Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthController;

Route::get('/login',
    [AuthController::class,'showLogin']);

Route::post('/login',
    [AuthController::class,'login']);

Route::get('/logout',
    [AuthController::class,'logout']);


Route::middleware('check.login')->group(function () {

    Route::get(
        '/users',
        [UserController::class,'index']
    );

    Route::get(
        '/users/create',
        [UserController::class,'create']
    );

    Route::post(
        '/users/store',
        [UserController::class,'store']
    );

    Route::get(
        '/users/edit/{id}',
        [UserController::class,'edit']
    );

    Route::post(
        '/users/update/{id}',
        [UserController::class,'update']
    );

    Route::get(
        '/users/delete/{id}',
        [UserController::class,'destroy']
    );

});

Route::middleware('check.login')->group(function () {

    Route::get(
        '/rooms',
        [RoomController::class,'index']
    );

    Route::get(
        '/rooms/create',
        [RoomController::class,'create']
    );

    Route::post(
        '/rooms/store',
        [RoomController::class,'store']
    );

    Route::get(
        '/rooms/edit/{id}',
        [RoomController::class,'edit']
    );

    Route::post(
        '/rooms/update/{id}',
        [RoomController::class,'update']
    );

    Route::get(
        '/rooms/delete/{id}',
        [RoomController::class,'destroy']
    );

});

Route::middleware('check.login')->group(function () {

    Route::get(
        '/drafts',
        [ProcurementController::class,'index']
    );

    Route::get(
        '/drafts/create',
        [ProcurementController::class,'create']
    );

    Route::post(
        '/drafts/store',
        [ProcurementController::class,'store']
    );

    Route::get(
        '/drafts/items/{item_id}/edit',
        [ProcurementController::class,'editItem']
    );

    Route::post(
        '/drafts/items/{item_id}/update',
        [ProcurementController::class,'updateItem']
    );

    Route::post(
        '/drafts/items/{item_id}/delete',
        [ProcurementController::class,'deleteItem']
    );

    Route::get(
        '/drafts/{id}/items',
        [ProcurementController::class,'items']
    );

    Route::post(
        '/drafts/{id}/items/store',
        [ProcurementController::class,'storeItem']
    );

    Route::post(
        '/drafts/{id}/submit',
        [ProcurementController::class,'submitDraft']
    );

});

Route::middleware('check.login')->group(function () {

    Route::get(
        '/reviews',
        [ReviewController::class,'index']
    );

    Route::get(
        '/reviews/{id}',
        [ReviewController::class,'detail']
    );

    Route::get(
        '/reviews/item/{id}/approve',
        [ReviewController::class,'approve']
    );

    Route::get(
        '/reviews/item/{id}/reject',
        [ReviewController::class,'reject']
    );

    Route::get(
        '/reviews/draft/{id}/finalize',
        [ReviewController::class,'finalize']
    );

});

Route::middleware('check.login')->group(function () {

    Route::get(
        '/inventories',
        [InventoryController::class,'index']
    );

    Route::get(
        '/inventories/create',
        [InventoryController::class,'create']
    );

    Route::post(
        '/inventories/store',
        [InventoryController::class,'store']
    );

    Route::get(
        '/inventories/{id}',
        [InventoryController::class,'show']
    );

    Route::post(
        '/inventories/{id}/upload',
        [InventoryController::class,'uploadPhoto']
    );

});

Route::middleware('check.login')->group(function () {

    Route::get(
        '/bhp',
        [BhpController::class,'index']
    );

    Route::get(
        '/bhp/create',
        [BhpController::class,'create']
    );

    Route::post(
        '/bhp/store',
        [BhpController::class,'store']
    );

    Route::get(
        '/bhp/{id}/stock-in',
        [BhpController::class,'stockInForm']
    );

    Route::post(
        '/bhp/{id}/stock-in',
        [BhpController::class,'stockIn']
    );

    Route::get(
        '/bhp/{id}/stock-out',
        [BhpController::class,'stockOutForm']
    );

    Route::post(
        '/bhp/{id}/stock-out',
        [BhpController::class,'stockOut']
    );

    Route::get(
        '/bhp/low-stock',
        [BhpController::class,'lowStock']
    );

});

Route::middleware('check.login')->group(function () {

    Route::get(
        '/maintenance',
        [MaintenanceController::class,'index']
    );

    Route::get(
        '/maintenance/create',
        [MaintenanceController::class,'create']
    );

    Route::post(
        '/maintenance/store',
        [MaintenanceController::class,'store']
    );

    Route::get(
        '/maintenance/{id}',
        [MaintenanceController::class,'show']
    );

});