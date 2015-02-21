<?php
//Generate title menu
elgg_register_title_button();

$owner = get_user_by_username($segments[1]);

if(!$owner){
    register_error("That user could not be found.");
    forward(REFERRER);
}

$friends = $owner->getFriends();

if(!friends){
    register_error("That users friends could not be found.");
    forward(REFERER);
}



$user_guids = array();

foreach($friends as $friend){
    array_push($user_guids, $friend->getGUID());
}

$body .= elgg_list_entities(array(
    'type' => 'object',
    'subtype' => 'partner-blog',
    'full_view' => false,
    'owner_guids' => $user_guids,
));



$body = elgg_view_layout('content', array('content' => $body));

echo elgg_view_page("All Partner Blogs", $body);