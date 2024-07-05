<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

use App\Models\Product;

class HomeController extends Controller
{
    public function index() {
        $featureProducts = Product::where('is_featured', 1)->get();
        $saleProducts = Product::where('price_sale', '<>', 0)->get();
        return view('client.home', compact('featureProducts', 'saleProducts'));
    }

    public function testMail() {
        $order = Order::find(2);
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        return view('mail.orders.order-confirm', compact('order', 'orderItems'));
    }
}
