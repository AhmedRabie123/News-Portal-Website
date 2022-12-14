<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class AdminCategoryController extends Controller
{
    public  function category_show()
    {
        $categories = Category::with('rLanguage')->orderBy('category_order', 'asc')->get();
        return view('Admin.category_show', compact('categories'));

    }

    public  function category_create()
    {

        return view('Admin.category_create');

    }

    public  function category_store(Request $request)
    {

        $request->validate([
            'category_name' => 'required|',
            'category_order' => 'required'

        ]);

        $category = new Category();

        $category->category_name = $request->category_name;
        $category->show_on_menu = $request->show_on_menu;
        $category->category_order = $request->category_order;
        $category->language_id = $request->language_id;
        $category->save();

        return redirect()->route('admin_category_show')->with('success', 'Category Created successfully.');

    }

    public function category_edit($id)
    {

        $category_single = Category::where('id',$id)->first();
        return view('Admin.category_edit', compact('category_single'));

    }

    public function category_update(Request $request, $id)
    {

        $request->validate([
            'category_name' => 'required|',
            'category_order' => 'required|'
        ]);

        $category = Category::where('id',$id)->first();

        $category->category_name = $request->category_name;
        $category->show_on_menu = $request->show_on_menu;
        $category->category_order = $request->category_order;
        $category->language_id = $request->language_id;
        $category->update();

        return redirect()->route('admin_category_show')->with('success', 'Category updated successfully.');

    }

    public function category_delete($id)
    {
        $category_single = Category::where('id',$id)->first();
        $count = SubCategory::where('category_id', $id)->count();


        if($count == 0){
            $category_single->delete();
        }else{
            return redirect()->back()->with('error', 'You Can  Not delete this category, because there is one or more SubCategory under this.');
        }

        //$category_single->rSubCategory()->delete();

        return redirect()->route('admin_category_show')->with('success', 'Category deleted successfully.');

    }
}
