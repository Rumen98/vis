<?php

return [
    'paths' => [
        [
            'directory' => public_path('images/brands'),
            'asset_base' => 'images/brands',
        ],
        [
            'directory' => public_path('brands'),
            'asset_base' => 'brands',
        ],
    ],
    'trailing_image_overrides' => [
        'tp-link' => [
            'tplinksolutions.png',
        ],
        'hikvision' => [
            'hikvisionproducts.png',
        ],
        'dahua' => [
            'dahuacameras.png',
        ],
    ],
];
