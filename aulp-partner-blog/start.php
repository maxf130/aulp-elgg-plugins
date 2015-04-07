<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 07/02/15
 * Time: 16:09
 */
elgg_register_event_handler('init', 'system', 'aulp_partner_blog_init');

function aulp_partner_blog_init(){

    //Register save and delete actions
    elgg_register_action("partner-blog/save", elgg_get_plugins_path() . "aulp-partner-blog/actions/partner-blog/save.php");
    elgg_register_action("partner-blog/delete", elgg_get_plugins_path() . "aulp-partner-blog/actions/partner-blog/delete.php");

    // Register page handler
    elgg_register_page_handler('partner-blog', 'partner_blog_page_handler');

    // Partner blog menu item
    elgg_register_menu_item('site', array(
        'name' => 'partner-blog',
        'text' => 'Partner Blog',
        'href' => 'partner-blog/all'
    ));

    // Change default entity url
    elgg_register_entity_url_handler('object', 'partner-blog', 'partner_blog_url_handler');

    // If on the profile page then remove the 'add_widgets' functionality.
    if(elgg_in_context('profile')){
        elgg_register_plugin_hook_handler('view', 'page/layouts/widgets/add_button', 'add_button_remover');
    }
}

function add_button_remover($hook, $type, $returnvalue, $params){
    return "";
}


function partner_blog_page_handler($segments){
    switch ($segments[0]) {
        case 'add':
            include elgg_get_plugins_path() . 'aulp-partner-blog/pages/partner-blog/add.php';
            break;
        case 'all':
            include elgg_get_plugins_path() . 'aulp-partner-blog/pages/partner-blog/all.php';
            break;
        case 'edit':
            include elgg_get_plugins_path() . 'aulp-partner-blog/pages/partner-blog/edit.php';
            break;
        case 'view':
            include elgg_get_plugins_path() . 'aulp-partner-blog/pages/partner-blog/view.php';
            break;
        case 'owner':
            include elgg_get_plugins_path() . 'aulp-partner-blog/pages/partner-blog/owner.php';
            break;
        case 'friends':
            include elgg_get_plugins_path() . 'aulp-partner-blog/pages/partner-blog/friends.php';
            break;
        default:
            include elgg_get_plugins_path() . 'aulp-partner-blog/pages/partner-blog/all.php';
            break;
    }
    return true;
}

function partner_blog_url_handler($entity) {
    if (!$entity->getOwnerEntity()) {
        // default to a standard view if no owner.
        return FALSE;
    }

    $friendly_title = elgg_get_friendly_title($entity->title);

    return "partner-blog/view/{$entity->guid}/$friendly_title";
}