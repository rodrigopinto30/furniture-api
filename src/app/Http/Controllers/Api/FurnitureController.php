<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreFurnitureRequest;
use App\Http\Requests\UpdateFurnitureRequest;
use App\Interfaces\FurnitureRepositoryInterface;
use App\Repositories\FurnitureRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class FurnitureController
{
    protected FurnitureRepositoryInterface $furnitureRepository;

    public function __construct(FurnitureRepository $furnitureRepository)
    {
        $this->furnitureRepository = $furnitureRepository;
    }

    public function index(): JsonResponse
    {
        return $this->furnitureRepository->all();
    }

    public function store(StoreFurnitureRequest $request): JsonResponse
    {

        return $this->furnitureRepository->create($request->validated());
    }

    public function show(int $id): JsonResponse
    {
        return $this->furnitureRepository->find($id);
    }

    public function update(UpdateFurnitureRequest $request, int $id): JsonResponse
    {
        return $this->furnitureRepository->update($id, $request->validated());
    }

    public function destroy(int $id): JsonResponse
    {
        return $this->furnitureRepository->delete($id);
    }
}
