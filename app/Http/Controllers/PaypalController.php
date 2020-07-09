<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Orders;
use App\OrdersProduct;
use Session;

class PaypalController extends Controller
{
    public function paypal()
    {
        $provider = new ExpressCheckout;
        $data = $this->cartData();
        $response = $provider->setExpressCheckout($data);
        // This will redirect user to PayPal
        return redirect($response['paypal_link']);

    }

    public function success(Request $request)
    {
        $provider = new ExpressCheckout;
        $token = $request->token;
        $PayerID = $request->PayerID;
        $response = $provider->getExpressCheckoutDetails($token);
        $data = $this->cartData();
        $response = $provider->doExpressCheckoutPayment($data, $token, $PayerID);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $order_id = Session::get('order_id');
            Orders::where('id',$order_id)->update(['payment_status' => 1, 'transaction_id' => $response['PAYMENTINFO_0_TRANSACTIONID']]);
            return redirect('/cart')->with('flash_message_success','Thanh toán thành công');
        }
        return redirect('/cart')->with('flash_message_error','Thanh toán với paypal thất bại');
    }

    public function cancel()
    {
        return redirect('/cart')->with('flash_message_success','Thanh toán paypal của bạn đã bị hủy');
    }

    protected function cartData()
    {
        $order_id = Session::get('order_id');
        $order = Orders::with('orders')->find($order_id);
        $data = [];
        $data['items'] = [];
        foreach ($order['orders'] as $order_products) {
            array_push($data['items'], [
                'name' => $order_products->product_name,
                'price' => $order_products->product_price,
                'desc'  => 'Code: ' . $order_products->product_code . '. Color: ' . $order_products->product_color . '. Size: ' . $order_products->product_size,
                'qty' => $order_products->product_qty
            ]);
        }
        $data['invoice_id'] = $order_id;
        $data['invoice_description'] = "Mã đơn đặt hàng #{$data['invoice_id']}";
        $data['return_url'] = route('paypal.success');
        $data['cancel_url'] = route('paypal.cancel');
        $data['total'] = $order['grand_total'];
        return $data;
    }
}
