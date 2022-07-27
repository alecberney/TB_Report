<?php

    [...]

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

