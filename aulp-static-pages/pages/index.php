<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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


$params = array(
    'title' => $home['title'],
    'content' => $home['description'],
    'filter' => '',);

$body = elgg_view_layout('content', $params);

echo elgg_view_page('Aulp', $body);
