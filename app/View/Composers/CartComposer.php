<?php
 
namespace App\View\Composers;
 
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Cart;

class CartComposer
{
    /**
     * Create a new profile composer.
     */
    // public function __construct(
    //     protected UserRepository $users,
    // ) {}
 
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::user()->id)->get();
            $totalMoney = 0;
            foreach ($cartItems as $item) {
                if ($item->price_sale != 0) {
                    $totalMoney+=$item->price_sale*$item->quantity;
                } else {
                    $totalMoney+=$item->price*$item->quantity;
                }
            }
            $view->with('cartItems', $cartItems);
            $view->with('cartTotalMoney', $totalMoney);
        }
    }
}