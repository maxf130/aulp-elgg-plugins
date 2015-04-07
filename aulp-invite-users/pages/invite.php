<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 15/03/15
 * Time: 17:02
 */

$title = elgg_echo('aulp-invite-users:invite:title');

$content = elgg_view_title($title);
$form = elgg_view_form('aulp-invite-users/invite');
if(!$form){
    echo "The form returned false";
}
$content .= elgg_view_form('aulp-invite-users/invite');

$body = elgg_view_layout('one_column', array("content" => $content));

echo elgg_view_page($title, $body);
