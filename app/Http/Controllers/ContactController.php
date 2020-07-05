<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class ContactController extends Controller
{
// Frontend
    public function contact(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'full_name' => 'required',
                'email'     => 'required',
                'phone'     => 'required',
                'content'   => 'required',
            ],
            [
                'full_name.required' => 'Họ tên không được trống',
                'email.required'     => 'Email không được trống',
                'phone.required'     => 'Số điện thoại không được trống',
                'content.required'   => 'Nội dung không được trống',
            ]);

            $data = $request->all();
            DB::table('contact_us')->insert([
                'full_name' => $data['full_name'],
                'email'     => $data['email'],
                'phone'     => $data['phone'],
                'content'   => $data['content'],
            ]);
            return redirect()->back()->with('flash_message_success','Gửi liên hệ thành công');
        }
        return view('wayshop.contact_us.contact');
    }

// Admin
    public function viewContacts()
    {
        $contacts = DB::table('contact_us')->get();
        return view('admin.contacts.view_contacts')->with(compact('contacts'));
    }

    public function deleteContact($id)
    {
        DB::table('contact_us')->where('id', $id)->delete();
        return redirect()->back()->with('flash_message_error','Xóa liên hệ thành công');
    }
}
