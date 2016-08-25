<?php

namespace Purwandi\Advisor;

use Purwandi\Advisor\Suggest;

class Tripadvisor
{
    protected $key;
    protected $partner;

    public function __construct($key, $partner)
    {
        $this->key     = $key;
        $this->partner = $partner;
    }

    public function suggest()
    {
        return new Suggest;
    }

    public function widget()
    {
        return new Widget($this->key, $this->partner);
    }
}
