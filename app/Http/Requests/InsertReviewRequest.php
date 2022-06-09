<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertReviewRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $requiredNumeric = 'required|numeric';
        return [
            'userId'=>$requiredNumeric,
            'movieId'=>$requiredNumeric,
            'rating'=>$requiredNumeric,
            'review'=>'required|string|min:1|max:255'
        ];
    }
}
