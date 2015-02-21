<?php

$title = elgg_echo('partner-blog:all:title');

elgg_register_title_button();


$body .= elgg_list_entities(array(
    'type' => 'object',
    'subtype' => 'partner-blog',
    'full_view' => false,
));



$body = elgg_view_layout('content', array('content' => $body));

echo elgg_view_page($title, $body);