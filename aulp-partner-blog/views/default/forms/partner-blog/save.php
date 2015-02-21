<?php
$blog_post = $vars['blog_post'];
?>

<div>
    <label><?php echo elgg_echo("title"); ?></label><br />
    <?php echo elgg_view('input/text', array('name' => 'title', 'value' => $blog_post->title)); ?>
</div>

<div>
    <label><?php echo elgg_echo("subtitle"); ?></label><br />
    <?php echo elgg_view('input/text', array('name' => 'subtitle', 'value' => $blog_post->sub_title)); ?>
</div>

<div>
    <label><?php echo elgg_echo("body"); ?></label><br />
    <?php echo elgg_view('input/longtext', array('name' => 'body', 'value' => $blog_post->body)); ?>
</div>


<div>
    <label><?php echo elgg_echo("tags"); ?></label><br />
    <?php echo elgg_view('input/tags', array('name' => 'tags', 'value' => $blog_post->tags)); ?>
</div>

<div>
    <?php echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $blog_post->getGUID())); ?>
</div>

<div>
    <?php echo elgg_view('input/submit', array('value' => elgg_echo('save'))); ?>
</div>