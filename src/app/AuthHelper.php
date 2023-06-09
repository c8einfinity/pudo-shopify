<?php

class AuthHelper extends \Tina4\Auth
{
    function validToken(string $token, string $publicKey = "", string $encryption = \Nowakowskir\JWT\JWT::ALGORITHM_RS256): bool
    {
        //we will rely on shopify to validate the token
        return true;
    }
}