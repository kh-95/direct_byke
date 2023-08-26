<?php

namespace App\Helpers\Traits\Casts;

trait UnicodeJsonColumn
{
    protected function asJson(mixed $value) : string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
