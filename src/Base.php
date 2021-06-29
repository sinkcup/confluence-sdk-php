<?php

namespace Confluence;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Base
{
    protected mixed $client;

    protected array $conf = array(
        'root_uri' => 'http://localhost:8090/confluence/rest/api/',
        'timeout' => 3.0,
    );

    protected string $uriPrefix = '';

    protected array $apis = [];

    public function __construct(array $conf = [], $client = null)
    {
        $this->conf = array_merge($this->conf, $conf);
        if (empty($client)) {
            $this->client = new Client([
                'base_uri' => $this->conf['root_uri'] . $this->uriPrefix,
                'timeout' => $this->conf['timeout'],
                'headers' => [
                    // TODO
                ],
            ]);
        } else {
            $this->client = $client;
        }
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    protected function requestApi(string $method, string $path, array $params = [])
    {
        if (!in_array(debug_backtrace()[1]['function'], $this->apis)) {
            throw new Exception('Method Not Allowed', Exception::$codeStr2Num['MethodNotAllowed']);
        }
        $options = [];
        if (!empty($params)) {
            if (in_array($method, ['GET', 'DELETE'])) {
                $options = ['query' => $params];
            } else {
                $options = ['json' => $params];
            }
        }
        $response = $this->client->request($method, $path, $options);
        return json_decode($response->getBody(), true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     */
    public function destroy($id, $params = [])
    {
        return $this->requestApi('DELETE', $id, $params);
    }

    /**
     * Display a listing of the resource.
     *
     * @example shell curl -u admin:admin -X GET "http://localhost:8090/confluence/rest/api/content?type=blogpost
     * &start=0&limit=10&expand=space,history,body.view,metadata.labels" | python -mjson.tool
     */
    public function index(array $params = [])
    {
        return $this->requestApi('GET', '', $params);
    }

    /**
     * Display the specified resource.
     *
     * @example shell curl -u admin:admin http://localhost:8090/confluence/rest/api/content/3965072?expand=body.storage
     * | python -mjson.tool
     */
    public function show(int $id, array $params = [])
    {
        return $this->requestApi('GET', $id, $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @example shell curl -u admin:admin -X POST -H 'Content-Type: application/json'
     * -d '{"type":"page","title":"new page", "space":{"key":"TST"},
     * "body":{"storage":{"value":"<p>This is <br/> a new page</p>","representation": "storage"}}}'
     * http://localhost:8090/confluence/rest/api/content/ | python -mjson.tool
     * @return array
     */
    public function store(array $params)
    {
        return $this->requestApi('POST', '', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update($id, array $params)
    {
        return $this->requestApi('PUT', $id, $params);
    }
}