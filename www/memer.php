<?php

use VK\Client\VKApiClient;

require_once '../vendor/autoload.php';

$vk = new VKApiClient();
$access_token = "";
$group_access_token = "";

$rus_groups = [
    0 => -175146284,
    1 => -92337511,
    2 => -125980899,
    3 => -116499645,
    4 => -131069024,
    5 => -33494375
];
$eng_groups = [
    0 => -32041317
];

function downloadPost($rus_groups, $access_token, $vk, $c)
{
    $response = $vk->wall()->get($access_token, array(
        'owner_id' => $rus_groups[random_int(0, 5)],
        'offset' => 0,
        'count' => 100,
    ));

    $myfile = fopen('C:\Users\User\Documents\memePicks\processing/header.txt', "w");
    $repeat = true;
    while ($repeat){
        $item = $response['items'][random_int(0,99)];
        if (!in_array('attachments', $item) || $item['marked_as_ads'] != 0) continue;
        foreach ($item['attachments'] as $attachment) {
            if ($attachment['type'] == 'photo') {
                $repeat = false;
                fwrite($myfile, $c . " " . $item['text'] . "\n");
                $ch = curl_init($item['attachments']['0']['photo']['sizes']['7']['url']);
                $fp = fopen('C:\Users\User\Documents\memePicks\processing/' . $c . '.jpg', 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_exec($ch);
                curl_close($ch);
                fclose($fp);
            }
        }
    }
}

$c = 0;

downloadPost($rus_groups, $access_token, $vk, $c);
$c++;
downloadPost($rus_groups, $access_token, $vk, $c);

shell_exec("");

