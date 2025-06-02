<?php

namespace App\Repositories\Interfaces;

use App\DTO\Property\CreatePropertyDTO;
use App\DTO\Property\FilterPropertyDTO;
use App\DTO\Property\UpdatePropertyDTO;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

interface PropertyRepositoryInterface
{
    public function all(?FilterPropertyDTO $filter = null): array;
    public function findOne(string $id): stdClass | null;

    public function getAllFromOwner(string $id): Collection;

    public function create(CreatePropertyDTO $propertyData): stdClass;

    public function update(UpdatePropertyDTO $ownerData): stdClass | null;

    public function delete(string $id): void;
}
