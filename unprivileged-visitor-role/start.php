<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 27/07/14
 * Time: 15:49
 */


elgg_register_event_handler('init', 'system', 'unprivileged_visitor_role_init');

function unprivileged_visitor_role_init() {
    elgg_register_plugin_hook_handler('roles:config', 'role', 'unprivileged_visitor_config', 600);
}

function unprivileged_visitor_config($hook, $type, $value, $params){



    $roles = array(
        VISITOR_ROLE => array(
            'title' => 'roles:role:VISITOR_ROLE',
            'extends' => array(),
            'permissions' => array(
                'menus' => array(
                    'site' => array('rule' => 'deny'),
                ),
                'pages' => array (
                     'regexp(/^((?!contact|about|forgotpassword|secureinvite\/register|uservalidationbyemail\/confirm|$).)*$/)' => array(
                        'rule' => 'deny',
                        'forward' => '',
                    ),
                ),
                'views' => array(
                    'regexp(/.*/)' => array(
                        'rule' => 'deny',
                    ),
                ),
                'actions' => array(
                    'regexp(/^((?!login|user\/requestnewpassword|aulp-invite-users\/register).)*$/)' => array(
                        'rule' => 'deny',
                    ),
                ),
            )
        )

    );


    if(!is_array($value)) {
        return $roles;
    } else {
        return array_merge($value, $roles);
    }
}