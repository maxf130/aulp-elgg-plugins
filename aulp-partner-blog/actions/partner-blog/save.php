<?php


$title = get_input('title');
$sub_title = get_input('subtitle');
$body = get_input('body');
$tags = string_to_tag_array(get_input('tags'));
$guid = get_input('guid');

$blog = "";
if($guid) {
    $blogs = elgg_get_entities(array(
        'guid' => $guid,
    ));
    if ($blogs != FALSE){
        $blog = $blogs[0];
    }
} else {
    $blog = new ElggObject();
}

$blog->subtype = "partner-blog";
$blog->title = $title;
$blog->sub_title = $sub_title;
$blog->body = $body;

$blog->access_id = ACCESS_PUBLIC;

$blog->owner_guid = elgg_get_logged_in_user_guid();

$blog->tags = $tags;

$blog_guid = $blog->save();

if ($blog_guid) {
    system_message(elgg_echo('partner-blog:save:success'));
    forward($blog->getURL());
} else {
    register_error(elgg_echo('partner-blog:save:error'));
    forward(REFERER);
}