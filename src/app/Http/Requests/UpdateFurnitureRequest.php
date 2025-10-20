<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFurnitureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'categories' => 'sometimes|array',
            'categories.*' => 'integer|exists:categories,id',
            'tags' => 'sometimes|array',
            'tags.*' => 'integer|exists:tags,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'El nombre del mueble debe ser un texto válido.',
            'name.max' => 'El nombre del mueble no puede tener más de 255 caracteres.',

            'price.numeric' => 'El precio debe ser un número válido.',
            'price.min' => 'El precio no puede ser negativo.',

            'categories.array' => 'Las categorías deben enviarse en formato de lista.',
            'categories.*.integer' => 'Cada categoría debe ser un número entero.',
            'categories.*.exists' => 'Una o más categorías no existen.',

            'tags.array' => 'Las etiquetas deben enviarse en formato de lista.',
            'tags.*.integer' => 'Cada etiqueta debe ser un número entero.',
            'tags.*.exists' => 'Una o más etiquetas no existen.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->name) {
            $this->merge([
                'name' => trim($this->name),
            ]);
        }
    }
}
