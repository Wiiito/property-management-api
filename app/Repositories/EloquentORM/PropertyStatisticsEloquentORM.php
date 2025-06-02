<?php

namespace App\Repositories\EloquentORM;

use App\Models\Owner;
use App\Models\PropertyStatistics;
use App\Repositories\Interfaces\PropertyStatisticsRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class PropertyStatisticsEloquentORM implements PropertyStatisticsRepositoryInterface
{
    public function new(string $id)
    {
        PropertyStatistics::create(["property_id" => $id]);
    }

    public function get(string $id): stdClass | null
    {
        $PropertyStatistics = PropertyStatistics::where("property_id", $id)->first();

        return (object) $PropertyStatistics->toArray();
    }

    public function getAllFromOwner(string $id): Collection
    {
        $propertiesStatistics = Owner::find($id)->propertiesStatistics()->get();

        return $propertiesStatistics;
    }

    public function incrementImpressions(string $id): void
    {
        PropertyStatistics::where("property_id", $id)->increment("impressions");
    }

    public function incrementClick(string $id): void
    {
        PropertyStatistics::where("property_id", $id)->increment("clicks");
    }

    public function delete(string $id): void
    {
        PropertyStatistics::findOrFail($id)->delete();
    }
}
