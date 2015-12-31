<?php

namespace Purwandi\Advisor;

class Request
{
    /**
     * The response result
     *
     * @var string
     */
    protected $body;

    /**
     * Fake Rereferer request.
     *
     * @var string
     */
    protected $referer = 'https://www.tripadvisor.com';

    /**
     * Make Request api
     */
    public function __construct()
    {
        $this->request = curl_init();
    }

    /**
     * Send get request
     *
     * @param  string $url
     * @param  array  $data
     * @return void
     */
    public function get($url, array $data = [])
    {
        curl_setopt($this->request, CURLOPT_URL, $url . '?' . http_build_query($data));
        curl_setopt($this->request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->request, CURLOPT_SSL_VERIFYPEER, 'true');
        curl_setopt($this->request, CURLOPT_REFERER, $this->referer);
        curl_setopt($this->request, CURLOPT_CONNECTTIMEOUT, 5);

        $this->body = curl_exec($this->request);

        curl_close($this->request);

        if ($this->body == false) {
            $error = curl_error($this->request);
            throw new \Exception('Error retrieving "' . $url . '" (' . $error . ')');
        }

        return $this->body;
    }
}
