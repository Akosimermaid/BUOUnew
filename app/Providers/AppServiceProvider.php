<?php

namespace App\Providers;

use Illuminate\Validation\Rules\Password;
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
      //   FilamentBreezy::setPasswordRules(
       //     [
         //       Password::min(8)
           //         ->letters()
             //       ->numbers()
          //          ->mixedCase()
           //         ->uncompromised(3)
           // ]
       // );
    }
}
