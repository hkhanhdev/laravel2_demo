<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App;

Route::get('/',[App::class,'index']);

Route::get('/admin/index',[App::class,'adminIndex']);

Route::get('/admin/category_list',[App::class,'getAllCate']);

Route::get('/admin/product_list',[App::class,'getAllPrd']);

Route::post("/admin/delete_product",[App::class,"delete_prd"]);

Route::post("/admin/delete_category",[App::class,"delete_cate"]);

Route::get("/admin/edit_product",[App::class,"getAllPrd"]);

Route::get("/admin/edit_category",[App::class,"getAllCate"]);

Route::post("/admin/edit_category",[App::class,'update_cate']);

Route::post("/admin/edit_product",[App::class,"update_prd"]);

Route::post("/admin/add_cate",[App::class,'update_cate']);

Route::post("/admin/add_product",[App::class,'update_prd']);

Route::post("/admin/product_list",[App::class,"searching"]);

Route::post("/admin/category_list",[App::class,"searching"]);


