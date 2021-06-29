<?php

namespace Confluence;

class Exception extends \Exception
{
    public static $codeStr2Num = [
        'MethodNotAllowed' => 4051,
    ];
}
