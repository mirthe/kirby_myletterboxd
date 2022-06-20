<?php $localfile =  __DIR__ . "/letterboxd.rss";
   $feedurl = "https://letterboxd.com/" . option('letterboxd.username') . "/rss/";

    if (!file_exists($localfile) OR time()-filemtime($localfile) > 2 * 3600 OR isset($_GET['forcecache'])) {
        
        $ch = curl_init($feedurl);
        curl_setopt($ch, CURLOPT_URL, $feedurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // letterboxd certificate expired.. :-(
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $feeds = curl_exec($ch);
        curl_close($ch);
        
        $fp = fopen($localfile, 'w');
        fwrite($fp, $feeds);
        fclose($fp);

    } else {
        $feeds = file_get_contents($localfile); 
    }

    // Will replace : in tags and attributes names with _ allowing easy access
    $feeds = preg_replace('~(</?|\s)([a-z0-9_]+):~is', '$1$2_', $feeds);
    $rss = simplexml_load_string($feeds);
?>