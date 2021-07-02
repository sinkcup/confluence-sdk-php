<?php

namespace Confluence;

class ContentChild extends Base
{
    protected string $resourceUri = 'content/{content_id}/child';

    protected array $apis = [
        'index',
    ];

    public function index(array $params = [])
    {
        // HACK Confluence API is not RESTFul
        // https://docs.atlassian.com/ConfluenceServer/rest/7.12.2/#api/content/{id}/child-childrenOfType
        if (isset($params['type']) && !empty($params['type'])) {
            $type = $params['type'];
            unset($params['type']);
            return $this->requestApi('GET', $type, $params);
        }
        return parent::index($params);
    }
}
