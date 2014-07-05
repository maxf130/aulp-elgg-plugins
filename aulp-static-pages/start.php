<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

elgg_register_event_handler('init', 'system', 'aulp_static_pages_init');

function aulp_static_pages_init(){
    # Add new menu item 'AULP' to point to home page
    elgg_register_menu_item('site', array('name' => 'aulp', 'text' => 'AULP', 'href' => elgg_get_site_url()));
    
    elgg_register_page_handler('', 'home_page_handler');
}

function home_page_handler(){
    
}
