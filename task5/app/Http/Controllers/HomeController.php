<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeRequest;
use App\Services\SchoolService;
use App\Traits\Paginatable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use Paginatable;

    /** @var SchoolService $schoolService */
    private SchoolService $schoolService;

    public function __construct(SchoolService $schoolService)
    {
        $this->schoolService = $schoolService;
    }

    /**
     * Home Page
     *
     * @param HomeRequest $request
     * @return View
     */
    public function index(HomeRequest $request): View
    {
        $filters = [
            "with" => "members"
        ];
        if ($request->has('country') && !empty($request->input('country'))) {
            $filters["where"][] = ["country_id", "=", $request->input('country')];
        }
        $schools = $this->schoolService->findAll($filters);
        $paginatedItems = $this->getItems($schools, $request);

        return view('home', ['items' => $paginatedItems]);
    }
}
