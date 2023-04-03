<?php

return [
    [
        'name' => 'Products',
        'flag' => 'products.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'products.create',
        'parent_flag' => 'products.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'products.edit',
        'parent_flag' => 'products.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'products.destroy',
        'parent_flag' => 'products.index',
    ],
];
