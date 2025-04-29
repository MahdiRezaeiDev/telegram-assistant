<?php
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به تلگرام - رمز عبور</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">وارد کردن رمز عبور</h1>
        <form method="post" action="" class="space-y-4">
            <input type="password" name="password" placeholder="رمز عبور خود را وارد کنید" class="w-full p-2 border border-gray-300 rounded-md" required>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md">ورود</button>
        </form>
    </div>
</body>

</html>