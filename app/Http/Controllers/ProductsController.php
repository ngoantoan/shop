<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use RealRashid\SweetAlert\Facades\Alert;
use App\Products;
use App\Category;
use App\ProductsAttributes;
use App\ProductsImages;
use App\Coupons;
use App\User;
use App\Country;
use App\DeliveryAddress;
use App\Orders;
use App\OrdersProduct;
use Image;
use DB;
use Session;
use Auth;

class ProductsController extends Controller
{
// Backend
    public function addProduct(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (empty($data['product_image'])) {
                return redirect('/admin/add-product')->with('flash_message_error', 'Vui lòng chọn ảnh!');
            }
            $product = new Products;
            $product->category_id = $data['category_id'];
            $product->name = $data['product_name'];
            $product->code = $data['product_code'];
            $product->color = $data['product_color'];
            if (empty($data['product_description'])) {
                $product->description = '';
            } else {
                $product->description = $data['product_description'];
            }
            $product->price = $data['product_price'];
            $product->image = $data['product_image'];
            $product->save();
            return redirect('/admin/view-products')->with('flash_message_success', 'Thêm sản phẩm thành công!');
        }
        // Categories Dropdown menu Code
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $cat) {
            $categories_dropdown .= "<option style='font-weight: 700;' value='".$cat->id."'>".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                $categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp".$sub_cat->name."</option>";
            }
        }
        return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }

    public function viewProducts()
    {
        $products = Products::get();
        return view('admin.products.view_products')->with(compact('products'));
    }

    public function editProduct(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (empty($data['product_image'])) {
                return redirect('/admin/edit-product/'.$id)->with('flash_message_error', 'Vui lòng chọn ảnh!');
            }
            if (empty($data['product_description'])) {
                $data['product_description'] = '';
            }
            Products::where(['id' => $id])->update([
                'name'          => $data['product_name'],
                'category_id'   => $data['category_id'],
                'code'          => $data['product_code'],
                'color'         => $data['product_color'],
                'description'   => $data['product_description'],
                'price'         => $data['product_price'],
                'image'         => $data['product_image']
            ]);
            return redirect('/admin/view-products')->with('flash_message_success', 'Cập nhật sản phẩm thành công!');
        }

        $productDetails = Products::where(['id' => $id])->first();
        // Category dropdown code
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $cat) {
            if ($cat->id == $productDetails->category_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $categories_dropdown .= "<option style='font-weight: 700;' value='".$cat->id."'".$selected.">".$cat->name."</option>";

            // code for sub categories
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                if ($sub_cat->id == $productDetails->category_id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $categories_dropdown .= "<option value='".$sub_cat->id."'".$selected.">&nbsp;--&nbsp".$sub_cat->name."</option>";
            }
        }
        return view('admin.products.edit_product')->with(compact('productDetails', 'categories_dropdown'));
    }

    public function deleteProduct($id = null)
    {
        Products::where('id', $id)->delete();
        ProductsImages::where('product_id', $id)->delete();
        ProductsAttributes::where('product_id', $id)->delete();
        Alert::success('Deleted Successfully', 'Success Message');
        return redirect()->back()->with('flash_message_error', 'Xóa sản phẩm thành công');
    }

    public function updateStatus(Request $request, $id = null)
    {
        $data = $request->all();
        Products::where('id', $data['id'])->update(['status' => $data['status']]);
    }

    public function updateFeatured(Request $request, $id = null)
    {
        $data = $request->all();
        Products::where('id', $data['id'])->update(['featured_products' => $data['featured_products']]);
    }

    public function addAttributes(Request $request, $id = null)
    {
        $productDetails = Products::with('attributes')->where(['id' => $id])->first();
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data['sku'] as $key => $val) {
                if (!empty($val)) {
                    // Prevent duplicate SKU Record
                    $attrCountSKU = ProductsAttributes::where('sku', $val)->count();
                    if ($attrCountSKU > 0) {
                        return redirect('/admin/add-attributes/'. $id)->with('flash_message_error', 'SKU đã tồn tại, vui lòng chon SKU khác!');
                    }
                    // Prevent duplicate Size Record
                    $attrCountSizes = ProductsAttributes::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                    if ($attrCountSizes > 0) {
                        return redirect('/admin/add-attributes/'. $id)->with('flash_message_error', ''.$data['size'][$key].' Size đã tồn tại vui lòng chọn size khác!');
                    }

                    $attribute = new ProductsAttributes;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }
            return redirect('/admin/add-attributes/'. $id)->with('flash_message_success','Thêm thuộc tính thành công!');
        }
        return view('admin.products.add_attributes')->with(compact('productDetails'));
    }

    public function editAttributes(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data['attr'] as $key => $attr) {
                ProductsAttributes::where(['id' => $data['attr'][$key]])->update([
                    'sku'   => $data['sku'][$key],
                    'size'  => $data['size'][$key],
                    'price' => $data['price'][$key],
                    'stock' => $data['stock'][$key],
                ]);
            }
            return redirect()->back()->with('flash_message_success', 'Cập nhật thuộc tính thành công!');
        }
    }

    public function deleteAttribute($id = null)
    {
        ProductsAttributes::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_error', 'Xóa thuộc tính thành công!');
    }

    public function addImages(Request $request, $id = null)
    {
        $productDetails = Products::with('attributes')->where(['id' => $id])->first();
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (!empty($data['image'])) {
                $image = new ProductsImages;
                $image->product_id = $id;
                $image->image = $data['image'];
                $image->save();
                return redirect('/admin/add-images/'.$id)->with('flash_message_success', 'Thêm ảnh thành công');
            }
            return redirect('/admin/add-images/'.$id)->with('flash_message_error', 'Vui lòng chọn ảnh!');
        }
        $productImages = ProductsImages::where(['product_id' => $id])->get();
        return view('admin.products.add_images')->with(compact('productDetails', 'productImages'));
    }

    public function deleteAltImage($id = null)
    {
        $productImage = ProductsImages::where(['id' => $id])->first();
        $img_path = 'uploads/products/';
        if (file_exists($img_path.$productImage->image)) {
            unlink($img_path.$productImage->image);
        }
        ProductsImages::where(['id' => $id])->delete();
        Alert::success('Deleted','Success Message');
        return redirect()->back();
    }

