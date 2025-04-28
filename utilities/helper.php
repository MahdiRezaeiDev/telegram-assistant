<?php

/**
 * @param string $message is a message string containing information about the
 * particular goods part number which have to be extracted 
 */
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

    $mappedFinalCodes = array_map(function ($item) {
        $parts = explode(" ", $item);
        if (count($parts) >= 2) {
            $partOne = $parts[0];
            $partTwo = $parts[1];
            if (!preg_match('/[a-zA-Z]{4,}/i', $partOne) && !preg_match('/[a-zA-Z]{4,}/i', $partTwo)) {
                return $partOne . $partTwo;
            }
        }
        return $parts[0];
    }, $finalCodes);

    $nonConsecutiveCodes = array_filter($mappedFinalCodes, function ($item) {
        return !preg_match('/[a-zA-Z]{4,}/i', $item);
    });

    return implode("\n", array_map(function ($item) {
        return explode(" ", $item)[0];
    }, $nonConsecutiveCodes)) . "\n";
}


/**
 * @param object $MadelineProto
 * @param string $username
 */
function getProfilePicture($MadelineProto, $username)
{
    try {
        $info = $MadelineProto->getDownloadInfo($username) ?? false;
        print_r($info);
        $output_file_name = $MadelineProto->downloadToDir($info, './img/telegram');
        $url = explode('/', $output_file_name);
        return end($url);
    } catch (\Exception $e) {
        return 'images.png';
    }
}

/**
 * @param $MadelineProto
 * @param $data is the required data for sending message to the specific user
 */
function sendMessage($MadelineProto, $data)
{
    $receiver = $data['receiver'];
    $code = $data['code'];
    $price = $data['price'];

    $MadelineProto->messages->sendMessage(peer: $receiver, message: "$code  $price");
}

function sendMessageWithTemplate($MadelineProto, $receiver, $message)
{
    $MadelineProto->messages->sendMessage(peer: $receiver, message: "$message");
}

/**
 * @param $MadelineProto
 * @param $GroupLink
 * @param $CHAT_LIMIT
 * @param $lastMessageId
 */

function getMessages($MadelineProto, $GROPE_LINK, $CHAT_LIMIT, $lastReadMessageId)
{
    $messages = $MadelineProto->messages->getHistory([
        'peer' => $GROPE_LINK,
        'limit' => $CHAT_LIMIT,
        'min_id' => $lastReadMessageId,
    ]);
    return $messages;
}

/**
 * This function is used to get the last message id from the file
 */
function getLastReadMessageId($file)
{
    $index_file = fopen($file, 'r+');
    $message_index = fread($index_file, 1024);
    fclose($index_file);

    return intval($message_index) ?? 0;
}


/**
 * This function is used to update the last message if when ever new messages fetched from the group
 */
function updateLastReadMessageId($lastUnreadMessageId, $file)
{
    $index_file = fopen($file, 'r+');

    // Clear previous content and write new content
    ftruncate($index_file, 0); // Clear file content
    rewind($index_file); // Move pointer to the beginning of the file
    fwrite($index_file, $lastUnreadMessageId); // Write new content

    fclose($index_file);
    return true;
}


/**
 * this function receives a bunch of messages ang group them by the sender
 */
function getMessageBySender($MadelineProto, $messages)
{
    $messagesBySender = [];
    foreach ($messages['messages'] as $message) {
        // Check if the message is from a user (a person) and ignore system messages
        if (isset($message['from_id']) && $message['from_id'] > 0 && empty($message['action'])) {

            $senderInfo = $MadelineProto->getInfo($message['from_id']);

            $senderName = trim($senderInfo['User']['first_name']);
            $senderLastName = isset($senderInfo['User']['last_name']) ? trim($senderInfo['User']['last_name']) : '';
            $senderUseeID = $senderInfo['user_id'];

            // Construct the full name
            $fullName = $senderName . ($senderLastName !== '' ? ' ' . $senderLastName : '');

            // Check if the name already exists in the new array
            if (!isset($messagesBySender[$senderUseeID])) {
                $messagesBySender[$senderUseeID]['info'] = [];
                $messagesBySender[$senderUseeID]['name'] = [];
                $messagesBySender[$senderUseeID]['userName'] = [];
                $messagesBySender[$senderUseeID]['profile'] = [];
            }

            // Append the message to the array under the name key
            array_push($messagesBySender[$senderUseeID]['info'], ['code' => filterCode($message['message']), 'message' => $message['message'], 'date' => $message['date']]);
            array_push($messagesBySender[$senderUseeID]['name'],  $fullName);
            array_push($messagesBySender[$senderUseeID]['userName'],  $senderUseeID);
            array_push($messagesBySender[$senderUseeID]['profile'],  'images.png');
            // array_push($messagesBySender[$senderUseeID]['profile'],  getProfilePicture($MadelineProto, $senderUseeID));
        }
    }

    return $messagesBySender;
}



function getContacts($MadelineProto)
{
    $group_info = $MadelineProto->getPwrChat(GROPE_LINK);
    $users = $group_info['participants'];
    return array_column($users, 'user');
}
