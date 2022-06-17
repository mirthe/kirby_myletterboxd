<?php include('getmovies.php'); ?>

<div class="masonry">
<?php foreach($rss->channel->item as $item){ ?>

    <?php if ($item->letterboxd_filmTitle) { ?>
        <div class="block block--film">

        <?php $doc = new DOMDocument();
        $doc->loadHTML($item->description);
        $imageTags = $doc->getElementsByTagName('img');

        foreach($imageTags as $tag) {
            $img = $tag->getAttribute('src');
        } 
        
        $mijnreview = strip_tags(html_entity_decode($item->description)); ?>
    
        <a href="<?= $item->link ?>"><img class="block--img" width="500" height="750" src="<?= $img ?>"  alt="Cover <?= $item->letterboxd_filmTitle ?>"></a>
    
        <div class="block--body">
            <p><a href="<?= $item->link ?>"><?= $item->letterboxd_filmTitle ?></a> <?= $item->letterboxd_filmYear ?><br>
            <span style="color: silver"><?= strftime("%e %b %Y", strtotime($item->letterboxd_watchedDate)) ?><?php if ($item->letterboxd_rewatch == 'Yes'): ?> &bull; Rewatch<?php endif ?></span>

            <span class="nowrap" style="float: right;">
                <?php 
                for ($i = 1; $i <= floor($item->letterboxd_memberRating); $i++) {
                    echo '<i class="fa fa-star fa-active"></i>';
                }

                if (floor($item->letterboxd_memberRating) !== round($item->letterboxd_memberRating)){
                    echo '<i class="fa fa-star-half fa-active"></i>';
                    echo '<i class="fa fa-star-half fa-flip-horizontal fa-inactive"></i>';
                    $aanvullen = floor($item->letterboxd_memberRating) + 1;
                }
                else {
                    $aanvullen = floor($item->letterboxd_memberRating);
                }

                for ($i = $aanvullen; $i < 5; $i++) {
                    echo '<i class="fa fa-star fa-inactive"></i>';
                }
                ?>
            </span></p>

            <?php if(substr(trim($mijnreview),0,10) !== 'Watched on'): ?>
                <?= $mijnreview ?>
            <?php endif ?>
        </div>
        
    </div>
    <?php } ?>

<?php } ?>
</div>