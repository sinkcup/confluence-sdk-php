<?php

namespace Confluence;

class Content extends Base
{
    protected string $uriPrefix = 'content';

    protected array $apis = [
        'destroy',
        'index',
        'show',
        'store',
        'update',
    ];
}
