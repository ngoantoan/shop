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
            $banner = new Banners;
            $banner->name       = $data['banner_name'];
            $banner->text_style = $data['text_style'];
            $banner->sort_order = $data['sort_order'];
            $banner->content    = $data['banner_content'];
            $banner->link       = $data['banner_link'];
            // Upload Image
            if ($request->hasfile('image')) {
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    // Upload Image after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $banner_path = 'uploads/banners/'.$fileName;
                    Image::make($image_tmp)->save($banner_path);
                    $banner->image = $fileName;
                }
            }
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
            // Upload Image
            if ($request->hasfile('image')) {
                $img_tmp = Input::file('image');
                if ($img_tmp->isValid()) {
                    // image path code
                    $extension = $img_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $img_path = 'uploads/banners/'.$filename;
                    Image::make($img_tmp)->save($img_path);
                }
            } else if (!empty($data['current_image'])){
                $filename = $data['current_image'];
            } else {
                $filename = '';
            }
            Banners::where('id', $id)->update([
                'name'          => $data['banner_name'],
                'text_style'    => $data['text_style'],
                'sort_order'    => $data['sort_order'],
                'content'       => $data['banner_content'],
                'link'          => $data['banner_link'],
                'image'         => $filename
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
