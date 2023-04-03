<?php

namespace Botble\Products\Repositories\Eloquent;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Products\Repositories\Interfaces\ProductsInterface;

class ProductsRepository extends RepositoriesAbstract implements ProductsInterface
{
    public function getProducts()
    {
        $data = $this->model
            ->where([
                'status'      => BaseStatusEnum::PUBLISHED,
            ])
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }
}
