<?php
 
namespace App\View\Composers;
 
use Illuminate\View\View;

use App\Models\Category;
use App\Models\Brand;

class NavbarComposer
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
        $categories = Category::all();
        $brands = Brand::all();
        $view->with('categories', $categories);
        $view->with('brands', $brands);
    }
}