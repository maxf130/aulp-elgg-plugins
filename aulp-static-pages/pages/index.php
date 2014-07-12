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

include_once $_SERVER['DOCUMENT_ROOT'] . "/engine/start.php";

$homes = elgg_get_entities(array(
    'type' => 'object',
    'subtype' => 'aulphome'
));

$home = null;

if(!empty($homes)){
    $home = $homes[0];
}

// If current user is an admin, show link to edit homepage
if(elgg_is_admin_logged_in()){
    elgg_register_menu_item('page', array(
    'name' => 'edit_home',
    'text' => 'Edit Homepage',
    'href' => '/home/edit',
    ));
}




$bodyParams = array(
    'title' => $home['title'],
    'content' => $home['description'],
    'filter' => '',);

$body = elgg_view_layout('one_sidebar', $bodyParams);

echo elgg_view_page('Aulp', $body);
