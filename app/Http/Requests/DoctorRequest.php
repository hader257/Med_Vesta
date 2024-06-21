<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_ar' => 'required|min:8' ,
            'name_en' => 'required|min:8' ,
            'email' => 'required|email|unique:doctors,email',
            'bio_en' => 'required|min:5', //25
            'bio_ar' => 'required|min:5',
            'password' => 'required|min:8',
            'phone' => 'required|min:11|max:11',
            'nid' => 'required|min:14|max:14',
            'government_id' => 'required',
            'special_id' => 'required',
        ];
    }
    public function messages() :array {
        return [
            //
        ];
    }

    public function attributes() : array {
        return [
            'name_ar' => __('site.name_ar') ,
            'name_en' => __('site.name_en') ,
            'bio_ar' => __('site.bio_ar') ,
            'bio_en' => __('site.bio_en') ,
            'nid' => __('site.nid') ,
            'government_id' => __('site.government'),
            'special_id' => __('site.specialization'),
        ];
    }
}
