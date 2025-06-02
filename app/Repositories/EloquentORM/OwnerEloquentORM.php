<?php

namespace App\Repositories\EloquentORM;

use App\DTO\Owner\CreateOwnerDTO;
use App\DTO\Owner\LoginOwnerDTO;
use App\DTO\Owner\UpdateOwnerDTO;
use App\Models\Owner;
use App\Repositories\Interfaces\OwnerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use stdClass;

class OwnerEloquentORM implements OwnerRepositoryInterface
{
    public function __construct(
        protected Owner $model,
    ) {}

    public function all(): array
    {
        $allOwners = $this->model->paginate(20)->all();
        return $allOwners;
    }
    public function findOne(string $id): stdClass | null
    {
        $owner = $this->model->find($id);

        if (!$owner) {
            return null;
        }

        return (object) $owner->toArray();
    }

    public function create(CreateOwnerDTO $ownerData): Owner
    {
        $owner = $this->model->create((array) $ownerData);
        return $owner;
    }

    public function update(UpdateOwnerDTO $ownerData): stdClass | null
    {
        $owner = $this->model->find($ownerData->id);

        if (! $owner) {
            return null;
        }

        // Para caso a senha não tenha sido alterada, remove a senha para que ela não seja apagada
        $ownerData = array_filter((array) $ownerData);

        $owner->update($ownerData);
        return (object) $owner->toArray();
    }

    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }

    public function validate(LoginOwnerDTO $ownerData): Owner | null
    {
        $owner = $this->model->where('email', $ownerData->email)->first();

        if (!$owner) {
            return null;
        }

        if (!Hash::check($ownerData->password, $owner->password)) {
            return null;
        }

        return $owner;
    }
}
