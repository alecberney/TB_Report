<?php

namespace App\Providers;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        File::class => FilePolicy::class,
        FileType::class => FileTypePolicy::class,
        JobCategory::class => JobCategoryPolicy::class,
        Job::class => JobPolicy::class,
        Message::class => MessagePolicy::class,
        User::class => UserPolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
