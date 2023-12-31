<?php

\Tina4\Get::add ("/", function(\Tina4\Response $response, \Tina4\Request $request) {
    if (isset($request->server["HTTP_REFERER"]) && $request->server["HTTP_REFERER"] === "https://partners.shopify.com/") {
        $url = \Shopify\Auth\OAuth::begin($request->params["shop"], "/auth/callback", "0", function (Shopify\Auth\OAuthCookie $cookie) use ($request) {
            $cookieData = new Cookie();
            $cookieData->name = $cookie->getName();
            $cookieData->value = $cookie->getValue();
            $cookieData->shop = $request->params["shop"];
            $cookieData->expires = $cookie->getExpire();
            $cookieData->save();
            setcookie($cookie->getName(), $cookie->getValue(), $cookie->getExpire());
            return true;
        });

        \Tina4\redirect($url);
    }

    if (!isset($request->params["shop"]) || !isset($request->data->shop)) {
        return $response("No access", HTTP_FORBIDDEN);
    }

    $carriers = (new ShopifyHelper())->getCarrierServices($request);

    return $response(\Tina4\renderTemplate("admin/admin.twig", array_merge(["carriers" => $carriers],  (new ShopifyHelper())->getSessionData($request))));
});