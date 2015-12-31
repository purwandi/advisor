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
     * Set random user agent to avoid blocking
     *
     * @var array
     */
    protected $agents = [

        // Google chrome desktop
        'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.1 Safari/537.36',
        'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36',

        // Camino
        'Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; XH; rv:8.578.498) fr, Gecko/20121021 Camino/8.723+ (Firefox compatible)',
        'Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; XH; rv:8.578.498) fr, Gecko/20121021 Camino/8.443+ (Firefox compatible)',

        // Firefox
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:42.0) Gecko/20100101 Firefox/42.0',
        'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1',
        'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0',

        // Flock
        'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_6; en-US) AppleWebKit/534.7 (KHTML, like Gecko) Flock/3.5.3.4628 Chrome/7.0.517.450 Safari/534.7',
        'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.7 (KHTML, like Gecko) Flock/3.5.2.4599 Chrome/7.0.517.442 Safari/534.7',
        'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/534.7 (KHTML, like Gecko) Flock/3.5.2.4599 Chrome/7.0.517.442 Safari/534.7',
        'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_5; en-US) AppleWebKit/534.7 (KHTML, like Gecko) Flock/3.5.0.4568 Chrome/7.0.517.440 Safari/534.7',

        // Opera
        'Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16',
        'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14',
        'Mozilla/5.0 (Windows NT 6.0; rv:2.0) Gecko/20100101 Firefox/4.0 Opera 12.14',
        'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.0) Opera 12.14',

        // Safari
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A',
        'Mozilla/5.0 (iPad; CPU OS 6_0 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A5355d Safari/8536.25',
        'Mozilla/5.0 (Windows; U; Windows NT 6.1; tr-TR) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27',
    ];

    /**
     * Make header request completely legit
     *
     * @var array
     */
    protected $headers = [
        'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7',
        'Accept-Language:id,en-US;q=0.8,en;q=0.6',
        'Cache-Control: max-age=0',
        'Connection: keep-alive',
        'Keep-Alive: 300',
        'Pragma: ',
    ];

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
        curl_setopt($this->request, CURLOPT_USERAGENT, $this->agents[array_rand($this->agents)]);
        curl_setopt($this->request, CURLOPT_HTTPHEADER, $this->headers);

        $this->body = curl_exec($this->request);

        curl_close($this->request);

        if ($this->body == false) {
            $error = curl_error($this->request);
            throw new \Exception('Error retrieving "' . $url . '" (' . $error . ')');
        }

        return $this->body;
    }
}
