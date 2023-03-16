<?php

namespace App\View\Composers;

use App\Services\CountryService;
use Illuminate\View\View;

class CountriesComposer
{
    /**
     * Create a new add composer.
     */
    public function __construct(
        protected CountryService $countryService,
    ) {}

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('countries', $this->countryService->findAll());
    }
}
