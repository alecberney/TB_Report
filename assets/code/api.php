<?php

Route::middleware('auth:api')->group(function () {

    Route::prefix('/jobs')->controller(JobController::class)
    ->group(function () {
        Route::get('', 'index')->can('viewAny', Job::class);
        Route::get('/unassigned', 'unassigned_jobs')
        ->can('unassigned_jobs', Job::class);
        Route::get('/user/{username}', 'user_jobs')
        ->can('user_jobs', [Job::class, 'username']);
        Route::get('/client/{username}', 'user_as_client_jobs')
        ->can('user_as_client_jobs', [Job::class, 'username']);
        Route::get('/worker/{username}', 'user_as_worker_jobs')
        ->can('user_as_worker_jobs', [Job::class, 'username']);
        Route::get('/validator/{username}', 'user_as_validator_jobs')
        ->can('user_as_validator_jobs', [Job::class, 'username']);
        Route::get('/{id}', 'show')
        ->can('view', [Job::class, 'id']);
        Route::post('', 'store')
        ->can('create', Job::class);
        Route::put('', 'update')
        ->can('update', Job::class);
        Route::patch('/assign', 'assign')
        ->can('assign', Job::class);
        Route::patch('/status', 'update_status')
        ->can('update_status', Job::class);
        Route::patch('/rating', 'update_rating')
        ->can('update_rating', Job::class);
        Route::patch('{id}/notifications/user/{username}', 'update_notifications')
        ->can('update_notifications', [Job::class, 'id', 'username']);
        Route::delete('/{id}', 'destroy')
        ->can('destroy', [Job::class, 'id']);
    });

    Route::prefix('/files')->controller(FileController::class)
    ->group(function () {
        Route::get('/{id}', 'show')
        ->can('view', [File::class, 'id']);
        Route::get('/{id}/download', 'download')
        ->can('download', [File::class, 'id']);
        Route::get('/{id}/link', 'download')
        ->can('download', [File::class, 'id']);
        Route::post('', 'store')
        ->can('create', File::class);
        Route::put('', 'update')
        ->can('update', File::class);
        Route::delete('/{id}', 'destroy')
        ->can('destroy', [File::class, 'id']);
    });

    Route::prefix('/messages')->controller(MessageController::class)
    ->group(function () {
        Route::get('', 'index')
        ->can('viewAny', Message::class);
        Route::get('/{id}', 'show')
        ->can('view', [Message::class, 'id']);
        Route::post('', 'store')
        ->can('create', Message::class);
    });

    Route::prefix('/users')->controller(UserController::class)
    ->group(function () {
        Route::get('', 'index')
        ->can('viewAny', User::class);
        Route::get('/{username}', 'show')
        ->can('view', [User::class, 'username']);
        Route::post('', 'store')
        ->can('create', User::class);
        Route::put('', 'update')
        ->can('update', User::class);
        Route::patch('/notifications', 'update_email_notifications')
        ->can('update_email_notifications', User::class);
        Route::delete('/{username}', 'destroy')
        ->can('destroy', [User::class, 'username']);
    });

    Route::prefix('/job_categories')->controller(JobCategoryController::class)
    ->group(function () {
            Route::get('', 'index')
            ->can('viewAny', JobCategory::class);
            Route::get('/{id}', 'show')
            ->can('view', [JobCategory::class, 'id']);
            Route::get('/{id}/image', 'image')
            ->can('image', [JobCategory::class. 'id']);
            Route::post('', 'store')
            ->can('create', JobCategory::class);
            Route::put('', 'update')
            ->can('update', JobCategory::class);
            Route::delete('/{id}', 'destroy')
            ->can('destroy', [JobCategory::class, 'id']);
        });

    // Admin routes
    Route::prefix('/file_types')
        ->controller(FileTypeController::class)
        ->middleware('can:before,App\Models\FileType')
        ->group(function () {
            Route::get('', 'index');
            Route::get('/{id}', 'show');
            Route::post('', 'store');
            Route::put('', 'update');
            Route::delete('/{id}', 'destroy');
        });
});

