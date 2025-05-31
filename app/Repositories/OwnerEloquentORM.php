<?php

namespace App\Repositories;

use App\DTO\CreateOwnerDTO;
use App\DTO\UpdateOwnerDTO;
use App\Models\Owner;
use App\Repositories\OwnerRepositoryInterface;
use stdClass;

class OwnerEloquentORM implements OwnerRepositoryInterface
{
    public function __construct(
        protected Owner $model,
    ) {}
    public function findOne(string $id): stdClass | null
    {
        $owner = $this->model->find($id);

        if (!$owner) {
            return null;
        }

        return (object) $owner->toArray();
    }

    public function create(CreateOwnerDTO $ownerData): stdClass
    {
        $owner = $this->model->create((array) $ownerData);
        return (object) $owner->toArray();
    }

    public function update(UpdateOwnerDTO $ownerData): stdClass | null
    {
        $owner = $this->model->find($ownerData->id);

        if (! $owner) {
            return null;
        }

        $newData = (array) $ownerData;

        // Para caso a senha não tenha sido alterada, remove a senha para que ela não seja apagada
        if (!$newData['password']) {
            unset($newData['password']);
        }

        $owner->update($newData);
        return (object) $owner->toArray();
    }

    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }
}
