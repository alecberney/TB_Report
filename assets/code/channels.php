<?php

[...]

Broadcast::channel('message.{username}', function ($user, $username) {
    return $user->username === $username;
});

Broadcast::channel('job.{username}', function ($user, $username) {
    return $user->username === $username;
});

Broadcast::channel('job.workers', function ($user, $username) {
    return $user->has_given_role(\App\Constants\Roles::WORKER);
});
