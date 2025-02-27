<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit() {
        return view('client.profile.profile-info');
    }

    public function update(Request $request) {
        $administrator = User::find(Auth::user()->id);
        
        $request->validate(
            [
                'avatar' => 'nullable|image|max:2000',
                'name' => 'required',
                'tel' => 'required|regex:/(09)[0-9]{8}/',
            ],
            [
                'avatar.image' => 'File tải lên phải là ảnh',
                'avatar.max' => 'Dung lượng File tải lên không được vượt quá 5MB',
                'name.required' => 'Không được để trống tên',
                'tel.required' => 'Không được để trống số điện thoại',
                'tel.regex' => 'Số điện thoại không hợp lệ',
            ]
        );
        
        if ($request->hasFile('avatar')) {
            // Storage::disk('public')->delete($administrator->avatar);
            $avatarPath = $request->file('avatar')->store('upload/client/avatar','public');
        }

        $administrator->update([
            'name' => $request->name ?? Auth::user()->name,
            'avatar' => $avatarPath ?? Auth::user()->avatar,
            'tel' => $request->tel ?? Auth::user()->tel,
            'address' => $request->address ?? Auth::user()->address,
        ]);

        return back()->with('msg', 'Cật nhật thông tin thành công');
    }

    public function changePassword() {
        return view('client.profile.change-password');
    }

    public function updatePassword(Request $request) {
        $user = User::find(Auth::user()->id);
        
        $request->validate(
            [
                'old_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ],
            [
                'old_password.required' => 'Không được để trống mật khẩu',
                'new_password.required' => 'Không được để trống mật khẩu mới',
                'new_password.min' => 'Mật khẩu phải có tối thiểu 8 ký tự',
                'new_password.confirmed' => 'Mật khẩu nhập lại không khớp',
                'new_password_confirmation.confirmed' => 'Mật khẩu nhập lại không khớp',
            ]
        );

        if(!Hash::check($request->old_password, $user->password)){
            return back()->with("msg", "Mật khẩu nhập lại không khớp");
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('msg', 'Đổi mật khẩu thành công');
    }

    public function myOrders() {
        $myOrders = Order::where('user_id', Auth::user()->id)->latest()->paginate(10);
        return view('client.profile.my-orders', compact('myOrders'));
    }

    public function orderDetail(Order $order) {
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        return view('client.profile.order-detail', compact('order', 'orderItems'));
    }

    public function productReviews() {
        $myReviews = Review::where('user_id', Auth::user()->id)->paginate(10);
        return view('client.profile.product-reviews', compact('myReviews'));
    }

    public function myNotifications() {
        $myNotifications = Auth::user()->notifications->paginate(10);
        return view('client.profile.my-notifications', compact('myNotifications'));
    }
}
