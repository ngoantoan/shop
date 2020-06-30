<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupons;
use RealRashid\SweetAlert\Facades\Alert;

class CouponsController extends Controller
{
    public function addCoupon(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $coupon = new Coupons;
            $coupon->coupon_code   = $data['coupon_code'];
            $coupon->amount        = $data['coupon_amount'];
            $coupon->amount_type   = $data['amount_type'];
            $coupon->expiry_date   = $data['expiry_date'];
            $coupon->save();
            return redirect('/admin/view-coupons')->with('flash_message_success', 'Thêm mã khuyến mãi thành công!');
        }
        return view('admin.coupons.add_coupon');
    }

    public function viewCoupons()
    {
        $coupons = Coupons::get();
        return view('admin.coupons.view_coupons')->with(compact('coupons'));
    }

    public function updateStatus(Request $request ,$id = null)
    {
        $data = $request->all();
        Coupons::where('id', $data['id'])->update(['status' => $data['status']]);
    }

    public function editCoupon(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $coupon = Coupons::where('id', $id)->update([
                'coupon_code'   => $data['coupon_code'],
                'amount'        => $data['coupon_amount'],
                'amount_type'   => $data['amount_type'],
                'expiry_date'   => $data['expiry_date']
            ]);
            return redirect('/admin/view-coupons')->with('flash_message_success', 'Cập nhật mã khuyến mãi thành công!');
        }
        $couponDetails = Coupons::find($id);
        return view('admin.coupons.edit_coupon')->with(compact('couponDetails'));
    }

    public function deleteCoupon($id = null)
    {
        $coupon = Coupons::where('id', $id)->delete();
        Alert::success('Deleted','Success message');
        return redirect()->back();
    }
}
