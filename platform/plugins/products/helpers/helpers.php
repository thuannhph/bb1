<?php

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Base\Supports\SortItemsWithChildrenHelper;
use Botble\Products\Repositories\Interfaces\ProductsInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

if (!function_exists('get_products')) {
    /**
     * @param int $limit
     * @param array $with
     * @return Collection
     */
    function get_products()
    {
        return app(ProductsInterface::class)->getProducts();
    }
}

