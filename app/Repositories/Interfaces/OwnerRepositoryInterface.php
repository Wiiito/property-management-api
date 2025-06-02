<?php

namespace App\Repositories\Interfaces;

use stdClass;
use App\DTO\Owner\CreateOwnerDTO;
use App\DTO\Owner\LoginOwnerDTO;
use App\DTO\Owner\UpdateOwnerDTO;
use App\Models\Owner;
use Illuminate\Database\Eloquent\Collection;

interface OwnerRepositoryInterface
{
    public function all(): array;

    public function findOne(string $id): stdClass | null;

    public function create(CreateOwnerDTO $ownerData): stdClass;

    public function update(UpdateOwnerDTO $ownerData): stdClass | null;

    public function delete(string $id): void;

    public function validate(LoginOwnerDTO $ownerData): Owner | null;
}
