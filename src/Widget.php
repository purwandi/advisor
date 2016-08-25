<?php

namespace Purwandi\Advisor;

use Purwandi\Advisor\Request;

class Widget
{
    protected $key;
    protected $partner;

    /**
     * Create new widget api
     */
    public function __construct($key, $partner)
    {
        $this->request = new Request;
        $this->key     = $key;
        $this->partner = $partner;
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
        $response = $this->request->get($endpoint, ['key' => $this->key]);

        return json_decode($response);
    }

    /**
     * Get summary widget
     *
     * @param  int $id
     * @return string
     */
    public function summary($id)
    {
        return '<iframe src="https://www.tripadvisor.co.id/WidgetEmbed-cdspropertysummary?locationId=' . $id . '&partnerId=' . $this->partner . '&display=true" width="100%" height=800 name=tripadvisor-rating scrolling=auto frameborder=no></iframe>';
    }

    /**
     * Get review widget
     *
     * @param  int $id
     * @return string
     */
    public function review($id)
    {
        return '<iframe src="https://www.tripadvisor.co.id/WidgetEmbed-cdspropertydetail?locationId=' . $id . '&lang=en&partnerId=' . $this->partner . '&isTA=&format=html&display=true" width="100%" height=800 name=tripadvisor-rating scrolling=auto frameborder=no></iframe>';
    }
}
