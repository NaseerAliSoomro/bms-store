<?php

use Blinkswag\Store\Http\Controllers\BlinkswagStoreController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web', 'auth']], function(){

Route::get('dashboard_stores', [BlinkswagStoreController::class, "dashboard_stores"])->name("dashboard_stores");
Route::get('product/editor', [BlinkswagStoreController::class, "product_editor"])->name("product_editor"); //Inventory product list
Route::get('product/printful', [BlinkswagStoreController::class, "product_printful"])->name("product_printful"); //Printful product list
Route::post('printful/getProductDetails', [BlinkswagStoreController::class, "getProductDetails"])->name("getProductDetails");

Route::get('upload_products', [BlinkswagStoreController::class, "upload_products"])->name("upload_products");
Route::get('printful/upload_images_printful_product/{id}', [BlinkswagStoreController::class, "upload_images_printful_product"])->name("upload_images_printful_product");

Route::post('printful/getProductDetails_edit', [BlinkswagStoreController::class, "getProductDetails_edit"])->name("getProductDetails_edit");

Route::post('printful/getAllProductsByCategoryId', [BlinkswagStoreController::class, "getAllProductsByCategoryId"])->name("getAllProductsByCategoryId");
Route::post('printful/saveProductintoProductList', [BlinkswagStoreController::class, "saveProductintoProductList"])->name("saveProductintoProductList");
Route::post('deleteproductlist', [BlinkswagStoreController::class, "deleteproductlist"])->name("deleteproductlist");
//
Route::get('product/edit_product_list/{id}', [BlinkswagStoreController::class, "edit_product_list"])->name("edit_product_list"); //Printful product list
Route::get('printful/edit_printful_product/{id}', [BlinkswagStoreController::class, "edit_printful_product"])->name("edit_printful_product");
Route::post('addproductlist_store', [BlinkswagStoreController::class, "addproductlist_store"])->name("addproductlist_store");

Route::get('stores', [BlinkswagStoreController::class, "stores"])->name("stores");
Route::post('create_store', [BlinkswagStoreController::class, "create_store"])->name("create_store");
Route::post('deletestore', [BlinkswagStoreController::class, "deletestore"])->name("deletestore");
Route::post('deleteuploadimage', [BlinkswagStoreController::class, "deleteuploadimage"])->name("deleteuploadimage");
Route::post('updatestore', [BlinkswagStoreController::class, "updatestore"])->name("updatestore");
Route::get('editstore/{id}', [BlinkswagStoreController::class, "editstore"]);

Route::get('store/{storename}', [BlinkswagStoreController::class, "viewstore"]);
Route::post('userstore_signup', [BlinkswagStoreController::class, "userstore_signup"]);
Route::post('store/checkout_create_php',  [BlinkswagStoreController::class, "checkout_create_php"]);

Route::post('storeuseraddress',[BlinkswagStoreController::class, "storeuseraddress"]);
Route::get('store_order',  [BlinkswagStoreController::class, "store_order"]);
Route::post('storeUserLogin',[BlinkswagStoreController::class, "storeUserLogin"]);
Route::post('storeUserLogout',[BlinkswagStoreController::class, "storeUserLogout"]);
Route::post('forgetPassword',[BlinkswagStoreController::class, "forgetPassword"]);
Route::get('reset_password/{token}',  [BlinkswagStoreController::class, "reset_password"]);
Route::post('userstore_resetpassword',[BlinkswagStoreController::class, "userstore_resetpassword"]);

Route::get('view_uploaded_products', [BlinkswagStoreController::class, "view_uploaded_products"])->name('view_uploaded_products');
});

