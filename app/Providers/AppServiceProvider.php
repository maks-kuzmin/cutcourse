<?php

namespace App\Providers;

use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Exception, который будет показываться, когда мы пытаемся сделать запрос N+1
        Model::preventLazyLoading(!app()->isProduction());
        /*
        Exception, который будет показываться, когда мы будем пытаться сохранить какие данные в полях,
        которые не указаны в $fillable
        */
        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());

        /*
        Если запросы в БД выполняются больше 500 милисекунд, то этот метод оповещает об этом
        */
        DB::whenQueryingForLongerThan(500, function (Connection $connection, QueryExecuted $event) {
            // TODO 3rd lesson
        });

        // TODO 3rd lesson request cycle
    }
}
