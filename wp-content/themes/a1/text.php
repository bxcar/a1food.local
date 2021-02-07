<?php
/* Template Name: text-mobile */
require_once 'header_mobile.php';
?>
<script>
    if(!window.mobileAndTabletCheck()) {
        window.location.href = '/offer';
    }
</script>

<div class="textpage animated-background">

<?php
$my_postid = 293;//This is page id or post id
$content_post = get_post($my_postid);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
echo $content;
?>

</div>

</div>

<?php require_once 'footer_mobile.php'; ?>
