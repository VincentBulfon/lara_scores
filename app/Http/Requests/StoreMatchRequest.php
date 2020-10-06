<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'played-at' => 'date',
            'home-team' => 'string|different:away-team',
            'home-team-goals' => 'bail|required|numeric|max:20',
            'away-team' => 'string',
            'away-team-goals' => 'numeric|max:20'
        ];
    }
}
