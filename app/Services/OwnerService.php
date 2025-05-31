<?php

namespace App\Services;

use App\DTO\Owner\CreateOwnerDTO;
use App\DTO\Owner\UpdateOwnerDTO;
use App\Repositories\OwnerRepositoryInterface;
use stdClass;

class OwnerService
{
    public function __construct(
        /**
         * Interface do repositorio recebe bind em App\Providers\AppServiceProviders.php
         * Isso acontece para facilitar a implementação de um tipo generico de ORM, nesse caso Eloquent
         * Implementação pensada para manutenção
         */
        protected OwnerRepositoryInterface $repository,
    ) {}

    public function get(string $id): stdClass | null
    {
        $user = $this->repository->findOne($id);
        return $user;
    }

    public function create(CreateOwnerDTO $ownerData): stdClass | null
    {
        $owner = $this->repository->create($ownerData);
        return $owner;
    }

    public function update(UpdateOwnerDTO $ownerData)
    {
        $owner = $this->repository->update($ownerData);
        return $owner;
    }

    public function delete(string $id)
    {
        $this->repository->delete($id);
    }
}
