<?php

namespace Purwandi\Advisor;

use Purwandi\Advisor\Suggest;

class Tripadvisor
{
    protected $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function suggest()
    {
        return new Suggest;
    }

    public function widget()
    {
        return new Widget($this->key);
    }
}
