<?php

namespace Botble\Vip\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Vip\Repositories\Interfaces\VipInterface;

class VipCacheDecorator extends CacheAbstractDecorator implements VipInterface
{
/**
     * {@inheritDoc}
     */
    public function getVips()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
