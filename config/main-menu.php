<?php

return [
  'menu' => [
    [
      'uniqid' => 'menuDashboard', // unique identifier, use route name without function name like index, create, etc
      'type' => 'menu', // menu type "menu" or "divider"
      'text' => 'Dashboard', // menu label
      'route' => 'admin.dashboard.index', // menu url use route() helper
      'access' => true, // user access name, bypass it with true
      'active' => false, // required for helper change if menu active or not
      'open' => false, // required for helper change if submenu must be shown or not
      'children' => null // all sub menu, accept array of object like menu
    ],
    [
      'type' => 'divider',
    ],
    [
      'uniqid' => 'menuMasterData',
      'type' => 'menu',
      'text' => 'Master Data',
      'route' => '#',
      'access' => [
        'module.data-master.jabatan.index',
        'module.data-master.karyawan.index',
        'module.data-master.banner.index',
      ],
      'active' => false,
      'open' => false,
      'children' => [
        [
          'uniqid' => 'masterBanner',
          'type' => 'menu',
          'text' => 'Banner',
          'route' => 'admin.data-master.banner.index',
          'access' => 'module.data-master.banner.index',
          'active' => false,
          'open' => false,
          'children' => null
        ],
        [
          'uniqid' => 'masterGroupUser',
          'type' => 'menu',
          'text' => 'Group User',
          'route' => 'admin.data-master.jabatan.index',
          'access' => 'module.data-master.jabatan.index',
          'active' => false,
          'open' => false,
          'children' => null
        ],
        [
          'uniqid' => 'masterUser',
          'type' => 'menu',
          'text' => 'User',
          'route' => 'admin.data-master.karyawan.index',
          'access' => 'module.data-master.karyawan.index',
          'active' => false,
          'open' => false,
          'children' => null
        ]
      ]
    ],
    [
      'type' => 'divider',
    ],
    [
      'uniqid' => 'menuLaporan',
      'type' => 'menu',
      'text' => 'Laporan',
      'route' => '#',
      'active' => false,
      'open' => false,
      'children' => [
      ]
    ],
    [
      'uniqid' => 'menuLogActivity',
      'type' => 'menu',
      'text' => 'Log Activity',
      'route' => 'admin.log-activity.index',
      'access' => 'module.log-activity.index',
      'active' => false,
      'open' => false,
      'children' => null
    ]
  ]
];