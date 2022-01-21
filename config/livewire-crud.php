<?php

return [
    'dataTable' => [
        'actionClasses' => 'text-right !py-1 !md:py-2 !text-xs',
    ],
    'classes' => [
        'actions' => [
            'spacerClass' => 'ml-1',
            'basicClasses' => 'h-8',
        ],
    ],
    'modal' => [
        'abort' => [
            'color' => 'dark',
            'label' => 'Abort'
        ],
        'submit' => [
            'color' => 'negative',
            'label' => 'Delete permanently'
        ],
    ],
    'actions' => [
        'show' => [
            'routeEnd' => 'show',
            'color' => 'info',
            'label' => 'Show',
            'icon' => 'eye',
            'iconOnly' => true,
        ],
        'edit' => [
            'routeEnd' => 'edit',
            'color' => 'warning',
            'label' => 'Edit',
            'icon' => 'pencil',
            'iconOnly' => true,
        ],
        'delete' => [
            'routeEnd' => 'destroy',
            'color' => 'negative',
            'label' => 'Delete',
            'icon' => 'trash',
            'iconOnly' => true,
        ],
    ],
];
