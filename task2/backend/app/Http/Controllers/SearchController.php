<?php

namespace App\Http\Controllers;

use App\Http\Resources\SearchResource;
use App\Models\Profile;
use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class SearchController extends Controller
{
    private SearchService $profileService;

    public function __construct(SearchService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Search by name
     *
     * @param Request $request
     * @return Response|SearchResource
     * @throws ValidationException
     */
    public function search(Request $request): Response|SearchResource
    {
        $name = $this->getNameSearchTerm($request);
        $profiles = $this->searchProfiles($name);
        if (!$profiles) {
            return $this->createNotFoundResponse();
        }
        return new SearchResource($profiles);
    }

    /**
     * @throws ValidationException
     */
    private function getNameSearchTerm(Request $request): string
    {
        try {
            $this->validateRequest($request);
            return $request->input('name');
        } catch (ValidationException $e) {
            // Log the error
            error_log($e->getMessage());
            // Rethrow the exception to be handled by the caller
            throw $e;
        }
    }

    /**
     * Validate the search request.
     *
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    private function validateRequest(Request $request): void
    {
        $rules = [
            'name' => 'required|max:255',
        ];
        $messages = [
            'name.required' => 'The name field is required.',
        ];
        $this->validate($request, $rules, $messages);
    }

    /**
     * @param string $name
     * @return Profile|array
     */
    private function searchProfiles(string $name): Profile|array
    {
        // Use an interface to abstract the dependency
        $profiles = $this->profileService->findByName($name);
        return $profiles ?: [];
    }

    /**
     * @return Response
     */
    private function createNotFoundResponse(): Response
    {
        return response(['code' => 404, 'message' => 'Not Found'], 404);
    }
}
