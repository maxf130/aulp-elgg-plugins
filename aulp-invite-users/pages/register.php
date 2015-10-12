<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 15/03/15
 * Time: 17:33
 */

$invitecode = get_input('invitecode');
$email = get_input('email');

$invites = elgg_get_entities(array(
    'type' => 'object',
    'subtype' => 'invite',
));
$validInvite = false;
if(!$invites || count($invites) == 0){
    register_error(elgg_echo("aulp-invite-users:noinvite"));
    //No invites for this user/code
    forward();
} else {
    foreach($invites as $invite){
        if(time() - 3600*24 <= $invite->date ){
            //Allow user to create account
            $validInvite = $invite;
        } else {
            //Delete the invite (This shouldn't really be here anyways)
            $invite->delete();
        }
    }
}
if(!$validInvite){
    register_error(elgg_echo("aulp-invite-users:noinvite"));
    //No valid invites available
    forward();
} else if (elgg_is_logged_in()){
    register_error(elgg_echo("aulp-invite-users:already-logged-on"));
    //A logged in user should not be able to register a new user
    forward();
}

$title = elgg_echo("register");
$content = elgg_view_title($title);

// create the registration url - including switching to https if configured
$register_url = elgg_get_site_url() . 'action/aulp-invite-users/register';
if (elgg_get_config('https_login')) {
    $register_url = str_replace("http:", "https:", $register_url);
}
$form_params = array(
    'action' => $register_url,
    'class' => 'elgg-form-account',
);

$body_params = array(
    'friend_guid' => $friend_guid,
    'invitecode' => $invitecode,
    'e' => $email
);
$content .= elgg_view_form('register', $form_params, $body_params);

$content .= elgg_view('help/register');

if (elgg_get_config('walled_garden')) {
    elgg_load_css('elgg.walled_garden');
    $body = elgg_view_layout('walled_garden', array('content' => $content));
    echo elgg_view_page($title, $body, 'walled_garden');
} else {
    $body = elgg_view_layout('one_column', array('content' => $content));
    echo elgg_view_page($title, $body);
}
