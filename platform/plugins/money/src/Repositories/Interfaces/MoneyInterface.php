<?php

namespace Botble\Money\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface MoneyInterface extends RepositoryInterface
{
    public function getWithdraw();
    public function getTopUp();
}
