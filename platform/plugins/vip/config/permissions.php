<?php

return [
    [
        'name' => 'Vips',
        'flag' => 'vip.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'vip.create',
        'parent_flag' => 'vip.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'vip.edit',
        'parent_flag' => 'vip.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'vip.destroy',
        'parent_flag' => 'vip.index',
    ],
];
