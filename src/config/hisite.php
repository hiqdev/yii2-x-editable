<?php

return [
    'components' => [
        'i18n' => [
            'translations' => [
                'xeditable' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => '@hiqdev/xeditable/messages',
                    'fileMap' => [
                        'xeditable' => 'xeditable.php',
                    ],
                ],
            ],
        ],
    ],
];
