<?php

namespace Purwandi\Advisor;

use PHPHtmlParser\Dom;
use Purwandi\Advisor\Request;

class Widget
{
    /**
     * Create new widget api
     */
    public function __construct()
    {
        $this->request = new Request;
        $this->dom     = new Dom;
    }

    /**
     * Get trip advisor review
     *
     * @param  int $id
     * @return array
     */
    public function review($id)
    {
        $endpoint = 'https://www.tripadvisor.com/WidgetEmbed-cdsratingsonlynarrow';
        $params   = [
            'display'         => 'true',
            'locationId'      => $id,
            'lang'            => 'en_US',
            'display_version' => 2,
            'border'          => 'false',
        ];

        $response = $this->request->get($endpoint, $params);

        // Load the response result to parsing the dom element
        $this->dom->load($response);

        // Cek if trip advisor is available
        $cek = $this->dom->find('#WIDGET_ERR_IMAGE_LINK');

        if ($cek[0]) {
            return [
                'link'   => null,
                'src'    => null,
                'alt'    => null,
                'review' => null,
            ];
        }

        // Parsing and find element
        $img    = $this->dom->find('img')[1];
        $link   = $this->dom->find('#CDSLOCINNER')[0]->getAttribute('href');
        $review = $this->dom->find('span')[0]->text;

        return [
            'link'   => $link,
            'src'    => $img->getAttribute('src'),
            'alt'    => $img->getAttribute('alt'),
            'review' => trim($review),
        ];
    }
}
