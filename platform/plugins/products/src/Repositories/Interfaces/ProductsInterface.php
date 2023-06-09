<?php

namespace Botble\Products\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface ProductsInterface extends RepositoryInterface
{
    public function getProducts();
    public function getRandomProducts($level_id, $money);
}
