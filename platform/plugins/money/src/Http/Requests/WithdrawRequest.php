<?php

namespace Botble\Money\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class WithdrawRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'money'   => 'required|numeric|lte:money_me',
            'fund_password'   => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!password_verify($value, auth('member')->user()->fund_password)) {
                        $fail('Mật khẩu hiện tại không đúng');
                    }
                },
            ]
        ];
    }
}
