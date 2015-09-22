<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Guard;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Guard $auth)
    {
        //
        view()->composer('template.partials.nav', function($view) use ($auth)
        {
            /*
             *
            if(!$auth->check())
            {
                $user=array('name'=>'','admin'=>0,'email'=>'');
                $view->with('currentUser',compact('user'));
            } else {
            */
                $view->with('currentUser',$auth->user());


        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
