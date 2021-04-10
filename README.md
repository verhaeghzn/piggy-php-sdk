# Piggy PHP SDK #
With [Piggy's](https://www.piggy.eu/) all-in-one platform you can strengthen loyalty and automate every step. From reward programs, to branded giftcards and smart email marketing - Piggy takes care of it all. 

## Setup ##

**Composer:**

    composer require "piggy/piggy-php-sdk"

## Quickstart ##

**Example with Register Client**
    
    $apiKey = 'xxxx-xxxx-xxxx';
    $client = new Piggy\Api\RegisterClient($apiKey);
   
**Example with OAuth Client**

    $clientId = 'xxxx';
    $clientSecret = 'xxx-xxxxxxx';
    
    $client = new Piggy\Api\OAuthClient($clientId, $clientSecret);
    
    $access_token = $client->getAccessToken();    
    
    $client->setAccessToken($access_token);