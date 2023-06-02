<?php

namespace Afaqy\Integration\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ZkCarInfoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'car_number'    => [
                Rule::requiredIf(function () {
                    return request()->card_number == null && request()->qr_number == null;
                }),
                'nullable',
                'string',
                'min:4',
            ],
            'card_number'   => [
                Rule::requiredIf(function () {
                    return request()->car_number == null && request()->qr_number == null;
                }),
                'nullable',
                'integer',
            ],
            'qr_number'     => [
                Rule::requiredIf(function () {
                    return request()->car_number == null && request()->card_number == null;
                }),
                'nullable',
                'integer',
            ],
            'create_date'   => ['required', 'date_format:"Y-m-d\TH:i:sP"'],
            'photo_path'    => ['sometimes', 'nullable', 'string'],
            'channel_id'    => ['sometimes', 'nullable', 'integer'],
            'channel_name'  => ['sometimes', 'nullable', 'string'],
            'device_type'   => ['required', 'in:LPR,RFID,QR Code'],
            'device_ip'     => ['required', 'ip'],
            'is_authorized' => ['sometimes', 'nullable', 'boolean'],
            'direction'     => ['sometimes', 'nullable', 'in:IN,OUT'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'car_number.required'     => 'You must enter at least one of car_number, card_number or qr_number.',
            'card_number.required'    => 'You must enter at least one of car_number, card_number or qr_number.',
            'qr_number.required'      => 'You must enter at least one of car_number, card_number or qr_number.',
            'create_date.date_format' => 'The create date does not match ISO 8601 format, example: 2019-02-01T03:45:27+00:00.',
            'device_type.in'          => 'The selected device type is invalid, Choose between LRP, RFID or QR Code.',
            'direction.in'            => 'The selected direction is invalid, Choose between IN or OUT.',
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
