<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'sexo' => 'nullable|string|max:255',
            'privado' => 'nullable|boolean',
            'biografia' => 'nullable|string',
            'avatar' => 'nullable|image|max:2048',
            'portada' => 'nullable|image|max:2048',
            'ID_carrera' => 'nullable|exists:carreras,ID_carrera',
            'username' => 'required|string|max:255'
        ];
    }
}
