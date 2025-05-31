<?php

namespace App\Http\Controllers;

use App\DTO\CreateOwnerDTO;
use App\DTO\UpdateOwnerDTO;
use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use App\Services\OwnerService;
use Illuminate\Http\Response;

class OwnerController extends Controller
{
    public function __construct(
        protected OwnerService $ownerServices,
    ) {}

    public function index() {}


    public function store(StoreOwnerRequest $request)
    {
        $owner = $this->ownerServices->create(CreateOwnerDTO::fromRequest($request));

        return $owner;
    }


    public function show(string $id)
    {
        $owner = $this->ownerServices->get($id);

        if (!$owner) {
            return response()->json(["message" => "Owner not found"], Response::HTTP_NOT_FOUND);
        }

        return $owner;
    }


    public function update(UpdateOwnerRequest $request, string $id)
    {
        $owner = $this->ownerServices->update(UpdateOwnerDTO::fromRequest($request, $id));

        if (!$owner) {
            return response()->json(["message" => "Owner not found"], Response::HTTP_NOT_FOUND);
        }

        return $owner;
    }


    public function destroy(string $id)
    {
        $this->ownerServices->delete($id);
    }
}
