<?php

namespace App\Service;

use JsonException;
use pCloud\Sdk\App;
use pCloud\Sdk\Config;
use pCloud\Sdk\Curl;
use pCloud\Sdk\Exception;
use pCloud\Sdk\Request;

class PCloudApi
{
    public App $api;

    private string $userId;

    private string $password;

    private string $clientId;

    private string $clientSecret;

    private string $accessToken;

    public function __construct(string $userId, string $password, string $clientId, string $clientSecret, string $accessToken)
    {
        $this->userId = $userId;

        $this->password = $password;

        $this->clientId = $clientId;

        $this->clientSecret = $clientSecret;

        $this->accessToken = $accessToken;

        $this->api = new App();
        $this->api->setLocationId(2);
        $this->api->setAccessToken($this->accessToken);
        $this->api->setAppKey($this->clientId);
        $this->api->setAppSecret($this->clientSecret);
    }

//
//    /**
//     * @throws Exception
//     * @throws JsonException
//     */
//    public function listFolder(string $path, $folderId = null): array
//    {
//        $params = ($folderId !== null) ? ['folderId' => $folderId] : ['path' => $path];
//        return $this->runCurl('listfolder', $params);
//    }
//
//    /**
//     * @throws Exception
//     * @throws JsonException
//     */
//    private function runCurl(string $method, array $params): array
//    {
//        $defaults = [
//            "username" => $this->userId,
//            "password" => $this->password,
//        ];
//
//        $url = "https://eapi.pcloud.com/$method?" . http_build_query(array_merge($defaults, $params));
//
//        $curlConn = new Curl($url);
//        $curlConn->setOption(CURLOPT_USERAGENT, "pCloud PHP SDK");
//        $curlConn->setOption(CURLOPT_SSL_VERIFYPEER, false);
//        $curlConn->setOption(CURLOPT_RETURNTRANSFER, true);
//        $curlConn->setOption(CURLOPT_CONNECTTIMEOUT, 20);
//        $curlConn->setOption(CURLOPT_TIMEOUT, 3600);
//
//        return json_decode(json_encode($curlConn->exec(), JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
//    }


}
