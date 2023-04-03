<?php

namespace Botble\Member\Http\Requests;

use Botble\Support\Http\Requests\Request;

class FundPasswordRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password'   => 'required|min:6',
            'new_password'   => 'required|min:6',
            'confirm_new_password'   => 'required|min:6|same:new_password',
        ];
    }
}
