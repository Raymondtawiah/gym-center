<?php

return [

    'paths' => [
        base_path('resources/views'),
        base_path('resources/views/pages'),
    ],

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),

    'namespaces' => [
        'pages' => base_path('resources/views/pages'),
    ],

];