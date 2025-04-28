<?php
$pageTitle = "ورود به حساب کاربری";
require_once './components/header.php'; ?>
<main>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-screen lg:py-0">
        <a href="https://cheraghbargh.ir/" class="pb-5">
            <img src=" ../../public/img/CheraghBragh-LOGO.png" alt="logo" class="w-62 h-20 ml-2">
        </a>

        <div class="w-full bg-white rounded-lg md:mt-0 sm:max-w-md xl:p-0 shadow-lg">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 text-center">
                    ورود به حساب کاربری
                </h1>
                <form class="space-y-4 md:space-y-6" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900"> نام کاربری</label>
                        <input onkeyup="convertToEnglish(this)" type="text" name="username" id="username" minlength="3" maxlength="15" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-400  focus:ring-blue-500 focus:border-blue-500" placeholder="نام کاربری خود را وارد نمایید." required>
                    </div>
                    <div class="relative">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">رمز عبور</label>
                        <img onclick="togglePasswordInputType(this)" title="مشاهده/ پنهان کردن رمز عبور" src="../../public/icons/eye.svg" alt="eye icon" class="material-icons cursor-pointer" style="position: absolute; left:5px; top: 50%">
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <?= !empty($login_err) ? "<p class='text-sm text-red-700'>نام کاربری و یا رمز عبور اشتباه است.</p>" : "" ?>
                    </div>
                    <button type="submit" id="submit" class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded text-sm px-5 py-3 text-center">ورود به حساب</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php
require_once './components/footer.php';
