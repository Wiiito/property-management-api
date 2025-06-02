<?php

namespace App\Repositories\Interfaces;

use stdClass;
use Illuminate\Database\Eloquent\Collection;

interface PropertyStatisticsRepositoryInterface
{
    public function new(string $id);

    public function get(string $id): stdClass | null;

    public function getAllFromOwner(string $id): Collection;

    public function incrementImpressions(string $id): void;

    public function incrementClick(string $id): void;

    public function delete(string $id): void;
}
