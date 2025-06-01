<?php

namespace App\Services;

use App\DTO\Owner\CreateOwnerDTO;
use App\DTO\Owner\LoginOwnerDTO;
use App\DTO\Owner\UpdateOwnerDTO;
use App\Models\Owner;
use App\Models\Property;
use App\Repositories\Interfaces\OwnerRepositoryInterface;
use App\Repositories\Interfaces\PropertyRepositoryInterface;
use stdClass;

class OwnerService
{
    public function __construct(
        /**
         * Interface do repositorio recebe bind em App\Providers\AppServiceProviders.php
         * Isso acontece para facilitar a implementação de um tipo generico de ORM, nesse caso Eloquent
         * Implementação pensada para manutenção
         */
        protected OwnerRepositoryInterface $ownerRepository,
        protected PropertyRepositoryInterface $propertyRepository,
    ) {}

    public function get(string $id): stdClass | null
    {
        $user = $this->ownerRepository->findOne($id);
        return $user;
    }

    public function create(CreateOwnerDTO $ownerData): stdClass | null
    {
        $owner = $this->ownerRepository->create($ownerData);
        return $owner;
    }

    public function update(UpdateOwnerDTO $ownerData)
    {
        $owner = $this->ownerRepository->update($ownerData);
        return $owner;
    }

    public function delete(string $id)
    {
        $allProperties = $this->propertyRepository->getAllFromOwner($id);

        foreach ($allProperties as $property) {
            $property->delete();
        }

        $this->ownerRepository->delete($id);
    }

    public function validate(LoginOwnerDTO $ownerData): Owner | null
    {
        return $this->ownerRepository->validate($ownerData);
    }
}
