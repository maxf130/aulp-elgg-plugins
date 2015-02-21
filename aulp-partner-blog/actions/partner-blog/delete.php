<?php

$blog_guid = get_input('guid');
$blog = get_entity($blog_guid);

if (elgg_instanceof($blog, 'object', 'partner-blog') && $blog->canEdit()) {
    $container = get_entity($blog->container_guid);
    if ($blog->delete()) {
        system_message(elgg_echo('Deleted partner blog'));
        forward('partner-blog/all');
    } else {
        register_error(elgg_echo('Could not delete partner blog'));
    }
} else {
    register_error(elgg_echo('Could not find blog'));
}

forward(REFERER);