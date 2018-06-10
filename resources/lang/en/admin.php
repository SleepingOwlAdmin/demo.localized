<?php

return [
    'button' => [
        'create' => ':text (:locale)'
    ],
    'subscriptions' => [
        'title' => [
            'menu' => 'Subscriptions',
        ],
        'table' => [
            'button' => [
                'create' => 'New subscription'
            ],
            'column' => [
                'name' => 'Name',
                'locales' => 'Langs',
            ]
        ],
        'form' => [
            'name' => 'Name (:locale)',
            'description' => 'Description (:locale)',
        ]
    ],
    'pages' => [
        'title' => [
            'menu' => 'Pages',
            'meta_data' => 'Meta data'
        ],
        'table' => [
            'button' => [
                'create' => 'New page'
            ],
            'column' => [
                'title' => 'Title',
            ]
        ],
        'form' => [
            'meta_title' => 'Meta title (:locale)',
            'meta_keywords' => 'Meta keywords (:locale)',
            'meta_description' => 'Meta description (:locale)',
            'title' => 'Title (:locale)',
            'is_private' => 'Private',
            'is_draft' => 'Draft',
            'order' => 'Order',
            'slug' => 'Slug',
            'menu' => 'Show in menu',
            'html' => 'Text (:locale)',
        ]
    ],
    'companies' => [
        'title' => [
            'menu' => 'Companies',
        ],
        'table' => [
            'button' => [
                'create' => 'New company'
            ],
            'column' => [
                'logo' => 'Logo',
                'name' => 'Name',
                'locales' => 'Langs',
                'verified' => 'Verified'
            ]
        ],
        'form' => [
            'name' => 'Name (:locale)',
            'verified' => 'Verified',
            'receive_newsletters' => 'Receive Newsletters',
            'description' => 'Description (:locale)',
            'text' => 'Text (:locale)',
            'contacts' => 'Contacts (:locale)',
            'created_at' => 'Registered At',
            'logo' => 'Logo',
            'login' => 'login',
            'email' => 'E-mail',
            'phone' => 'Phone'
        ],
        'moderation' => [
            'title' => [
                'menu' => 'Company moderation',
            ],
            'table' => [
                'column' => [
                    'logo' => 'Logo',
                    'name' => 'Name',
                ]
            ],
        ]
    ],
    'news' => [
        'title' => [
            'menu' => 'News',
            'meta_data' => 'Meta data'
        ],
        'table' => [
            'button' => [
                'create' => 'New post'
            ],
            'column' => [
                'image' => 'Image',
                'locales' => 'Langs',
                'title' => 'Title',
                'description' => 'Description',
                'is_private' => 'Private',
                'is_draft' => 'Draft',
            ]
        ],
        'form' => [
            'meta_title' => 'Meta title (:locale)',
            'meta_keywords' => 'Meta keywords (:locale)',
            'meta_description' => 'Meta description (:locale)',
            'title' => 'Title (:locale)',
            'description' => 'Description (:locale)',
            'text' => 'Text (:locale)',
            'is_private' => 'Private',
            'image' => 'Image',
            'is_draft' => 'Draft',
            'created_at' => 'Published At',
        ]
    ],
    'articles' => [
        'title' => [
            'menu' => 'Articles',
            'meta_data' => 'Meta data'
        ],
        'table' => [
            'button' => [
                'create' => 'New article'
            ],
            'column' => [
                'image' => 'Image',
                'locales' => 'Langs',
                'title' => 'Title',
                'description' => 'Description',
                'is_private' => 'Private',
                'is_draft' => 'Draft',
            ]
        ],
        'form' => [
            'meta_title' => 'Meta title (:locale)',
            'meta_keywords' => 'Meta keywords (:locale)',
            'meta_description' => 'Meta description (:locale)',
            'title' => 'Title (:locale)',
            'description' => 'Description (:locale)',
            'text' => 'Text (:locale)',
            'is_private' => 'Private',
            'image' => 'Image',
            'is_draft' => 'Draft',
            'created_at' => 'Published At',
        ]
    ],
    'events' => [
        'title' => [
            'menu' => 'Activities',
            'meta_data' => 'Meta data'
        ],
        'table' => [
            'button' => [
                'create' => 'New activity'
            ],
            'column' => [
                'image' => 'Image',
                'locales' => 'Langs',
                'title' => 'Title',
                'description' => 'Description',
                'is_private' => 'Private',
                'event_at' => 'Event date',
                'lat' => 'Latitude',
                'lon' => 'Longitude',
                'address' => 'Address',
                'is_draft' => 'Draft',
            ]
        ],
        'form' => [
            'meta_title' => 'Meta title (:locale)',
            'meta_keywords' => 'Meta keywords (:locale)',
            'meta_description' => 'Meta description (:locale)',
            'title' => 'Title (:locale)',
            'description' => 'Description (:locale)',
            'text' => 'Text (:locale)',
            'is_private' => 'Private',
            'image' => 'Image',
            'address' => 'Address (:locale)',
            'lat' => 'Latitude',
            'lon' => 'Longitude',
            'event_at' => 'Event At',
            'is_draft' => 'Draft',
            'created_at' => 'Published At',
        ]
    ],
    'banners' => [
        'title' => [
            'menu' => 'Banners',
        ],
        'table' => [
            'button' => [
                'create' => 'New banner'
            ],
            'column' => [
                'locales' => 'Langs',
                'image' => 'Banner',
                'text' => 'Text',
                'color' => 'Text Color',
                'alignment' => 'Alignment',
                'is_draft' => 'Draft',
            ]
        ],
        'form' => [
            'text' => 'Text (:locale)',
            'color' => 'Text Color',
            'alignment' => 'Alignment',
            'image' => 'Banner',
            'icon' => 'Icon',
            'link' => 'Link',
            'is_draft' => 'Draft',
        ],
        'helpers' => [
            'color_format' => 'Format [#000000]'
        ],

        'icons' => [
            'title' => [
                'menu' => 'Banner Icons',
            ],
            'column' => [
                'image' => 'Icon',
                'name' => 'Name',
                'default' => 'Default'
            ],
            'form' => [
                'name' => 'Name',
                'image' => 'Image',
                'default' => 'Default'
            ]
        ],

        'sidebar' => [
            'title' => [
                'menu' => 'Sidebar Banners',
            ],
            'table' => [
                'button' => [
                    'create' => 'New banner'
                ],
                'column' => [
                    'locales' => 'Langs',
                    'image' => 'Image',
                    'link' => 'Link',
                    'is_draft' => 'Draft',
                ],
            ],

            'form' => [
                'image' => 'Image (:locale)',
                'link' => 'Link (:locale)',
                'is_draft' => 'Draft',
            ]
        ]
    ],
];