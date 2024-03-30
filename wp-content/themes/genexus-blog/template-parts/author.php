<?php
    $author_data = $args[0];
    $author_gravatar_url = $author_data[0];
    $author_display_name = $author_data[1];
    $author_url = $author_data[2];
    $date = $author_data[3];
?>
<div class="blog-author">
    <span class="blog-author__image">
        <a href="<?php echo $author_url; ?>">
            <img src="<?php echo $author_gravatar_url; ?>" alt="<?php echo $author_display_name; ?>">
        </a>
    </span>
    <span class="blog-author__name">
        <a href="<?php echo $author_url; ?>">
            <?php echo $author_display_name; ?>
        </a>
    </span>
    <span class="blog-author__pipe">|</span>
    <time class="blog-author__post-date" datetime="2021-07-21">
        <?php echo $date; ?>
    </time>
</div>