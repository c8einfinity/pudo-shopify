<?php

class PudoApi extends \Tina4\Api
{
    public $baseURL = "https://pudo...";

    function getCarriers()
    {
        return $this->sendRequest("/carriers");
    }

}