<?php

namespace App\Http\Requests;


class StoreImage extends Request
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
            'image_url' => 'required|url|urlToImage',
            'album_id' => 'required',
        ];
    }
}
