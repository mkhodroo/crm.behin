<?php

return [
    'menu' =>[
        
        'dashboard' => [
            'fa_name' => 'داشبرد',
            'submenu' => [
                'dashboard' => [ 'fa_name' => 'داشبرد', 'route-name' => '', 'route-url' => 'admin' ],
            ]
        ],
        'cases' => [
            'fa_name' => 'کارپوشه',
            'submenu' => [
                'new-case' => [ 'fa_name' => 'فرایند جدید', 'route-name' => 'MkhodrooProcessMaker.forms.start', 'route-url' => '' ],
                'inbox' => [ 'fa_name' => 'انجام نشده', 'route-name' => 'MkhodrooProcessMaker.forms.draft', 'route-url' => '' ]
            ]
        ],
        // 'agencies' => [
        //     'fa_name' => 'مراکز',
        //     'submenu' => [
        //         'dashboard' => [ 'fa_name' => 'همه', 'route-name' => 'agency.list-form', 'route-url' => '' ],
        //     ]
        // ],
        'agencies' => [
            'fa_name' => 'اطلاعات مراکز',
            'submenu' => [
                'all' => [ 'fa_name' => 'همه', 'route-name' => 'agencyInfo.listForm', 'route-url' => '' ],
            ]
        ],
        'tickets' => [
            'fa_name' => 'تیکت پشتیبانی',
            'submenu' => [
                'create' => [ 'fa_name' => 'ایجاد', 'route-name' => 'ATRoutes.index', 'route-url' => '' ],
                'show' => [ 'fa_name' => 'مشاهده', 'route-name' => 'ATRoutes.show.listForm', 'route-url' => '' ],
            ]
        ],
        'users' => [
            'fa_name' => 'کاربران',
            'submenu' => [
                'dashboard' => [ 'fa_name' => 'همه', 'route-name' => '', 'route-url' => 'admin/user/all' ],
                'role' => [ 'fa_name' => 'نقش ها', 'route-name' => 'role.listForm', 'route-url' => '' ],
            ]
        ],
        // 'tickets' => [
        //     'fa_name' => 'تیکت پشتیبانی',
        //     'submenu' => [
        //         'create' => [ 'fa_name' => 'ایجاد', 'route-name' => 'ATRoutes.index', 'route-url' => '' ],
        //         'show' => [ 'fa_name' => 'مشاهده', 'route-name' => 'ATRoutes.show.listForm', 'route-url' => '' ],
        //     ]
        // ],

    ]
];