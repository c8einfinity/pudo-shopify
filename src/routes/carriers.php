<?php


\Tina4\Post::add("/carriers/activate", function (\Tina4\Response $response, \Tina4\Request $request) {

    $carriers = (new ShopifyHelper())->getCarrierServices($request);

    if (empty($carriers)) {
        //Create Carrier Service
        $data = array("carrier_service" => array(
            "name" => "Pudo Shipping Provider",
            "callback_url" => $_ENV['SHOPIFY_APP_HOST_NAME'] . "/pudo-rates",
            "service_discovery" => "true")
        );

        $response = (new ShopifyHelper())->createCarrierService($request, $data);

        //@todo what was the response ?
        \Tina4\redirect("/?message=Carrier service added&shop={$request->data->shop}");
    } else {
        \Tina4\redirect("/?message=Carrier service already exists&shop={$request->data->shop}");
    }

});