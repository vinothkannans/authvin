<?php

namespace Authvin\Providers;

use Illuminate\Support\ServiceProvider;
use Authvin;

class AuthvinServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind('authvin', function () {
          return new Authvin;
      });
    }
}
