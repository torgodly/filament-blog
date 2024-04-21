<?php


return [
    'navigation.group' => 'Blog',
    'navigation.label' => 'Post',
    'navigation.plural-label' => 'Posts',
    'navigation.model-label' => 'Post',

    'form' => [
        'sections' => [
            'blog-details' => [
                'label' => 'Blog Details',
                'field-sets' => [
                    'titles' => [
                        'label' => 'Titles',
                        'fields' => [
                            'categories' => 'Categories',
                            'title' => 'Title',
                            'slug' => 'Slug',
                            'sub-title' => 'Sub Title',
                            'tags' => 'Tags'
                        ]
                    ],
                    'feature-image' => [
                        'label' => 'Feature Image',
                        'fields' => [
                            'cover-photo' => [
                                'label' => 'Cover Photo',
                                'hint' => 'This cover image is used in your blog post as a feature image. Recommended image size 1200 X 628'
                            ],
                            'photo-alt-text' => 'Photo alt text'
                        ]
                    ],
                    'status' => [
                        'label' => 'Status',
                        'fields' => [
                            'status' => 'Status',
                            'scheduled-for' => 'Scheduled for'
                        ]
                    ]
                ]
            ],

        ],
        'fields' => [
            'body' => 'Body',
            'user' => 'User'
        ]
    ],
    'table' => [
        'title' => 'Title',
        'status' => 'Status',
        'cover-photo' => 'Cover Photo',
        'author' => 'Author',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
    ],

    'filter' => [
        'author' => 'Author',
    ],

    'infolist' => [
        'sections' => [
            'post' => [
                'label' => 'Post',
                'field-sets' => [
                    'general' => [
                        'label' => 'General',
                        'fields' => [
                            'title' => 'Title',
                            'slug' => 'Slug',
                            'sub-title' => 'Sub Title',
                        ]
                    ],
                    'publish-information' => [
                        'label' => 'Publish Information',
                        'fields' => [
                            'status' => 'Status',
                            'published-at' => 'Published At',
                            'scheduled-for' => 'Scheduled For'
                        ]
                    ],
                    'description' => [
                        'label' => 'Description',
                        'fields' => [
                            'body' => 'Body'
                        ]
                    ]
                ]

            ]
        ]
    ],

    'widgets' => [
        'published-post' => 'Published Post',
        'scheduled-post' => 'Scheduled Post',
        'pending-post' => 'Pending Post',
    ],

    'taps' => [
        'all' => 'All',
        'published' => 'Published',
        'pending' => 'Pending',
        'scheduled' => 'Scheduled'
    ],


    'sub-navigation' => [
        'view-post' => [
            'label' => 'View Post',
            'header-actions' => [
                'send-notification' => 'Send Notification',
                'preview' => 'Preview'
            ],

        ],
        'seo-detail' => [
            'label' => 'Manage Seo Detail',
            'form' => [
                'title' => 'Title',
                'keywords' => 'KeyWords',
                'description' => 'Description'
            ],
            'table' => [
                'model-label' => 'Seo Detail',
                'plural-model-label' => 'Seo Details',
                'title' => 'Title',
                'description' => 'Description',
                'keywords' => 'keyWords',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ]
        ],
        'post-comments' => [
            'label' => 'Manage Comments',
            'bread-crumb' => 'Comments',
            'form' => [
                'user' => 'User',
                'comment' => 'Comment',
                'approved' => 'Approved'
            ],
            'table' => [
                'model-label' => 'Comment',
                'plural-model-label' => 'Comments',
                'comment' => 'Comment',
                'commented-by' => 'Commented By',
                'approved' => 'Approved',
                'approved-at' => 'Approved At',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ],
            'filters' => [
                'user' => 'User'
            ],

            'infolist' => [
                'sections' => [
                    'comment' => [
                        'label' => 'Comment',
                        'fields' => [
                            'commented-by' => 'Commented By',
                            'comment' => 'Comment',
                            'approved-at' => 'Approved At',
                            'not-approved' => 'Not Approved',
                            'created_at' => 'Created At',
                        ]
                    ]
                ]
            ]
        ],
        'edit-post' => [
            'label' => 'Edit Post',
        ],

    ]


];
