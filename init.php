<?php
header('Access-Control-Allow-Origin: *'); // Allow requests from any origin

// Other headers to allow various types of requests
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Headers: Content-Type, x-requested-with');



require_once 'vendor/autoload.php';
require_once './utilities/helper.php';

use danog\MadelineProto\API;

$MadelineProto = new API('bot.madeline');

define('BOT', $MadelineProto);
// Works OK with both bots and user bots
$MadelineProto->start();
