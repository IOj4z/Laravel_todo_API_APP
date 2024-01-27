<?php

namespace App\Providers;

use App\Models\Task;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\\Http\\Controllers\\API\\V1\\';
    public function map()
    {
        $this->mapApiRoutes();
    }

    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
//            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
    public function boot()
    {

        Route::model('task', Task::class);
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
//                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('auth.basic')->get('/user', function (Request $request) {
                return $request->user();
            });
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
