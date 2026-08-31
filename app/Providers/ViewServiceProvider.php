<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Material;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layouts._sidebar', function ($view) {
            $materials = Material::all();
            $view->with('sidebar_materials', $materials);
        });
    }
}