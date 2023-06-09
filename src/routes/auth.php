<?php

\Tina4\Get::add ("/login", function(\Tina4\Response $response, \Tina4\Request $request) {
    $url = \Shopify\Auth\OAuth::begin($request->params["shop"], "/auth/callback", "0", function(Shopify\Auth\OAuthCookie $cookie) use ($request) {
        $cookieData = new Cookie();
        $cookieData->name = $cookie->getName();
        $cookieData->value = $cookie->getValue();
        $cookieData->shop = $request->params["shop"];
        $cookieData->expires = $cookie->getExpire();
        $cookieData->save();
        return true;
    } );
    \Tina4\redirect($url);
});


\Tina4\Get::add ("/auth/callback", function(\Tina4\Response $response, \Tina4\Request $request) {
    if (!isset($request->params["shop"])) {
        return $response("No access", HTTP_FORBIDDEN);
    }

    $cookieData = (new SessionHelper())->getCookieData($request->params["shop"]);

    $session = Shopify\Auth\OAuth::callback($cookieData, $request->params);

    $loadedSession = \Shopify\Context::$SESSION_STORAGE->loadSession($session->getId());

    $sessionData = new Session();
    $sessionData->shop = $loadedSession->getShop();
    $sessionData->sessionData = json_encode(["accessToken" => $loadedSession->getAccessToken(), "scope" => $loadedSession->getScope(), "id" => $loadedSession->getId(), "expires" => $loadedSession->getExpires()]);
    $sessionData->save();


    (new ShopifyHelper())->registerHandlers($loadedSession->getShop(), $loadedSession->getAccessToken());

    //redirect here to store
   \Tina4\redirect("https://{$request->params["shop"]}");
});

