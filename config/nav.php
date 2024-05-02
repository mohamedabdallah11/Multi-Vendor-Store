<?php
return [
    [
        'icons' => 'far fa-circle nav-icon', 
        'route' => 'dashboard.',
        'title'=>'Dashboard',
        'active'=>'dashboard.'
    ],
    [
        'icons' => 'far fa-circle nav-icon', 
        'route' => 'dashboard.categories.index',
        'title'=>'categories',
        'active'=>'dashboard.categories.*'
    ],
    [
        'icons' => 'far fa-circle nav-icon', 
        'route' => 'dashboard.categories.index',
        'title'=>'products',
        'active'=>'dashboard.products.*'

    ],
    [
        'icons' => 'far fa-circle nav-icon', 
        'route' => 'dashboard.categories.index',
        'title'=>'orders',
        'active'=>'dashboard.orders.*'

    ]


];
