<?php

use danog\MadelineProto\API;
use danog\MadelineProto\Settings;
use danog\MadelineProto\Exception;

// Setup
define('DIR', __DIR__);

require_once DIR . '/vendor/autoload.php';
require_once DIR . '/config/constants.php';
require_once DIR . '/database/DB_connect.php';
require_once DIR . '/utilities/helper.php';

$messages = getMessages();
$accounts = getAccounts();

foreach ($accounts as $account) {
    $sessionName = getAccountSession($account['user_id']);
    $sessionPath = DIR . '/views/telegram/sessions/' . $sessionName;

    try {
        // ✅ Use Settings object instead of array
        $settings = (new Settings)
            ->setAppInfo((new Settings\AppInfo)
                ->setApiId($account['api_id']) // Use the API ID from the account
                ->setApiHash($account['api_hash']));

        $MadelineProto = new API($sessionPath, $settings);

        try {
            $MadelineProto->start(); // This will prompt login only if session doesn't exist
        } catch (\Throwable $th) {
            echo "⚠️ Skipping user_id {$account['user_id']} due to failed login: " . $th->getMessage() . "\n";
            continue;
        }

        $self = $MadelineProto->getSelf();
        $myId = $self['id'];

        foreach ($messages as $message) {
            if ($message['sender'] == $myId) continue;
            if (!isValidContact($message['sender'], $account['user_id'])) continue;

            $codes = filterCode($message['message']);
            if (empty($codes)) continue;

            $template = '';
            foreach ($codes as $code) {
                $code = strtoupper($code);
                $goodSpecification = isCodeExist($code, $account['user_id']);
                if (empty($goodSpecification)) continue;

                if ($goodSpecification['without_price']) {
                    $template .= "$code : برای قیمت تماس بگیرید\n";
                } else {
                    $template .= "$code : {$goodSpecification['price']} {$goodSpecification['brand']}\n";
                }
            }

            if (!empty($template)) {
                try {
                    $MadelineProto->messages->sendMessage(peer: $message['sender'], message: $template);
                    markAsResolved($message['id']);
                    saveGivenPrice($message['sender'], $template, $account['user_id']);
                } catch (\Throwable $th) {
                    // Try importing contact and retry
                    $phone = getPhoneNumber($message['sender'], $account['user_id']);
                    if ($phone) {
                        $MadelineProto->contacts->importContacts([[
                            '_' => 'inputPhoneContact',
                            'client_id' => 0,
                            'phone' => $phone,
                            'first_name' => 'Unknown',
                            'last_name' => ''
                        ]]);
                        // Retry
                        $MadelineProto->messages->sendMessage(peer: $message['sender'], message: $template);
                        markAsResolved($message['id']);
                        saveGivenPrice($message['sender'], $template, $account['user_id']);
                    }
                }
            }
        }
    } catch (\Throwable $th) {
        echo "❌ Failed to initialize for user_id {$account['user_id']}: " . $th->getMessage() . "\n";
        continue;
    }
}


function isCodeExist($code, $user_id)
{
    $stmt = DB->prepare("SELECT goods.part_number, patterns.* FROM goods 
    INNER JOIN patterns ON patterns.id = goods.pattern_id
    WHERE 
    goods.part_number LIKE :part_number 
    AND is_deleted = 0 
    AND patterns.is_bot_allowed = 1
    AND patterns.user_id = :user_id ORDER BY patterns.id DESC");

    $pattern = "%" . $code . "%";
    $stmt->bindParam(":part_number", $pattern);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results[0] ?? [];
}

function markAsResolved($id)
{
    $stmt = DB->prepare("UPDATE incoming SET is_resolved = 1 WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

function saveGivenPrice($receiver, $message, $account)
{
    $stmt = DB->prepare("INSERT INTO outgoing SET receiver = :receiver , message = :message, user_id = :account;");
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
    return $stmt->fetchColumn() !== false;
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

function getPhoneNumber($sender, $user_id)
{
    $stmt = DB->prepare("SELECT phone FROM contacts WHERE api_bot_id = :api_bot_id AND user_id = :user_id ORDER BY id DESC LIMIT 1");
    $stmt->bindParam(':api_bot_id', $sender);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['phone'] ?? null;
}
