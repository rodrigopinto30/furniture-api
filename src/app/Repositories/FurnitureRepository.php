<?php

namespace App\Repositories;

use App\Models\Furniture;
use App\Interfaces\FurnitureRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Exception;

class FurnitureRepository implements FurnitureRepositoryInterface
{
    public function all(): JsonResponse
    {
        try {
            $muebles = Furniture::with(['category', 'tags'])->get();

            return response()->json([
                'message' => 'Listado de muebles obtenido correctamente.',
                'data' => $muebles
            ], 200);
        } catch (Exception $e) {
            Log::error('Error al obtener muebles: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al obtener los muebles.'
            ], 500);
        }
    }

    public function find(int $id): JsonResponse
    {
        try {
            $mueble = Furniture::with(['category', 'tags'])->find($id);

            if (!$mueble) {
                return response()->json([
                    'message' => 'Mueble no encontrado.'
                ], 404);
            }

            return response()->json([
                'message' => 'Mueble obtenido correctamente.',
                'data' => $mueble
            ], 200);
        } catch (Exception $e) {
            Log::error('Error al buscar mueble: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al buscar el mueble.'
            ], 500);
        }
    }

    public function create(array $data): JsonResponse
    {
        try {
            $mueble = Furniture::create($data);

            if (!empty($data['category'])) {
                $mueble->category()->sync($data['category']);
            }

            if (!empty($data['tags'])) {
                $mueble->tags()->sync($data['tags']);
            }

            return response()->json([
                'message' => 'Mueble creado exitosamente.',
                'data' => $mueble->load(['category', 'tags'])
            ], 201);
        } catch (Exception $e) {
            Log::error('Error al crear mueble: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al crear el mueble.'
            ], 500);
        }
    }

    public function update(int $id, array $data): JsonResponse
    {
        try {
            $mueble = Furniture::find($id);

            if (!$mueble) {
                return response()->json([
                    'message' => 'Mueble no encontrado.'
                ], 404);
            }

            $mueble->update($data);

            if (array_key_exists('category', $data)) {
                $mueble->category()->sync($data['category'] ?? []);
            }

            if (array_key_exists('tags', $data)) {
                $mueble->tags()->sync($data['tags'] ?? []);
            }

            return response()->json([
                'message' => 'Mueble actualizado correctamente.',
                'data' => $mueble->load(['category', 'tags'])
            ], 200);
        } catch (Exception $e) {
            Log::error('Error al actualizar mueble: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al actualizar el mueble.'
            ], 500);
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $mueble = Furniture::find($id);

            if (!$mueble) {
                return response()->json([
                    'message' => 'Mueble no encontrado.'
                ], 404);
            }

            $mueble->delete();

            return response()->json([
                'message' => 'Mueble eliminado correctamente.'
            ], 200);
        } catch (Exception $e) {
            Log::error('Error al eliminar mueble: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al eliminar el mueble.'
            ], 500);
        }
    }
}
