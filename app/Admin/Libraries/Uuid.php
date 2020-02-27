<?php

namespace App\Admin\Libraries;

class Uuid extends \Ramsey\Uuid\Uuid
{
    public static function checkUuid4($value)
    {
        return preg_match('/\w{8}-\w{4}-\w{4}-\w{4}-\w{12}/', $value);
    }
}
