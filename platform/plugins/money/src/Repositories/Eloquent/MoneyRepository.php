<?php

namespace Botble\Money\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Money\Repositories\Interfaces\MoneyInterface;

class MoneyRepository extends RepositoriesAbstract implements MoneyInterface
{
    public function getWithdraw()
    {
        $data = $this->model
            ->where([
                'type'  => 1,
            ])
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }
    public function getTopUp()
    {
        $data = $this->model
            ->where([
                'type'  => 2,
            ])
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }
}
