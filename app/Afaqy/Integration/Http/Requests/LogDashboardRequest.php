<?php

namespace Afaqy\Integration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogDashboardRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status'      => ['sometimes', 'nullable', 'string'],
            'plateNumber' => ['sometimes', 'nullable', 'string'],
            'date'        => ['sometimes', 'nullable', 'date_format:Y-m-d'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
