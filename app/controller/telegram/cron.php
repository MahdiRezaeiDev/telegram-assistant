<?php

use danog\MadelineProto\API;

define('DIR', __DIR__);

require_once './../../vendor/autoload.php';
require_once './../../config/constants.php';
require_once './../../database/DB_connect.php';
require_once './../../utilities/helper.php';

$messages = getMessages();
$accounts = getAccounts();

$defaultMessageCache = []; // cache for user default messages
foreach ($accounts as $account) {


    // $sessionName = getAccountSession($account['user_id']);

    $sessionName = getAccountSession($account['user_id']);
    $sessionPath = $sessionDir . '/' . $sessionName;
    $sessionConnectionFile = $sessionPath . '/safe.php';

    // Redirect if session is missing
    if (!file_exists($sessionConnectionFile)) {
        continue;
    }
    // ⚠️ Handle possible corrupted sessions
    try {
        $MadelineProto = new API($sessionPath);
        $MadelineProto->start();

        $user = $MadelineProto->getSelf();
        if (!isset($user['_']) || $user['_'] !== 'user') {
            throw new \Exception("Invalid session type.");
        }
    } catch (\Throwable $e) {
        error_log("MadelineProto Error: " . $e->getMessage());
        continue;
    }

    $self = $MadelineProto->getSelf();
    $myId = $self['id'];

    foreach ($messages as $message) {
        if ($message['sender'] == $myId) {
            continue; // skip self messages
        }

        if (!isValidContact($message['sender'], $account['user_id'])) {
            continue; // skip blocked or invalid contacts
        }

        $codes = filterCode($message['message']);
        if (empty($codes)) {
            continue; // skip if no valid codes found
        }

        $template = '';
        foreach ($codes as $code) {
            $code = strtoupper(trim($code));
            $goodSpecification = isCodeExist($code, $account['user_id']);
            if (empty($goodSpecification)) {
                continue;
            }

            if (!empty($goodSpecification['without_price'])) {
                $template .= "$code : " . getUserDefaultMessage($account['user_id']) . "\n";
            } else {
                $template .= "$code : " . $goodSpecification['price'] . " " . $goodSpecification['brand'] . "\n";
            }
        }

        if (!empty($template)) {
            $template = trim($template);

            try {
                $MadelineProto->messages->sendMessage([
                    'peer' => $message['sender'],
                    'message' => $template
                ]);

                markAsResolved($message['id']);
                saveGivenPrice($message['sender'], $template, $account['user_id']);
            } catch (\Throwable $th) {
                $phone = getPhoneNumber($message['sender'], $account['user_id']);

                if ($phone !== 'undefined') {
                    try {
                        $MadelineProto->contacts->importContacts([
                            'contacts' => [[
                                '_' => 'inputPhoneContact',
                                'client_id' => 0,
                                'phone' => $phone,
                                'first_name' => 'Unknown',
                                'last_name' => ''
                            ]]
                        ]);

                        // Retry after importing contact
                        $MadelineProto->messages->sendMessage([
                            'peer' => $message['sender'],
                            'message' => $template
                        ]);

                        markAsResolved($message['id']);
                        saveGivenPrice($message['sender'], $template, $account['user_id']);
                    } catch (\Throwable $innerTh) {
                        echo "❌ Failed after import for sender {$message['sender']}: " . htmlspecialchars($innerTh->getMessage()) . "\n";
                        continue;
                    }
                } else {
                    echo "⚠️ No phone for sender {$message['sender']}, cannot import or send.\n";
                    continue;
                }
            }
        }
    }
}


// ================== SUPPORTING FUNCTIONS ===================== //

function isCodeExist($code, $user_id)
{
    $stmt = DB->prepare("
        SELECT goods.part_number, patterns.*
        FROM goods
        INNER JOIN patterns ON patterns.id = goods.pattern_id
        WHERE goods.part_number LIKE :part_number
          AND goods.is_deleted = 0
          AND patterns.is_bot_allowed = 1
          AND patterns.user_id = :user_id
        ORDER BY patterns.id DESC
    ");

    $pattern = "%" . $code . "%";
    $stmt->bindParam(":part_number", $pattern);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results[0] ?? [];
}

function getUserDefaultMessage($user_id)
{
    global $defaultMessageCache;

    if (isset($defaultMessageCache[$user_id])) {
        return $defaultMessageCache[$user_id];
    }

    $stmt = DB->prepare("SELECT message FROM default_message WHERE user_id = ? LIMIT 1");
    $stmt->execute([$user_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $defaultMessageCache[$user_id] = $result ? trim($result['message']) : 'برای قیمت تماس بگیرید';
    return $defaultMessageCache[$user_id];
}

function markAsResolved($id)
{
    $stmt = DB->prepare("UPDATE incoming SET is_resolved = 1 WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

function saveGivenPrice($receiver, $message, $account)
{
    $stmt = DB->prepare("INSERT INTO outgoing (receiver, message, user_id) VALUES (:receiver, :message, :account)");
    $stmt->bindParam(':receiver', $receiver);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':account', $account);
    $stmt->execute();
}

function getMessages()
{
    $stmt = DB->prepare("SELECT * FROM incoming WHERE is_resolved = 0");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function isValidContact($contact_id, $user_id)
{
    $stmt = DB->prepare("SELECT 1 FROM contacts WHERE api_bot_id = :account_id AND user_id = :user_id AND is_blocked = 0");
    $stmt->execute([
        ':account_id' => $contact_id,
        ':user_id' => $user_id
    ]);
    return (bool) $stmt->fetchColumn();
}

function getAccounts()
{
    $stmt = DB->prepare("SELECT * FROM telegram_credentials WHERE is_connected = 1");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserContacts($user_id)
{
    $stmt = DB->prepare("SELECT * FROM contacts WHERE user_id = :user_id AND is_blocked = 0");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function filterCode($message)
{
    if (empty($message)) {
        return [];
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

    return array_values(array_filter($finalCodes));
}

function getPhoneNumber($sender, $user_id)
{
    $stmt = DB->prepare("SELECT phone FROM contacts WHERE api_bot_id = :api_bot_id AND user_id = :user_id ORDER BY id DESC LIMIT 1");
    $stmt->bindParam(':api_bot_id', $sender);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['phone'] ?? null;
}
