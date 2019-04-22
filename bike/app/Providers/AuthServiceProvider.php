<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Mockery\Generator\StringManipulation\Pass\Pass;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 配置passport路由
        Passport::routes(null, [
            'prefix'=>'api/oauth'
        ]);
        // 指定Token的有效期
        Passport::tokensExpireIn(Carbon::now()->addHour(10));
        // 指定Refresh Token的有效期是一个月  刷新token
        Passport::refreshTokensExpireIn(Carbon::now()->addDay(30));
    }
}
