<?php

namespace App\Providers;

use App\UseCases\Git\GitReceivePackUseCaseCore;
use App\UseCases\Git\GitReceivePackUseCaseInputInterface;
use App\UseCases\Git\GitReceivePackUseCaseOutputInterface;
use App\UseCases\Git\GitReceivePackUseCasePresenter;
use App\UseCases\Git\GitUploadPackUseCaseCore;
use App\UseCases\Git\GitUploadPackUseCaseInputInterface;
use App\UseCases\Git\GitUploadPackUseCaseOutputInterface;
use App\UseCases\Git\GitUploadPackUseCasePresenter;
use Illuminate\Support\ServiceProvider;

class UseCaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GitReceivePackUseCaseInputInterface::class, GitReceivePackUseCaseCore::class);
        $this->app->bind(GitReceivePackUseCaseOutputInterface::class, GitReceivePackUseCasePresenter::class);
        $this->app->bind(GitUploadPackUseCaseInputInterface::class, GitUploadPackUseCaseCore::class);
        $this->app->bind(GitUploadPackUseCaseOutputInterface::class, GitUploadPackUseCasePresenter::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
