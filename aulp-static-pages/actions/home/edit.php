<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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