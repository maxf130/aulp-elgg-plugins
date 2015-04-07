<?php
/**
 * Elgg demo custom index page plugin
 * 
 */

elgg_register_event_handler('init', 'system', 'aulp_home_init');

function aulp_home_init() {

	// Replace the default index page
	elgg_register_plugin_hook_handler('index', 'system', 'aulp_home');
}

function aulp_home($hook, $type, $return, $params) {
    $title = elgg_echo("aulp-home:title");
    $header = elgg_view_title($title);

    $section_title = elgg_view_title(elgg_echo("expages:about"));
    $content = $section_title;

    $object = elgg_get_entities(array(
        'type' => 'object',
        'subtype' => 'about',
        'limit' => 1,
    ));

    if ($object) {
        $content .= elgg_view('output/longtext', array('value' => $object[0]->description));
    } else {
        $content .= elgg_echo("expages:notset");
    }

    $section_title = elgg_view_title(elgg_echo("expages:terms"));
    $content .= $section_title;

    $object = elgg_get_entities(array(
        'type' => 'object',
        'subtype' => 'terms',
        'limit' => 1,
    ));

    if ($object) {
        $content .= elgg_view('output/longtext', array('value' => $object[0]->description));
    } else {
        $content .= elgg_echo("expages:notset");
    }

    $section_title = elgg_view_title(elgg_echo("expages:privacy"));
    $content .= $section_title;

    $object = elgg_get_entities(array(
        'type' => 'object',
        'subtype' => 'privacy',
        'limit' => 1,
    ));

    if ($object) {
        $content .= elgg_view('output/longtext', array('value' => $object[0]->description));
    } else {
        $content .= elgg_echo("expages:notset");
    }


    $body = elgg_view_layout('one_sidebar', array('title' => $title, 'content' => $content));

    echo elgg_view_page($title, $body);
    #$content = elgg_view('expages/wrapper', array('content' => $content));


	// return true to signify that we have handled the front page
	return true;
}
