<?php

namespace Botble\Vip\Models;

use Botble\Base\Models\BaseModel;

class VipTranslation extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vips_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'lang_code',
        'vips_id',
        'name',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
