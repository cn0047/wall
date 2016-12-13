<?php

namespace Wall\Application\VO\Message;

use ValueObject\ValueObject;

/**
 * @method integer getUserId
 * @method string getMessage
 */
class NewMessage extends ValueObject
{
    protected function getRules():array
    {
        return [
            'userId' => ['NotBlank', 'Type' => ['type' => 'integer'],  'Range' => ['min' => 0]],
            'message' => ['NotBlank', 'Type' => ['type' => 'string']],
        ];
    }
}
