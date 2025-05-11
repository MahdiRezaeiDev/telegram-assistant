<?php

use danog\MadelineProto\API;
use danog\MadelineProto\Exception;

define('DIR', __DIR__);

require_once(DIR . '/vendor/autoload.php');
require_once(DIR . '/config/constants.php');
require_once(DIR . '/database/DB_connect.php');
require_once(DIR . '/utilities/helper.php');

$messages = getMessages();
$accounts = getAccounts();

foreach ($accounts as $account) {
    $sessionName = DIR . '/views/telegram/' . $account['session_name'];
    $MadelineProto = new API($sessionName);
    $MadelineProto->start();

    $MadelineProto->messages->sendMessage([
        'peer' => $MadelineProto->getSelf(),
        'message' => 'HI',
    ]);
}


function getMessages()
{
    $stmt = DB->prepare("SELECT * FROM incoming WHERE is_resolved = 0");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAccounts()
{
    $stmt = DB->prepare("SELECT * FROM telegram_credentials WHERE is_connected = 1;");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function filterCode($message)
{
    if (empty($message)) {
        return "";
    }

    $codes = explode("\n", $message);

    $filteredCodes = array_map(function ($code) {
        $code = preg_replace('/\[[^\]]*\]/', '', $code);

        $parts = preg_split('/[:,]/', $code, 2);

        if (!empty($parts[1]) && strpos($parts[1], "/") !== false) {
            $parts[1] = explode("/", $parts[1])[0];
        }

        $rightSide = trim(preg_replace('/[^a-zA-Z0-9 ]/', '', $parts[1] ?? ''));

        return $rightSide ? $rightSide : trim(preg_replace('/[^a-zA-Z0-9 ]/', '', $code));
    }, $codes);

    $finalCodes = array_filter($filteredCodes, function ($item) {
        $data = explode(" ", $item);
        return strlen($data[0]) > 4;
    });
    return $finalCodes;
}
