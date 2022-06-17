<?php

Kirby::plugin('mirthe/myletterboxd', [
    'options' => [
        'username' => null
    ],
    'snippets' => [
        'letterboxd-movies-watched' => __DIR__ . '/snippets/movies.php'
    ]
]);