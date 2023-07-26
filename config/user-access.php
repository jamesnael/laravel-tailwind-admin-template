<?php

return [
  'access' => [
    [
      'module' => 'Master Data',
      'sub_module' => [
        [
          'module' => 'Banner',
          'activities' => [
            [
              'label' => 'Menu Banner',
              'value' => 'module.data-master.banner.index',
            ],
            [
              'label' => 'Edit Banner',
              'value' => 'module.data-master.banner.edit',
            ],
            [
              'label' => 'Delete Banner',
              'value' => 'module.data-master.banner.delete',
            ]
          ]
        ],
        [
          'module' => 'Group User',
          'activities' => [
            [
              'label' => 'Menu Group User',
              'value' => 'module.data-master.jabatan.index',
            ],
            [
              'label' => 'Create Group User',
              'value' => 'module.data-master.jabatan.create',
            ],
            [
              'label' => 'Edit Group User',
              'value' => 'module.data-master.jabatan.edit',
            ],
            [
              'label' => 'Delete Group User',
              'value' => 'module.data-master.jabatan.delete',
            ]
          ]
        ],
        [
          'module' => 'User',
          'activities' => [
            [
              'label' => 'Menu User',
              'value' => 'module.data-master.karyawan.index',
            ],
            [
              'label' => 'Create User',
              'value' => 'module.data-master.karyawan.create',
            ],
            [
              'label' => 'Edit User',
              'value' => 'module.data-master.karyawan.edit',
            ],
            [
              'label' => 'Delete User',
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
          'module' => 'Log Activity',
          'activities' => [
            [
              'label' => 'Menu Log Activity',
              'value' => 'module.log-activity.index',
            ],
            [
              'label' => 'Detail Log Activity',
              'value' => 'module.log-activity.detail',
            ]
          ]
        ]
      ]
    ]
  ]
];