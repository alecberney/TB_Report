<?php

namespace App\Providers;

class KeycloakServiceProvider extends ServiceProvider
{
    public function register()
    {
        JWT::$leeway = 10;

        // Adding our custom guard
        Auth::extend('keycloak', function ($app, $name, array $config) {
            return new KeycloakGuard(Auth::createUserProvider($config['provider']), $app->request);
        });
    }
}
