<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'posts' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'comments' => 'c,r,u,d',
            'likes' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'editor' => [
            'posts' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'comments' => 'c,r,u,d',
            'likes' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'member' => [
            'comments' => 'c,r,u,d',
            'likes' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
    ],
    'permission_structure' => [
        'cru_user' => [
            'profile' => 'c,r,u'
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
