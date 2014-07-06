<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

gatekeeper();

// Set title
$title = "Edit Homepage";


$content = elgg_view_title($title);

$content .= elgg_view_form('home/edit');

$sidebar = "";

$body = elgg_view_layout('one_sidebar', array(
    'content' => $content,
    'sidebar' => $sidebar
));

echo elgg_view_page($title, $body);