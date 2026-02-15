<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\JobPostRepository;
use App\Repositories\JobPostRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            JobPostRepositoryInterface::class,
            JobPostRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
