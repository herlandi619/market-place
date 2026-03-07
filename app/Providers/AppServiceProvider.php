<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
         View::composer('*', function ($view) {

                $cartCount = 0;
                $pendingOrdersCount = 0;
                $paidOrdersCount = 0;
                $newOrderCount = 0;

                if (auth()->check()) {

                    // ✅ Cart Buyer
                    $cartCount = Cart::where('user_id', auth()->id())
                        ->sum('qty');

                    // ✅ Admin Notification (Order Pending Today)
                    if (auth()->user()->role === 'admin') {
                        $pendingOrdersCount = Order::where('status', 'pending')
                            ->whereDate('created_at', today())
                            ->count();
                    }

                    // ✅ Buyer Notification (Order Sudah Paid)
                    if (auth()->user()->role === 'buyer') {
                        $paidOrdersCount = Order::where('user_id', auth()->id())
                            ->where('status', 'paid')
                            ->whereDate('updated_at', today())
                            ->count();
                    }

                    // ✅ Seller Notification (Order status = paid)
                    if (auth()->user()->role === 'seller') {
                        $newOrderCount = Order::whereHas('items.product', function ($q) {
                            $q->where('user_id', auth()->id());
                        })
                        ->where('status', 'paid')
                        ->count();
                    }

                }

                $view->with([
                    'cartCount' => $cartCount,
                    'pendingOrdersCount' => $pendingOrdersCount,
                    'paidOrdersCount' => $paidOrdersCount,
                    'newOrderCount' => $newOrderCount
                ]);
            });
        // ngrox 4
        // URL::forceScheme('https');

        // tailwind
         Paginator::useTailwind();
    }
}
