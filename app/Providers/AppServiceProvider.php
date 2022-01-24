<?php

namespace Vanguard\Providers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Vanguard\Repositories\Country\CountryRepository;
use Vanguard\Repositories\Country\EloquentCountry;
use Vanguard\Repositories\LocationCode\EloquentLocationCode;
use Vanguard\Repositories\LocationCode\LocationCodeRepository;
use Vanguard\Repositories\Patient\EloquentPatient;
use Vanguard\Repositories\Patient\PatientRepository;
use Vanguard\Repositories\Permission\EloquentPermission;
use Vanguard\Repositories\Permission\PermissionRepository;
use Vanguard\Repositories\Role\EloquentRole;
use Vanguard\Repositories\Role\RoleRepository;
use Vanguard\Repositories\Session\DbSession;
use Vanguard\Repositories\Session\SessionRepository;
use Vanguard\Repositories\User\EloquentUser;
use Vanguard\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;
use Vanguard\Repositories\CommonCode\CommonCodeRepository;
use Vanguard\Repositories\CommonCode\EloquentCommonCode;
use Vanguard\Repositories\Attach\AttachBtsRepository;
use Vanguard\Repositories\Attach\EloquentAttachBts;
use Vanguard\Repositories\Attach\EloquentAttachQrcode;
use Vanguard\Repositories\Attach\AttachQrcodeRepository;
use Vanguard\Repositories\PatientHistory\EloquentPatientHistory;
use Vanguard\Repositories\PatientHistory\PatientHistoryRepository;
use Vanguard\Repositories\PatientRelated\EloquentPatientRelated;
use Vanguard\Repositories\PatientRelated\PatientRelatedRepository;
use Vanguard\Repositories\PatientFamily\EloquentPatientFamily;
use Vanguard\Repositories\PatientFamily\PatientFamilyRepository;

use Vanguard\Repositories\PatientTravelHistory\EloquentPatientTravelHistory;
use Vanguard\Repositories\PatientTravelHistory\PatientTravelHistoryRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
        config(['app.name' => setting('app_name')]);
        \Illuminate\Database\Schema\Builder::defaultStringLength(191);

        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return 'Database\Factories\\'.class_basename($modelName).'Factory';
        });

        \Illuminate\Pagination\Paginator::useBootstrap();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(RoleRepository::class, EloquentRole::class);
        $this->app->singleton(PermissionRepository::class, EloquentPermission::class);
        $this->app->singleton(SessionRepository::class, DbSession::class);
        $this->app->singleton(CountryRepository::class, EloquentCountry::class);

        $this->app->singleton(LocationCodeRepository::class, EloquentLocationCode::class);
        $this->app->singleton(CommonCodeRepository::class, EloquentCommonCode::class);
        $this->app->singleton(PatientRepository::class, EloquentPatient::class);
        $this->app->singleton(AttachBtsRepository::class, EloquentAttachBts::class);
        $this->app->singleton(AttachQrcodeRepository::class, EloquentAttachQrcode::class);
        $this->app->singleton(PatientHistoryRepository::class, EloquentPatientHistory::class);
        $this->app->singleton(PatientRelatedRepository::class, EloquentPatientRelated::class);
        $this->app->singleton(PatientFamilyRepository::class, EloquentPatientFamily::class);
        $this->app->singleton(PatientTravelHistoryRepository::class, EloquentPatientTravelHistory::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
