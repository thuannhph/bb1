<?php

namespace Botble\Vip\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface VipInterface extends RepositoryInterface
{
    public function getVips();
}
