<?php

/* 
 * Copyright (C) 2014 Maximilian Friedersdorff
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

elgg_register_event_handler('init', 'system', 'aulp_static_pages_init');

function aulp_static_pages_init() {
    // Add new menu items to point to home page, contact and about
    elgg_register_menu_item('page', array(
        'name' => 'contact',
        'text' => 'Contact',
        'href' => elgg_get_site_url() . "contact"));
    elgg_register_menu_item('page', array(
        'name' => 'about',
        'text' => 'About',
        'href' => elgg_get_site_url() . "about"));
    elgg_register_menu_item('page', array(
        'name' => 'home',
        'text' => 'Home',
        'href' => elgg_get_site_url()));
    // Register plugin hook to render home page
    elgg_register_plugin_hook_handler('index', 'system', 'aulp_home');


    // Register page handlers for contact and about
    elgg_register_page_handler('contact', 'aulp_contact');
    elgg_register_page_handler('about', 'aulp_about');
    
    // Register page handlers for edit forms
    elgg_register_page_handler('edit', 'aulp_edit');

    // Register actions
    elgg_register_action("home/edit", elgg_get_plugins_path() . "aulp-static-pages/actions/home/edit.php", admin);
    elgg_register_action("contact/edit", elgg_get_plugins_path() . "aulp-static-pages/actions/contact/edit.php", admin);
    elgg_register_action("about/edit", elgg_get_plugins_path() . "aulp-static-pages/actions/about/edit.php", admin);
}

function aulp_home() {
    // Ensure page loads, otherwise return false to indicate 404
    if (!include_once elgg_get_plugins_path() . "aulp-static-pages/pages/index.php") {
        return false;
    }
    return true;
}

function aulp_contact() {
    // Ensure page loads, otherwise return false to indicate 404
    if (!include_once elgg_get_plugins_path() . "aulp-static-pages/pages/contact.php") {
        return false;
    }
    return true;
}

function aulp_about() {
    // Ensure page loads, otherwise return false to indicate 404
    if (!include_once elgg_get_plugins_path() . "aulp-static-pages/pages/about.php") {
        return false;
    }
    return true;
}

function aulp_edit($segments){
    $endSegment = $segments[0];
    if($endSegment == ""){
        return false;
    }
    if(!include elgg_get_plugins_path(). 'aulp-static-pages/pages/'.$endSegment.'/edit.php'){
        return false;
    }
    return true;
}
