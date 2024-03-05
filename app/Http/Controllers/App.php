<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use function Laravel\Prompts\table;

class App extends Controller
{
    public function index()
    {
        return view("client/index");
    }
    public function adminIndex() {
        return view("admin/admin-index");
    }

    public function getAllCate() {
        // SELECT * FROM category
        $route = Route::getCurrentRoute();

        $categories = DB::table("category")
            ->get();
        return view("admin/category-list", [
            "categories" => $categories,"route"=>$route
        ]);
    }

    public function getAllPrd() {
        // SELECT * FROM product
        $route = Route::getCurrentRoute();
        $products = DB::table("product")
            ->get();
        return view("admin/product_list", [
            "products" => $products,"route"=>$route
        ]);
    }

    public function delete_prd(Request $request)
    {
        $prd_id = $request->input("prd_id");

        $is_deleted = DB::table('product')->where('id', $prd_id)->delete();

        if ($is_deleted) {
            return redirect()->back()->with('success', 'Record deleted successfully.'); #redirect back to previous route and flash a session message
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function delete_cate(Request $request)
    {
        $cate_id = $request->input("cate_id");

        $is_deleted = DB::table('category')->where('id', $cate_id)->delete();

        if ($is_deleted) {
            return redirect()->back()->with('success', 'Record deleted successfully.'); #redirect back to previous route and flash a session message
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function update_prd(Request $request)
    {
        $prd_id = $request->input("prd_idd");
        $prd_name = $request->input("prd_name");

        $is_updated = DB::table('product')->where('id',$prd_id)->update(['prd_name'=>$prd_name]);

        if ($is_updated) {
            return redirect()->back()->with('success', 'Record updated successfully.'); #redirect back to previous route and flash a session message
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function update_cate(Request $request)
    {
        $cate_id = $request->input("cate_idd");
        $cate_name = $request->input("cate_name");
        $is_updated = DB::table('category')->where('id',$cate_id)->update(['category_name'=>$cate_name]);
        if ($is_updated) {
            return redirect()->back()->with('success', 'Record updated successfully.'); #redirect back to previous route and flash a session message
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }


}
