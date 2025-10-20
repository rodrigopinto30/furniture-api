<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Interfaces\TagRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Exception;

class TagRepository implements TagRepositoryInterface
{
    public function all(): JsonResponse
    {
        try {
            $tags = Tag::with('muebles')->get();

            return response()->json([
                'message' => 'Listado de etiquetas obtenido correctamente.',
                'data' => $tags
            ], 200);
        } catch (Exception $e) {
            Log::error('Error al obtener etiquetas: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al obtener las etiquetas.'
            ], 500);
        }
    }

    public function find(int $id): JsonResponse
    {
        try {
            $tag = Tag::with('muebles')->find($id);

            if (!$tag) {
                return response()->json([
                    'message' => 'Etiqueta no encontrada.'
                ], 404);
            }

            return response()->json([
                'message' => 'Etiqueta obtenida correctamente.',
                'data' => $tag
            ], 200);
        } catch (Exception $e) {
            Log::error('Error al buscar etiqueta: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al buscar la etiqueta.'
            ], 500);
        }
    }

    public function create(array $data): JsonResponse
    {
        try {
            $tag = Tag::create($data);

            return response()->json([
                'message' => 'Etiqueta creada exitosamente.',
                'data' => $tag
            ], 201);
        } catch (Exception $e) {
            Log::error('Error al crear etiqueta: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al crear la etiqueta.'
            ], 500);
        }
    }

    public function update(int $id, array $data): JsonResponse
    {
        try {
            $tag = Tag::find($id);

            if (!$tag) {
                return response()->json([
                    'message' => 'Etiqueta no encontrada.'
                ], 404);
            }

            $tag->update($data);

            return response()->json([
                'message' => 'Etiqueta actualizada correctamente.',
                'data' => $tag
            ], 200);
        } catch (Exception $e) {
            Log::error('Error al actualizar etiqueta: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al actualizar la etiqueta.'
            ], 500);
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $tag = Tag::find($id);

            if (!$tag) {
                return response()->json([
                    'message' => 'Etiqueta no encontrada.'
                ], 404);
            }

            $tag->delete();

            return response()->json([
                'message' => 'Etiqueta eliminada correctamente.'
            ], 200);
        } catch (Exception $e) {
            Log::error('Error al eliminar etiqueta: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al eliminar la etiqueta.'
            ], 500);
        }
    }
}
