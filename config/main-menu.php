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
      'uniqid' => 'menuDataMaster',
      'type' => 'menu',
      'text' => 'Data Master',
      'route' => '#',
      'access' => [
        'module.data-master.jabatan.index',
        'module.data-master.karyawan.index',
      ],
      'active' => false,
      'open' => false,
      'children' => [
        [
          'uniqid' => 'masterJabatan',
          'type' => 'menu',
          'text' => 'Jabatan',
          'route' => 'admin.data-master.jabatan.index',
          'access' => 'module.data-master.jabatan.index',
          'active' => false,
          'open' => false,
          'children' => null
        ],
        [
          'uniqid' => 'masterKaryawan',
          'type' => 'menu',
          'text' => 'Karyawan',
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
      'uniqid' => 'menuLogAktivitas',
      'type' => 'menu',
      'text' => 'Log Aktivitas',
      // 'route' => 'admin.log-aktivitas.index',
      'route' => '#',
      'active' => false,
      'open' => false,
      'children' => null
    ]
  ]
];