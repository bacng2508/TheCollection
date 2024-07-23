<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\VnpayInfo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Jobs\OrderConfirm;

class OrderController extends Controller
{
    public function create() {
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();
        $subTotalMoney = 0;
        foreach ($cartItems as $item) {
            $subTotalMoney+= ($item->price_sale != 0 ? $item->price_sale : $item->price)*$item->quantity;
        }
        return view('client.check-out', compact('cartItems', 'subTotalMoney'));
    }

    public function vnpayPayment($orderId, $orderCode, $totalMoney) {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        // $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        $vnp_Returnurl = "http://127.0.0.1:8000/payment-result";
        $vnp_TmnCode = "O1CQRUPJ";//Mã website tại VNPAY 
        $vnp_HashSecret = "ZQ77B3ETGEMHQEW0SFIRT1CX42NYGTKH"; //Chuỗi bí mật
        
        $vnp_TxnRef = $orderCode; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        // $vnp_OrderInfo = $_POST['order_desc'];
        $vnp_OrderType = "other";
        $vnp_Amount = (int)$totalMoney * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "VNBANK";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        $startTime = date("YmdHis");
        $vnp_ExpireDate = date('YmdHis',strtotime('+5 minutes',strtotime($startTime)));
        //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address=$_POST['txt_inv_addr1'];
        // $vnp_Bill_City=$_POST['txt_bill_city'];
        // $vnp_Bill_Country=$_POST['txt_bill_country'];
        // $vnp_Bill_State=$_POST['txt_bill_state'];
        // Invoice
        // $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
        // $vnp_Inv_Email=$_POST['txt_inv_email'];
        // $vnp_Inv_Customer=$_POST['txt_inv_customer'];
        // $vnp_Inv_Address=$_POST['txt_inv_addr1'];
        // $vnp_Inv_Company=$_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type=$_POST['cbo_inv_type'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan don hang ".$orderCode,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$vnp_ExpireDate,
            // "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
            // "vnp_Bill_Email"=>$vnp_Bill_Email,
            // "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
            // "vnp_Bill_LastName"=>$vnp_Bill_LastName,
            // "vnp_Bill_Address"=>$vnp_Bill_Address,
            // "vnp_Bill_City"=>$vnp_Bill_City,
            // "vnp_Bill_Country"=>$vnp_Bill_Country,
            // "vnp_Inv_Phone"=>$vnp_Inv_Phone,
            // "vnp_Inv_Email"=>$vnp_Inv_Email,
            // "vnp_Inv_Customer"=>$vnp_Inv_Customer,
            // "vnp_Inv_Address"=>$vnp_Inv_Address,
            // "vnp_Inv_Company"=>$vnp_Inv_Company,
            // "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
            // "vnp_Inv_Type"=>$vnp_Inv_Type
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        // }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['payment_method'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }

        // header('Location: ' . $vnp_Url);
        // vui lòng tham khảo thêm tại code demo
    
    }

    public function store(Request $request) {

        $request->validate(
            [
                'fullname' => 'required',
                'email' => 'required',
                'phone_number' => 'required',
                'address' => 'required',
            ],
            [
                'fullname.required' => 'Không được để trống họ tên',
                'email.required' => 'Không được để trống email',
                'phone_number.required' => 'Không được để trống số điện thoại',
                'address.required' => 'Không được để trống địa chỉ',
            ]
        );

        $cartItems = Cart::where('user_id', Auth::user()->id)->get();

        $errorText = '';
        $isOutOfStock = false;
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            if ($item->quantity > $product->quantity) {
                $isOutOfStock = true;
                $errorText.= "$item->name chỉ còn $product->quantity sản phẩm ,";
            }
        }
        $errorText = rtrim($errorText, ',');

        if ($isOutOfStock) {
            return back()->with('msg', $errorText);
        }

        // Caculate subTotalMoney
        $subTotalMoney = 0;
        foreach ($cartItems as $item) {
            $subTotalMoney+= ($item->price_sale != 0 ? $item->price_sale : $item->price)*$item->quantity;
        }

        // Find coupon
        $coupon = Coupon::where('name', $request->coupon_name)->first();
        $isCouponAvailable = Coupon::where('name', $request->coupon_name)->whereDate('expire_date', '>=', Carbon::now())->first();
        if ($request->coupon_name != null) {
            if ($isCouponAvailable) {
                $discount = round($subTotalMoney * (($coupon->value)/100));
            } else {
                // return back()->with(['coupon_msg', 'coupon_name'], ['Coupon không hợp lệ', $request->coupon_name]);
                return back()->withErrors(['coupon_name' => 'Coupon không hợp lệ'])->withInput(['coupon_name' => $request->coupon_name]);
            }
        }

