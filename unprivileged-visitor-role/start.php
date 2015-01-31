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
                    'site::activity' => array('rule' => 'deny'),
                    'site::blog' => array('rule' => 'deny'),
                    'site::bookmarks' => array('rule' => 'deny'),
                    'site::files' => array('rule' => 'deny'),
                    'site::groups' => array('rule' => 'deny'),
                    'site::members' => array('rule' => 'deny'),
                    'site::pages' => array('rule' => 'deny'),
                    'site::file' => array('rule' => 'deny'),
                    'site::thewire'=> array('rule' => 'deny'),
                ),
                'pages' => array (
                     'regexp(^\/(?!(contact|about|$)\/?$))' => array(
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
                    'regexp(/.*/)' => array(
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