<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 15/03/15
 * Time: 15:15
 */

$site = elgg_get_site_entity();
$introduction = elgg_echo('invitefriends:introduction');
$message = elgg_echo('invitefriends:message');
$default = elgg_echo('invitefriends:message:default', array($site->name));
$partner = elgg_echo('aulp-invite-users:partner');

echo <<< HTML
<div>
	<label>
		$introduction
		<textarea class="elgg-input-textarea" name="emails" ></textarea>
	</label>
</div>
<div>
	<label>
		$message
		<textarea class="elgg-input-textarea" name="emailmessage" >$default</textarea>
	</label>
</div>
<div>

HTML;
?>
<div>
    <label><?php echo $partner?></label><br />
    <?php echo elgg_view('input/checkbox', array("name" => 'partner'))?>
</div>

<?php

echo '<div class="elgg-foot">';
echo elgg_view('input/submit', array('value' => elgg_echo('send')));
echo '</div>';