<?php

class SessionHelper extends \Tina4\Data implements \Shopify\Auth\SessionStorage
{

    /**
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function storeSession(\Shopify\Auth\Session $session): bool
    {
        // TODO: Implement storeSession() method.
        file_put_contents("./sessions/{$session->getId()}", serialize($session));
        return true;

    }

    public function loadSession(string $sessionId)
    {
        // TODO: Implement loadSession() method.
        if (file_exists("./sessions/{$sessionId}")) {
            return unserialize(file_get_contents("./sessions/{$sessionId}"));
        }

        return null;
    }

    public function deleteSession(string $sessionId): bool
    {
        unlink("./sessions/{$sessionId}");
        return true;
    }

    public function getCookieData($shop): array
    {
        $cookies = (new Cookie())->select("*")->where("shop = ?", [$shop])->asArray();

        $result = [];
        foreach ($cookies as $cookie) {
            $result[$cookie["name"]] = $cookie["value"];
        }

        return $result;
    }
}