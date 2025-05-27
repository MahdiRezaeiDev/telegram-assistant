
# Telegram Auto-Responder Bot

This project allows users to connect their **Telegram accounts** to an automated system that reads and responds to incoming messages based on specified patterns.

## ✨ Features

- 🔐 **Secure Session Handling**Each user connects via their own Telegram session for full privacy.
- 🤖 **Auto-Responder Logic**Automatically replies to messages that match a specified pattern (e.g., codes, product inquiries, etc.).
- 🧠 **Custom Pattern Matching**Easily define what message formats trigger a response.
- 📦 **Multi-Account Support**Works with multiple Telegram accounts independently.
- 📊 **Logging and Tracking**
  Messages are marked as resolved and responses are logged.

## ⚙️ How It Works

1. User uploads their Telegram session file (`.madeline` or similar).
2. The system reads new messages.
3. If a message matches a pre-defined pattern (e.g., `ABC-123`), it sends an automated reply.
4. The message is marked as answered and stored in the log.

## 📁 Folder Structure
