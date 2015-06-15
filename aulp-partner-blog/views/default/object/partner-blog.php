<?php

$title = $vars['entity']->title;




$blog_link = elgg_view('output/url', array(
    'href' => $vars['entity']->getUrl(),
    'text' => $title,
    'is_trusted' => true,
));
$content = elgg_view_title($blog_link);


$content .= elgg_view('output/text', array('value' => $vars['entity']->sub_title));

if($vars['full_view']){
    $content .= elgg_view('output/longtext', array('value' => $vars['entity']->body));
}

$content .= elgg_view('output/tags', array('value' => $vars['entity']->tags));


if($vars['entity']->getOwnerGUID() == elgg_get_logged_in_user_guid()){
    // Provide link for editing/deleting the blog
    echo elgg_view_menu('entity', array(
        'entity' => $vars['entity'],
        'handler' => 'partner-blog',
        'sort_by' => 'priority',
        'class' => 'elgg-menu-hz',
    ));

}

if($vars['full_view']){
    $content .= elgg_view_comments($vars['entity']);
}




echo $content;