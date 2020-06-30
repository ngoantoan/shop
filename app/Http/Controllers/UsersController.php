<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Country;
use Auth;
use Session;
use DB;

class UsersController extends Controller
{
    public function useLoginRegister()
    {
        return view('wayshop.users.login_register');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $userCount = User::where('email', $data['email'])->count();
            if ($userCount > 0) {
                return redirect()->back()->with('flash_message_error', 'Email đã tồn tại!');
            } else {
                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    Session::put('frontSession', $data['email']);
                    return redirect('/cart');
                }
            }
        }
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                Session::put('frontSession', $data['email']);
                $session_id = Session::get('session_id');
                if ($session_id) {
                    DB::table('cart')->where('session_id', $session_id)->update(['user_email' => $data['email']]);
                }
                return redirect('/cart');
            } else {
                return redirect()->back()->with('flash_message_error','Username hoặc Password không đúng!');
            }
        }
    }

    public function logout()
    {
        Session::forget('frontSession');
        Auth::logout();
        return redirect('/');
    }

    public function account()
    {
        return view('wayshop.users.account');
    }

    public function changePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $old_pwd = User::where('id', Auth::user()->id)->first();
            if (Hash::check($data['current_password'], $old_pwd->password)) {
                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id', Auth::User()->id)->update(['password' => $new_pwd]);
                return redirect()->back()->with('flash_message_success','Mật khẩu của bạn đã được thay đổi!');
            } else {
                return redirect()->back()->with('flash_message_error','Mật khẩu cũ không đúng!');
            }
        }
        return view('wayshop.users.change_password');
    }

    public function changeAddress(Request $request)
    {
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        if ($request->isMethod('post')) {
            $data = $request->all();
            $user = User::find($user_id);
            $user->name     = $data['name'];
            $user->address  = $data['address'];
            $user->city     = $data['city'];
            $user->district = $data['district'];
            $user->country  = $data['country'];
            $user->pincode  = $data['pincode'];
            $user->mobile   = $data['mobile'];
            $user->save();
            return redirect()->back()->with('flash_message_success','Cập nhật thông tin thành công');
        }
        $countries = Country::get();
        return view('wayshop.users.change_address')->with(compact('countries', 'userDetails'));
    }
}
