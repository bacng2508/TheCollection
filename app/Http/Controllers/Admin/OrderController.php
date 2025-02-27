<?php

namespace App\Http\Controllers\Admin;


use App\Models\Order;
use App\Models\OrderItem;
// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Notifications\OrderChangeStatus;

class OrderController extends Controller
{
    public function index(Request $request) {
        $this->authorize('list-order');
        $orders = Order::query()
            ->filterOrder($request)
            ->latest()
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
        $order->user->notify(new OrderChangeStatus($order));
        return back()->with('msg', 'Cập nhật trạng thái đơn hàng thành công');
    }

    public function exportInvoice(Order $order) {
        // dd($order);
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        $pdf = Pdf::loadView('admin.orders.invoice', compact('order', 'orderItems'));
        // return $pdf->stream();
        // return view('admin.orders.invoice', compact('order', 'orderItems'));
        return $pdf->download('invoice.pdf');
    }
}
