<?php

namespace App\Providers;
use App\Repository\UserRepositoryInterface;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Observers\BoxObserver;
use App\Observers\ProductObserver;
use App\Models\Box;
use App\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RepositoryInterface::class, Repository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Box::observe(BoxObserver::class);
        Product::observe(ProductObserver::class);
    }
}
