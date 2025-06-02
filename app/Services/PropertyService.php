<?php

namespace App\Services;


use App\DTO\Property\CreatePropertyDTO;
use App\DTO\Property\FilterPropertyDTO;
use App\DTO\Property\UpdatePropertyDTO;
use App\Repositories\Interfaces\PropertyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class PropertyService
{
    public function __construct(
        /**
         * Interface do repositorio recebe bind em App\Providers\AppServiceProviders.php
         * Isso acontece para facilitar a implementação de um tipo generico de ORM, nesse caso Eloquent
         * Implementação pensada para manutenção
         */
        protected PropertyRepositoryInterface $repository,
    ) {}

    public function all(FilterPropertyDTO $filter): array
    {
        return $this->repository->all($filter);
    }

    public function get(string $id): stdClass | null
    {
        $user = $this->repository->findOne($id);
        return $user;
    }

    public function create(CreatePropertyDTO $propertyData): stdClass
    {
        $property = $this->repository->create($propertyData);
        return $property;
    }

    public function update(UpdatePropertyDTO $propertyData)
    {
        $property = $this->repository->update($propertyData);
        return $property;
    }

    public function delete(string $id)
    {
        $this->repository->delete($id);
    }
}
