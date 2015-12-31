<?php

namespace Purwandi\Advisor;

use GuzzleHttp\Client;

class Suggest
{
    protected $endpoint = 'https://www.tripadvisor.co.id/TypeAheadJson';

    protected $defaultParams = [
        'action'          => 'CDS',
        'types'           => 'hotel',
        'local'           => 'true',
        'hglt'            => false,
        'excludeoverview' => true,
        'query'           => '',
    ];

    public function __construct($params = [])
    {
        $this->init($params);
    }

    public function init($params = [])
    {
        foreach ($params as $key => $value) {
            if (in_array($key, $this->defaultParams)) {
                $this->defaultParams[$key] = $value;
            }
        }
    }

    public function search($query)
    {
        $this->defaultParams['query'] = $query;

        $request  = new Client();
        $response = $request->get($this->endpoint . http_build_query($this->defaultParams));

        return $response->getBody();
    }
}
