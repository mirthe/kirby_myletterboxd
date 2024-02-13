<?php include_once ('getmovies.php'); ?>

<div class="masonry">
<?php $counter = 0;
foreach ($rss->channel->item as $item):

    if ($counter == $limit) {break;} ?>

    <?php if ($item->letterboxd_filmTitle): ?>
    <div class="block block--film">

        <?php $img = "";
        $doc = new DOMDocument();
        $doc->loadHTML($item->description);
        $imageTags = $doc->getElementsByTagName('img');

        foreach ($imageTags as $tag) {
            $img = $tag->getAttribute('src');
        } ?>

        <?php if ($img !== ''): ?>
            <a href="<?= $item->link ?>" 
                title="<?= $item->letterboxd_filmTitle ?> (<?= $item->letterboxd_filmYear ?>)">
                <img class="block--img" alt=""
                    width="500" height="750"
                    src="<?= $img ?>">
            </a>
        <?php else: ?>
            <a href="<?= $item->link ?>" class='block--fallback'></a>
        <?php endif ?>

    </div>
    <?php $counter++;
    endif ?>

<?php endforeach ?>
</div>
