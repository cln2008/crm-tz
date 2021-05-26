<?php


namespace App\CRM;

use GuzzleHttp\Client;

class CRMClient
{

    protected $baseUrl = "https://companydomain.pipedrive.com/api/v1/";
    protected $apiKey = "7681373f61673412b1f2d664fd54492134541f95";
    protected $entity;
    protected $client;
    protected $reqUrl;


    public function setEntity($entity)
    {
        $this->entity = $entity;
        return $this;
    }

    public function setRequestUrl()
    {
        $this->reqUrl = $this->baseUrl . $this->entity . "/";
        return $this;
    }

    private function clear()
    {
        $this->entity = null;
        $this->client = null;
        $this->reqUrl = null;
    }

    public function get()
    {
        try {
            $r = (new Client(['verify' => false,]))->request('GET', $this->reqUrl, [
                'query' => [
                    'api_token' => $this->apiKey,
                ],

                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Accept-encoding' => "*",
                    'Connection' => 'keep-alive',
                ],
            ]);

            $resp = (string)$r->getBody();
            $responce = json_decode($resp, true);

        } catch (Exception $e) {
            $responce = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];

        }

        $this->clear();
        return $responce;
    }
}