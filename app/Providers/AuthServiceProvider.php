<?php

namespace App\Providers;

use Gate;
use App\User;
use App\Article;
use App\Comment;
use App\Option;

use App\Policies\ArticlePolicy;
use App\Policies\UserPolicy;
use App\Policies\CommentPolicy;
use App\Policies\OptionPolicy;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
	Article::class => ArticlePolicy::class,
	User::class => UserPolicy::class,
	Comment::class => CommentPolicy::class,
	Option::class => OptionPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //
    }
}
