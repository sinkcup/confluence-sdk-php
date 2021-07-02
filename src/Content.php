<?php

namespace Confluence;

class Content extends Base
{
    protected string $resourceUri = 'content';

    protected array $apis = [
        'destroy',
        'index',
        'show',
        'store',
        'update',
    ];
}
