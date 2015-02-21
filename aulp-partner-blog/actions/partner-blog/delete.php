<?php

$blog_guid = get_input('guid');
$blog = get_entity($blog_guid);

if (elgg_instanceof($blog, 'object', 'partner-blog') && $blog->canEdit()) {
    $container = get_entity($blog->container_guid);
    if ($blog->delete()) {
        system_message(elgg_echo('partner-blog:deleted:success'));
        forward('partner-blog/all');
    } else {
        register_error(elgg_echo('partner-blog:deleted:error'));
    }
} else {
    register_error(elgg_echo('partner-blog:find:error'));
}

forward(REFERER);