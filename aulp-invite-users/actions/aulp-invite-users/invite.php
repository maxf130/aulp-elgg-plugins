<?php

$site = elgg_get_site_entity();

$emails = get_input('emails');
$emailmessage = get_input('emailmessage');
$partner = get_input('partner');

$emails = trim($emails);
if (strlen($emails) > 0) {
    $emails = preg_split('/\\s+/', $emails, -1, PREG_SPLIT_NO_EMPTY);
}

if (!is_array($emails) || count($emails) == 0) {
    register_error(elgg_echo('invitefriends:noemails'));
    forward(REFERER);
}

$current_user = elgg_get_logged_in_user_entity();

$error = FALSE;
$bad_emails = array();
$already_members = array();
$save_invite = array();
$sent_total = 0;
foreach ($emails as $email) {

    $email = trim($email);
    if (empty($email)) {
        continue;
    }

// send out other email addresses
    if (!is_email_address($email)) {
        $error = TRUE;
        $bad_emails[] = $email;
        continue;
    }

    if (get_user_by_email($email)) {
        $error = TRUE;
        $already_members[] = $email;
        continue;
    }


    $inviteCode = generate_invite_code($current_user->username);

    $invites = elgg_get_entities_from_metadata(array(
        'type' => 'object',
        'subtype' => 'invite',
        'metadata_name_value_pair' => array(
            array('name' => 'code', 'value' => $inviteCode),
            array('name' => 'user_email', 'value' => $email)
        )
    ));

    if($invites && count($invites) !=0) {
        foreach ($invites as $invitation) {
            $invitation->delete();
        }
    }
    $invite = new ElggInvite();
    $invite->code = $inviteCode;
    $invite->user_email = $email;
    $invite->date = time();
    if($partner){
        $invite->partner = true;
    } else {
        $invite->partner = false;
    }
    $inviteGUID = $invite->save();
    if(!$inviteGUID){
        $save_invite[] = $email;
        continue;
    }

    $link = elgg_get_site_url() . 'secureinvite/register?email=' . $email . '&invitecode=' . $inviteCode;
    $message = elgg_echo('invitefriends:email', array(
            $site->name,
            $current_user->name,
            $emailmessage,
            $link
        )
    );

    $subject = elgg_echo('invitefriends:subject', array($site->name));

// create the from address
    $site = get_entity($site->guid);
    if ($site && $site->email) {
        $from = $site->email;
    } else {
        $from = 'noreply@' . get_site_domain($site->guid);
    }

    elgg_send_email($from, $email, $subject, $message);
    $sent_total++;
}

if ($error) {
    register_error(elgg_echo('invitefriends:invitations_sent', array($sent_total)));

    if (count($bad_emails) > 0) {
        register_error(elgg_echo('invitefriends:email_error', array(implode(', ', $bad_emails))));
    }

    if (count($already_members) > 0) {
        register_error(elgg_echo('invitefriends:already_members', array(implode(', ', $already_members))));
    }

    if (count($save_invite) > 0) {
        register_error(elgg_echo('aulp-invite-users:error:save-invite', array(implode(', ', $save_invite))));
    }

} else {
    system_message(elgg_echo('invitefriends:success'));
}

forward(REFERER);