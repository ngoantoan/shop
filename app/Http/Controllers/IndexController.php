<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banners;
use App\Category;
use App\Products;

class IndexController extends Controller
{
    public function index()
    {
        $banners = Banners::where('status', 1)->orderby('sort_order', 'asc')->get();
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();
        $products = Products::paginate(12);
        return view('wayshop.index')->with(compact('banners', 'categories', 'products'));
    }

    public function home()
    {
        $banners = Banners::where('status', 1)->orderby('sort_order', 'asc')->get();
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();
        $products = Products::paginate(12);
        return view('wayshop.index')->with(compact('banners', 'categories', 'products'));
    }

    public function categories($category_id)
    {
        $categories = Category::with('categories')->where('parent_id', 0)->get();
        $child_category = Category::where('parent_id', $category_id)->get();
        if (empty($child_category)) {
            // chỉ lấy sản phẩm trong danh mục con
            $products = Products::where('category_id', $category_id)->paginate(12);
        } else {
            // lấy tất cả sản phẩm danh mục con của 1 thằng danh mục cha
            $arrChildCategory = [$category_id];
            foreach ($child_category as $child) {
                array_push($arrChildCategory, $child->id);
            }
            $products = Products::whereIn('category_id', $arrChildCategory)->paginate(12);
        }

        $category_name = Category::where('id', $category_id)->first();
        return view('wayshop.category')->with(compact('categories', 'products', 'category_name'));
    }
}
