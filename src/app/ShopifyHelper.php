<?php

use Psr\Http\Client\ClientExceptionInterface;
use Shopify\Clients\Rest;
use Shopify\Exception\MissingArgumentException;
use Shopify\Exception\UninitializedContextException;
use Shopify\Exception\WebhookRegistrationException;
use Shopify\Webhooks\Registry;
use Shopify\Webhooks\Topics;


class ShopifyHelper
{
    private array $REGISTERED_HANDLERS = [Shopify\Webhooks\Topics::APP_UNINSTALLED, Shopify\Webhooks\Topics::CARTS_CREATE, Shopify\Webhooks\Topics::CARTS_UPDATE, Shopify\Webhooks\Topics::ORDERS_CREATE, Shopify\Webhooks\Topics::ORDERS_UPDATED, Shopify\Webhooks\Topics::ORDERS_CANCELLED];


    /**
     * Gets the rest client for shopify
     * @param $request
     * @return Rest
     * @throws ReflectionException
     * @throws MissingArgumentException
     */
    private function getRestClient($request): Rest
    {

        $sessionData = $this->getSessionData($request);



        if (isset($sessionData["accessToken"])) {
            $session = $sessionData["accessToken"];
            return new Rest($session->shop, $session->accessToken);
        } else {
            die("Something is incredibly wrong, please contact support");
        }
    }


    /**
     * This is where we add all the handlers for the webhooks we want to listen to.
     * @return void
     */
    function addHandlers(): void
    {
        foreach ($this->REGISTERED_HANDLERS as $handler) {
            Registry::addHandler($handler, new GenericHandler());
        }
    }

    /**
     * Register handlers
     * @param $shop
     * @param $accessToken
     * @return void
     * @throws ClientExceptionInterface
     * @throws \Shopify\Exception\InvalidArgumentException
     * @throws UninitializedContextException
     * @throws WebhookRegistrationException
     */
    function registerHandlers($shop, $accessToken): void
    {
        foreach ($this->REGISTERED_HANDLERS as $handler) {
            $response = Shopify\Webhooks\Registry::register(
                '/shopify/webhooks',
                $handler,
                $shop,
                $accessToken
            );

            if ($response->isSuccess()) {
                // Webhook registered!
                \Tina4\Debug::message("Webhook registration succeeded for:".$handler , TINA4_LOG_ALERT);
            } else {
                \Tina4\Debug::message("Webhook registration failed with response: \n" . var_export($response, true), TINA4_LOG_ERROR);
            }
        }
    }

    /**
     * Gets the session data needed for the twig template
     * @param $request
     * @return array
     * @throws ReflectionException
     */
    function getSessionData($request) : array
    {

        if (!isset($request->params["shop"]) || !isset($request->data->shop)) {
            return [];
        }

        //Fetch the session data from the database

        $sessionData = (new Session())->select("*")->where("shop = ?", [$request->params["shop"] ?? $request->data->shop ])->asArray();

        if (empty($sessionData)) {
            return [];
        }

        $accessToken = json_decode($sessionData[0]["sessionData"]);

        return ["accessToken" => $accessToken, "env" => $_ENV];
    }

    /**
     * Removes store session and cookie
     * @param string $shop
     * @return bool
     * @throws Exception
     */
    public function removeShop(string $shop): bool
    {
        (new Session())->delete("shop = ?", [$shop]);
        (new Cookie())->delete("shop = ?", [$shop]);
        return true;
    }

    /**
     * Gets the carrier services for the store
     * @param $request
     * @return mixed
     * @throws ReflectionException
     * @throws ClientExceptionInterface
     * @throws MissingArgumentException
     * @throws UninitializedContextException|JsonException
     */
    public function getCarrierServices ($request): array
    {
        $client = $this->getRestClient($request);

        $response = $client->get('carrier_services');

        return $response->getDecodedBody()["carrier_services"];
    }

    /**
     * Creates a carrier service
     * @param $request
     * @param array $data
     * @return array
     * @throws JsonException
     * @throws ClientExceptionInterface
     * @throws UninitializedContextException
     */
    public function createCarrierService($request, array $data)
    {

        $response = [];
        try {
            $client = $this->getRestClient($request);

            $response = $client->post('carrier_services', $data);

            print_r ($response->getHeaders());

            return $response->getDecodedBody();
        } catch (ReflectionException|MissingArgumentException $e) {
            \Tina4\Debug::message($e->getMessage(), TINA4_LOG_ERROR);
        }

        return $response;

    }

    /**
     * Gets the shopify url
     * @param $url
     * @param $shop
     * @return string
     */
    public function getShopifyUrl($url, $shop) : string
    {
        return $url."?shop=".$shop;
    }

}