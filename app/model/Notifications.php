<?php

/*
 +------------------------------------------------------------------------+
 | Phosphorum                                                             |
 +------------------------------------------------------------------------+
 | Copyright (c) 2013-2016 Phalcon Team and contributors                  |
 +------------------------------------------------------------------------+
 | This source file is subject to the New BSD License that is bundled     |
 | with this package in the file LICENSE.txt.                             |
 |                                                                        |
 | If you did not receive a copy of the license and are unable to         |
 | obtain it through the world-wide-web, please send an email             |
 | to license@phalconphp.com so we can send you a copy immediately.       |
 +------------------------------------------------------------------------+
*/

namespace Phosphorum\Model;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;

/**
 * Class Notifications
 *
 * @property \Phosphorum\Model\Users        user
 * @property \Phosphorum\Model\Posts        post
 * @property \Phosphorum\Model\PostsReplies reply
 *
 * @package Phosphorum\Model
 */
class Notifications extends Model
{

    public $id;

    public $users_id;

    public $type;

    public $posts_id;

    public $posts_replies_id;

    public $created_at;

    public $modified_at;

    public $message_id;

    public $sent;

    public function beforeValidationOnCreate()
    {
        $this->sent = 'N';
    }

    public function initialize()
    {
        $this->belongsTo(
            'users_id',
            'Phosphorum\Model\Users',
            'id',
            array(
                'alias' => 'user'
            )
        );

        $this->belongsTo(
            'posts_id',
            'Phosphorum\Model\Posts',
            'id',
            array(
                'alias' => 'post'
            )
        );

        $this->belongsTo(
            'posts_replies_id',
            'Phosphorum\Model\PostsReplies',
            'id',
            array(
                'alias' => 'reply'
            )
        );

        $this->addBehavior(
            new Timestampable(array(
                'beforeCreate' => array(
                    'field' => 'created_at'
                ),
                'beforeUpdate' => array(
                    'field' => 'modified_at'
                )
            ))
        );
    }
}
