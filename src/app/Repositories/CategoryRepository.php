<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Exception;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all(): JsonResponse
    {
        try {
            $categories = Category::all();

            return response()->json([
                'message' => 'Listado de categorías obtenido correctamente.',
                'data' => $categories
            ], 200);
        } catch (Exception $e) {
            Log::error('Error al obtener categorías: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al obtener las categorías.',
            ], 500);
        }
    }

    public function find(int $id): JsonResponse
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Categoría no encontrada.'
                ], 404);
            }

            return response()->json([
                'message' => 'Categoría obtenida correctamente.',
                'data' => $category
            ], 200);
        } catch (Exception $e) {
            Log::error('Error al buscar categoría: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al buscar la categoría.',
            ], 500);
        }
    }

    public function create(array $data): JsonResponse
    {
        try {
            $category = Category::create($data);

            return response()->json([
                'message' => 'Categoría creada exitosamente.',
                'data' => $category
            ], 201);
        } catch (Exception $e) {
            Log::error('Error al crear categoría: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al crear la categoría.',
            ], 500);
        }
    }

    public function update(int $id, array $data): JsonResponse
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Categoría no encontrada.'
                ], 404);
            }

            $category->update($data);

            return response()->json([
                'message' => 'Categoría actualizada correctamente.',
                'data' => $category
            ], 200);
        } catch (Exception $e) {
            Log::error('Error al actualizar categoría: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al actualizar la categoría.',
            ], 500);
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Categoría no encontrada.'
                ], 404);
            }

            $category->delete();

            return response()->json([
                'message' => 'Categoría eliminada correctamente.'
            ], 200);
        } catch (Exception $e) {
            Log::error('Error al eliminar categoría: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al eliminar la categoría.',
            ], 500);
        }
    }
}
