<?php

use Bms\Store\Http\Controllers\StoresController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

Route::group(['middleware' => ['web', 'auth']], function(){

Route::get('dashboard_stores', [StoresController::class, "dashboard_stores"])->name("dashboard_stores");
Route::get('product/editor', [StoresController::class, "product_editor"])->name("product_editor"); //Inventory product list
Route::get('product/printful', [StoresController::class, "product_printful"])->name("product_printful"); //Printful product list
Route::post('printful/getProductDetails', [StoresController::class, "getProductDetails"])->name("getProductDetails");

Route::get('upload_products', [StoresController::class, "upload_products"])->name("upload_products");
Route::get('printful/upload_images_printful_product/{id}', [StoresController::class, "upload_images_printful_product"])->name("upload_images_printful_product");

Route::post('printful/getProductDetails_edit', [StoresController::class, "getProductDetails_edit"])->name("getProductDetails_edit");

Route::post('printful/getAllProductsByCategoryId', [StoresController::class, "getAllProductsByCategoryId"])->name("getAllProductsByCategoryId");
Route::post('printful/saveProductintoProductList', [StoresController::class, "saveProductintoProductList"])->name("saveProductintoProductList");
Route::post('deleteproductlist', [StoresController::class, "deleteproductlist"])->name("deleteproductlist");
//
Route::get('product/edit_product_list/{id}', [StoresController::class, "edit_product_list"])->name("edit_product_list"); //Printful product list
Route::get('printful/edit_printful_product/{id}', [StoresController::class, "edit_printful_product"])->name("edit_printful_product");
Route::post('addproductlist_store', [StoresController::class, "addproductlist_store"])->name("addproductlist_store");

Route::get('stores', [StoresController::class, "stores"])->name("stores");
Route::post('create_store', [StoresController::class, "create_store"])->name("create_store");
Route::post('deletestore', [StoresController::class, "deletestore"])->name("deletestore");
Route::post('deleteuploadimage', [StoresController::class, "deleteuploadimage"])->name("deleteuploadimage");
Route::post('updatestore', [StoresController::class, "updatestore"])->name("updatestore");
Route::get('editstore/{id}', [StoresController::class, "editstore"]);

Route::get('store/{storename}', [StoresController::class, "viewstore"]);
Route::post('userstore_signup', [StoresController::class, "userstore_signup"]);
Route::post('store/checkout_create_php',  [StoresController::class, "checkout_create_php"]);

Route::post('storeuseraddress',[StoresController::class, "storeuseraddress"]);
Route::get('store_order',  [StoresController::class, "store_order"]);
Route::post('storeUserLogin',[StoresController::class, "storeUserLogin"]);
Route::post('storeUserLogout',[StoresController::class, "storeUserLogout"]);
Route::post('forgetPassword',[StoresController::class, "forgetPassword"]);
Route::get('reset_password/{token}',  [StoresController::class, "reset_password"]);
Route::post('userstore_resetpassword',[StoresController::class, "userstore_resetpassword"]);

Route::get('view_uploaded_products', [StoresController::class, "view_uploaded_products"])->name('view_uploaded_products');
});

