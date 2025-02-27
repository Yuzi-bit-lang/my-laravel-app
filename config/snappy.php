<?php

return [
    'pdf' => [
        'enabled' => true,
        'binary'  => '"C:\\Program Files (x86)\\wkhtmltopdf\\bin\\wkhtmltopdf.exe"',
        'timeout' => false,
        'options' => [
            'javascript-delay' => 1000,
            'enable-local-file-access' => true,  // Important pour les fichiers locaux
            'no-stop-slow-scripts' => true,
            'disable-smart-shrinking' => true,
            'viewport-size' => '1280x1024',
            'dpi' => 300,
        ],
        'env' => [],
    ],
];
