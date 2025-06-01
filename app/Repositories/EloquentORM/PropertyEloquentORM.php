<?php

namespace App\Repositories\EloquentORM;

use App\DTO\Property\CreatePropertyDTO;
use App\DTO\Property\UpdatePropertyDTO;
use App\Models\Property;
use App\Repositories\Interfaces\PropertyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class PropertyEloquentORM implements PropertyRepositoryInterface
{
    public function __construct(
        protected Property $model,
    ) {}

    public function all(): array
    {
        $allProperties = $this->model->all();
        return $allProperties->toArray();
    }

    public function findOne(string $id): stdClass | null
    {
        $property = $this->model->find($id);

        if (!$property) {
            return null;
        }

        return (object) $property->first()->toArray();
    }

    public function getAllFromOwner(string $id): Collection
    {
        $allProperties = $this->model->where("owner_id", $id)->get();

        return $allProperties;
    }

    public function create(CreatePropertyDTO $propertyData): stdClass
    {
        $property = $this->model->create((array) $propertyData);
        return (object) $property->toArray();
    }

    public function update(UpdatePropertyDTO $propertyData): stdClass | null
    {
        $property = $this->model->find($propertyData->id);

        if (!$property) {
            return null;
        }

        // Remove valores não passados para que não sejam alterados
        $propertyData = array_filter((array) $propertyData, function ($value) {
            return $value !== null;
        });

        $property->update($propertyData);

        return (object) $property->toArray();
    }

    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }
}
