<?php

namespace App\Services;

use GuzzleHttp\Client;

class CommonEssentialService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * AkunService constructor.
     */
    public function __construct()
    {
        $baseUrl = env('API_COMMON_ESSENTIAL');

        $this->client = new Client([
            'base_uri' => $baseUrl,
            'headers' => [
                'X-Header-Service' => 'common-essential',
                'Accept'     => 'application/json',
            ]
        ]);
    }

    public function getHakAksesMenu($userId) {
        $response = $this->client->get('/hak-akses-menu/' . $userId);

        if ($response->getStatusCode() != 500) {
            $body = json_decode((string)$response->getBody());
            return $body->data; 
        } 
        else return NULL;
    }
}
