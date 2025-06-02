<?php

namespace App\Repositories\EloquentORM;

use App\DTO\Property\CreatePropertyDTO;
use App\DTO\Property\FilterPropertyDTO;
use App\DTO\Property\UpdatePropertyDTO;
use App\Models\Property;
use App\Repositories\Interfaces\PropertyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class PropertyEloquentORM implements PropertyRepositoryInterface
{
    public function __construct(
        protected Property $model,
    ) {}

    public function all(?FilterPropertyDTO $filter = null): array
    {
        if (is_null($filter)) {
            return $this->model->paginate(20)->all();
        }

        $filteredProperties = DB::table("properties");

        $filter->city ? $filteredProperties->where("city", "like", "%" . $filter->city . "%") : "";
        $filter->type ? $filteredProperties->where("type", $filter->type) : "";
        $filter->minValue ? $filteredProperties->where("value", ">", $filter->minValue) : "";
        $filter->maxValue ? $filteredProperties->where("value", "<", $filter->maxValue) : "";
        $filter->minFloor ? $filteredProperties->where("floor", ">", $filter->minFloor) : "";
        $filter->maxValue ? $filteredProperties->where("floor", "<", $filter->maxValue) : "";
        !is_null($filter->furnished) ? $filteredProperties->where("furnished", $filter->furnished) : "";

        $filteredProperties->paginate(20);

        return $filteredProperties->get()->all();
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
