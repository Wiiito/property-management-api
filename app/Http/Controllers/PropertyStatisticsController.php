<?php

namespace App\Http\Controllers;

use App\Services\PropertyStatisticsService;
use Illuminate\Http\Request;

class PropertyStatisticsController extends Controller
{
    public function __construct(
        protected PropertyStatisticsService $service,
    ) {}

    public function index(Request $request)
    {
        return $this->service->getAllFromOwner($request->user()->id);
    }

    public function show(string $id)
    {
        return $this->service->get($id);
    }
}
