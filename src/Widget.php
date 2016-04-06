<?php

namespace Purwandi\Advisor;

use Purwandi\Advisor\Request;

class Widget
{

    protected $key;

    /**
     * Create new widget api
     */
    public function __construct($key)
    {
        $this->request = new Request;
        $this->key     = $key;
    }

    /**
     * Get trip advisor review
     *
     * @param  int $id
     * @return array
     */
    public function hotel($id)
    {
        $endpoint = 'http://api.tripadvisor.com/api/partner/2.0/location/' . $id;
        return $this->request->get($endpoint, ['key' => $this->key]);
    }

    /**
     * Get review widget
     *
     * @param  int $id
     * @return string
     */
    public function review($id)
    {
        return '<iframe src="https://www.tripadvisor.co.id/WidgetEmbed-cdspropertydetail?locationId=' . $id . '&lang=en&partnerId=' . $this->key . '&isTA=&format=html&display=true" width="100%" height=800 name=tripadvisor-rating scrolling=auto frameborder=no></iframe>';
    }
}
