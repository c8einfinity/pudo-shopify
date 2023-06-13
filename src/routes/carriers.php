<?php


\Tina4\Post::add("/carriers/activate", function (\Tina4\Response $response, \Tina4\Request $request) {
    $carriers = (new ShopifyHelper())->getCarrierServices($request);

    if (empty($carriers)) {
        //Create Carrier Service
        $data = ["carrier_service" => [
            "name" => "Pudo Shipping Provider",
            "callback_url" => $_ENV['SHOPIFY_APP_HOST_NAME'] . "/carriers/pudo/rates",
            "service_discovery" => "true"]
        ];

        $response = (new ShopifyHelper())->createCarrierService($request, $data);

        //@todo what was the response ?
        \Tina4\redirect("/?message=Carrier service added&shop={$request->data->shop}");
    } else {
        \Tina4\redirect("/?message=Carrier service already exists&shop={$request->data->shop}");
    }
});


\Tina4\Post::add("/carriers/de-activate", function (\Tina4\Response $response, \Tina4\Request $request) {
    $carriers = (new ShopifyHelper())->getCarrierServices($request);

    if (!empty($carriers)) {
        //Create Carrier Service
        $data = ["id" => $carriers[0]["id"]];

        $response = (new ShopifyHelper())->deleteCarrierService($request, $data);

        //@todo what was the response ?
        \Tina4\redirect("/?message=Carrier service deleted&shop={$request->data->shop}");
    } else {
        \Tina4\redirect("/?message=Carrier service could not be removed&shop={$request->data->shop}");
    }
});

\Tina4\Get::add("/carriers/pudo/rates", function(\Tina4\Response $response, \Tina4\Request $request){


    //return back carrier information
});
