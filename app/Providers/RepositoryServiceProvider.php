<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces;
use App\Repositories;
use Dotenv\Repository\RepositoryInterface;
use Illuminate\Cache\Repository;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Interfaces\UserInterface::class, Repositories\UserRepository::class);
        $this->app->bind(Interfaces\SkillInterface::class, Repositories\SkillRepository::class);
        $this->app->bind(Interfaces\JobsInterface::class, Repositories\JobsRepository::class);
        $this->app->bind(Interfaces\CandidateInterface::class, Repositories\CandidateRepository::class);
        
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
};
