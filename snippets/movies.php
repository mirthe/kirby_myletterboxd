<?php include_once ('getmovies.php'); ?>

<div class="masonry">
<?php foreach ($rss->channel->item as $item): ?>

    <?php if ($item->letterboxd_filmTitle): ?>
    <div class="block block--film">

        <?php $img = "";
        $doc = new DOMDocument();
        $doc->loadHTML($item->description);
        $imageTags = $doc->getElementsByTagName('img');

        foreach ($imageTags as $tag) {
            $img = $tag->getAttribute('src');
        }
        
        $mijnreview = strip_tags(html_entity_decode($item->description)); ?>

        <?php if ($img !== ''): ?>
            <a href="<?= $item->link ?>">
                <img class="block--img" width="500" height="750"
                    src="<?= $img ?>"
                    alt="Cover <?= $item->letterboxd_filmTitle ?>">
            </a>
        <?php else: ?>
            <a href="<?= $item->link ?>" class='block--fallback'></a>
        <?php endif ?>

        <div class="block--body">
            <p><a href="<?= $item->link ?>"><?= $item->letterboxd_filmTitle ?></a>
                <?= $item->letterboxd_filmYear ?><br>
                <span style="color: silver">
                    <?= strftime("%e %b %Y", strtotime($item->letterboxd_watchedDate)) ?>
                    <?php if ($item->letterboxd_rewatch == 'Yes'): ?>
                    &bull; Rewatch<?php endif ?>
                </span>

                <span class="nowrap" style="float: right;">
                <?php for ($i = 1; $i <= $item->letterboxd_memberRating; $i++) {
                    echo '<i class="fa-solid fa-star"></i>';
                }

                if ( (float)$item->letterboxd_memberRating !== round((int)$item->letterboxd_memberRating)) {
                    echo '<i class="fa-solid fa-star-half-stroke"></i>';
                    // echo '<span class="fa-stack"
                    // <i class="fa-solid  fa-stack-1x fa-star-half"></i> 
                    // <i class="fa-solid  fa-stack-1x fa-star-half fa-flip-horizontal fa-inactive"></i>
                    // </span>';
                    $aanvullen = round((int)$item->letterboxd_memberRating) + 1;
                } else {
                    $aanvullen = round((int)$item->letterboxd_memberRating);
                }

                for ($i = $aanvullen; $i < 5; $i++) {
                    echo '<i class="fa-solid fa-star fa-inactive"></i>';
                }
                
                // TODO aria toevoegen
                // https://www.google.com/search?&q=star%20rating%20aria ?>
                </span>
            </p>

            <?php if(substr(trim($mijnreview), 0, 10) !== 'Watched on'): ?>
                <?= $mijnreview ?>
            <?php endif ?>
        </div>

    </div>
    <?php endif ?>

<?php endforeach ?>
</div>
