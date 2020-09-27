<?php

namespace Antriver\EnergenieMihomeApi\Entities;

use Antriver\EnergenieMihomeApi\Utils;

abstract class AbstractMihomeEntity
{
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $camelKey = Utils::snakeCaseToCamelCase($key);
            if (property_exists($this, $camelKey)) {
                $this->{$camelKey} = $value;
            }
        }
    }
}
