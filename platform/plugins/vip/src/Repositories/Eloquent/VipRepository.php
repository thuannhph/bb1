<?php

namespace Botble\Vip\Repositories\Eloquent;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Vip\Repositories\Interfaces\VipInterface;

class VipRepository extends RepositoriesAbstract implements VipInterface
{
    /**
     * {@inheritDoc}
     */
    public function getVips()
    {
        $data = $this->model
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }
}
