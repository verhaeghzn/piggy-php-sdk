# Piggy PHP SDK #
With [Piggy's](https://www.piggy.eu/) all-in-one platform you can strengthen loyalty and automate every step. From reward programs, to branded giftcards and smart email marketing - Piggy takes care of it all. 

## Setup ##

<b>Composer:</b>

```composer require "piggy/piggy-php-sdk"```

## Quickstart ##

<b>Example with Register Client</b>
```
$apiKey = 'xxxx-xxxx-xxxx';

$client = new Piggy\Api\RegisterClient($apiKey);
```

<b>Example with OAuth Client</b>
```
$clientId = 'xxxx';
$clientSecret = 'xxxxxxxxxxx';

$client = new Piggy\Api\OAuthClient($clientId, $clientSecret);

$access_token = $client->getAccessToken();    

$client->setAccessToken($access_token);
```