<?php

$title = elgg_echo('partner-blog:add:title');


$content = elgg_view_title($title);

$content .= elgg_view_form("partner-blog/save", array(), array('blog_post'  => false));

$body = elgg_view_layout('one_sidebar', array(
    'content' => $content,
    'sidebar' => ''
));

echo elgg_view_page($title, $body);
