<?php

namespace Botble\Products\Models;

use Botble\Base\Models\BaseModel;

class ProductsTranslation extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'lang_code',
        'products_id',
        'name',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
