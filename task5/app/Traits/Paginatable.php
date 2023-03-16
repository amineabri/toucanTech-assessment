<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

trait Paginatable
{

    /**
     * Define how many items we want to be visible in each page
     *
     * @var int $itemsPerPage
     */

    private int $itemsPerPage = 25;

    /**
     * Get the number of models to return per page.
     *
     * @param $itemCollection
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getItems($itemCollection, Request $request): LengthAwarePaginator
    {
        $currentPage        = LengthAwarePaginator::resolveCurrentPage();

        $this->setPerPage($request);

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(
            ($currentPage * $this->itemsPerPage) - $this->itemsPerPage,
            $this->itemsPerPage
        )->all();

        // Create our paginator and pass it to the view
        $paginatedItems = new LengthAwarePaginator(
            $currentPageItems,
            count($itemCollection),
            $this->itemsPerPage
        );

        // set url path for generated links
        $paginatedItems->setPath($request->url());
        return $paginatedItems->appends($request->all());
    }

    /**
     * @param Request $request
     * @return void
     */
    public function setPerPage(Request $request): void
    {
        $itemsPerPage = $request->has('perPage')?
                                $request->get('perPage'):
                                config('pagination.items.items-per-page');
        $this->setItemPerPage($itemsPerPage);
    }

    /**
     * @param string $itemPerPage
     */
    public function setItemPerPage(string $itemPerPage): void
    {
        $this->itemsPerPage = $itemPerPage;
    }

    /**
     * @return string
     */
    public function getItemPerPage(): string
    {
        return $this->itemsPerPage;
    }
}
