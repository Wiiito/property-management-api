<?php

namespace App\Http\Controllers;

use App\DTO\Owner\CreateOwnerDTO;
use App\DTO\Owner\LoginOwnerDTO;
use App\DTO\Owner\UpdateOwnerDTO;
use App\Http\Requests\Owner\LoginOwnerRequest;
use App\Http\Requests\Owner\StoreOwnerRequest;
use App\Http\Requests\Owner\UpdateOwnerRequest;
use App\Models\Owner;
use App\Services\OwnerService;
use Illuminate\Http\Response;

class OwnerController extends Controller
{
    public function __construct(
        protected OwnerService $service,
    ) {}

    public function store(StoreOwnerRequest $request)
    {
        $owner = $this->service->create(CreateOwnerDTO::fromRequest($request));

        return $owner;
    }


    public function show(string $id)
    {
        $owner = $this->service->get($id);

        if (!$owner) {
            return response()->json(["message" => "Owner not found"], Response::HTTP_BAD_GATEWAY);
        }

        return $owner;
    }


    public function update(UpdateOwnerRequest $request, string $id)
    {
        $owner = $this->service->update(UpdateOwnerDTO::fromRequest($request, $id));

        if (!$owner) {
            return response()->json(["message" => "Owner not found"], Response::HTTP_BAD_GATEWAY);
        }

        return $owner;
    }


    public function destroy(string $id)
    {
        $this->service->delete($id);
    }

    public function generateToken(LoginOwnerRequest $request)
    {
        $loginData = LoginOwnerDTO::fromRequest($request);

        $owner = $this->service->validate($loginData);

        if (!$owner) {
            return response()->json(["message" => "Wrong credentials"], Response::HTTP_UNAUTHORIZED);
        }

        $token = $owner->createToken($request->deviceName)->plainTextToken;

        return response()->json(['token' => $token]);
    }
}
