<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/engine/start.php";

$params = array(
    'title' => 'About',
    'content' => 'Aulp about text',
    'filter' => '',);

$body = elgg_view_layout('content', $params);

echo elgg_view_page('Aulp', $body);
