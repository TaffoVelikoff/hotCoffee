<?php

namespace TaffoVelikoff\HotCoffee;

use TaffoVelikoff\HotCoffee\Role;
use Illuminate\Support\ServiceProvider;

class HotCoffeeViewServiceProvider extends ServiceProvider
{

    // Article model in use
    public $model_name;

    public function __construct() {
        $this->model_name = config('hotcoffee.articles.model');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->sharePageNames();
        $this->shareAllTags();
        $this->shareAllRoles();
    }

    /**
     * Catch view name, default page name.
     */
    protected function sharePageNames() {
        view()->composer('*', function($view){
            // Page name
            $pageName = explode('.', $view->getName());
            view()->share('pageName', end($pageName));

            // View name
            view()->share('viewName', $view->getName());
        });
    }

    /**
     * Share tags for articles module.
     */
    protected function shareAllTags() {
        view()->composer('hotcoffee::admin.article', function($view){
            view()->share('allTags', $this->model_name::existingTags());
        });
    }

    /**
     * Share roles for info pages modele.
     */
    protected function shareAllRoles() {
        view()->composer('hotcoffee::admin.infopage', function($view){
            view()->share('roles', Role::all());
        });
    }
}