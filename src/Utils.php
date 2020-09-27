<?php

namespace Antriver\EnergenieMihomeApi;

class Utils
{
    public static function snakeCaseToCamelCase(string $string): string
    {
        return lcfirst(implode('', array_map('ucfirst', explode('_', strtolower($string)))));
    }
}
