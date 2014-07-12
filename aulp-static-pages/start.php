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
    // Add new menu item 'AULP' to point to home page
    elgg_register_menu_item('site', array('name' => 'aulp', 'text' => 'AULP', 'href' => elgg_get_site_url()));

    // Register plugin hook to render home page
    elgg_register_plugin_hook_handler('index', 'system', 'aulp_home');


    // Register page handlers for contact and about
    elgg_register_page_handler('contact', 'aulp_contact');
    elgg_register_page_handler('about', 'aulp_about');
    
    // Register page handlers for edit forms
    elgg_register_page_handler('home', 'aulp_home_edit');

    // Register actions
    elgg_register_action("home/edit", elgg_get_plugins_path() . "aulp-static-pages/actions/home/edit.php", admin);
}

function aulp_home() {
    
    echo elgg_get_plugins_path();
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

function aulp_home_edit($segments){
    if ($segments[0] == "edit"){
        include elgg_get_plugins_path() . 'aulp-static-pages/pages/home/edit.php';
        return true;
    }
    return false;
}
