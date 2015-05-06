<?php namespace Berg\Authorizer\Laravel;

use Berg\Authorizer\Authorizer;
use Illuminate\Support\ServiceProvider;

class AuthorizerServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('Authorizer', function ($app, $userRoles) {
            return new Authorizer($userRoles);
        });
    }
}