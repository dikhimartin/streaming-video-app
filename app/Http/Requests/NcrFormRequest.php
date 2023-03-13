<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NcrFormRequest extends FormRequest
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
        return
            [
                'kategori_temuan'     => 'required',
                'jenis_temuan'     => 'required',
                'pic'     => 'required',
                'auditor'     => 'required',
                'tanggal_temuan'     => 'required',
                'ketidaksesuaian'     => 'required',
            ];
    }
}
