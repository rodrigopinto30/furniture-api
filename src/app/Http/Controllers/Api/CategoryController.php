<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CategoryController
{

    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(): JsonResponse
    {
        return $this->categoryRepository->all();
    }

    public function show($id): JsonResponse
    {
        return $this->categoryRepository->find($id);
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        return $this->categoryRepository->create($request->validated());
    }

    public function update(UpdateCategoryRequest $request, int $id): JsonResponse
    {
        return $this->categoryRepository->update($id, $request->validated());
    }

    public function destroy(int $id): JsonResponse
    {
        return $this->categoryRepository->delete($id);
    }
}
