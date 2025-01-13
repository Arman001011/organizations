<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'filter' => ['sometimes', 'nullable', 'array'],
            'filter.building_id' => ['sometimes', 'nullable', 'exists:buildings,id'],
            'filter.activity_id' => ['sometimes', 'nullable', 'exists:activities,id'],
            'filter.name' => ['sometimes', 'nullable', 'string', 'min:2', 'max:15'],
            'filter.activity_name' => ['sometimes', 'nullable', 'string', 'min:2', 'max:15'],
            'filter.circle' => ['sometimes', 'nullable', 'array', 'min:3', 'max:3'],
            'filter.circle.latitude' => ['required_with:filter.circle', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'filter.circle.longitude' => ['required_with:filter.circle', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'filter.circle.radius' => ['required_with:filter.circle', 'numeric', 'min:0.1', 'max:250'],
            'filter.square' => ['sometimes', 'nullable', 'array', 'min:4', 'max:4'],
            'filter.square.latitude' => ['required_with:filter.square', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'filter.square.longitude' => ['required_with:filter.square', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'filter.square.width' => ['required_with:filter.square', 'numeric', 'min:0.1', 'max:250'],
            'filter.square.height' => ['required_with:filter.square', 'numeric', 'min:0.1', 'max:250'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
