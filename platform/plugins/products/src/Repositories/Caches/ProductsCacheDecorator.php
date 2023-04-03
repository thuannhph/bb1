<?php

namespace Botble\Products\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Products\Repositories\Interfaces\ProductsInterface;

class ProductsCacheDecorator extends CacheAbstractDecorator implements ProductsInterface
{
    public function getProducts()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    public function getRandomProducts($level_id, $money)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
