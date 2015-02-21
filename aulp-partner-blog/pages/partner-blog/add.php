<?php

$title = "Create a new partner blog post";


$content = elgg_view_title($title);

$content .= elgg_view_form("partner-blog/save");

$body = elgg_view_layout('one_sidebar', array(
    'content' => $content,
    'sidebar' => ''
));

echo elgg_view_page($title, $body);
