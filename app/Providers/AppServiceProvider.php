<?php

namespace App\Providers;

use App\Company;
use Illuminate\Support\Facades\View;
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
        try {
            $companyList = Company::all()->pluck('name', 'id');
        } catch (\Exception $e) {
            $companyList = [];
        }
        View::share('companyList', $companyList);
    }
}
