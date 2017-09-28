<?php

namespace Wall\Application\VO\Message;

use ValueObject\ValueObject;

/**
 * @method string getLimit
 * @method string getOffset
 */
class GetMessageByCriteria extends ValueObject
{
    protected function getRules(): array
    {
        return [
            'limit' => ['NotBlank', 'Type' => ['type' => 'digit']],
            'offset' => ['NotBlank', 'Type' => ['type' => 'digit']],
        ];
    }
}
