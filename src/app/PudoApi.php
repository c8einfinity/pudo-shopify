<?php

class PudoApi extends \Tina4\Api
{
    public $baseURL = "";
    public $apiKey = "";
    public $testMode = True;
    public $baseURLTest = "https://ksttcgfunctionsv3-dev.azurewebsites.net/api/";


    function __construct($apiKey="", $testMode=True,?string $baseURL = "", string $authHeader = "")
    {
        parent::__construct($baseURL, $authHeader);
        $this->apiKey = $apiKey;
        $this->testMode = $testMode;
    }


    function checkTestMode()
    {
        \Tina4\Debug::message("!!!!PUDO API IS IN TEST MODE!!!!", TINA4_LOG_ALERT);
        if ($this->testMode) {
            $this->baseURL = $this->baseURLTest;
        }
    }

    function getLockers()
    {
        $this->checkTestMode();
        $lockerEndPoint = "tcg/terminal/get/all?code=".$this->apiKey;
        $result = $this->sendRequest($lockerEndPoint, "GET");
        if (empty($result->error)) {
            return $result["body"];
        } else {
            return ["error" => $result["error"]];
        }
    }

}