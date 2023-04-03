<?php

namespace Botble\Money\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Money\Repositories\Interfaces\MoneyInterface;

class MoneyCacheDecorator extends CacheAbstractDecorator implements MoneyInterface
{
    public function getWithdraw()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function getTopUp()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
