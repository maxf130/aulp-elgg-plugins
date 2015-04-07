<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 15/03/15
 * Time: 16:53
 */

elgg_register_event_handler('init', 'system', 'aulp_invite_users_init');

function aulp_invite_users_init(){
    elgg_register_page_handler('secureinvite', 'aulp_invite_users_page_handler');

    elgg_register_class("ElggInvite", elgg_get_plugins_path() . 'aulp-invite-users/classes/ElggInvite.php');

    elgg_register_action('aulp-invite-users/invite', elgg_get_plugins_path() . 'aulp-invite-users/actions/aulp-invite-users/invite.php');
    elgg_register_action('aulp-invite-users/register', elgg_get_plugins_path() . 'aulp-invite-users/actions/aulp-invite-users/register.php', "public");

    elgg_register_plugin_hook_handler('register', 'menu:page', 'aulp_invite_item_handler');
}


function aulp_invite_users_page_handler($segments){
    if($segments[0] == 'register') {
        if (!include_once elgg_get_plugins_path() . 'aulp-invite-users/pages/register.php') {
            return false;
        }
    } else if(!include_once elgg_get_plugins_path() . 'aulp-invite-users/pages/invite.php'){
        return false;
    }
    return true;
}

function aulp_invite_item_handler($hook, $type, $menu, $return){
    foreach ($menu as $key => $item){
        if($item->getName() == 'invite'){
            $item->setHref('secureinvite');
            break;
        }
    }

    return $menu;
}