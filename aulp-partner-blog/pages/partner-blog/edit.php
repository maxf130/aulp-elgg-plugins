<?php
$guid = $segments[1];

$blog_post = elgg_get_entities(array(
    'type' => 'object',
    'subtype' => 'partner-blog',
    'guid' => $guid,
))[0];

$title = "Edit partner blog post";

$content = elgg_view_title($title);

$content .= elgg_view_form('partner-blog/save', array(), array('blog_post' => $blog_post));

$body = elgg_view_layout('one_sidebar', array(
    'content' => $content,
    'sidebar' => ''
));

echo elgg_view_page($title, $body);

?>