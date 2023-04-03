<?php

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Base\Supports\SortItemsWithChildrenHelper;
use Botble\Vip\Repositories\Interfaces\VipInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

if (!function_exists('get_vips')) {
    function get_vips()
    {
        return app(VipInterface::class)->getVips();
    }
}
