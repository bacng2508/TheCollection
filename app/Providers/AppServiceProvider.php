<?php

namespace App\Providers;

use App\Http\Middleware\Administrator;
use App\View\Composers\CartComposer;
use App\View\Composers\NavbarComposer;
use App\View\Composers\Admin\NotificationComposer;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page'): LengthAwarePaginator {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage)->values(),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });

        Paginator::useBootstrapFour();
        View::composer('client.*', CartComposer::class);
        View::composer('client.*', NavbarComposer::class);
        View::composer('client.*', NavbarComposer::class);
        View::composer('admin.*', NotificationComposer::class);
    }
}
