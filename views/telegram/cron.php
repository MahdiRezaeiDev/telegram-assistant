<?php

use danog\MadelineProto\API;

define('DIR', __DIR__);

require_once DIR . '/../../vendor/autoload.php';
require_once DIR . '/../../config/constants.php';
require_once DIR . '/../../database/DB_connect.php';
require_once DIR . '/../../utilities/helper.php';

$messages = getMessages();
$accounts = getAccounts();

$defaultMessageCache = []; // cache for user default messages

foreach ($accounts as $account) {
    $sessionName = getAccountSession($account['user_id']);

    // Skip if session file doesn't exist or is not readable
    if (!isSessionValid($account['session_name'])) {
        echo "⏭️ Skipping account {$account['user_id']} - session file not found or invalid: {$account['session_name']}\n";
        continue;
    }

    try {
        $MadelineProto = new API($account['session_name']);
        $MadelineProto->start();

        // Verify the account is actually logged in
        if (!isAccountLoggedIn($MadelineProto)) {
            echo "⏭️ Skipping account {$account['user_id']} - not logged in\n\n\n\n";
            continue;
        }

        // Process messages for this account
        processMessagesForAccount($MadelineProto, $account, $messages);
    } catch (\Throwable $th) {
        echo "❌ Failed to start session for user_id {$account['user_id']}: " . htmlspecialchars($th->getMessage()) . "\n";

        // Update database to mark as disconnected if it's an auth issue
        if (isAuthError($th)) {
            markAccountAsDisconnected($account['user_id']);
        }
        continue;
    }
}

// ================== NEW SUPPORTING FUNCTIONS ===================== //

function isSessionValid($sessionPath)
{
    // Check if session file exists and is readable
    if (!file_exists($sessionPath) || !is_readable($sessionPath)) {
        return false;
    }

    // Optional: Check if session file has reasonable size
    $fileSize = filesize($sessionPath);
    if ($fileSize < 100) { // Less than 100 bytes probably invalid
        return false;
    }

    return true;
}

function isAccountLoggedIn($MadelineProto)
{
    try {
        $me = $MadelineProto->getSelf();
        return !empty($me) && isset($me['id']);
    } catch (\Throwable $th) {
        return false;
    }
}

function isAuthError($exception)
{
    $message = $exception->getMessage();
    $authErrors = [
        'auth',
        'login',
        'session',
        'expired',
        'revoked',
        'invalid',
        'unauthorized'
    ];

    foreach ($authErrors as $error) {
        if (stripos($message, $error) !== false) {
            return true;
        }
    }
    return false;
}

function processMessagesForAccount($MadelineProto, $account, $messages)
{
    $user_id = $account['user_id'];
    $processedCount = 0;

    foreach ($messages as $message) {
        // All accounts process ALL messages (no user_id filtering)
        try {
            $sender = $message['sender'];
            $messageText = $message['message'];

            // Check if contact is valid for THIS account
            if (!isValidContact($sender, $user_id)) {
                // Don't mark as resolved here - other accounts might still process it
                continue;
            }

            // Extract codes from message
            $codes = filterCode($messageText);

            if (empty($codes)) {
                $defaultMessage = getUserDefaultMessage($user_id);
                sendMessage($MadelineProto, $sender, $defaultMessage, $user_id, $message['id']);
                $processedCount++;
                continue;
            }

            // Process each code
            $response = processCodes($codes, $user_id);

            if (!empty($response)) {
                sendMessage($MadelineProto, $sender, $response, $user_id, $message['id']);
            } else {
                $defaultMessage = getUserDefaultMessage($user_id);
                sendMessage($MadelineProto, $sender, $defaultMessage, $user_id, $message['id']);
            }

            $processedCount++;
        } catch (\Throwable $th) {
            echo "❌ Error processing message {$message['id']} for account $user_id: " . $th->getMessage() . "\n";
        }
    }

    echo "✅ Account $user_id processed $processedCount messages\n";
}

function sendMessage($MadelineProto, $receiver, $message, $user_id, $incoming_id)
{
    try {
        $MadelineProto->messages->sendMessage([
            'peer' => $receiver,
            'message' => $message,
            'parse_mode' => 'HTML'
        ]);

        // Save to outgoing
        saveGivenPrice($receiver, $message, $user_id);

        echo "📤 Account $user_id sent message to $receiver\n";
    } catch (\Throwable $th) {
        echo "❌ Account $user_id failed to send message to $receiver: " . $th->getMessage() . "\n";

        // If it's an auth error, mark account as disconnected
        if (isAuthError($th)) {
            markAccountAsDisconnected($user_id);
            throw $th; // Re-throw to stop processing for this account
        }
    }
}

function processCodes($codes, $user_id)
{
    $results = [];

    foreach ($codes as $code) {
        $product = isCodeExist($code, $user_id);

        if (!empty($product)) {
            $price = formatProductResponse($product, $code);
            $results[] = $price;
        }
    }

    return implode("\n\n", $results);
}

function formatProductResponse($product, $originalCode)
{
    return "کد: {$originalCode}\n" .
        "قیمت: " . ($product['price'] ?? 'تماس بگیرید') . "\n" .
        "موجودی: " . ($product['stock'] ?? 'نامشخص');
}

// ================== YOUR EXISTING FUNCTIONS ===================== //

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
    $stmt = DB->prepare("SELECT * FROM telegram_credentials WHERE is_connected = 1 ORDER BY user_id");
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
