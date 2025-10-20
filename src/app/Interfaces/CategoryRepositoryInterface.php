<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;

interface CategoryRepositoryInterface
{
    public function all(): JsonResponse;
    public function find(int $id): JsonResponse;
    public function create(array $data): JsonResponse;
    public function update(int $id, array $data): JsonResponse;
    public function delete(int $id): JsonResponse;
}
