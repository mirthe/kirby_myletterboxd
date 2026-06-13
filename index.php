<?php

Kirby::plugin('mirthe/myletterboxd', [
    'options' => [
        'username' => null,
        'cache' => true
    ],
    'snippets' => [
        'letterboxd-movies-watched' => __DIR__ . '/snippets/movies.php',
        'letterboxd-movies-watched-compact' => __DIR__ . '/snippets/compact.php'
    ],
    'translations' => [
        'nl' => [
            'mirthe.myletterboxd.rewatch' => 'Nogmaals'
        ],
        'en' => [
            'mirthe.myletterboxd.rewatch' => 'Rewatch'
        ]
    ],
]);