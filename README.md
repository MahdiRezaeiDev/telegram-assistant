
# Telegram Auto-Responder Bot

This project allows users to connect their **Telegram accounts** to an automated system that reads and responds to incoming messages based on specified patterns.

## ✨ Features

* 🔐 **Secure Session Handling**

  Each user connects via their own Telegram session for full privacy.
* 🤖 **Auto-Responder Logic**

  Automatically replies to messages that match a specified pattern (e.g., codes, product inquiries, etc.).
* 🧠 **Custom Pattern Matching**

  Easily define what message formats trigger a response.
* 📦 **Multi-Account Support**

  Works with multiple Telegram accounts independently.
* 📊 **Logging and Tracking**

  Messages are marked as resolved and responses are logged.

## ⚙️ How It Works

1. User uploads their Telegram session file (`.madeline` or similar).
2. The system reads new messages.
3. If a message matches a pre-defined pattern (e.g., `ABC-123`), it sends an automated reply.
4. The message is marked as answered and stored in the log.

## 📁 Folder Structure

```
telegram-auto-responder/
├── sessions/               # Stores Telegram session files
├── src/
│   ├── MessageHandler.php  # Core logic to match and respond
│   ├── BotRunner.php       # Initializes and runs the bot
├── views/                  # UI and upload forms
├── public/                 # Entry point and assets
├── README.md
└── composer.json
```

## 🚀 Installation

1. **Clone the repository**

```bash
git clone https://github.com/yourusername/telegram-auto-responder.git
cd telegram-auto-responder
```

2. **Install dependencies**

```bash
composer install
```

3. **Set write permissions** (for sessions)

```bash
chmod -R 755 views/telegram/sessions
```

4. **Run the system**

You can start the bot via a PHP entry file (e.g., `index.php`) or schedule it via cron for periodic checks.

## 🛠 Requirements

* PHP 8.0+
* Composer
* [MadelineProto](https://github.com/danog/MadelineProto)

## 📌 Notes

* This project  **does not use Telegram Bot API** . It uses  **MadelineProto** , which provides full access like a real Telegram user.
* Make sure to follow [Telegram&#39;s Terms of Service](https://telegram.org/tos) when automating responses.

## 📄 License

MIT License © 2025 [Mahdi Rezaei]
