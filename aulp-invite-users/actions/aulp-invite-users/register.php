<?php
/**
 * Elgg registration action
 *
 * @package Elgg.Core
 * @subpackage User.Account
 */

elgg_make_sticky_form('register');

// Get variables
$username = get_input('username');
$password = get_input('password', null, false);
$password2 = get_input('password2', null, false);
$email = get_input('email');
$name = get_input('name');
$friend_guid = (int) get_input('friend_guid', 0);
$invitecode = get_input('invitecode');

$invites = elgg_get_entities_from_metadata(array(
    'type' => 'object',
    'subtype' => 'invite',
    'metadata_name_value_pair' => array(
        array('name' => 'code', 'value' => $invitecode),
        array('name' => 'user_email', 'value' => $email)
    )
));

try {
  if(!$invites || count($invites) == 0){
      //No invites for this user/code
      throw new RegistrationException(elgg_echo('aulp-invite-users:noinvite'));
  } else {
      foreach($invites as $invite){
          if(time() - 3600*24 <= $invite->date ){
              //Allow user to create account
              $validInvite = $invite;
          } else {
              //Delete the invite (This shouldn't really be here anyways)
              $invite->delete();
          }
      }
  }
  if(!$validInvite){
      //No valid invites available
      throw new RegistrationException(elgg_echo('aulp-invite-users:noinvite'));
  } else if (elgg_is_logged_in()){
      //A logged in user should not be able to register a new user
      throw new RegistrationException(elgg_echo('aulp-invite-users:already-logged-on'));
  }

    if (trim($password) == "" || trim($password2) == "") {
        throw new RegistrationException(elgg_echo('RegistrationException:EmptyPassword'));
    }

    if (strcmp($password, $password2) != 0) {
        throw new RegistrationException(elgg_echo('RegistrationException:PasswordMismatch'));
    }




    $guid = register_user($username, $password, $name, $email, false);


    if ($guid) {
        $new_user = get_entity($guid);

        // allow plugins to respond to self registration
        // note: To catch all new users, even those created by an admin,
        // register for the create, user event instead.
        // only passing vars that aren't in ElggUser.
        $params = array(
            'user' => $new_user,
            'password' => $password,
            'friend_guid' => $friend_guid,
            'invitecode' => $invitecode
        );

        // @todo should registration be allowed no matter what the plugins return?
        if (!elgg_trigger_plugin_hook('register', 'user', $params, TRUE)) {
            $ia = elgg_set_ignore_access(true);
            $new_user->delete();
            elgg_set_ignore_access($ia);
            // @todo this is a generic messages. We could have plugins
            // throw a RegistrationException, but that is very odd
            // for the plugin hooks system.
            throw new RegistrationException(elgg_echo('registerbad'));
        }

        //Assume user creation was successful at this point.  Check for
        //Role and set if necessary.
        if($validInvite->partner){
            //Set users role to partner
            $partnerRole = roles_get_role_by_name('aulp_partners');
            if(!$partnerRole){
                //Role doesn't exist. Panic
                throw new RegistrationException(elgg_echo('registerbad'));
            }

            roles_set_role( $partnerRole ,$new_user);#
        }

        elgg_clear_sticky_form('register');
        system_message(elgg_echo("registerok", array(elgg_get_site_entity()->name)));

        // if exception thrown, this probably means there is a validation
        // plugin that has disabled the user
        try {
            login($new_user);
        } catch (LoginException $e) {
            // do nothing
        }

        // Remove the just used invite.  It should not be possible for the user to register again!
        $validInvite->delete();

        // Forward on success, assume everything else is an error...
        forward();
    } else {
        register_error(elgg_echo("registerbad"));
    }
} catch (RegistrationException $r) {
    register_error($r->getMessage());
}

forward(REFERER);
