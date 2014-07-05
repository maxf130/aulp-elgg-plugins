<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

elgg_register_event_handler('init', 'system', 'aulp_static_pages_init');

function aulp_static_pages_init() {
    // Add new menu item 'AULP' to point to home page
    elgg_register_menu_item('site', array('name' => 'aulp', 'text' => 'AULP', 'href' => elgg_get_site_url()));

    // Register plugin hook to render home page
    elgg_register_plugin_hook_handler('index', 'system', 'aulp_home');


    // Register page handlers for contact and about
    elgg_register_page_handler('contact', 'aulp_contact');
    elgg_register_page_handler('about', 'aulp_about');
}

function aulp_home() {
    // Ensure page loads, otherwise return false to indicate 404
    if (!include_once $_SERVER['DOCUMENT_ROOT'] . "/mod/aulp-static-pages/pages/index.php") {
        return false;
    }
    return true;
}

function aulp_contact() {
    // Ensure page loads, otherwise return false to indicate 404
    if (!include_once $_SERVER['DOCUMENT_ROOT'] . "/mod/aulp-static-pages/pages/contact.php") {
        return false;
    }
    return true;
}

function aulp_about() {
    // Ensure page loads, otherwise return false to indicate 404
    if (!include_once $_SERVER['DOCUMENT_ROOT'] . "/mod/aulp-static-pages/pages/about.php") {
        return false;
    }
    return true;
}
