<?php

namespace App\Providers\Keycloak;

use App\Constants\Roles;
use App\Models\Role;
use App\Models\User;
use App\Providers\Keycloak\Exceptions\TokenException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * source: https://github.com/robsontenorio/laravel-keycloak-guard
 * author: Robson Tenório https://github.com/robsontenorio
 * author: adapted by Alec Berney https://github.com/alecberney
 */
class KeycloakGuard implements Guard
{
    private $config;
    private $user;
    private $provider;
    private $decodedToken;

    public function __construct(UserProvider $provider, Request $request)
    {
        $this->config = config('keycloak');
        $this->user = null;
        $this->provider = $provider;
        $this->decodedToken = null;
        $this->request = $request;

        $this->authenticate();
    }

    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check(): bool
    {
        return !is_null($this->user());
    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest(): bool
    {
        return !$this->check();
    }
    
    [...]