<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 14/03/15
 * Time: 17:01
 */

class ElggInvite extends ElggObject {

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "invite";
        $this->attributes['access_id'] = ACCESS_PUBLIC;
    }

}