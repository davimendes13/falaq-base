<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePerguntaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'evento_id' => $this->route('id'),
        ]);
    }

    public function rules(): array
    {
        return [
            'texto' => ['required', 'string', 'min:10', 'max:255'],
            'evento_id' => ['required', 'exists:eventos,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'texto.required' => 'O campo de pergunta é obrigatório.',
            'texto.min' => 'Sua pergunta precisa ter pelo menos :min caracteres.',
            'texto.max' => 'Sua pergunta não pode ultrapassar :max caracteres.',
            'evento_id.required' => 'O evento é obrigatório.',
            'evento_id.exists' => 'O evento informado não existe.',
        ];
    }
}