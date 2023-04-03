<?php

namespace Botble\Money\Models;

use Botble\Base\Models\BaseModel;

class MoneyTranslation extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'money_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'lang_code',
        'money_id',
        'name',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
