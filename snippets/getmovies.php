<?php
$feedurl = "https://letterboxd.com/" . option('letterboxd.username') . "/rss/";
$cache = kirby()->cache('mirthe.myletterboxd');
$cacheKey = 'letterboxd-rss-' . strtolower(option('letterboxd.username'));
$feeds = $cache->get($cacheKey);
$force = isset($_GET['forcecache']);

if ($feeds === null || $force) {
    $ch = curl_init($feedurl);
    curl_setopt($ch, CURLOPT_URL, $feedurl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, kirby()->site()->title());

    // letterboxd certificate expired.. :-(
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $feeds = curl_exec($ch);
    $error = curl_errno($ch);
    curl_close($ch);

    if ($feeds !== false && $error === 0) {
        $cache->set($cacheKey, $feeds, 3600);
    } elseif ($feeds === false) {
        $feeds = $cache->get($cacheKey);
    }
}

// Will replace : in tags and attributes names with _ allowing easy access
$feeds = preg_replace('~(</?|\s)([a-z0-9_]+):~is', '$1$2_', trim($feeds));
// print_r($feeds); exit();
$rss = simplexml_load_string($feeds);

