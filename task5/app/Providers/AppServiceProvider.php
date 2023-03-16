<?php

namespace App\Providers;

use App\Interfaces\CountryRepository;
use App\Interfaces\MemberRepository;
use App\Interfaces\SchoolRepository;
use App\Models\Country;
use App\Models\Member;
use App\Models\School;
use App\Repositories\Builders\OrderBuilder;
use App\Repositories\Builders\OrderBuilderInterface;
use App\Repositories\Builders\QueryBuilder;
use App\Repositories\Builders\QueryBuilderInterface;
use App\Repositories\EloquentCountryRepository;
use App\Repositories\EloquentMemberRepository;
use App\Repositories\EloquentSchoolRepository;
use App\View\Composers\CountriesComposer;
use App\View\Composers\SchoolsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Ramsey\Uuid\Uuid;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            QueryBuilderInterface::class,
            QueryBuilder::class
        );
        $this->app->bind(
            OrderBuilderInterface::class,
            OrderBuilder::class
        );
        $this->app->bind(
            SchoolRepository::class,
            EloquentSchoolRepository::class
        );
        $this->app->bind(
            MemberRepository::class,
            EloquentMemberRepository::class
        );
        $this->app->bind(
            CountryRepository::class,
            EloquentCountryRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['member.save', 'member.list'], SchoolsComposer::class);
        View::composer('home', CountriesComposer::class);

        Country::creating(static function (Country $country) {
            $country->uuid = Uuid::uuid4()->toString();
        });
        School::creating(static function (School $country) {
            $country->uuid = Uuid::uuid4()->toString();
        });
        Member::creating(static function (Member $country) {
            $country->uuid = Uuid::uuid4()->toString();
        });
    }
}
