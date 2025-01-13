<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationsRequest;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;

class OrganizationController extends Controller
{
    public function index(OrganizationsRequest $request) {
        $organizations = Organization::with(['building', 'activities'])
            ->filter($request->get('filter'))
            ->jsonPaginate();

        return OrganizationResource::collection($organizations)
            ->response();
    }

    public function show(Organization $organization) {
        if ($organization->status != Organization::STATUS_ACTIVE) {
            abort(404);
        }
        $organization->load(['building', 'activities']);

        return (new OrganizationResource($organization))->response();
    }
}
