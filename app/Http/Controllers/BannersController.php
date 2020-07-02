<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use RealRashid\SweetAlert\Facades\Alert;
use App\Banners;
use Image;

class BannersController extends Controller
{
    public function banners()
    {
        $banners = Banners::get();
        return view('admin.banners.banners')->with(compact('banners'));
    }

    public function addBanner(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (empty($data['banner_image'])) {
                return redirect('/admin/add-banner')->with('flash_message_error','Vui lòng chọn ảnh!');
            }
            $banner = new Banners;
            $banner->name       = $data['banner_name'];
            $banner->text_style = $data['text_style'];
            $banner->sort_order = $data['sort_order'];
            $banner->content    = $data['banner_content'];
            $banner->link       = $data['banner_link'];
            $banner->image      = $data['banner_image'];
            $banner->save();
            return redirect('/admin/banners')->with('flash_message_success','Thêm banner thành công!');
        }
        return view('admin.banners.add_banner');
    }

    public function editBanner(Request $request, $id = null)
    {
        $bannerDetails = Banners::where(['id' => $id])->first();
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (empty($data['banner_image'])) {
                return redirect('/admin/edit-banner/'. $id)->with('flash_message_error', 'Vui lòng chọn ảnh!');
            }
            Banners::where('id', $id)->update([
                'name'          => $data['banner_name'],
                'text_style'    => $data['text_style'],
                'sort_order'    => $data['sort_order'],
                'content'       => $data['banner_content'],
                'link'          => $data['banner_link'],
                'image'         => $data['banner_image']
            ]);
            return redirect('/admin/banners')->with('flash_message_success', 'Cập nhật banner thành công!');
        }
        return view('admin.banners.edit_banner')->with(compact('bannerDetails'));
    }

    public function deleteBanner($id = null)
    {
        Banners::where(['id' => $id])->delete();
        Alert::success('Deleted Successfully', 'Success Message');
        return redirect()->back()->with('flash_message_error', 'Xóa banner thành công');
    }

    public function updateStatus(Request $request, $id = null)
    {
        $data = $request->all();
        Banners::where('id', $data['id'])->update(['status' => $data['status']]);
    }
}
