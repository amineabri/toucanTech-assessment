<?php

namespace App\View\Composers;
use App\Services\SchoolService;
use Illuminate\View\View;

class SchoolsComposer
{
    /**
     * Create a new add composer.
     */
    public function __construct(
        protected SchoolService $schoolService,
    ) {}

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('schools', $this->schoolService->findAll());
    }
}
