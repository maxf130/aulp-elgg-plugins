<?php
$guid = $segments[1];

$blog_posts = elgg_get_entities(array(
    'type' => 'object',
    'subtype' => 'partner-blog',
    'guid' => $guid,
));

if(!$blog_posts){
    register_error(elgg_echo('partner-blog:find:error'));
    forward(REFERER);
}

$blog_post = $blog_posts[0];

$title = elgg_echo('partner-blog:edit:title');

$content = elgg_view_title($title);

$content .= elgg_view_form('partner-blog/save', array(), array('blog_post' => $blog_post));

$body = elgg_view_layout('one_sidebar', array(
    'content' => $content,
    'sidebar' => ''
));

echo elgg_view_page($title, $body);

?>