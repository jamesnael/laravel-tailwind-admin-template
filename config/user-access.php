<?php

return [
  'access' => [
    [
      'module' => 'Data Master',
      'sub_module' => [
        [
          'module' => 'Jabatan',
          'activities' => [
            [
              'label' => 'Menu Jabatan',
              'value' => 'module.data-master.jabatan.index',
            ],
            [
              'label' => 'Tambah Jabatan',
              'value' => 'module.data-master.jabatan.create',
            ],
            [
              'label' => 'Ubah Jabatan',
              'value' => 'module.data-master.jabatan.edit',
            ],
            [
              'label' => 'Hapus Jabatan',
              'value' => 'module.data-master.jabatan.delete',
            ]
          ]
        ],
        [
          'module' => 'Karyawan',
          'activities' => [
            [
              'label' => 'Menu Karyawan',
              'value' => 'module.data-master.karyawan.index',
            ],
            [
              'label' => 'Tambah Karyawan',
              'value' => 'module.data-master.karyawan.create',
            ],
            [
              'label' => 'Ubah Karyawan',
              'value' => 'module.data-master.karyawan.edit',
            ],
            [
              'label' => 'Hapus Karyawan',
              'value' => 'module.data-master.karyawan.delete',
            ]
          ]
        ],
      ]
    ],
    [
      'module' => 'Log',
      'sub_module' => [
        [
          'module' => 'Log Aktivitas',
          'activities' => [
            [
              'label' => 'Menu Log Aktivitas',
              'value' => 'Menu Log Aktivitas',
            ]
          ]
        ]
      ]
    ]
  ]
];