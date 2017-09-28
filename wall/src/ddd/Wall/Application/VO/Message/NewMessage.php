<?php

namespace Wall\Application\VO\Message;

use ValueObject\ValueObject;

/**
 * @method string getUserId
 * @method string getMessage
 */
class NewMessage extends ValueObject
{
    protected function getRules(): array
    {
        return [
            'userId' => ['NotBlank', 'Type' => ['type' => 'digit']],
            'message' => ['NotBlank', 'Type' => ['type' => 'string']],
        ];
    }
}
