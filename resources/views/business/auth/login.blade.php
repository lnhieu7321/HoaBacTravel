<head>
    <link rel="stylesheet" href="./assets/css/login.css" />
</head>

<body>
    <div class="btn-admin">
        <a class="admin" href="../../admin/auth/login.blade.php">Quản trị</a>
    </div>

    <div class="container" id="container">
        <!-- form đăng ký -->
        <div class="form-container sign-up-container">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h1 class="title">Tạo tài khoản</h1>

                <input class="inputinfo" type="text" placeholder="Tên người dùng" id="name" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                <input class="inputinfo" type="email" placeholder="Email" id="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <input class="inputinfo" type="tel" placeholder="Số điện thoại" id="phone" name="phone" :value="old('phone')" required autocomplete="tel" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                <input class="inputinfo" type="password" placeholder="Mật khẩu" id="password" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <input class="inputinfo" type="password" placeholder="Nhập lại Mật khẩu" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                <button class="btn_main" type="submit">{{ __('Đăng ký') }}</button>
            </form>
        </div>
        <!-- form đăng nhập -->
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1 class="title">Đăng nhập</h1>
                <input class="inputinfo" type="email" placeholder="Email" id="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <input class="inputinfo" type="password" placeholder="Mật khẩu" id="password" class="block mt-1 w-full" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Quên mật khẩu?') }}
                </a>
                @endif
                <button class="btn_main" type="submit">{{ __('Đăng nhập') }}</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="title">Chào mừng trở lại!</h1>
                    <p>
                        Để duy trì kết nối với chúng tôi vui lòng đăng nhập bằng thông tin
                        cá nhân của bạn
                    </p>
                    <button class="ghost move" id="signIn">Đăng nhập</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="title">Chào bạn!</h1>
                    <p>
                        Nhập thông tin cá nhân của bạn và bắt đầu hành trình với chúng tôi
                    </p>
                    <button class="ghost move" id="signUp">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/js/login.js"></script>
</body>