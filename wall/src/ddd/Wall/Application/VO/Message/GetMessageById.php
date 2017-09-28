<?php

namespace Wall\Application\VO\Message;

use ValueObject\ValueObject;

/**
 * @method string getId
 */
class GetMessageById extends ValueObject
{
    protected function getRules(): array
    {
        return [
            'id' => ['NotBlank', 'Type' => ['type' => 'digit']],
        ];
    }
}