        // Check if coupon is valid
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => 'OD' . strtoupper(fake()->randomLetter() . fake()->randomLetter()) . fake()->randomNumber(5),             
            'fullname' => $request->fullname, 
            'email' => $request->email, 
            'phone_number' => $request->phone_number, 
            'address' => $request->address, 
            'note' => $request->note ?? "", 
            'coupon_id' => $isCouponAvailable ? $coupon->id : null, 
            'discount' => $discount ?? 0, 
            'sub_total' => $subTotalMoney, 
            'grand_total' => isset($discount) ? ($subTotalMoney - $discount) : $subTotalMoney, 
            'payment_method' => $request->payment_method, 
            // 'order_date' => Carbon::now(),
            'order_status' => 1
        ]);
        
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity
            ]);
        }
        
        Cart::where('user_id', Auth::user()->id)->delete();

        if ($request->payment_method == 'cod') {
            $orderItems = OrderItem::where('order_id', $order->id)->get();

            foreach($orderItems as $item) {
                $item->product->update(['quantity' => $item->product->quantity - $item->quantity]);
            }

            $payment_message = "Đặt hàng thành công!";
            $orderItems = OrderItem::where('order_id', $order->id)->get();
            // SendEmail::dispatch($order)->delay(now()->addSecond(10));
            OrderConfirm::dispatch($order)->delay(now()->addSecond(10));
            return view('client.payment-result', compact('payment_message', 'order', 'orderItems'));
        } else {
            $this->vnpayPayment($order->id, $order->order_code,$order->grand_total);
        }           
    }

    public function applyCoupon(Request $request) {
        $coupon = Coupon::where('name', $request->coupon)->first();
        
        if ($coupon == null) {
            return response()->json([
                'status' => false,
                'message' => 'Coupon không hợp lệ'
            ]);
        }

        // Check if coupon is valid
        $now = Carbon::now();
        $isCouponAvailable = Coupon::where('name', $request->coupon)->whereDate('expire_date', '>=', Carbon::now())->first();
        
        if ($isCouponAvailable) {
            return response()->json([
                'status' => true,
                'message' => 'Áp dụng mã giảm giá thành công',
                'discount_value' => $isCouponAvailable->value
            ]);
        } else {
            
            return response()->json([
                'status' => false,
                'message' => 'Mã giảm giá đã hết hạn'
            ]);
        }
    }

    public function vnpayResult(Request $request) {
        $order = Order::where('order_code', $request->vnp_TxnRef)->first();
        $orderItems = OrderItem::where('order_id', $request->vnp_TxnRef)->get();
        
        VnpayInfo::create([
            'order_id' => $order->id,
            'vnp_TmnCode' => $request->vnp_TmnCode,
            'vnp_Amount' => $request->vnp_Amount, 
            'vnp_BankCode' => $request->vnp_BankCode, 
            'vnp_PayDate' => $request->vnp_PayDate, 
            'vnp_OrderInfo' => $request->vnp_OrderInfo, 
            'vnp_TransactionNo' => $request->vnp_TransactionNo, 
            'vnp_ResponseCode' => $request->vnp_ResponseCode,
            'vnp_TransactionStatus' => $request->vnp_TransactionStatus,
            'vnp_TxnRef' => $request->vnp_TxnRef,
        ]);

        if ($request->vnp_TransactionStatus == '00') {
            // $orderItems = OrderItem::where('order_id', $request->vnp_TxnRef)->get();

            foreach($orderItems as $item) {
                $item->product->update(['quantity' => $item->product->quantity - $item->quantity]);
            }
            $payment_message = "Giao dịch thành công";
            OrderConfirm::dispatch($order)->delay(now()->addSecond(10));
            
        } else {
            Order::find($order->id)->update(['order_status' => 0]);
            $payment_message = "Đã có lỗi xảy ra, xin vui lòng thử lại!";
        }

        // } else if ($request->vnp_TransactionStatus == '11') {
        //     $payment_message = "Giao dịch không thành công do: Đã hết hạn chờ thanh toán. Xin quý khách vui lòng thực hiện lại giao dịch.";
        // } else if ($request->vnp_TransactionStatus == '13') {
        //     $payment_message = "Giao dịch không thành công do Quý khách nhập sai mật khẩu xác thực giao dịch (OTP). Xin quý khách vui lòng thực hiện lại giao dịch.";
        // } else if ($request->vnp_TransactionStatus == '24') {
        //     $payment_message = "Giao dịch không thành công do: Khách hàng hủy giao dịch";
        // } else {
        //     $payment_message = "Đã có lỗi xảy ra, xin vui lòng thử lại!";
        // }
        return view('client.payment-result', compact('payment_message', 'order', 'orderItems'));
    }
}
