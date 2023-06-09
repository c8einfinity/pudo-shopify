<?php

\Tina4\Get::add("/settings", function(\Tina4\Response $response, \Tina4\Request $request) {

    return $response(\Tina4\renderTemplate("admin/settings.twig", (new ShopifyHelper())->getSessionData($request)));
});