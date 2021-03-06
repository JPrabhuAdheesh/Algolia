<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Module\SearchInterface;
use App\Module\AlgoliaRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */  

    public function register()
    { 
       $this->app->bind(SearchInterface::class, AlgoliaRepository::class);
    }
}