// Frontend
    public function products($id = null)
    {
        $productDetails = Products::with('attributes')->where('id', $id)->first();
        $productsAltImages = ProductsImages::where('product_id', $id)->get();
        $featuredProducts = Products::where('featured_products', 1)->get();
        return view('wayshop.products.product_detail')->with(compact('productDetails', 'productsAltImages', 'featuredProducts'));
    }

    public function getPrice(Request $request)
    {
        $data = $request->all();
        $proAttr = explode("-", $data['idSize']);
        $proAttr = ProductsAttributes::where(['product_id' => $proAttr[0], 'size' => $proAttr[1]])->first();
        return $proAttr->price;
    }

    public function addtoCart(Request $request)
    {
        Session::forget('couponAmount');
        Session::forget('CouponCode');
        $data = $request->all();
        if (empty(Auth::user()->email)) {
            $data['user_email'] = '';
        } else {
            $data['user_email'] = Auth::user()->email;
        }
        $session_id = Session::get('session_id');
        if (empty($session_id)) {
            $session_id = str_random(40);
            Session::put('session_id', $session_id);
        }
        $sizeAttr = explode('-', $data['size']);
        $countProducts = DB::table('cart')->where(['product_id'        => $data['product_id'],
                                                'product_color'     => $data['product_color'],
                                                'price'             => $data['product_price'],
                                                'size'              => $sizeAttr[1],
                                                'session_id'        => $session_id
                                            ])->count();
        if ($countProducts > 0) {
            return 0;
        } else {
            DB::table('cart')->insert([
                'product_id'        => $data['product_id'],
                'product_name'      => $data['product_name'],
                'product_color'     => $data['product_color'],
                'product_code'      => $data['product_code'],
                'price'             => $data['product_price'],
                'size'              => $sizeAttr[1],
                'quantity'          => $data['quantity'],
                'user_email'        => $data['user_email'],
                'session_id'        => $session_id
            ]);
            // lấy số lượng sản phẩm có trong giỏ hàng
            $countCart = DB::table('cart')->where(['session_id' => $session_id])->count();
            Session::put('countCart', $countCart);
            // tạo session hiển thị giỏ hàng trên header
            $userCart = DB::table('cart')->where('session_id', $session_id)->orderBy('id', 'desc')->get();
            foreach ($userCart as $key => $products) {
                $productDetails = Products::where('id', $products->product_id)->first();
                $userCart[$key]->image = $productDetails['image'];
            }
            Session::put('userCart', $userCart);
            $image = Products::select('image')->where('id', $data['product_id'])->first();
            $response = [];
            $response['countCart'] = $countCart;
            $response['image'] = $image;
            return json_encode($response);
        }
    }

    public function cart(Request $request)
    {
        if (Auth::check()) {
            $user_email = Auth::user()->email;
            $userCart = DB::table('cart')->where('user_email', $user_email)->orderBy('id', 'desc')->get();
        } else {
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where('session_id', $session_id)->orderBy('id', 'desc')->get();
        }
        foreach ($userCart as $key => $products) {
            $productDetails = Products::where('id', $products->product_id)->first();
            $userCart[$key]->image = $productDetails['image'];
        }
        return view('wayshop.products.cart')->with(compact('userCart'));
    }

    public function deleteCartProduct($id = null)
    {
        Session::forget('couponAmount');
        Session::forget('CouponCode');
        DB::table('cart')->where('id', $id)->delete();
        // lấy số lượng sản phẩm có trong giỏ hàng để hiển thị trên icon cart
        $session_id = Session::get('session_id');
        $countCart = DB::table('cart')->where(['session_id' => $session_id])->count();
        Session::put('countCart', $countCart);
        // cập nhật danh sách sản phẩm để hiển thị trên cart header
        $session_id = Session::get('session_id');
        $userCart = DB::table('cart')->where('session_id', $session_id)->orderBy('id', 'desc')->get();
        foreach ($userCart as $key => $products) {
            $productDetails = Products::where('id', $products->product_id)->first();
            $userCart[$key]->image = $productDetails['image'];
        }
        Session::put('userCart', $userCart);
        return redirect('/cart')->with('flash_message_error','Xóa sản phẩm thành công!');
    }

    public function updateCartQuantity($id = null, $quantity = null)
    {
        Session::forget('couponAmount');
        Session::forget('CouponCode');
        DB::table('cart')->where('id', $id)->increment('quantity', $quantity);
        // cập nhật danh sách sản phẩm để hiển thị trên cart header
        $session_id = Session::get('session_id');
        $userCart = DB::table('cart')->where('session_id', $session_id)->orderBy('id', 'desc')->get();
        foreach ($userCart as $key => $products) {
            $productDetails = Products::where('id', $products->product_id)->first();
            $userCart[$key]->image = $productDetails['image'];
        }
        Session::put('userCart', $userCart);
        return redirect('/cart')->with('flash_message_success','Cập nhật số lượng thành công');
    }

    public function applyCoupon(Request $request)
    {
        Session::forget('couponAmount');
        Session::forget('CouponCode');
        if ($request->isMethod('post')) {
            $data = $request->all();
            $couponCount = Coupons::where('coupon_code', $data['coupon_code'])->count();
            if ($couponCount == 0) {
                return redirect()->back()->with('flash_message_error','Mã giảm giá không tồn tại');
            } else {
                $couponDetails = Coupons::where('coupon_code', $data['coupon_code'])->first();
                // Coupon code status
                if ($couponDetails->status == 0) {
                    return redirect()->back()->with('flash_message_error','Mã giảm giá đã bị dừng hoạt động');
                }
                // check coupon expiry date
                $expiry_date = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');
                if ($expiry_date < $current_date) {
                    return redirect()->back()->with('flash_message_error','Mã giảm giá đã hết hạn');
                }
                // Coupon is ready for discount
                $session_id = Session::get('session_id');
                if (Auth::check()) {
                    $user_email = Auth::user()->email;
                    $userCart = DB::table('cart')->where('user_email', $user_email)->get();
                } else if ($session_id) {
                    $userCart = DB::table('cart')->where('session_id', $session_id)->get();
                }
                $total_amount = 0;
                foreach ($userCart as $item) {
                    $total_amount = $total_amount + ($item->price * $item->quantity);
                }
                // check if coupon amount is fixed or perentage
                if ($couponDetails->amount_type == "Fixed") {
                    $couponAmount = $couponDetails->amount;
                } else {
                    $couponAmount = $total_amount * ($couponDetails->amount/100);
                }
                // Add Coupon code in session
                Session::put('couponAmount', $couponAmount);
                Session::put('CouponCode', $data['coupon_code']);
                return redirect()->back()->with('flash_message_success','Mã phiếu giảm giá được áp dụng thành công');
            }
        }
    }

    public function checkout(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $shippingDetails = DeliveryAddress::where('user_id', $user_id)->first();
        $userDetails = User::find($user_id);
        $countries = Country::get();
        // check if shipping address exists
        $shippingCount = DeliveryAddress::where('user_id', $user_id)->count();
        $shippingDetails = array();
        if ($shippingCount > 0) {
            $shippingDetails = DeliveryAddress::where('user_id', $user_id)->first();
        }
        // Update cart table with email
        if ($request->isMethod('post')) {
            $data = $request->all();
            // Update Users Details
            User::where('id', $user_id)->update([
                'name'      => $data['billing_name'],
                'address'   => $data['billing_address'],
                'city'      => $data['billing_city'],
                'district'  => $data['billing_district'],
                'pincode'   => $data['billing_pincode'],
                'country'   => $data['billing_country'],
                'mobile'    => $data['billing_mobile']
            ]);

            if ($shippingCount > 0) {
                // update shipping address
                DeliveryAddress::where('user_id', $user_id)->update([
                    'name'      => $data['shipping_name'],
                    'address'   => $data['shipping_address'],
                    'city'      => $data['shipping_city'],
                    'district'  => $data['shipping_district'],
                    'pincode'   => $data['shipping_pincode'],
                    'country'   => $data['shipping_country'],
                    'mobile'    => $data['shipping_mobile']
                ]);
            } else {
                // New shipping Address
                $shipping = new DeliveryAddress;
                $shipping->user_id = $user_id;
                $shipping->user_email = $user_email;
                $shipping->name = $data['shipping_name'];
                $shipping->address = $data['shipping_address'];
                $shipping->city = $data['shipping_city'];
                $shipping->district = $data['shipping_district'];
                $shipping->pincode = $data['shipping_pincode'];
                $shipping->country = $data['shipping_country'];
                $shipping->mobile = $data['shipping_mobile'];
                $shipping->save();
            }
            return redirect('/order-review');
        }
        return view('wayshop.products.checkout')->with(compact('userDetails', 'countries', 'shippingDetails'));
    }

    public function orderReview()
    {
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $shippingDetails = DeliveryAddress::where('user_id', $user_id)->first();
        $userDetails = User::find($user_id);
        $userCart = DB::table('cart')->where('user_email', $user_email)->get();
        foreach ($userCart as $key => $product) {
            $productDetails = Products::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
        return view('wayshop.products.order_review')->with(compact('userDetails', 'shippingDetails', 'userCart'));
    }

    public function placeOrder(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;

            // Get Shipping Details of Users
            $shippingDetails = DeliveryAddress::where('user_email', $user_email)->first();
            if (empty(Session::get('CouponCode'))) {
                $coupon_code = 'Not Used';
            } else {
                $coupon_code = Session::get('CouponCode');
            }
            if (empty(Session::get('couponAmount'))) {
                $coupon_amount = '0';
            } else {
                $coupon_amount = Session::get('couponAmount');
            }

            $order = new Orders;
            $order->user_id         = $user_id;
            $order->user_email      = $user_email;
            $order->name            = $shippingDetails['name'];
            $order->address         = $shippingDetails['address'];
            $order->city            = $shippingDetails['city'];
            $order->district        = $shippingDetails['district'];
            $order->pincode         = $shippingDetails['pincode'];
            $order->country         = $shippingDetails['country'];
            $order->mobile          = $shippingDetails['mobile'];
            $order->coupon_code     = $coupon_code;
            $order->coupon_amount   = $coupon_amount;
            $order->order_status    = 'New';
            $order->payment_method  = $data['payment_method'];
            $order->grand_total     = str_replace(',','',$data['grand_total']);
            $order->save();

            $order_id = DB::getPdo()->lastinsertID();

            $cartProducts = DB::table('cart')->where('user_email', $user_email)->get();

            foreach ($cartProducts as $pro) {
                $carPro = new OrdersProduct;
                $carPro->order_id       = $order_id;
                $carPro->user_id        = $user_id;
                $carPro->product_id     = $pro->product_id;
                $carPro->product_code   = $pro->product_code;
                $carPro->product_name   = $pro->product_name;
                $carPro->product_color  = $pro->product_color;
                $carPro->product_size   = $pro->size;
                $carPro->product_price  = $pro->price;
                $carPro->product_qty    = $pro->quantity;
                $carPro->save();
            }
            Session::put('order_id', $order_id);
            Session::put('grand_total', $data['grand_total']);
            if ($data['payment_method'] == "cod") {
                return redirect('/thanks');
            } else {
                return redirect('/stripe');
            }
        }
    }

    public function thanks()
    {
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email', $user_email)->delete();
        Session::forget('couponAmount');
        Session::forget('CouponCode');
        Session::forget('countCart');
        Session::forget('userCart');
        return view('wayshop.orders.thanks');
    }

    public function stripe(Request $request)
    {
        Session::forget('countCart');
        Session::forget('userCart');
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email', $user_email)->delete();
        if ($request->isMethod('post')) {
            $data = $request->all();
            \Stripe\Stripe::setApiKey('sk_test_51GyWepFUnGWUDfxs7mZNYdZkSp34esH5e20wlHf2jLQNU3MLD4LIa60JK8fKFBt4BSj1QiT5WCldLNBDN4jMJFrO00GZkNZFJx');

            $token = $_POST['stripeToken'];
            $charge = \Stripe\charge::Create([
                'amount' => $request->input('total_amount'),
                'currency' => 'vnd',
                'description' => $request->input('name'),
                'source' => $token
            ]);
            return redirect()->back()->with('flash_message_success','Thanh toán thành công!');
        }
        return view('wayshop.orders.stripe');
    }

    public function userOrders()
    {
        $user_id = Auth::user()->id;
        $orders = Orders::with('orders')->where('user_id', $user_id)->orderBy('id','DESC')->get();
        return view('wayshop.orders.user_orders')->with(compact('orders'));
    }

    public function userOrderDetails($order_id)
    {
        $orderDetails = Orders::with('orders')->where('id', $order_id)->first();
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id', $user_id)->first();
        return view('wayshop.orders.user_order_details')->with(compact('orderDetails', 'userDetails'));
    }

    public function viewOrders()
    {
        $orders = Orders::with('orders')->orderBy('id','DESC')->get();
        return view('admin.orders.view_orders')->with(compact('orders'));
    }

    public function viewOrderDetails($order_id = null)
    {
        $orderDetails = Orders::with('orders')->where('id',$order_id)->first();
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('admin.orders.order_details')->with(compact('orderDetails','userDetails'));
    }

    public function UpdateOrderStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            Orders::where('id', $data['order_id'])->update(['order_status' => $data['order_status']]);
            return redirect()->back()->with('flash_message_success','Trạng thái đơn hàng đã được cập nhật thành công!');
        }
    }
}
