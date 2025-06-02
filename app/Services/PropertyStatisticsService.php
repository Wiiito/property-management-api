<?php

namespace App\Services;

use App\Repositories\Interfaces\PropertyStatisticsRepositoryInterface;

class PropertyStatisticsService
{
    public function __construct(
        protected PropertyStatisticsRepositoryInterface $statisticsRepository
    ) {}

    public function new(string $id)
    {
        $this->statisticsRepository->new($id);
    }

    public function getAllFromOwner(string $id)
    {
        return $this->statisticsRepository->getAllFromOwner($id);
    }

    public function get(string $id)
    {
        return $this->statisticsRepository->get($id);
    }

    public function incrementImpressions(string $id): void
    {
        $this->statisticsRepository->incrementImpressions($id);
    }

    public function incrementClick(string $id): void
    {
        $this->statisticsRepository->incrementClick($id);
    }

    public function delete(string $id)
    {
        $this->statisticsRepository->delete($id);
    }
}
