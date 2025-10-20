<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Interfaces\TagRepositoryInterface;
use Illuminate\Http\JsonResponse;

class TagController
{

    protected TagRepositoryInterface $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index(): JsonResponse
    {
        return $this->tagRepository->all();
    }

    public function show(int $id): JsonResponse
    {
        return $this->tagRepository->find($id);
    }

    public function store(StoreTagRequest $request): JsonResponse
    {
        return $this->tagRepository->create($request->validated());
    }

    public function update(UpdateTagRequest $request, int $id): JsonResponse
    {
        return $this->tagRepository->update($id, $request->validated());
    }

    public function destroy(int $id): JsonResponse
    {
        return $this->tagRepository->delete($id);
    }
}
