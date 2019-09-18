<?php

namespace App\Providers;

use App\Cache\Handler\InMemoryCachePoolHandler;
use App\Cache\Repository\CachedLanguageRepository;
use App\Language\Repository\InMemoryLanguageRepository;
use App\Language\Repository\LanguageRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(LanguageRepository::class, InMemoryLanguageRepository::class);

        $this->app->extend(LanguageRepository::class, function (LanguageRepository $repository) {
            return new CachedLanguageRepository($repository, new InMemoryCachePoolHandler());
        });
    }
}
