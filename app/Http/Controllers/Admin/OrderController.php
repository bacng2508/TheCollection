<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class OrderController extends Controller
{
    public function index(Request $request) {
        $this->authorize('list-order');
        $orders = Order::query()
            ->filterOrder($request)
            ->paginate(10)
            ->withQueryString();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Request $request) {
        $this->authorize('detail-order');
        $order = Order::find($request->id);
        
        $orderItems = OrderItem::where('order_id', $request->id)->get();
        
        $orderItemDetails = new Collection();
        foreach($orderItems as $orderItem) {
            $orderItemDetails->push($orderItem->product);
        }

        return response()->json([
            "order" => $order,
            "orderItems" => $orderItems,
            "orderItemDetails" => $orderItemDetails,
            "coupon" => $order->coupon_id != null ? $order->coupon : ""
        ]);
    }

    public function updateStatus(Request $request, Order $order) {
        $this->authorize('status-order');
        $order->update([
            'order_status' => $request->order_status,
        ]);
        return back()->with('msg', 'Cập nhật trạng thái đơn hàng thành công');
    }
}
