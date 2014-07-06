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

// Grab values from form
$body = get_input('body');
$title = get_input('title');

// Grab all homepage objects (there should only be one)
$homes = elgg_get_entities(array(
    'type' => 'object',
    'subtype' => 'aulphome'
));

$home = NULL;

// Check there is one.  Edit if yes, create if not.
if(!empty($homes)){
    $home = $homes[0];
}else{
    $home = new ElggObject();
    $home->subtype = 'aulphome';
    $home->access_id = ACCESS_PUBLIC;
}

// Assign new content
$home->description = $body;
$home->title = $title;

// Attempt to save
$home_guid = $home->save();

// Check that it has saved, otherwise throw error and send back to form
if (!$home_guid) {
    register_error("The home page could not be saved");
    forward(REFERER);
} else {
    forward('/');
}