<?php

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Base\Supports\SortItemsWithChildrenHelper;
use Botble\Money\Repositories\Interfaces\MoneyInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

if (!function_exists('get_withdraw')) {
    /**
     * @param int $limit
     * @param array $with
     * @return Collection
     */
    function get_withdraw()
    {
        return app(MoneyInterface::class)->getWithdraw();
    }
}

if (!function_exists('get_top_up')) {
    /**
     * @param int $limit
     * @param array $with
     * @return Collection
     */
    function get_top_up()
    {
        return app(MoneyInterface::class)->getTopUp();
    }
}

