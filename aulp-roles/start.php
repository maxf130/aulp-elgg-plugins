<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 27/07/14
 * Time: 15:49
 */


elgg_register_event_handler('init', 'system', 'aulp_roles_init');

function aulp_roles_init() {
    elgg_register_plugin_hook_handler('roles:config', 'role', 'aulp_roles_config', 600);
}

function aulp_roles_config($hook, $type, $value, $params){



    $roles = array(
        VISITOR_ROLE => array(
            'title' => 'roles:role:VISITOR_ROLE',
            'extends' => array(),
            'permissions' => array(
                'menus' => array(
                    'site' => array('rule' => 'deny'),
                    'footer' => array('rule' => 'deny'),
                ),
                'pages' => array (
                     'regexp(/^((?!forgotpassword|secureinvite\/register|uservalidationbyemail\/confirm|$).)*$/)' => array(
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
        ),
        DEFAULT_ROLE => array(
            'title' => 'roles:role:DEFAULT_ROLE',
            'extends' => array(),
            'permissions' => array(
                'pages' => array(
                    'regexp(/^secureinvite.*/)' => array(
                        'rule' => 'deny',
                        'forward' => '',
                    ),
                ),
                'actions' => array(
                    'regexp(/^aulp-invite-users.*/)' => array(
                        'rule' => 'deny',
                    ),
                ),
                'views' => array(
                    'regexp(/^aulp-invite-users.*/)' => array(
                        'rule' => 'deny',
                    ),
                ),
                'menus' => array(
                    'page::invite' => array(
                        'rule' => 'deny'
                    ),
                ),
            ),
        ),
        'aulp_partners' => array(
            'title' => 'Partners',
            'extends' => array(DEFAULT_ROLE),
            'permissions' => array(
                'pages' => array(
                    'regexp(/^((?!partner-blog|profile|messages\/inbox|messages\/read|about|contact|avatar|settings\/user|settings\/statistics).+)/)' => array(
                        'rule' => 'deny'
                    ),
                ),
                'actions' => array(
                    'regexp(/^((?!partner-blog|logout|avatar|profile|messages\/send|messages\/process|usersettings\/save).+)/)' => array(
                        'rule' => 'deny'
                    ),
                ),
                'views' => array(
                    'regexp(/^partner-blog/.*/)' => array(
                        'rule' => 'allow'
                    ),
                ),
                'menus' => array(
                    'topbar::friends' => array(
                        'rule' => 'deny'
                    ),
                    'owner_block' => array(
                        'rule' => 'deny'
                    ),
                    'title::add' => array(
                        'rule' => 'deny'
                    ),
                    'page::1_plugins' => array(
                        'rule' => 'deny'
                    ),
                    'page::2_a_user_notify' => array(
                        'rule' => 'deny'
                    ),
                    'page::2_group_notify' => array(
                        'rule' => 'deny'
                    ),
                    'site::activity' => array(
                        'rule' => 'deny'
                    ),
                    'site::blog' => array(
                        'rule' => 'deny'
                    ),
                    'site::bookmarks' => array(
                        'rule' => 'deny'
                    ),
                    'site::file' => array(
                        'rule' => 'deny'
                    ),
                    'site::groups' => array(
                        'rule' => 'deny'
                    ),
                    'site::members' => array(
                        'rule' => 'deny'
                    ),
                    'site::pages' => array(
                        'rule' => 'deny'
                    ),
                    'site::partner_blog' => array(
                        'rule' => 'deny'
                    ),
                    'site::thewire' => array(
                        'rule' => 'deny'
                    ),
                    'extras::bookmark' => array(
                        'rule' => 'deny'
                    ),
                    'filter::friend' => array(
                        'rule' => 'deny'
                    )
                )
            ),
        ),
    );


    if(!is_array($value)) {
        return $roles;
    } else {
        return array_merge($value, $roles);
    }
}