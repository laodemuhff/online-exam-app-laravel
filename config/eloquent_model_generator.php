<?php

return [
    'model_defaults' => [
        'namespace'       => 'App\\Http\\Models',
        'base_class_name' => \Illuminate\Database\Eloquent\Model::class,
        'output_path'     => 'Http/Models',
        'no_timestamps'   => null,
        'date_format'     => null,
        'connection'      => null,
        'backup'          => null,
    ],

    'db_types' => [
        'enum' => 'string',
    ]
];
