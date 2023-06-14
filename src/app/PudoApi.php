<?php

class PudoApi extends \Tina4\Api
{
    public $baseURL = "https://pudo...";

    function getLockers()
    {
        return $this->sendRequest("/carriers");
    }

}