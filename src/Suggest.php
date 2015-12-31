<?php

namespace Purwandi\Advisor;

use Purwandi\Advisor\Request;

class Suggest
{
    /**
     * The api endpoint
     *
     * @var string
     */
    protected $endpoint = 'https://www.tripadvisor.co.id/TypeAheadJson';

    /**
     * The dafault parameters request
     *
     * @var array
     */
    protected $params = [
        'action'          => 'CDS',
        'types'           => 'hotel',
        'local'           => 'true',
        'hglt'            => 'false',
        'excludeoverview' => 'true',
        'query'           => '',
    ];

    /**
     * Make suggest class
     */
    public function __construct()
    {
        $this->request = new Request;
    }

    /**
     * Run search
     *
     * @param  string $query
     * @return json
     */
    public function search($query)
    {
        $this->params['query'] = $query;
        return $this->request->get($this->endpoint, $this->params);
    }
}
