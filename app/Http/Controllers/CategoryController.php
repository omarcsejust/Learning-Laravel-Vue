<?php

namespace App\Http\Controllers;

use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function viewCategoryDashboard(){
        return view('category/category_dashboard');
    }

    public function addCategory(Request $request){
        Category::validateCategory($request);

        $category = [
            'category_name' => $request->category_name,
            'created_at' => Carbon::now()
        ];

        Category::insert($category);
        return back();
    }

    public function viewCategoryDashboardByVueComponent(){
        return view('category/category_dashboard_vue');
    }
}
