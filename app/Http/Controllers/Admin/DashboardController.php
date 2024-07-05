<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        $orders = Order::all();
        $products = Product::all();
        $users = User::all();

        $revenueByDate = Order::whereDate('created_at', Carbon::now()->format('Y-m-d'))
        ->where('order_status', 3)
        ->sum('grand_total');

        $revenueByWeek = $revenueByMonth = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->where('order_status', 3)
        ->sum('grand_total');
        
        $revenueByMonth = Order::whereYear('created_at', Carbon::now()->format('Y'))
        ->whereMonth('created_at', Carbon::now()->format('m'))
        ->where('order_status', 3)
        ->sum('grand_total');
        
        $revenueByYear = Order::whereYear('created_at', Carbon::now()->format('Y'))
        ->where('order_status', 3)
        ->sum('grand_total');

        $revenueInMonths = new Collection();
        for ($i=0; $i < 12; $i++) { 
            $revenueInMonths->push(Order::whereYear('created_at', Carbon::now()->format('Y'))
            ->whereMonth('created_at', $i+1)
            ->where('order_status', 3)
            ->sum('grand_total') ?? 0);
        }

        $clientRegistedInMonths = new Collection();
        for ($i=0; $i < 12; $i++) { 
            $clientRegistedInMonths->push(User::whereYear('created_at', Carbon::now()->format('Y'))
            ->whereMonth('created_at', $i+1)
            ->count() ?? 0);
        }

        $clientRatings = new Collection();
        for ($i=0; $i < 12; $i++) { 
            $clientRatings->push(Review::where('rating', $i+1)
            ->count() ?? 0);
        }

        return view('admin.dashboard', compact('orders', 'products', 'users', 'revenueByDate', 'revenueByWeek','revenueByMonth', 'revenueByYear', 'revenueInMonths', 'clientRatings', 'clientRegistedInMonths'));
    }
}
