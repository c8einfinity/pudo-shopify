<?php

\Tina4\Get::add("/settings", function(\Tina4\Response $response, \Tina4\Request $request) {
    $services = (new ShopifyHelper())->getCarrierServices($request);

    $pudoShopSettings = new PudoShopSettings();
    $pudoShopSettings->load("shop = ?", [$request->params["shop"]]);

    return $response(\Tina4\renderTemplate("admin/settings.twig", array_merge(["pudoShopSettings" => $pudoShopSettings], (new ShopifyHelper())->getSessionData($request))));
});


\Tina4\Post::add("/settings", function(\Tina4\Response $response, \Tina4\Request $request) {
    $pudoShopSettings = new PudoShopSettings($request->data);
    $pudoShopSettings->load("shop = ?", [$request->data->shop]);

    if (!$pudoShopSettings->save()) {
        \Tina4\redirect("/settings?message=Saved Settings&shop={$request->data->shop}");
    } else {
        \Tina4\redirect("/settings?error=Could not save settings&shop={$request->data->shop}");
    }
});