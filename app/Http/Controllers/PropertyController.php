<?php

namespace App\Http\Controllers;

use App\DTO\Property\CreatePropertyDTO;
use App\DTO\Property\UpdatePropertyDTO;
use App\Http\Requests\Property\CreatePropertyRequest;
use App\Http\Requests\Property\UpdatePropertyRequest;
use App\Models\Property;
use App\Services\PropertyService;
use Illuminate\Http\Response;

class PropertyController extends Controller
{
    public function __construct(
        protected PropertyService $service,
    ) {}

    public function index()
    {
        return $this->service->all();
    }

    public function store(CreatePropertyRequest $request)
    {
        return $this->service->create(CreatePropertyDTO::fromRequest($request));
    }

    public function show(string $id)
    {
        $property = $this->service->get($id);

        if (!$property) {
            return response()->json(["message" => "Property not found"], Response::HTTP_BAD_REQUEST);
        }

        return $property;
    }

    public function update(UpdatePropertyRequest $request, string $id)
    {
        $property = $this->service->update(UpdatePropertyDTO::fromRequest($request, $id));

        if (!$property) {
            return response()->json(["message" => "Property not found"], Response::HTTP_BAD_REQUEST);
        }

        return $property;
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);
    }
}
