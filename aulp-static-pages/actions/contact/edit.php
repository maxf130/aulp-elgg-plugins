<?php

/* 
 * Copyright (C) 2014 max
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

// Grab all hcontact objects (there should only be one)
$contacts = elgg_get_entities(array(
    'type' => 'object',
    'subtype' => 'aulpcontact'
));

$home = NULL;

// Check there is one.  Edit if yes, create if not.
if(!empty($contacts)){
    $contact = $contacts[0];
}else{
    $contact = new ElggObject();
    $contact->subtype = 'aulpcontact';
    $contact->access_id = ACCESS_PUBLIC;
}

// Assign new content
$contact->description = $body;
$contact->title = $title;

// Attempt to save
$contact_guid = $contact->save();

// Check that it has saved, otherwise throw error and send back to form
if (!$contact_guid) {
    register_error("The contact page could not be saved");
    forward(REFERER);
} else {
    forward('/contact');
}