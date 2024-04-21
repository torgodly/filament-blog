<?php
return [
    'navigation.group' => 'مدونة',
    'navigation.label' => 'مقال',
    'navigation.plural-label' => 'مقلات',
    'navigation.model-label' => 'مقال',


    'form' => [
        'sections' => [
            'blog-details' => [
                'label' => 'تفاصيل المدونة',
                'field-sets' => [
                    'titles' => [
                        'label' => 'العناوين',
                        'fields' => [
                            'categories' => 'الفئات',
                            'title' => 'العنوان',
                            'slug' => 'الرابط المختصر',
                            'sub-title' => 'العنوان الفرعي',
                            'tags' => 'الوسوم'
                        ]
                    ],
                    'feature-image' => [
                        'label' => 'صورة مميزة',
                        'fields' => [
                            'cover-photo' => [
                                'label' => 'صورة الغلاف',
                                'hint' => 'هذه الصورة الغلاف مستخدمة في مقالتك في المدونة كصورة مميزة. الحجم الموصى به للصورة هو 1200 × 628'
                            ],
                            'photo-alt-text' => 'نص بديل للصورة'
                        ]
                    ],
                    'status' => [
                        'label' => 'الحالة',
                        'fields' => [
                            'status' => 'الحالة',
                            'scheduled-for' => 'مجدولة لـ'
                        ]
                    ]
                ]
            ]
        ],
        'fields' => [
            'body' => 'المحتوى',
            'user' => 'المستخدم'
        ]
    ],

    'table' => [
        'title' => 'العنوان',
        'status' => 'الحالة',
        'cover-photo' => 'صورة الغلاف',
        'author' => 'المؤلف',
        'created_at' => 'تاريخ الإنشاء',
        'updated_at' => 'تاريخ التحديث',
    ],

    'filter' => [
        'author' => 'المؤلف',
    ],
    'infolist' => [
        'sections' => [
            'post' => [
                'label' => 'المقالة',
                'field-sets' => [
                    'general' => [
                        'label' => 'العام',
                        'fields' => [
                            'title' => 'العنوان',
                            'slug' => 'الرابط المختصر',
                            'sub-title' => 'العنوان الفرعي',
                        ]
                    ],
                    'publish-information' => [
                        'label' => 'معلومات النشر',
                        'fields' => [
                            'status' => 'الحالة',
                            'published-at' => 'تم النشر في',
                            'scheduled-for' => 'مجدولة لـ'
                        ]
                    ],
                    'description' => [
                        'label' => 'الوصف',
                        'fields' => [
                            'body' => 'المحتوى'
                        ]
                    ]
                ]

            ]
        ]
    ],

    'widgets' => [
        'published-post' => 'المقالات المنشورة',
        'scheduled-post' => 'المقالات المجدولة',
        'pending-post' => 'المقالات المعلقة',
    ],

    'taps' => [
        'all' => 'الكل',
        'published' => 'تم النشر',
        'pending' => 'معلق',
        'scheduled' => 'مجدول'
    ],

    'sub-navigation' => [
        'view-post' => [
            'label' => 'عرض المقالة',
            'header-actions' => [
                'send-notification' => 'إرسال إشعار',
                'preview' => 'معاينة'
            ],
        ],
        'seo-detail' => [
            'label' => 'إدارة تفاصيل SEO',
            'form' => [
                'title' => 'العنوان',
                'keywords' => 'الكلمات الرئيسية',
                'description' => 'الوصف'
            ],
            'table' => [
                'model-label' => 'تفاصيل SEO',
                'plural-model-label' => 'تفاصيل SEO',
                'title' => 'العنوان',
                'description' => 'الوصف',
                'keywords' => 'الكلمات الرئيسية',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
            ]
        ],
        'post-comments' => [
            'label' => 'إدارة التعليقات',
            'bread-crumb' => 'التعليقات',
            'form' => [
                'user' => 'المستخدم',
                'comment' => 'التعليق',
                'approved' => 'موافق'
            ],
            'table' => [
                'model-label' => 'التعليق',
                'plural-model-label' => 'التعليقات',
                'comment' => 'التعليق',
                'commented-by' => 'التعليق بواسطة',
                'approved' => 'موافق',
                'approved-at' => 'تم الموافقة في',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
            ],
            'filters' => [
                'user' => 'المستخدم'
            ],
            'infolist' => [
                'sections' => [
                    'comment' => [
                        'label' => 'التعليق',
                        'fields' => [
                            'commented-by' => 'التعليق بواسطة',
                            'comment' => 'التعليق',
                            'approved-at' => 'تم الموافقة في',
                            'not-approved' => 'غير موافق',
                            'created_at' => 'تاريخ الإنشاء',
                        ]
                    ]
                ]
            ]
        ],
        'edit-post' => [
            'label' => 'تحرير المقالة',
        ],

    ]




];
