<?php

namespace Botble\Member\Http\Requests;

use Botble\Support\Http\Requests\Request;

class MemberBankRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account_holder' => 'required',
            'bank_number'  => 'required',
        ];
    }
}
