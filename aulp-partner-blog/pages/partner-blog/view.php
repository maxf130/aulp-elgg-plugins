<?php
$guid = $segments[1];

$blog_post = "";
$blog_posts = elgg_get_entities(array(
    'guid' => $guid
));
if ($blog_posts != FALSE){
    $blog_post = $blog_posts[0];
}
$title = $blog_post->title;


$content = elgg_view_entity($blog_post, array(
    'full_view' => true,
));


$body = elgg_view_layout('one_sidebar', array(
    'content' => $content,
    'sidebar' => ''
));

echo elgg_view_page($title, $body);