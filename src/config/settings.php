<?php

return [
    /*
     * Default database connection name.
     *
     * By default, "mysql".
     */

    'connection' => env('DB_CONNECTION', 'mysql'),

    /*
     * Table names for models.
     * You can use the default settings or set your own.
     */

    'tables' => [
        'users' => 'users',

        'roles'       => 'roles',
        'permissions' => 'permissions',

        'user_roles'       => 'user_roles',
        'role_permissions' => 'role_permissions',
    ],

    /*
     * If `true`, then the blade directives `role()` and `permission()` will be specified during initialization.
     */

    'use_blade' => false,
];