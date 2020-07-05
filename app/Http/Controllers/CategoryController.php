<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Products;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $category = new Category;
            $category->name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->url = $data['category_url'];
            $category->description = $data['category_description'];
            $category->save();
            return redirect('/admin/add-category')->with('flash_message_success','Thêm danh mục sản phẩm thành công!');
        }
        $levels = Category::where(['parent_id' => 0])->get();
        return view('admin.category.add_category')->with(compact('levels'));
    }

    public function viewCategories()
    {
        $categories = Category::get();
        return view('admin.category.view_categories')->with(compact('categories'));
    }

    public function editCategory(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            Category::where(['id' => $id])->update([
                'name'          => $data['category_name'],
                'parent_id'     => $data['parent_id'],
                'url'           => $data['category_url'],
                'description'   => $data['category_description']
            ]);
            return redirect('/admin/view-categories')->with('flash_message_success', 'Câp nhật danh mục sản phẩm thành công!');
        }
        $levels = Category::where(['parent_id' => 0])->get();
        $categoryDetails = Category::where(['id' => $id])->first();
        return view('admin.category.edit_category')->with(compact('levels', 'categoryDetails'));
    }

    public function deleteCategory(Request $request)
    {
        $data = $request->all();
        $childCategory = Category::where('parent_id', $data['id'])->count();
        if ($childCategory > 0) {
            return 0;
        } else {
            $products = Products::where('category_id', $data['id'])->count();
            if ($products > 0) {
                return 0;
            } else {
                Category::where('id', $data['id'])->delete();
                return 1;
            }
        }
        return 0;
    }

    public function updateStatus(Request $request, $id = null)
    {
        $data = $request->all();
        Category::where('id', $data['id'])->update(['status' => $data['status']]);
    }
}
