<?php

namespace App\Repositories;

use stdClass;
use App\DTO\Owner\CreateOwnerDTO;
use App\DTO\Owner\UpdateOwnerDTO;

interface OwnerRepositoryInterface
{
    public function findOne(string $id): stdClass | null;

    public function create(CreateOwnerDTO $ownerData): stdClass;

    public function update(UpdateOwnerDTO $ownerData): stdClass | null;

    public function delete(string $id): void;
}
