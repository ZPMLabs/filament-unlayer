<?php

return [
    'upload' => [
        'url' => '/filament-unlayer-upload-action',
        'url_name' => 'filament-unlayer.upload',
        'class' => \ZPMLabs\FilamentUnlayer\Services\UploadImage::class,
        'disk' => 'public',
        'path' => 'unlayer',
        'validation' => 'required|image',
        'middlewares' => [],
    ],
    'templateResolver' => \ZPMLabs\FilamentUnlayer\Services\GetTemplates::class,
];
