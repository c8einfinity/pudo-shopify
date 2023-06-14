<?php

\Tina4\Get::add("/settings", function(\Tina4\Response $response, \Tina4\Request $request) {
    $services = (new ShopifyHelper())->getCarrierServices($request);

    $pudoShopSettings = new PudoShopSettings();
    $pudoShopSettings->load("shop = ?", [$request->params["shop"]]);


    $lockers = (new PudoApi($pudoShopSettings->pudoApiKey, $pudoShopSettings->testMode))->getLockers();


    sort($lockers);

    return $response(\Tina4\renderTemplate("admin/settings.twig", array_merge(["pudoShopSettings" => $pudoShopSettings, "lockers" => $lockers, "options" => ["Locker", "Street"]], (new ShopifyHelper())->getSessionData($request))));
});


\Tina4\Post::add("/settings", function(\Tina4\Response $response, \Tina4\Request $request) {
    $pudoShopSettings = new PudoShopSettings($request->data);
    $pudoShopSettings->load("shop = ?", [$request->data->shop]);

    if ($pudoShopSettings->save()) {
        \Tina4\redirect("/settings?message=Saved Settings&shop={$request->data->shop}");
    } else {
        \Tina4\redirect("/settings?error=Could not save settings&shop={$request->data->shop}");
    }
});

\Tina4\Get::add("/settings/lockers", function(\Tina4\Response $response, \Tina4\Request $request){
    $filter = $request->params["filter"];
    $pudoShopSettings = new PudoShopSettings();
    $pudoShopSettings->load("shop = ?", [$request->params["shop"]]);

    $lockers = (new PudoApi($pudoShopSettings->pudoApiKey, $pudoShopSettings->testMode))->getLockers();

    $filteredArray = [];
    foreach ($lockers as $id => $locker)
    {
        if (strpos(strtolower($locker["name"]), strtolower($filter)) !== false) {
            $filteredArray[] = $locker;
        }
    }

    return $response($filteredArray, HTTP_OK);
});