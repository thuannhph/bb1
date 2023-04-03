<?php

return [
    [
        'name' => 'Money',
        'flag' => 'money.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'money.create',
        'parent_flag' => 'money.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'money.edit',
        'parent_flag' => 'money.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'money.destroy',
        'parent_flag' => 'money.index',
    ],
];
