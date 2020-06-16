<?php

use VK\Client\VKApiClient;
use VK\OAuth\Scopes\VKOAuthUserScope;
use VK\OAuth\VKOAuth;
use VK\OAuth\VKOAuthDisplay;
use VK\OAuth\VKOAuthResponseType;

require_once '../vendor/autoload.php';


$vk = new VKApiClient();
$access_token = "ba57e9d1ba57e9d1ba57e9d12fba259b05bba57ba57e9d1e48d4777fa2da2c985fac452";
$group_access_token = "150a2c1c9a257bc301c859c824ebcefaf960fa1c3123e93b66b77121c6f29d18ea789592a091848e0a782";


$response = $vk->users()->get($access_token, array(
    'user_ids' => array(1, 249852530),
    'fields' => array('city', 'photo'),
));

//249852530 tihon 160492927 me -92337511 amdevs -175146284 treasure -125980899 bred -116499645 enciar -131069024 cinemaElite -32041317 9gag -169385748 femaleM

$response = $vk->wall()->get($access_token, array(
    'owner_id' => -169385748,
    'offset' => 0,
    'count' => 100,
));

//print_r($response);
//print($response['items']['0']['attachments']['0']['photo']['sizes']['9']['url']);
/*
$oauth = new VKOAuth();
$client_id = 7500500;
$redirect_uri = 'https://example.com/vk';
$display = VKOAuthDisplay::PAGE;
$scope = array(VKOAuthUserScope::WALL, VKOAuthUserScope::GROUPS);
$state = 'secret_state_code';

$browser_url = $oauth->getAuthorizeUrl(VKOAuthResponseType::CODE, $client_id, $redirect_uri, $display, $scope, $state);
*/
$c = 0;
$c1 = 0;
$myfile = fopen('C:\Users\User\Documents\memePicks\female/header.txt', "w");
foreach ($response['items'] as $item) {
    fwrite($myfile, $c . " " . $item['text'] . "\n");
    $c++;
    if (!in_array('attachments', $item)) continue;
    $c1 = 0;
    foreach ($item['attachments'] as $attachment) {
        $c1++;
        if ($attachment['type'] == 'photo') {
            $ch = curl_init($item['attachments']['0']['photo']['sizes']['7']['url']);
            $fp = fopen('C:\Users\User\Documents\memePicks\female/' . $c . '_' . $c1 . '.jpeg', 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
        }
    }
}
fclose($myfile);

