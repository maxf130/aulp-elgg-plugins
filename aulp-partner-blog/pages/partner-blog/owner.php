<?php
//Generate title menu
elgg_register_title_button();

$owner = get_user_by_username($segments[1]);

if(!$owner){
    register_error(elgg_echo('user:username:notfound'));
    forward(REFERRER);
}
$user_guid = $owner->getGUID();

$body .= elgg_list_entities(array(
    'type' => 'object',
    'subtype' => 'partner-blog',
    'full_view' => false,
    'owner_guids' => array($user_guid),
));



$body = elgg_view_layout('content', array('content' => $body));

echo elgg_view_page($segments[1] . " " . elgg_echo('partner-blog:owner:title'), $body);