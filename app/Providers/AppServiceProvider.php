<?php

namespace App\Providers;

use App\Models\File;
use App\Policies\FilePolicy;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('delete-file' , function($user , $file){
            return $user->id === $file->user_id;
        });

        Gate::define('viewAll', [FilePolicy::class , 'viewAny']);
        // Gate::define('add-file' , function($user ){
        //     return $user->role === 'admin';
        // });
    }
}
